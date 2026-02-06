<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a new comment
     */
    public function store(Request $request)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to comment'
            ], 401);
        }

        // Validate input
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
            'page' => 'required|string|max:50',
            'parent_comment_id' => 'nullable|integer|exists:comments,id'
        ]);

        // Create comment
        $comment = Comment::create([
            'user_id' => Auth::id(),
            'comment' => $validated['comment'],
            'page' => $validated['page'],
            'parent_comment_id' => $validated['parent_comment_id'] ?? null
        ]);

        // Load user relationship
        $comment->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Comment posted successfully',
            'comment' => $comment
        ], 201);
    }

    /**
     * Get all comments for a page
     */
    public function getComments(Request $request)
    {
        $page = $request->query('page', 'welcome');
        
        // Get comments for the page
        $comments = Comment::where('page', $page)
            ->with('user', 'votes')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'comments' => $comments
        ]);
    }

    /**
     * Vote on a comment (like/dislike)
     */
    public function vote(Request $request, Comment $comment)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to vote'
            ], 401);
        }

        $validated = $request->validate([
            'vote_type' => 'required|in:like,dislike'
        ]);

        $userId = Auth::id();

        // Check if user already voted on this comment
        $existingVote = CommentVote::where('user_id', $userId)
            ->where('comment_id', $comment->id)
            ->first();

        if ($existingVote) {
            // If same vote type, remove it (toggle)
            if ($existingVote->vote_type === $validated['vote_type']) {
                $existingVote->delete();
                
                // Update comment counts
                if ($validated['vote_type'] === 'like') {
                    $comment->decrement('likes_count');
                } else {
                    $comment->decrement('dislikes_count');
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Vote removed',
                    'comment' => $comment->fresh()
                ]);
            } else {
                // Change vote type
                $oldType = $existingVote->vote_type;
                $existingVote->vote_type = $validated['vote_type'];
                $existingVote->save();

                // Update counts
                if ($oldType === 'like') {
                    $comment->decrement('likes_count');
                } else {
                    $comment->decrement('dislikes_count');
                }

                if ($validated['vote_type'] === 'like') {
                    $comment->increment('likes_count');
                } else {
                    $comment->increment('dislikes_count');
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Vote changed',
                    'comment' => $comment->fresh()
                ]);
            }
        }

        // Create new vote
        CommentVote::create([
            'user_id' => $userId,
            'comment_id' => $comment->id,
            'vote_type' => $validated['vote_type']
        ]);

        // Update comment count
        if ($validated['vote_type'] === 'like') {
            $comment->increment('likes_count');
        } else {
            $comment->increment('dislikes_count');
        }

        return response()->json([
            'success' => true,
            'message' => 'Vote recorded',
            'comment' => $comment->fresh()
        ]);
    }

    /**
     * Delete a comment (only owner or admin)
     */
    public function destroy(Comment $comment)
    {
        if (!Auth::check() || Auth::id() !== $comment->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted'
        ]);
    }
}


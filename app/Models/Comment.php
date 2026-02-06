<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['user_id', 'comment', 'page', 'parent_comment_id', 'likes_count', 'dislikes_count'];

    /**
     * Get the user who made this comment
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get replies to this comment
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_comment_id');
    }

    /**
     * Get parent comment if this is a reply
     */
    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'parent_comment_id');
    }

    /**
     * Get all votes on this comment
     */
    public function votes()
    {
        return $this->hasMany(CommentVote::class);
    }
}


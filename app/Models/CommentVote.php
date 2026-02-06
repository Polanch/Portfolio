<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentVote extends Model
{
    protected $table = 'comment_votes';
    protected $fillable = ['user_id', 'comment_id', 'vote_type'];

    /**
     * Get the user who made this vote
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the comment being voted on
     */
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}

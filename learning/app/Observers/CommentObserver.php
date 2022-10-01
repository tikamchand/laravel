<?php

namespace App\Observers;

use App\Models\comment;
use Illuminate\Support\Facades\Cache;

class CommentObserver
{
    /**
     * Handle the comment "created" event.
     *
     * @param  \App\Models\comment  $comment
     * @return void
     */
    public function creating(comment $comment)
    {
        if($comment->commentable_type === App\Models\BlogPost::class){
            Cache::tags(['blog-post'])->forget("blog-post-{$comment->commentable_id}");
            Cache::tags(['blog-post'])->forget("mostCommented");
        }
    }

   
}

<?php

namespace App\Listeners;

use App\Jobs\NotifyUsersPostWasCommented;
use App\Jobs\ThrottledMail;
use App\Mail\CommentPostedMarkdown;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUsersAbout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    { 
        ThrottledMail::dispatch(
            new CommentPostedMarkdown($event->comment), 
            $event->comment->commentable->user
        )->onQueue('low');
        NotifyUsersPostWasCommented::dispatch($event->comment)
            ->onQueue('high');
    }
}

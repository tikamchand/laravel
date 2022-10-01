<?php

namespace App\Mail;

use App\Models\comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentPosted extends Mailable
{
    use Queueable, SerializesModels;
    public $comment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Comment was posted on your {$this->comment->commentable->title} blog post";
        return $this
        // ->attach(
        //     storage_path('app/public') . '/' . $this->comment->user->image->path,
        //     [
        //         'as' => 'profile_picture.jpeg'
        //     ]
        // )
        ->subject($subject)
        ->view('emails.posts.commented');
    }
}

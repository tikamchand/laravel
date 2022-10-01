<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Jobs\NotifyUsersPostWasCommented;
use App\Mail\CommentPosted;
use App\Mail\CommentPostedMarkdown;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostCommentController extends Controller
{
   public function __construct(){
     $this->middleware('auth')->only(['store']);
   }
  public function store(BlogPost $post, StoreComment $request) {
    $comment = $post->comments()->create([ 
    'content' => $request->input('content'),
    'user_id' => $request->user()->id
 ]);
  Mail::to($post->user)->queue(
      new CommentPostedMarkdown($comment)  
  );
    NotifyUsersPostWasCommented::dispatch($comment);
   $request->session()->flash('status', 'Comment was created !');
   return redirect()->back();
   }
}

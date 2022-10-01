@auth    
<form method="POST" action="{{route('posts.comments.store', ['post'=> $posts->id]) }}">
    @csrf 
<div class="mb-3">
    <textarea name="content" cols="30" rows="10" class="form-control">
    </textarea>
</div>
<button type="submit" class="btn btn-primary btn-block">Add comment</button>    
</form>
@else
<a href="{{ route('login') }}">Sign-in </a>to post comments!
@endauth
<hr/>
@extends('layout.app')
@section('title',$posts['title'])
@section('content')
{{-- @if($posts['is_new'])
<div>This will render if is_new is true for posts.</div>
@endif --}}
{{-- @unless ($posts['is_new'])
<div>It is show using unless condition</div>
@endunless --}}

<h1>{{$posts['title']}}</h1>
<p>{{$posts['content']}}</p>
<p>Added {{$posts->created_at->diffForHumans()}}</p>
@if(now()->diffForHumans($posts->created_at)< 5)
<div class="alert alert-info">New !</div>
@endif
<h4>Comments</h4>
@forelse($posts->comments as $comment)
<p>
    {{$comment->content}}, added {{$comment->created_at->diffForHumans()}}
</p>
@empty
<p>No comments yet !</p>
@endforelse    
@endsection
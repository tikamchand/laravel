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
{{-- <p>Added {{$posts->created_at->diffForHumans()}}</p> --}}
<x-updated>
    <x-slot name="slot">Added</x-slot>
    {{-- <x-slot name="date">{{ 'date' => $post->created_at }}</x-slot> --}}
    {{-- <x-slot name="name">{{ 'name' => $post->user->name }}</x-slot> --}}
</x-updated>
@if((new Carbon\Carbon())->diffInMinutes($posts->created_at)< 450)
   <x-badge>
    <x-slot name='slot'>new comment</x-slot>
   </x-badge>
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
@extends('layout.app')
@section('title',$posts['title'])
@section('content')

<h1>{{$posts['title']}}</h1>
<p>{{$posts['content']}}</p>
<p>Added {{$posts->created_at->diffForHumans()}}</p>
<x-updated>
    <x-slot name="slot">Added</x-slot>
    <x-slot name="date">{{ $posts->created_at }}</x-slot>
    <x-slot name="name">{{ $posts->user->name }}</x-slot>
</x-updated>
<x-tags>
    <x-slot name="tag">
        {{-- {{  $posts->tags }} --}}
    </x-slot>
</x-tags>
@if((new Carbon\Carbon())->diffInMinutes($posts->created_at)< 450)
   <x-badge>
    <x-slot name='slot'>new comment</x-slot>
   </x-badge>
@endif
<p>Currently read by {{ $counter }} people</p>
<h4>Comments</h4>
@forelse($posts->comments as $comment)
<p>
    {{$comment->content}}, added {{$comment->created_at->diffForHumans()}}
</p>
@empty
<p>No comments yet !</p>
@endforelse   
<div class="col-4">
    {{-- @include('posts.partials.activity')</div>  --}}
@endsection
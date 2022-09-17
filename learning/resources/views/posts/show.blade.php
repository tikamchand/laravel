@extends('layout.app')
@section('title',$posts['title'])
@section('content')
@if($posts->image)
<div style="background-image: url('{{ $posts->image->url() }}'); min-height: 500px; color: white; text-align: center; background-attachment: fixed;">
    <h1 style="padding-top: 100px; text-shadow: 1px 2px #000">
@else
    <h1>
@endif
    {{ $posts->title }}
    {{-- @badge(['show' => now()->diffInMinutes($posts->created_at) < 30])
        Brand new Post!
    @endbadge --}}
@if($posts->image)    
    </h1>
</div>
@else
    </h1>
@endif
{{-- <h1>{{$posts['title']}}</h1> --}}
<p>{{$posts['content']}}</p>
<p>Added {{$posts->created_at->diffForHumans()}}</p>
{{-- <img src="http://127.0.0.1:8000/{{ $posts->image->path }}" alt=""> --}}
{{-- <img src="{{ $posts->image->url() }}" alt=""> --}}
<x-updated>
    <x-slot name="slot">Added</x-slot>
    <x-slot name="date">{{ $posts->created_at }}</x-slot>
    <x-slot name="name">{{ $posts->user->name }}</x-slot>
</x-updated>
<x-tags>
    <x-slot name="tag">
        {{  $posts->tags }}
    </x-slot>
</x-tags>
@if((new Carbon\Carbon())->diffInMinutes($posts->created_at)< 450)
   <x-badge>
    <x-slot name='slot'>new comment</x-slot>
   </x-badge>
@endif
<p>Currently read by {{ $counter }} people</p>
<h4>Comments</h4>
@include('comments._form')
@forelse($posts->comments as $comment)
<p>
    {{$comment->content}}
</p>
added {{$comment->created_at->diffForHumans()}}
<x-updated>
    <x-slot name="slot">Added</x-slot>
    <x-slot name="date">{{ $comment->created_at }}</x-slot>
    <x-slot name="name">{{ $comment->user->name }}</x-slot>
</x-updated>
@empty
<p>No comments yet !</p>
@endforelse   
<div class="col-4">
    {{-- @include('posts.partials.activity')</div>  --}}
@endsection
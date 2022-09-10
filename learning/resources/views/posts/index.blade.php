@extends('layout.app')
@section('title','Blog post')
@section('content')
@forelse ($posts as $key => $posts)
@include('posts.partials.post')
@empty
No Posts found !
@endforelse
@endsection                                             
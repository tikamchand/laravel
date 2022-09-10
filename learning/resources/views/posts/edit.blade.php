@extends('layout.app')
@section('title','update')
@section('content')
<form action="{{ route('posts.update', ['post' => $post ->id])}}" method="POST">
    @csrf
    @method('put')
    @include('posts.partials.form')
    <div><button type="submit" value="update">Update</button></div>
</form>
@endsection
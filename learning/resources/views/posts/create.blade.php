@extends('layout.app')
@section('title','form')
@section('content')
<form action="{{ route('posts.store')}}" method="POST">
    @csrf
    @include('posts.partials.form')
    <div><button type="submit" class="btn btn-primary">submit</button></div>
</form>
@endsection

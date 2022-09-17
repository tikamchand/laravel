@extends('layout.app')
@section('title','form')
@section('content')
<form action="{{ route('posts.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('posts.partials.form')
    <div><button type="submit" class="btn btn-primary">submit</button></div>
</form>
@endsection

@extends('layout.app')
@section('title','Contacts')
@section('content')
<h3>This is the Contact page using a blade templete.</h3>
@can('home.secret')
<p>
    <a href="{{route('home.secret')}}">Got to differetn wordl</a>
</p>
@endcan
@endsection
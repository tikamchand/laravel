@extends('layouts.app')
@section('content')
<div class="container">
    <form method="POST" action="{{route('order.store') }}">
        <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Name</label>
      <input type="text" name="name" class="form-control" id="exampleInputEmail1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Phone number</label>
        <input type="phone" name="phone" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Address</label>
      <textarea name="address" class="form-control" id="exampleInputPassword1"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
@endsection
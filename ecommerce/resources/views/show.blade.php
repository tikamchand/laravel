@extends('layouts.app')
@section('content')
<div class="container">

  <div class="card mb-3">
    <img src="{{ asset($product->image) }}" class="card-img-top" alt="Shoe image"  style="width: 100%;height:600px">
    <div class="card-body">
      <h5 class="card-title"><b>{{ $product->product_name }}</b></h5>
      <p class="card-text">Description:</p>
      <p class="card-text">{{ $product->product_description }}</p>
      <p class="card-text">Price: <b>Rs</b> {{ $product->product_price }}</p>
      <p class="card-text">Quantity: {{ $product->product_quantity }}</p>
      <a href="#" class="btn btn-primary">Add to cart</a>
    </div>
  </div>
</div>
@endsection
@extends('layouts.app')
@section('content')
<div class="card mb-3">
    <img src="{{ asset($product->image) }}" class="card-img-top" alt="Shoe image">
    <div class="card-body">
      <h5 class="card-title">{{ $product->product_name }}</h5>
      <p class="card-text">Description:</p>
        <p class="card-text">{{ $product->product_description }}</p>
        <p class="card-text">Price: Rs{{ $product->product_price }}</p>
        <p class="card-text">Quantity: {{ $product->product_quantity }}</p>
        <a href="#" class="btn btn-primary">Add to cart</a>
    </div>
  </div>
@endsection
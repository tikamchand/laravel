@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Products:</h2>
<div class="card-deck" style="display: flex; flex-wrap:wrap">
    @foreach ($products as $product)
    <div class="card  m-2 " style="width: 18rem;">
      <img class="card-img-top" src="{{ asset($product->image) }}" alt="Card image cap" style="height: 12rem">
      <div class="card-body">
        <h5 class="card-title">{{ $product->product_name }}</h5>
        {{-- <p class="card-text">Description:</p>         --}}
        {{-- <p class="card-text">{{ \Illuminate\Support\Str::limit($product->product_description, 35, $end='...') }}</p> --}}
        {{-- <p class="card-text">{{ $product->product_description }}</p> --}}
        <div>Price: Rs {{ $product->product_price }}</div>
        <div>In-Stock: {{ $product->product_quantity }}</div>
        @auth
        <a href="{{ route('products.show', [$product->id])}}" class="btn btn-primary">Details</a>
        @else
        <a href="{{ route('login')}}" class="btn btn-primary">Sign-in to shop</a>
        @endauth
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection

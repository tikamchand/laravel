@extends('layouts.app')

@section('content')
<div class="container">
<div class="card-deck" style="display: flex; flex-wrap:wrap">
    @foreach ($products as $product)
    {{ dd($product->id) }}
    <div class="card  m-2 " style="width: 18rem;">
      <img class="card-img-top" src="{{ asset($product->image) }}" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">{{ $product->product_name }}</h5>
        <p class="card-text">Description:</p>
        <p class="card-text">{{ $product->product_description }}</p>
        <p class="card-text">Price: Rs{{ $product->product_price }}</p>
        <p class="card-text">Quantity: {{ $product->product_quantity }}</p>
        <a href="{{ route('products.show'), ['id' => $product->id] }}" class="btn btn-primary">Details</a>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection

@extends('layouts.app')
@section('content')
<div class="container">
  <h2>Cart:</h2>
  @if ($userProducts->count() == 0)
  <div class="alert alert-info" role="alert">
    <h3> Nothing in your Cart! <a href="{{ route('products.index') }}">Click to buy</a></h3>
  </div>
  @else
  @foreach ($userProducts as $index => $product)
  <div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="{{ asset($product->image) }}" class="img-fluid rounded-start" alt="shoe image" style="height=100%"">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">{{ $product->product_name}}</h5>
          <p class="card-text mb-1"><b>Quantity:</b> {{ $user_cart[$index]->quantity}}</p>
          <p class="card-text mb-1"><b>Price:</b> {{ $product->product_price}}</p>
          <p class="card-text mb-1"><b>Total Price:</b> Rs {{ $user_cart[$index]->quantity * $product->product_price}}</p>
            <div class="block">
              <a href="" class="btn btn-primary">Order</a>
            </div>
          <div class="inline">
            <form action="{{ route('cart.destroy', [$user_cart[$index]->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit"  class="btn btn-danger mt-2">Delete</button>
            </form>
          </div>
      </div>
    </div>
  </div>
</div>
@endforeach
{{-- @endforeach --}}
@endif
</div>
@endsection
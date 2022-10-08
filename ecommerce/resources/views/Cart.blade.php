@extends('layouts.app')
@section('content')
<div class="container">
  <h2>Cart:</h2>
  <div class="row">
    @if ($userProducts->count() == 0)
    <div class="alert alert-info" role="alert">
    <h3> Nothing in your Cart! <a href="{{ route('products.index') }}">Click to buy</a></h3>
  </div>
  @else
  <div class="col-8">
    @foreach ($userProducts as $index => $product)
    <div class="card mb-3" style="width: 540px;">
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
                  {{-- <div class="block">
                      <a href="{{ route("order.index") }}" class="btn btn-primary">Order</a>
                  </div> --}}
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
</div>
@endif
<div class="col-4">
  <div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">Cart's total</h5>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Product name</th>
            <th scope="col">Price</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($userProducts as $index => $product)
          <tr>
            <th scope="row"><i class="bi bi-caret-right-fill"></i></th>
            <td>{{ $product->product_name }}</td>
            <td>Rs {{ $user_cart[$index]->quantity * $product->product_price }}</td>
          </tr>
          @endforeach

        </tbody>
      </table>      
      <a href="{{ route('order.index')}}" class="btn btn-primary">Order</a>
    </div>
  </div>
</div>
</div>
</div>
@endsection
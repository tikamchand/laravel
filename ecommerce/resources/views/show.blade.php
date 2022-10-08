@extends('layouts.app')
<script>
  setTimeout(function() 
{ 
    document.getElementById("status").style.display = "none"; 
}, 3000);
</script>
@section('content')
<div class="container">
  <div class="card mb-3">
    <img src="{{ asset($product->image) }}" class="card-img-top" alt="Shoe image"  style="width: 100%;height:600px">
    <div class="card-body">
      <h5 class="card-title"><b>{{ $product->product_name }}</b></h5>
      <p class="card-text">Description:</p>
      <p class="card-text">{{ $product->product_description }}</p>
      <p class="card-text">Price: <b>Rs </b> {{ $product->product_price }}</p>
      @if ($product->product_quantity == 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Product out of stock</strong>
        </div>
      @else
        <p class="card-text">Quantity: {{ $product->product_quantity }}</p>
        <form action="{{ route("cart.store")}}" method="POST">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <input type="number" class="form-control mb-3" name="quantity" id="exampleFormControlInput1" placeholder="Enter quantity"  style='width:20%'> 
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          @if(session()->has('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="status">
              <strong>{{ session()->get('status') }}</strong>
            </div>
          @endif
          <button type="submit" class="btn btn-primary">Add to cart</button>   
        </form> 
      @endif
     
      </div>
  </div>
</div>
@endsection
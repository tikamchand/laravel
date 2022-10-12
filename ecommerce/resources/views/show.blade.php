@extends('layouts.app')
<script>
  setTimeout(function() 
{ 
    document.getElementById("status").style.display = "none"; 
}, 3000);
</script>
<style>
  .card:hover{
    transform: scale(1.03);
    transition: all 0.3s ease-in-out;
  }
</style>
@section('content')
 {{-- {{ dd($cart) }} --}}
<div class="container">
  <div class="row g-5">
    <div class="col-md-7">
      <img src="{{ asset($product->image) }}" class="img-fluid rounded-start" alt="Shoe image"  style="width: 100%;height:600px">
    </div>
    <div class="col-4">
      <div class="card mb-3">
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
          <div class="input-group mb-4">   
            @if($cart)
            <input type="text" name='quantity' class="form-control" placeholder="Quantity" value="{{ $cart->quantity }}" id="input">
            <button class="btn btn-outline-primary" type="button" id="minus"><i class="bi bi-dash-lg"></i></button>
            <button class="btn btn-outline-primary" type="button" id="plus"><i class="bi bi-plus-lg"></i></button>
            @else
            <input type="text" name='quantity' class="form-control" placeholder="Quantity" value="1" id="input">
            <button class="btn btn-outline-primary" type="button" id="minus"><i class="bi bi-dash-lg"></i></button>
            <button class="btn btn-outline-primary" type="button" id="plus"><i class="bi bi-plus-lg"></i></button>
            @endif
          </div>
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
          <div class="alert alert-{{ session()->get('color') }} alert-dismissible fade show" role="alert" id="status">
            <strong>{{ session()->get('status') }}</strong>
              </div>
              @endif
              <button type="submit" class="btn btn-primary">Add to cart</button>   
            </form> 
            @endif
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    const minusButton = document.getElementById('minus');
    const plusButton = document.getElementById('plus');
    const inputField = document.getElementById('input');

    minusButton.addEventListener('click', event => {
      event.preventDefault();
      const currentValue = Number(inputField.value);
      if(currentValue > 1){
        // console.log(currentValue);
        inputField.value = currentValue - 1;
      }
    });

    plusButton.addEventListener('click', event => {
      event.preventDefault();
      const currentValue = Number(inputField.value);
        inputField.value = currentValue + 1;
    });
  </script>
    @endsection
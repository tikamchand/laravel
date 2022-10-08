@extends('layouts.app')
@section('content')
<div class="container">
  <h2>Payment</h2>
      <form method="POST" action="{{ route('order.store') }}">
        @csrf
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
          <label class="form-label">Total Price</label>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="bi bi-currency-rupee"></i></span>
            <input type="number" class="form-control" aria-label="Amount (to the nearest rupees)" name="total" disabled value="{{ $total }}">
            <span class="input-group-text">.00</span>
          </div>        
          <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Card No</label>
              <input name="cardNo" class="form-control" id="exampleInputPassword1"></input>
          </div>
          <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">CVV</label>
              <input name="cvvNo" class="form-control" id="exampleInputPassword1"></input>
          </div>        
          <button type="submit" class="btn btn-primary"><i class="bi bi-credit-card"></i> Pay via card</button>
      </form>
</div>
@endsection
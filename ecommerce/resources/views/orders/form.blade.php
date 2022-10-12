@extends('layouts.app')
@section('content')
<div class="container">
  <h2>Payment</h2>
</div>
<div class="container d-flex flex-column align-items-center">
      <form method="POST" action="{{ route('order.store') }}" style="width: 50%">
        @csrf
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="exampleInputEmail1">
          </div>
          <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Phone number</label>
              <input type="phone" name="phone" value="{{ old('phone') }}" class="form-control" id="exampleInputPassword1">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword2" class="form-label">Address</label>
            <textarea name="address" class="form-control" value="{{ old('address') }}" id="exampleInputPassword2"></textarea>
          </div>
          <label class="form-label">Total Price</label>
          <div class="input-group mb-3">
            <span class="input-group-text"><i class="bi bi-currency-rupee"></i></span>
            <input type="number" class="form-control" aria-label="Amount (to the nearest rupees)" name="total" disabled value="{{ $total }}">
            <span class="input-group-text">.00</span>
          </div>        
          <div class="mb-3">
              <label for="exampleInputPassword3" class="form-label">Card No</label>
              <input name="cardNo" class="form-control" min="16" max="16" id="exampleInputPassword3"></input>
          </div>
          <div class="mb-3">
              <label for="exampleInputPassword4" class="form-label">CVV</label>
              <input name="cvvNo" class="form-control" min="3" max="3" id="exampleInputPassword4"></input>
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
              <div class="alert alert-danger alert-dismissible fade show" role="alert" id="status">
                <strong>{{ session()->get('status') }}</strong>
              </div>
           @endif
          <button type="submit" class="btn btn-primary"><i class="bi bi-credit-card"></i> Pay via card</button>
      </form>
</div>
@endsection
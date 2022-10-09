@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Your orders</h3>
</div>
<div class="container d-flex flex-column align-items-center">
    @foreach ($userOrders as $index => $userOrder)
    <div class="card mb-3" style="min-width: 750px;">
        <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset($userOrder->image) }}" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $userOrder->product_name }}</h5>
                        <div class="card-text"><b>Name:</b> {{ $orders[$index]->name}}</div>
                        <div class="card-text"><b>Phone:</b> {{ $orders[$index]->phone}}</div>
                        <div class="card-text"><b>Quantity:</b> {{ $orders[$index]->quantity}}</div>
                        <div class="card-text"><b>Total payment:</b> {{ $orders[$index]->payment_details}}</div>
                        <div class="card-text"><b>Shipping Address:</b> {{ $orders[$index]->shipping_details}}</div>
                        <div class="card-text"><small class="text-muted">Order On {{ $orders[$index]->created_at->format('m/d/Y')}}</small></div>
                        <button class="btn btn-danger">Cancel order</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
</div>
@endsection
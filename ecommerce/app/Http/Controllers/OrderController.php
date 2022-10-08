<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\order;
use App\Models\Products;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth')
        ->only(['show','store','delete']);
    } 
    public function index(cart $cart){
        DB::connection()->enableQueryLog();
        $cart = cart::all();
        // dd($cart);
        $total = 0;
        for($i=0;$i<$cart->count();$i++){
            $pd = Products::findOrFail($cart[$i]->products_id);
            $total += $pd->product_price * $cart[$i]->quantity;
        }
        // dd($total);
        return view("orders.form", ['total' => $total]); 
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(order $order, Request $request)
    {
        DB::connection()->enableQueryLog();
        $total = 0;
        $cart = cart::all();
        for($i=0;$i < $cart->count();$i++){
            $pd = Products::findOrFail($cart[0]->products_id);
            $total += $pd->product_price * $cart[0]->quantity;
            
        }
        foreach ($cart as $ct){
            // dd($ct->products_id);
            $order->create([
                'user_id' => auth()->user()->id,
                'products_id' => $ct->products_id,
                'quantity' => $ct->products_id,
                'shipping_details' => $request->input('address'),
                'payment_details' => $total,
                // dd($request->input('total_price'))     
            ]);
        }
        foreach($cart as $ct){
            $ct = cart::findOrFail($ct->id);
           $ct->delete();
        }
        
        return view('home');
    }
      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $user = User::findOrFail($id);
        return view('orders.showOrder',['products' => $user->product]);
    }
}

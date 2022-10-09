<?php

namespace App\Http\Controllers;

use App\Http\Requests\orderProduct;
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
        $total = 0;
        for($i=0;$i<$cart->count();$i++){
            $pd = Products::findOrFail($cart[$i]->products_id);
            $total += $pd->product_price * $cart[$i]->quantity;
        }
        return view("orders.form", ['total' => $total]); 
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(order $order, orderProduct $request)
    {
        DB::connection()->enableQueryLog();
        $total = 0;
        $cart = cart::all();
        for($i=0;$i < $cart->count();$i++){
            $pd = Products::findOrFail($cart[$i]->products_id);
            $total += $pd->product_price * $cart[$i]->quantity;            
        }
        // dd($total);
        foreach ($cart as $ct){
            // dd($cart);
            $pd = Products::findOrFail($ct->products_id);
            $order->create([
                'user_id' => auth()->user()->id,
                'products_id' => $ct->products_id,
                'quantity' => $ct->quantity,
                'shipping_details' => $request->input('address'),
                'payment_details' => $pd->product_price * $ct->quantity,  
                'phone'=>$request->input('phone'),
                'cardNo' => $request->input('cardNo'),
                'name' => $request->input('name')
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
        $order = order::select('*')->where('user_id', $id)->get();
        // dd($order);  
        return view('orders.showOrder',['userOrders' => $user->order, 'orders' => $order]);
    }
}

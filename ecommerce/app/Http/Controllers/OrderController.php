<?php

namespace App\Http\Controllers;

use App\Http\Requests\orderProduct;
use App\Models\cart;
use App\Models\order;
use App\Models\Products;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth')
        ->only(['show','store','delete']);
    } 
    public function index(cart $cart){
        DB::connection()->enableQueryLog();
        $cart = User::find(auth()->user()->id)->cart()->get();;
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

        $cart = User::findOrFail(auth()->user()->id)->cart;;
        // $total = 0;
        // foreach($cart as $cartItem){
        //     $pd = Products::findOrFail($cartItem->products_id);
        //     $total += $pd->product_price * $cartItem->quantity;
        // }
        if($request->input('cardNo') == '4242'){
            foreach ($cart as $ct){
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
        return redirect()->route('order.show', [auth()->user()->id]);
    }else{
        $request->session()->flash('status', 'Invalid card credential !');
       return redirect()->back();
    }
        
    //    redirect(route('order.show',[auth()->user()->id]));
    }
      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        $user = Auth::user();
        $order = order::select('*')->where('user_id', $id)->get();
        // dd($order);  
        return view('orders.showOrder',['userOrders' => $user->order, 'orders' => $order]);
    }
    public function destroy($id)
    {
        $order = order::findOrFail($id);
        $pd = Products::findOrFail($order->products_id);
        if($pd){
         $pd->product_quantity = $pd->product_quantity + $order->quantity;
         $pd->save();
        }
       $order->delete();
       return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeProductInCart;
use App\Models\cart;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        // $this->middleware('auth')
        // ->only(['show','store','delete']);
    }   
    public function index()
    {     
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
        $cart = cart::select('quantity','id')->where('user_id', $id)->get();  
        return view('cart', ['userProducts' => $user->product, 'user_cart' => $cart]);           
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(cart $cart, storeProductInCart $request)
    {
    //   $cart->create([
    //     'user_id' => auth()->user()->id,
    //     'products_id' => $request->input('product_id'),
    //     'quantity' => $request->input('quantity')
    // ]);0
    $pd = Products::findOrFail($request->input('product_id'));
    if($pd->product_quantity < $request->input('quantity')){
        $request->session()->flash('status', 'Invalid product quantity');
        return redirect()->back();        
    }
    if(cart::where('products_id',$request->input('product_id'))->get()->count() != 0 ){
        $cart = cart::where('products_id',$request->input('product_id'))->get();
        $ct  = cart::findOrFail($cart[0]->id);
        $ct->quantity = $request->input('quantity') + $ct->quantity;
        $ct->save();
        $pd->product_quantity = $pd->product_quantity - $request->input('quantity');
        $pd->save();
       return redirect()->back();
    } else{

        $cart->user_id = auth()->user()->id;
        $cart->products_id = $request->input('product_id');
       $cart->quantity = $request->input('quantity');
       $cart->save();
       if($pd){
        $pd->product_quantity = $pd->product_quantity - $request->input('quantity');
        $pd->save();
       }
       $request->session()->flash('status', 'Product added to cart !');
       return redirect()->back();
    }
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $cart = cart::findOrFail($id);
        $pd = Products::findOrFail($cart->products_id);
        if($pd){
         $pd->product_quantity = $pd->product_quantity + $cart->quantity;
         $pd->save();
        }
    //    $cart = cart::findOrFail($id);
       $cart->delete();
       return redirect()->back();
    }
}

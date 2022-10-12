<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeProductInCart;
use App\Models\cart;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        DB::connection()->enableQueryLog();
        $cart =Auth::user()->cart;
        // dd('carat');
        $total = 0;
        foreach($cart as $cartItem){
            // $pd = Products::findOrFail($cartItem->products_id);
            // dd($cartItem->products_id); 
            $pd = $cartItem->product;
            // dd($pd);
            $total += $pd->product_price * $cartItem->quantity;
        }
        $user = Auth::user(); 
        return view('cart', ['userProducts' => $user->product, 'user_cart' => $cart, 'total'=>$total]);           
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
    // ]);
    $pd = Products::findOrFail($request->input('product_id'));
    if($pd->product_quantity < $request->input('quantity') || $request->input('quantity') < 0){
        $request->session()->flash('status','Invalid product quantity','color' ,'danger');
        $request->session()->flash('color' ,'danger');
        return redirect()->back();       
    }
        $cartItem = User::findOrFail(auth()->user()->id)->cart;
        // dd($cartItem);
        if($cartItem->count() != 0){                                        
            foreach($cartItem as $item){
                if($item->products_id == $request->input('product_id')){
                $ct  = cart::findOrFail($item->id);        
                $ct->quantity = $request->input('quantity') ;
                $ct->save();
                $diff =  $ct->quantity - $request->input('quantity');
                $pd->product_quantity = $pd->product_quantity + $diff;
                $pd->save();
                $request->session()->flash('status', 'Product added to cart !');
                $request->session()->flash('color','success');
                // return redirect()->route('cart.show', [auth()->user()->id]);
                return redirect()->back();
            }
        }
     }     
    
        $cart->user_id = auth()->user()->id;
       $cart->products_id = $request->input('product_id');
       $cart->quantity = $request->input('quantity');
       $cart->save();
       if($pd){
           $pd->product_quantity = $pd->product_quantity - $request->input('quantity');
           $pd->save();
        }
        $request->session()->flash('status', 'Product added to cart !');
        $request->session()->flash('color','success');
        return redirect()->back();
    //    return redirect()->route('cart.show', [auth()->user()->id]);
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
       $cart->delete();
       return redirect()->back();
    }
}

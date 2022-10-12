<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\count;
use App\Models\cart;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {      
        return view('product',['products' => Products::all()]);
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
        $product =  Products::findOrFail($id);
        $user =  User::findOrFail(auth()->user()->id)->cart;
         foreach( $user as $item){
            // dd($item);
            if($item->products_id == $product->id){
                return view('show',['product' => $product,'cart' => $item] );
            }
         }
         $item = null;
        // $cart = cart::where('products_id',$product->id)->get();
        return view('show',['product' => $product,'cart' => $item] );
    }
}

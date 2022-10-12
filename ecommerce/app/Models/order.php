<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','products_id','quantity','shipping_details','payment_details','name','phone','cardNo'];

    public function user(){
        return $this->belongsToMany('App\Models\User');
    }
    public function product(){
        return $this->hasOne(Product::class);
    }
}

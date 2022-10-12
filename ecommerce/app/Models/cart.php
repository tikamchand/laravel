<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $fillable = ['quantity','user_id','products_id'];
    // protected $table = "cart_pages";
    public function user(){
        return $this->hasOne(User::class);
    }
    public function product(){
        return $this->belongsTo(Products::class, 'products_id');
    }
}

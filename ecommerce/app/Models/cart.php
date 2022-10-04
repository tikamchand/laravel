<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    // protected $table = "cart_pages";
    public function user(){
        return $this->belongsToMany(User::class, 'users');
    }
    public function product(){
        return $this->belongsToMany(Products::class, 'products');
    }
}

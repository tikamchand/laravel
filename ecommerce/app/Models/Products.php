<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsToMany(User::class);
    }
    public function cart(){
        return $this->belongsToMany(cart::class);
    }
}

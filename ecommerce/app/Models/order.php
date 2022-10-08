<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','products_id','quantity','shipping_details','payment_details'];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}

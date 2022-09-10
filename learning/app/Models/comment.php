<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class comment extends Model
{  use SoftDeletes;
   use HasFactory;
   public function blogPost(){
    return $this->belongsTo('App\Models\BlogPost');
   }
}

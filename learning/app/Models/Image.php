<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class Image extends Model
{
    use HasFactory; 
    protected $fillable = ['path', 'blog_post_id'];

    public function imageable()
    {
        return $this->morphTo();
    }
    public function url()
    {
        // return Storage::url($this->path);
        return URL::asset('storage/'.$this->path);
    }
     
}

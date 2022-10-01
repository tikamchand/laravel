<?php

namespace App\Models;


use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class comment extends Model
{  use SoftDeletes;
   use HasFactory;
   protected $fillable = ['user_id', 'content']; 
   // public function blogPost(){
   //  return $this->belongsTo('App\Models\BlogPost');
   // }
   public function commentable(){
      return $this->morphTo();
   }
   public function user(){
    return $this->belongsTo('App\Models\User');
   }
   public function tags()
   {
      return $this->morphToMany('App\Models\Tag', 'taggable')->withTimestamps();
   }
   public function scopesLatest(Builder $query){
   return $query->orderBy(static::CREATED_AT, 'desc');
   }
   public static function boot(){
      parent::boot();
      static::creating(function(comment $comment){
         if($comment->commentable_type === App\Models\BlogPost::class){
            Cache::tags(['blog-post'])->forget("blog-post-{$comment->commentable_id}");
            Cache::tags(['blog-post'])->forget("mostCommented");
         }
     });
   } 
}

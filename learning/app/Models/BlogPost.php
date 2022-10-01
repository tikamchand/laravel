<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class BlogPost extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = ['title','content','user_id'];
    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable')->latest();
        
    } 
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable')->withTimestamps();
    }
    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented(Builder $query)
    {
        // comments_count
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }
    public static function boot(){
        parent::boot();
        // static::addGlobalScope(new LatestScopes);
        static::deleting(function(BlogPost $blogPost){
            $blogPost->comments()->delete();
            $blogPost->image()->delete();
            Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
        });
        static::updating(function(BlogPost $blogPost){
            Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
        });
        static::restoring(function(BlogPost $blogPost){
            $blogPost->comments()->restore();
        });
    }
} 

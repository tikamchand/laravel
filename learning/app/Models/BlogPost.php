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
        return $this->hasMany('App\Models\Comment');
        
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
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
        });
        static::updating(function(BlogPost $blogPost){
            Cache::forget("blog-post-{$blogPost->id}");
        });
        static::restoring(function(BlogPost $blogPost){
            $blogPost->comments()->restore();
        });
    }
}

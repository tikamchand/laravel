<?php

namespace App\Models;
use Scopes\LatestScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use  Illuminate\Database\Query\Builder;
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
        return $this->belongsTo('App\User');
    }
    public function scopeLatest(Builder $query)
    {
        return $query->orderBy(static::CREATED_AT, 'desc');
    }
    // public function scopeMostCommented(Builder $query)
    // {
    //     return $query->withCount('comments')->orderBy('comments_count','desc');
    // }
    public static function boot(){
        parent::boot();
        // static::addGlobalScope(new LatestScopes);
        static::deleting(function(BlogPost $blogPost){
            $blogPost->comments()->delete();
        });
        static::restoring(function(BlogPost $blogPost){
            $blogPost->comments()->restore();
        });
    }
}

<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogPostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagCount = Tag::all()->count();
        BlogPost::all()->each(function (BlogPost $post){
         $take = random_int(1,5);
         $tags = Tag::inRandomOrder()->take($take)->get()->pluck('id');
         $post->tags()->sync($tags);
        });
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = \App\Models\BlogPost::all();
        // if($posts->count() > 0) {
        //     $this->command->info('There are no blog posts, so no comments will be added.');
        //     return;
        // }
        // $commentsCount = (int)$this->command->ask("How many comments would you like to add?",100);
        $comments = \App\Models\comment::factory(200)
        ->make()
        ->each(function($comment) use($posts){
            $comment->blog_post_id = $posts->random()->id;
            $comment->save();
        });
    }
}

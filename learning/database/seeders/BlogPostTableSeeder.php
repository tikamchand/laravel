<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $postsCount = (int)$this->command->ask("How many blog posts would you like to add?",100);
        $userCreate = \App\Models\User::all();
        $posts =  \App\Models\BlogPost::factory(100)
                                        ->make()
                                        ->each(function($post) use($userCreate){
                                                $post->user_id = $userCreate->random()->id;
                                                $post->save();
                                                // dd($post->title);
                                                // dd($post->user_id);
                                                // dd($post->content);

                                            });
    }
}

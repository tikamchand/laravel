<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        // \App\Models\User::factory()->create([
            //     'name' => 'Test User',   
            //     'email' => 'test@example.com', 
            // ]);
            Cache::tags(['blog-post'])->flush();
       $this->call([
        UserTableSeeder::class,
        BlogPostTableSeeder::class,
        CommentsTableSeeder::class,
        TagsTableSeeder::class,
        BlogPostTagsTableSeeder::class,
    ]);    
      
    // dd($posts);
   
    }
}

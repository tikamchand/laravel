<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect(['Sciences', 'Sporting', 'Entertainment', 'Economy', 'Business']);
        $tags->each(function ($tagName){
        $tag = new Tag();
        $tag->name = $tagName;
        $tag->save();
        });
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'title'=>fake()->sentence(10),
        'content'=> fake()->sentence(30),
        ];
    }
    public function defaultData()
    {
    return $this->state(function () {
        return [
            'title'=>'this is from fake',
            'content'=> 'This content is from fake',
            ];
    });
    }
}

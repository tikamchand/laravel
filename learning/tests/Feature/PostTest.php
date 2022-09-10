<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
       $this->assertTrue(true);
    }
    public function test_StoreValid(){
        $params = [
            'title' => 'valid title',
            'content' => 'At least 10 characters'
        ];  
        $this->post('/posts',$params)
        ->assertStatus(302)
        ->assertSessionHas('status');
        $this->assertEquals(session('status'),'The post has been saved');
    }
    public function test_StoreFail(){
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];
        $this->post('/posts',$params)
        ->assertStatus(302)
        ->assertSessionHas('errors');
        $messages = session('errors');
        // dd($messages->getMessages());
    }
    public function test_updateValid(){
        $post = $this->createDummyBlogPost();
        $this->assertDatabaseHas('blog_posts', $post->toArray());
    }
    private function createDummyBlogPost():BlogPost{
        $post = new BlogPost();
        $post->title = 'New title';
        $post->content = 'Content of blog post';
        $post->save();
        return $post;
    }
}

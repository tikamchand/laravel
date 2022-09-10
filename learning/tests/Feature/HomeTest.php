<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_HomePage()
    {
        $response = $this->get('/');

        $response->assertSeeText('This is the Home page using a blade templete.');
        // $response->assertSeeText('is this on page');
    }
    public function test_Contact()
    {
        $response = $this->get('/contact');
        $response->assertSeeText('This is the Contact page using a blade templete.');
    }
}

<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\PostCommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {  
//     return view('home.index', []);
// })->name('home.index');
// Route::view('/', 'home.index')->name('home.index');
Route::get('/contact', function () {
        return view('home.contact', []);
    })->name('contact.index');
    Route::get('/', [HomeController::class, 'home'])->name('home.index');
    Route::get('/secret', [HomeController::class, 'secret'])->name('home.secret')->middleware('can:home.secret');
    // Route::get('/contact', [HomeController::class, 'contact'])->name('contact.index');
    Route::get('/about', AboutController::class)->name('about.index');
    $posts = [
    1 => [
        'title' => 'Intro to Laravel',
        'content' => 'Congratulations, you have just an expensive blog post for laravel.',
        'is_new' => true
    ],
    2 => [
        'title' => 'Into to PHP Development',
        'content' => 'Congratulations, you have just an expensive blog post for php.',
        'is_new' => false
    ]
];
Route::resource('posts', PostsController::class);
// ->only(['index', 'show','create','store', 'edit','update']);
// Route::get('/posts', function () use ($posts) {
//     // dd(request()->all());
//      dd(request()->input('page',1));
//     return view('posts.index', ['posts' => $posts]);
// });
// Route::get('/posts/{id}', function ($id) use ($posts) {
//     abort_if(!isset($posts[$id]), 404);
//     return view('posts.show', ['posts' => $posts[$id]]);
// })->name('posts.show');
// ->where([
//     'id' => '[0-9]+'
// ])
// Route::get('/recent-posts/{days_ago?}', function ($postDaysAgo = 10) {
//     return "your are viewing post " . $postDaysAgo . " days ago";
// })->name('post.show.recent');
// Route::get('/posts/tag/{id}', PostTagController::class)->name('posts.tags.index' );
Route::get('/posts/tag/{tag}', 'App\Http\Controllers\PostTagController@index')->name('posts.tags.index' );
Route::prefix('/fun')->name('fun.')->group(function() use($posts) {
    Route::get('responses', function() use($posts) {
        return response($posts, 201)
        ->header('Content-Type', 'application/json')
        ->cookie('MY_COOKIE', 'Tikamchand kumawat', 3600);
    })->name('responses');
  
    Route::get('redirect', function() {
      return redirect('/contact');
    })->name('redirect');
                                       
    Route::get('back', function() {
      return back();
    })->name('back');
  
    Route::get('named-route', function() {
      return redirect()->route('posts.show', ['id' => 1]);
    })->name('named-route');
  
    Route::get('away', function() {
      return redirect()->away('https://google.com');
    })->name('away');
  
    Route::get('json', function() use($posts) {
      return response()->json($posts);
    })->name('json');
  
    Route::get('download', function() use($posts) {
      return response()->download(public_path('/daniel.jpg'), 'face.jpg');
    })->name('download');
  });
Route::resource('posts.comments','App\Http\Controllers\PostCommentController')->only(['store']);
Route::resource('users', 'UserController')->only('show','edit', 'update');
Auth::routes();
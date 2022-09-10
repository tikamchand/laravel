<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    //    private  $posts = [
    //     1 => [
    //         'title' => 'Intro to Laravel',
    //         'content' => 'Congratulations, you have just an expensive blog post for laravel.',
    //         'is_new' => true
    //     ],
    //     2 => [
    //         'title' => 'Into to PHP Development',
    //         'content' => 'Congratulations, you have just an expensive blog post for php.',
    //         'is_new' => false
    //     ]
    // ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
    $this->middleware('auth')
    ->only(['create','store','edit','delete','update']);
    }   
    public function index()
    {
        DB::connection()->enableQueryLog();
        // $posts  = BlogPost::all();
        $posts  = BlogPost::with('comments')->get();
        foreach($posts as $post){
            foreach($post->comments as $comment){
                echo $comment->content;
            }
        }
        // dd(DB::getQueryLog());
        return view('posts.index', 
        ['posts' => BlogPost::withCount('comments')->get(),
        //   'mostCommented' => BlogPost::mostCommented()->take(5)->get(),
        //   'mostActive' => User::withMostBlogPosts()->take(5)->get(),
    
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        //    dd($request);
        $validate = $request->validated();
        $validate['user_id'] = $request->user()->id; 
        $post = BlogPost::create($validate);
        // $post = new BlogPost();
        // $post->title = $validate['title'];
        // $post->content = $validate['content'];
        // $post->save();
        $request->session()->flash('status', 'The post has been saved');
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // abort_if(!isset($this->posts[$id]), 404);
        return view('posts.show', ['posts' => BlogPost::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    $post = BlogPost::findOrFail($id);
        // if(Gate::denies('update-post', $post)){
        //     abort(403);
        // }
        $this->authorize('update', $post);
        return view('posts.edit',['post'=> $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id) 
    {
        $post = BlogPost::findOrFail($id);
        $this->authorize('update', $post);
        $validate = $request->validated();
        $post->fill($validate);
        $post->save();
        $request->session()->flash('success', 'Blog post has been saved Successfully');
        return redirect()->route('posts.show',['post'=>$post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);
        $this->authorize('delete', $post);
        $post->delete();
        session()->flash('status', 'Blog post was deleted!');
        return redirect()->route('posts.index');
    }
}
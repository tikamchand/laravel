<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\comment;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

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
        ['posts' => BlogPost::withCount('comments')->with('user')->get()  
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
        $validate = $request->validated();
        $validate['user_id'] = $request->user()->id; 
        $post = BlogPost::create($validate);
        if($request->hasFile('thumbnail')){
           
            $path = $request->file('thumbnail')->store('thumbnails');
            $post->image()->save(
              Image::make(['path'=> $path])
            );
        }
        // dd(URL::asset('storage/'.$path));
        // http://localhost/laravel/learning/storage/app/thumbnails/104.jpg
        //    $hasFile = $request->hasFile('thumbnail');
        //    dump($hasFile);
        //   if($hasFile){
        //     $file = $request->file('thumbnail');
        //     dump($file);
        //     dump($file->getClientMimeType());
        //     dump($file->getClientOriginalExtension());
        //     $file->store('thumbnails');
        //     $name = $file->storeAs('thumbnails', $post->id.'.'. $file->guessExtension());
        //     dump(Storage::url($name));
        //     echo asset('storage/app/thumbnails/104.jpg');
        //   }
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
        $blogPost = Cache::tags(['blog-post'])->remember("blog-post-${id}", 60, function() use($id){
                    return BlogPost::with('comments','tags','user','comments.user')
                    ->findOrFail($id);
        });
        $sessionId = session()->getId();
        $counterKey = "blog-post-${id}-counter";
        $usersKey = "blog-post-${id}-users";
        $users = Cache::tags(['blog-post'])->get($usersKey, []);
        $usersUpdate = [];
        $diffrence = 0;
        $now = now(); 
        foreach ($users as $session => $lastVisit) {
            if ($now->diffInMinutes($lastVisit) >= 1) {
                $diffrence--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if(
            !array_key_exists($sessionId, $users)
            || $now->diffInMinutes($users[$sessionId]) >= 1
        ) {
            $diffrence++;
        }

        $usersUpdate[$sessionId] = $now;
        Cache::tags(['blog-post'])->forever($usersKey, $usersUpdate);

        if (!Cache::tags(['blog-post'])->has($counterKey)) {
            Cache::tags(['blog-post'])->forever($counterKey, 1);
        } else {
            Cache::tags(['blog-post'])->increment($counterKey, $diffrence);
        }
        $coutner = Cache::get($counterKey);
        return view('posts.show', [
            'posts' =>  $blogPost,
            'counter'=> $coutner,
        ]);
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

        if($request->hasFile('thumbnail')){
            $path = $request->file('thumbnail')->store('thumbnails');
            if($post->image){
                Storage::delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();
            }else{
                $post->image()->save(
                    Image::make(['path'=> $path])
                );
            }
        }

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

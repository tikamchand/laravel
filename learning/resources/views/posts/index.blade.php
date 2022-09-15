@extends('layout.app')
@section('title','Blog post')
@section('content')
<div class="row">
    <div class="col-8">
        @forelse ($posts as $key => $posts)
        <h3><a href="{{ route('posts.show', ['post' => $posts->id]) }}">{{ $posts->title }}</a></h3>
        @if($posts->comments_count)
        <p>{{ $posts->comments_count }} comments</p>
        @else  
        <p>No comments yet</p>
        @endif   
        <div class="mb-3">
            @auth                
            @can('update',$posts)
            <a href="{{ route('posts.edit', ['post' => $posts->id]) }}" class="btn btn-primary">Edit</a>
            @endcan
            @endauth
            @auth              
            @can('delete',$posts)
            <form class="d-inline" action="{{ route('posts.destroy', ['post' => $posts->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Delete!" class="btn btn-primary">
            </form>
            @endcan
            @endauth
        </div>
        @empty
        No Posts found !
        @endforelse
    </div>
       
    
    <div class="col-4">
        <div class="container">
            <div class="row">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                            <h5 class="card-title">Most Commented</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                            What people are currently talking about
                        </h6>
                         </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($mostCommented as $post) 
                        <li class="list-group-item"> 
                                <a href="{{ route('posts.show', ['post' => $post->id]) }}"> 
                                    {{ $post->title }} -
                                </a>
                            </li>
                            @endforeach
                    </ul>
            </div>
            <div class="row mt-5">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                            <h5 class="card-title">Most Active</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                            User with most posts written
                        </h6>
                         </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($mostActive as $user) 
                        <li class="list-group-item"> 
                        {{ $user->name }}        
                         </li>
                            @endforeach
                    </ul>
            </div>
            <div class="row mt-5">
                        <div class="card" style="width: 100%;">
                            <div class="card-body">
                            <h5 class="card-title">Most Active Last Month</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                            User with most posts written in the last month
                        </h6>
                         </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($mostActiveLastMonth as $user) 
                        <li class="list-group-item"> 
                        {{ $user->name }}        
                         </li>
                            @endforeach
                    </ul>
            </div>
        </div>
    </div>
</div>
@endsection                                             
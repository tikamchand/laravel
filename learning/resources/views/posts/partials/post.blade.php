{{-- @break($key == 2) --}}
{{-- @continue($key == 1) --}}
<div class="row">
<div class="col-8">
    @forelse ($posts as $post)
    <h3><a href="{{ route('posts.show', ['post' => $posts->id]) }}">{{ $posts->title }}</a></h3>

    @if($posts->comments_count)
    <p>{{ $posts->comments_count }} comments</p>
    @else  
    <p>No comments yet</p>
    @endif   
    <div class="mb-3">
        @can('update',$posts)
        <a href="{{ route('posts.edit', ['post' => $posts->id]) }}" class="btn btn-primary">Edit</a>
        @endcan
        @can('delete',$posts)
        <form class="d-inline" action="{{ route('posts.destroy', ['post' => $posts->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete!" class="btn btn-primary">
        </form>
        @endcan
    </div>
    @empty
    <p>No blog posts yet!</p>
    @endforelse
</div>

</div>
 {{-- <div class="col-4">
    <div class="card" style="width: 18rem;">
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
</div> --}}
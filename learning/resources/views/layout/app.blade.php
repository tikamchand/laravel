<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> --}}
    <script src="{{asset('js/app.js')}}" defer></script>
    <title>Laravel page - @yield('title')</title>
</head>
<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4">
        <h5 class="my-0 mr-md-auto font-weight-normal">Laravel App</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a href="{{route('home.index')}}" class="p-2 text-dark">Home</a>
            <a href="{{route('contact.index')}}" class="p-2 text-dark">Contact</a>
            <a href="{{route('posts.index')}}"  class="p-2 text-dark">Blog posts</a>
            <a href="{{route('posts.create')}}"  class="p-2 text-dark">Add Blog post</a>
            @guest
            @if (Route::has('register'))
            <a href="{{route('register')}}" class="p-2 text-dark">Register</a>
            @endif
            <a href="{{route('login')}}"  class="p-2 text-dark">Login</a>
            @else
            <a href="{{route('logout')}}"  class="p-2 text-dark"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            >Logout({{Auth::user()->name}})</a> 
            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none">
            @csrf
            </form>
            @endguest
        </nav>
    </div>
    <div class="container">
        @if(session('status'))
        <div class="alert alert-success">{{session('status')}}</div>
        @endif
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
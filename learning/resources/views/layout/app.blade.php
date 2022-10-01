
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
    
        <nav class="navbar navbar-expand-lg bg-dark">
            <div class="container-fluid">
            <h5 class="navbar-brand">Laravel App</h5>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                        <a href="{{route('home.index')}}" class="p-2 text-dark nav-link">Home</a> </li>
                        <li class="nav-item">
                        <a href="{{route('contact.index')}}" class="p-2 text-dark nav-link">Contact</a></li>
                        <li class="nav-item">
                        <a href="{{route('posts.index')}}"  class="p-2 text-dark nav-link">Blog posts</a></li>
                        <li class="nav-item">
                        <a href="{{route('posts.create')}}"  class="p-2 text-dark nav-link">Add Blog post</a></li>
                    </ul>

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
                 </div>
            </div>
        </nav>

    <div class="container">
        @if(session('status'))
        <div class="alert alert-success">{{session('status')}}</div>
        @endif
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
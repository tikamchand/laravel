 @extends('layout.app')
 @section('content')
 
 <form action="{{route('register')}}" method="POST">
    @csrf
        <div class="mt-3">
            <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}">
        @if ( $errors->has('name') )
 <span class = "invalid-feedback" >
    <strong> { { $errors->first('name')}}</strong>
  </span>
@endif
    </div>
    <div class="mt-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}">
        {{-- @if($errors->has('email'))
        <span class="invalid-feedback" >
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif --}}
        @if ( $errors->has('email') )
        <span class = "invalid-feedback" >
           <strong> {{$errors->first('email')}}</strong>
         </span>
       @endif
    </div>
    <div class="mt-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}">
        @if($errors->has('password'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>
    <div class="mt-3 mb-5">
        <label for="password_R" class="form-label">Re-enter_password</label>
        <input type="password" name="password_confirmation" id="password_R" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Register!</button>
</form>

@endsection
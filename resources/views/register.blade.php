@extends('master')

@section('content')

@foreach($errors->all() as $error)

    <div class="alert alert-danger">
        
        {{$error}}
    </div>
@endforeach
    <h1>Register</h1><br>
	
	 <form action="register" method="post">
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-inline">

            <label for="login">Login</label>
            <input type="text" name="login" class="form-control" value="{{ old('login', '') }}">
        </div><br>
        <div class="form-inline">

            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
        </div><br>
        <div class="form-inline">

            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" value="{{ old('email', '') }}">
        </div><br>
        <input type="submit" class="btn btn-success" value="Register">
        <br><br><br>
    </form>
@stop
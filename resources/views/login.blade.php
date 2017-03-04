@extends('master')

@section('content')

@foreach($errors->all() as $error)

    <div class="alert alert-danger">
        
        {{$error}}
    </div>
@endforeach

    <h1>Login</h1><br>

	<form action="login" method="post">
        
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-inline">

            <label for="login">Login</label>
            <input type="text" name="login" class="form-control" value="{{ old('login', '') }}">
        </div><br>
        <div class="form-inline">

            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
        </div><br>
        <input type="submit" class="btn btn-success" value="Login">
        <br><br><br>
    </form>
@stop
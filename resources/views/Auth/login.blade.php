@extends('layout')

@section('content')

    <h1>Login</h1>

    <form class="form-inline" action="login" method="POST">
        {{ csrf_field() }}
        <input class="form-control" type="email" name="email" id="" placeholder="Email">
        <input class="form-control" type="password" name="password" id="" placeholder="password">
        <input class="btn btn-primary" type="submit" value="Entrar">
    </form>
    
@endsection
@extends('layout')

@section('content')
    <h1>Editar Usuario</h1>

    @if (session()->has('info'))
        <div class="alert alert-success">{{ session('info') }}</div>
    @endif

    <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
            {{ method_field('PUT')}}
            
            @include('users.form')
            
            <input type="submit" class="btn btn-primary" value="Enviar">
    </form>
@endsection
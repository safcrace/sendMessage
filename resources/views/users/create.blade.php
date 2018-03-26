@extends('layout')

@section('content')

    <h1>Ingreso de Usuarios</h1>

    <form action="{{ route('usuarios.store') }}" method="POST">            
            
            @include('users.form', ['user' => new App\User])
            
            <input type="submit" class="btn btn-primary" value="Guardar">
    </form>
    
@endsection
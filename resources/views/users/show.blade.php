@extends('layout')

@section('content')

    <h1>{{ $user->name }}</h1>

    <table class="table">
        <tr>
            <th>Nombre</th>
            <td>{{$user->nombre}}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <th>Role</th>
            <td>
                @foreach($user->roles as $role)
                    {{$role->display_name}}
                @endforeach
            </td>                    
        </tr>
    </table>

    @can('edit', $user)
        <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-info">Editar</a>        
    @endcan

    @can('destroy', $user)
         <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" style="display: inline">
            {{ csrf_field() }}
            {{method_field('DELETE')}}
            <button class="btn btn-danger" type="submit">Eliminar</button>
        </form>        
    @endcan


    
@endsection
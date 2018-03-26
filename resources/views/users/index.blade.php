@extends('layout')

@section('content')    
    <h1>Usuarios</h1>

    <a class="btn btn-success" href=" {{ route('usuarios.create') }}">Crear nuevo usuario</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Role</th>
                <th>Notas</th>
                <th>Etiquetas</th>
                <th>Acciones</th>
            </tr>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><a href="{{ route('usuarios.show', $user->id) }}"> {{ $user->name }}</a> </td>
                        <td>{{ $user->email }}</td>
                        <td>
                        {{ $user->roles->pluck('display_name')->implode(' - ') }}                           
                        </td>
                        <td>{{ $user->note ? $user->note->body : '' }}</td>
                        <td>{{ $user->tags->pluck('name')->implode(', ') }}</td>
                        <td>
                        <a class="btn btn-info btn-xs" href="{{ route('usuarios.edit', $user->id) }}">
                                Editar
                            </a>
                            <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" style="display: inline">
                                {{ csrf_field() }}
                                {{method_field('DELETE')}}
                                <button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </thead>

    </table>
@endsection
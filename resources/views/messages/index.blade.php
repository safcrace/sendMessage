@extends('layout')

@section('content')
    <h1>Todos los mensajes</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Mensaje</th>
                <th>Notas</th>
                <th>Etiquetas</th>
                <th>Acciones</th>
            </tr>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $message->id }}</td>
                        <td>
                            <a href="{{ route('mensajes.show', $message->id) }}">
                                {{ $message->nombre }}
                            </a>
                        </td>
                        <td>{{ $message->email }} </td>
                        <td>{{ $message->mensaje }} </td>
                        <td>{{ $message->note ? $message->note->body : '' }}</td>
                        <td>{{ $message->tags->pluck('name')->implode(', ') }}</td>
                        <td>
                            <a class="btn btn-info btn-xs" href="{{ route('mensajes.edit', $message->id) }}">
                                Editar
                            </a>
                            <form action="{{ route('mensajes.destroy', $message->id) }}" method="POST" style="display: inline">
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
    <div class="text-center">{!! $messages->appends(request()->query())->links('pagination::default') !!}</div>
@endsection
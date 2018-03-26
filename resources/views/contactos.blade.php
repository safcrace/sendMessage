@extends('layout')

@section('content')
    <h1>Contactos</h1>
    <h2>Escribeme</h2>

    @if( session()->has('info') )
        <h3> {{ session('info') }} </h3>      
    @else
        <form action="contacto" method="POST">
       {{ csrf_field() }}
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}">
        {!! $errors->first('nombre', '<span class="error">:message</span>')!!}
        <br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}">
         {!! $errors->first('email', '<span class="error">:message</span>')!!}
         <br>
        <label for="mensaje">Mensaje</label>
        <label for="email">Email</label>
        <textarea name="mensaje" id="mensaje" cols="30" rows="10">{{ old('mensaje') }}</textarea>
         {!! $errors->first('mensaje', '<span class="error">:message</span>')!!}
        <input type="submit" value="Enviar">
    </form>
    @endif
    
@endsection

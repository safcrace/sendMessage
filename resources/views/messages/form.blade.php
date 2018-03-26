{{ csrf_field() }}

@if($showFields)
    <label for="nombre">Nombre</label>
    <input class="form-control" type="text" name="nombre" id="nombre" value="{{ $message->nombre or old('nombre')}}">
    {!! $errors->first('nombre', '<span class="error">:message</span>')!!}
    <br>
    <label for="email">Email</label>
    <input class="form-control" type="email" name="email" id="email" value="{{ $message->email or old('email') }}">
    {!! $errors->first('email', '<span class="error">:message</span>')!!}
    <br>
@endif
<label for="mensaje">Mensaje</label>
<textarea class="form-control" name="mensaje" id="mensaje" cols="30" rows="10">{{ $message->mensaje }}</textarea>
{!! $errors->first('mensaje', '<span class="error">:message</span>')!!}
<br>

<input class="btn btn-primary" type="submit" value="Enviar">
</br>


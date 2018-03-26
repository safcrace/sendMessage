{{ csrf_field() }}
<p><label for="nombre">Nombre</label>
<input type="text" class="form-control" name="name" id="name" value="{{ $user->name or old('name') }}">
{!! $errors->first('name', '<span class="error">:message</span>')!!}</p>
<p><label for="email">Email</label>
<input type="email" class="form-control" name="email" id="email" value="{{ $user->email or old('email') }}">
{!! $errors->first('email', '<span class="error">:message</span>')!!}</p>
@unless($user->id)
    <p><label for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password"  }}">
    {!! $errors->first('password', '<span class="error">:message</span>')!!}</p>
    <p><label for="password_confirmation">Password Confirm</label>
    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"  }}">
    {!! $errors->first('password_confirmation', '<span class="error">:message</span>')!!}</p>
@endunless
<div class="checkbox">
    @foreach($roles as $id => $name)
        <label for="">
            <input type="checkbox" name="roles[]" value="{{$id}}" {{ $user->roles->pluck('id')->contains($id) ? 'checked' : '' }}>{{$name}}
        </label>                    
    @endforeach
</div>
{!! $errors->first('roles', '<span class="error">:message</span>')!!}</p>
<hr>
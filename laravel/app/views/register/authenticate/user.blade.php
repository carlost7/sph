@extends('layouts.webpage_master')

@section('wrapper')
<div class="row">
      <div class="col-sm-6 col-sm-push-3">
            <h2>Registrar nuevo usuario</h2>
            {{ Form::open(array('route' => 'authenticate.store')) }}
            <div class="form-group">
                  {{ Form::label('username', 'Nombre de usuario') }}
                  {{ Form::text('username', $username, array('placeholder' => 'nombre de usuario', 'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                  {{ Form::label('email', 'Correo electrónico') }}
                  {{ Form::text('email', Input::old('correo'), array('placeholder' => 'ejemplo@correo.com', 'class'=>'form-control')) }}
            </div>                        
            
            @include('layouts.show_form_errors')
            
            <div class="form-group">
                  <button type="submit" class="btn btn-primary">Registrar</button>
            </div>        
            {{ Form::close() }}            
      </div>
</div>
@stop
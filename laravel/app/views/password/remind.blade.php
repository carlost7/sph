@extends('layouts.webpage_master')

@section('wrapper')
<div class="col-sm-6 col-sm-push-3">
      <h2>Recuperar Password</h2>

      <form action="{{ action('RemindersController@postRemind') }}" method="POST">
            <div class="form-group">
                  {{ Form::label('email', 'Correo Electrónico') }}
                  {{ Form::text('email', Input::old('email'), array('placeholder' => 'ejemplo@correo.com', 'class'=>'form-control')) }}
            </div>
            <div class="form-group">
                  <button type="submit" class="btn btn-primary">Enviar Correo</button>                    
            </div>        
      </form>
</div>
@stop


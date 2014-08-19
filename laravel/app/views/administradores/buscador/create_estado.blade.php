@extends('layouts.admin_dashboard_master')

@section('content')

<h2>Crear Categorias de buscador</h2>

{{ Form::open(array('route'=>'administradores_buscador.store')) }}

<div class="form-group">
      {{ Form::label('categoria', 'Categoria') }}
      {{ Form::text('categoria', Input::old('categoria'), array('placeholder' => 'categoria', 'class'=>'form-control')) }}
</div>

<div class="form-group">
      {{ Form::label('subcategoria', 'Subcategoria') }}
      {{ Form::text('subcategoria', Input::old('subcategoria'), array('placeholder' => 'subcategoria', 'class'=>'form-control')) }}
</div>

<div class="form-group">
      {{ Form::label('estado', 'Estado') }}
      {{ Form::text('estado', Input::old('estado'), array('placeholder' => 'estado', 'class'=>'form-control')) }}
</div>

<div class="form-group">
      {{ Form::label('zona', 'Zona') }}
      {{ Form::text('zona', Input::old('zona'), array('placeholder' => 'zona', 'class'=>'form-control')) }}
</div>


@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Agregar Datos</button>
</div>        

{{ Form::close() }}

@stop

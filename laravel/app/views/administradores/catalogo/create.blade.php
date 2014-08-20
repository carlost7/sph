@extends('layouts.admin_dashboard_master')

@section('content')

<h2>Crear Categorias de buscador</h2>

{{ Form::open(array('route'=>'administrador_catalogo.store')) }}

<div class="container">
      <div class="row">
            <div class="col-sm-6">
                  <h4>Agregar Categoría</h4>
                  <div class="form-group">
                        {{ Form::label('categoria', 'Categoria') }}
                        {{ Form::text('categoria', Input::old('categoria'), array('placeholder' => 'categoria', 'class'=>'form-control')) }}
                  </div>
            </div>
            <div class="col-sm-6">
                  <h4>Agregar subcategoría</h4>
                  <div class="form-group">
                        {{ Form::label('categoria_id', 'Categoria') }}
                        {{ Form::select('categoria_id', $categorias->lists('categoria', 'id')) }}
                  </div>                  
                  <div class="form-group">
                        {{ Form::label('subcategoria', 'Subcategoria') }}
                        {{ Form::text('subcategoria', Input::old('subcategoria'), array('placeholder' => 'categoria', 'class'=>'form-control')) }}
                  </div>
            </div>
      </div>
      <div class="row">
            <div class="col-sm-6">
                  <h4>Agregar Estado</h4>
                  <div class="form-group">
                        {{ Form::label('estado', 'Estado') }}
                        {{ Form::text('estado', Input::old('estado'), array('placeholder' => 'categoria', 'class'=>'form-control')) }}
                  </div>
            </div>
            <div class="col-sm-6">
                  <h4>Agregar Zona</h4>
                  <div class="form-group">
                        {{ Form::label('estado_id', 'Estado') }}
                        {{ Form::select('estado_id', $estados->lists('estado', 'id')) }}
                  </div>
                  <div class="form-group">
                        {{ Form::label('zona', 'Zona') }}
                        {{ Form::text('zona', Input::old('zona'), array('placeholder' => 'categoria', 'class'=>'form-control')) }}
                  </div>
            </div>
      </div>
</div>
@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Agregar Datos</button>
</div>        

{{ Form::close() }}

@stop

@extends('layouts.admin_dashboard_master')

@section('content')

<h2>Editar elemento</h2>

<div class="container">

      {{ Form::model($objeto, array('route' => array('administrador_catalogo.update', $objeto->id), 'method' => 'PUT')) }}

      {{ Form::hidden('tipo',$tipo)}}
      
      @if($tipo=='subcategoria')
      {{ Form::label('categoria_id', 'Categoria') }}
      {{ Form::select('categoria_id', $categorias->lists('categoria', 'id'),$objeto->categoria->id,array('class'=>'form-control')) }}
      @elseif($tipo=='zona')
      {{ Form::label('estado_id', 'Estado') }}
      {{ Form::select('estado_id', $estados->lists('estado', 'id'),$objeto->estado->id,array('class'=>'form-control')) }}
      @endif

      {{ Form::label($tipo,$tipo) }}

      {{ Form::text($tipo,null,array('placeholder' => $tipo, 'class'=>'form-control')) }}

      @include('layouts.show_form_errors')

      <div class="form-group">
            <button type="submit" class="btn btn-primary">Agregar Datos</button>
      </div>        

      {{ Form::close() }} 

</div>
@stop
@extends('layouts.client_dashboard_master')

@section('content')

<h2>Crear Negocio</h2>

{{ Form::open(array('route'=>'publicar.clientes_negocios.store', 'files'=>true)) }}

{{ Form::hidden('add_images',false,array('id'=>'addimg')) }}      
@include('layouts.show_form_errors')
<div class="form-group">
      <button type="submit" class="btn btn-primary">Agregar Imagenes</button>
</div>        

{{ Form::close() }}

@stop

@section('scripts')

@stop
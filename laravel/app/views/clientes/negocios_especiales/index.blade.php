@extends('layouts.client_dashboard_master')

@section('content')

<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('clientes_negocios_especiales.create','Agregar imágenes',array('negocio_id'=>$negocio_id)) }}</li>            
      </ul>
</div>
<h2>Lista de imágenes especiales</h2>
@if($imagenes->count())

<p>Da click en una imagen para editarla</p>



<div class="list-group">
      @foreach($imagenes as $imagen)
      
      <a href="{{ URL::route('clientes_negocios_especiales.edit',array('id'=>$imagen->id,'negocio_id'=>$negocio_id)) }}"><img src="{{Config::get('params.path_public_image').$imagen->path.$imagen->nombre}}" alt="{{ $imagen->alt }}" /></a>
      
      @endforeach
</div>

@else

<h3>Aún no has agregado ninguna imágen</h3>

@endif


@stop
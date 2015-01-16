@extends('layouts.client_dashboard_master')

@section('content')
@if($promocion)
<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('publicar.clientes_promociones.edit','Editar promoción',$promocion->id) }}</li>            
      </ul>
</div>


<h2>{{ $promocion->nombre }}</h2>

@if($promocion->imagen_file_name != "")
<img src="{{ URL::to("/").$promocion->imagen->url('medium')}}">
@endif
<div class="list-group">  
      <p class="list-group-item"><span class="label label-default">Negocio:</span> {{ $promocion->negocio->nombre }}</p>      
      <p class="list-group-item"><span class="label label-default">Nombre:</span> {{ $promocion->nombre }}</p>      
      <p class="list-group-item"><span class="label label-default">Código:</span> {{ $promocion->codigo }}</p>
      <p class="list-group-item"><span class="label label-default">Descripción:</span> {{ $promocion->descripcion }}</p>
      <p class="list-group-item"><span class="label label-default">Vigencia:</span> {{ date('d-m-Y H:i',strtotime($promocion->vigencia_inicio)).' - '.date('d-m-Y H:i',strtotime($promocion->vigencia_fin)) }}</p>
      <p class="list-group-item"><span class="label label-default">Publicado:</span> {{ ($promocion->publicar) ? "Si" : "No" }}</p>
</div>

@else

<h2>No seleccionó ningún negocio</h2>

@endif


@stop
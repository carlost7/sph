@extends('layouts.webpage_master')

@section('wrapper')
<div class="container">
      <div class="row">
            <div class="col-sm-12">
                  <a href="{{ URL::previous() }}" >Regresar</a>
            </div>
            @if($promocion)
            <div class="col-sm-2">
                  @if($promocion->imagen_file_name != "")
                  <img src="{{ URL::to("/").$promocion->imagen->url('medium')}}">
                  @endif
                  <h2>{{ $promocion->nombre }}</h2>
                  <div class="list-group">                          
                        <p class="list-group-item"><span class="label label-default">Nombre:</span> {{ $promocion->nombre }}</p>      
                        <p class="list-group-item"><span class="label label-default">Código:</span> {{ $promocion->codigo }}</p>
                        <p class="list-group-item"><span class="label label-default">Descripción:</span> {{ $promocion->descripcion }}</p>
                        <p class="list-group-item"><span class="label label-default">Vigencia:</span> {{ date('d-m-Y H:i',strtotime($promocion->vigencia_inicio)).' - '.date('d-m-Y H:i',strtotime($promocion->vigencia_fin)) }}</p>                        
                  </div>
            </div>
            @endif

      </div>
</div>
@stop


@extends('layouts.client_dashboard_master')

@section('content')

@if($pago)
<h2>Usar código promocional</h2>

<div class="list-group">  
      <p class="list-group-item"><span class="label label-default">Nombre:</span> {{ $pago->nombre }}</p>
      <p class="list-group-item"><span class="label label-default">Descripción:</span> {{ $pago->descripcion }}</p>
      <p class="list-group-item"><span class="label label-default">Monto:</span> ${{ $pago->monto }}</p>      
</div>

{{ Form::open(array('route' => array('clientes_pagos_codigo.post', $pago->id))) }}

<div class="form-group">
      {{ Form::label('numero','Número promocional') }}
      {{ Form::text('numero',Input::old('codigo'),array('placeholder'=>'código promocional','class'=>'form-control')) }}
</div>
@include('layouts.show_form_errors')

<div class="form-group">
      <button type="submit" class="btn btn-primary">Usar codigo</button>
</div>        

{{ Form::close() }}


@else
<h2>No seleccionó ningún pago</h2>

@endif

@stop

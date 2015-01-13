@extends('layouts.client_dashboard_master')

@section('content')

<h2>Agregar Imagenes de {{$evento->nombre}}</h2>

{{ Form::open(array('route'=>array('publicar.clientes_evento_imagenes.store',$evento->id),'files'=>true))}}
<div class="form-group">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('imagen','Agregar imagen de evento 250px * 250px') }}
                  {{ Form::file('imagen') }}
            </div>
      </div>
      {{ Form::submit('agregar imagen',array("class"=>"btn btn-primary")) }}
      @include('layouts.show_form_errors')
</div>
{{ Form::close() }}


@if(count($imagenes))
<div class="container">
      <div class="row">
            @foreach($imagenes as $imagen)
            <div class="col-sm-3">
                  <img src="{{ URL::to("/").$imagen->imagen->url('medium')}}">

                  {{ Form::open(array('route' => array('publicar.clientes_evento_imagenes.destroy',$evento->id,$imagen->id),'method'=>'DELETE')) }}            
                  
                  <p class="text-right">{{ Form::submit('eliminar', array('class' => 'btn btn-sm btn-danger')) }} </p>
                  {{ Form::close() }}                        
            </div>      
            @endforeach
      </div>
</div>

@endif


@stop
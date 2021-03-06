@extends('layouts.client_dashboard_master')

@section('content')

<h2>Agregar Imagenes de {{$negocio->nombre}}</h2>

{{ Form::open(array('route'=>array('publicar.clientes_negocio_imagenes.store',$negocio->id),'files'=>true))}}
<div class="form-group">
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('imagen','Agregar imagen de negocio 250px * 250px') }}
                  {{ Form::file('imagen') }}
            </div>
            <div class="col-sm-12">
                  {{ Form::label('alt','Descripción de la imagen') }}
                  {{ Form::text('alt', Input::old('alt') ,array('placeholder'=>'Descripción','class'=>'form-control')) }}
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
                  <img src="{{ URL::to("/").$imagen->imagen->url('large')}}">

                  {{ Form::open(array('route' => array('publicar.clientes_negocio_imagenes.destroy',$negocio->id,$imagen->id),'method'=>'DELETE')) }}            
                  
                  <p class="text-right">{{ Form::submit('eliminar', array('class' => 'btn btn-sm btn-danger')) }} </p>
                  {{ Form::close() }}                        
            </div>      
            @endforeach
      </div>
</div>

@endif


@stop
@extends('layouts.webpage_master')

@section('wrapper')
<div class="container">

      @include('layouts.show_catalog',array('action'=>'cartelera'))

      @if($evento)

      <h2>{{ $evento->nombre }}</h2>

      <div class="rank" id="rank">
            @if(Auth::check() && Auth::user()->userable_type === 'Miembro')
            @if($evento->is_especial)    
            @if($add_rank)
            <button type="button" class="btn btn-small btn-primary" id="btn_rank"> + Rank</button>
            rank: {{ $evento->rank }}
            @else
            rank: {{ $evento->rank }}

            @endif
            @else
            <button type="button" class="btn btn-small btn-primary" id="btn_rank" disabled="disabled"> + Rank</button>
            @endif                  
            @else
            <p>¿Te gusta este evento? {{ HTML::linkRoute('register.user','Regístrate como usuario para rankear el negocio ') }}</p> 
            @endif
      </div>

      @if(count($evento->imagen))
      <img src="{{Config::get('params.path_public_image').$evento->imagen->path.$evento->imagen->nombre}}" alt="{{ $evento->imagen->alt }}" />
      @endif


      <div class="list-group">  
            <p class="list-group-item"><span class="label label-default">Fecha:</span> {{ date('d-m-Y',strtotime($evento->fecha_inicio)).' - '.date('d-m-Y',strtotime($evento->fecha_fin)) }}</p>
            <p class="list-group-item"><span class="label label-default">Horario:</span> {{ date('H:i',strtotime($evento->hora_inicio)).' - '.date('H:i',strtotime($evento->hora_fin)) }}</p>
            <p class="list-group-item"><span class="label label-default">Lugar:</span> {{ $evento->lugar }}</p>
            <p class="list-group-item"><span class="label label-default">Dirección:</span> {{ $evento->direccion }}</p>
            <p class="list-group-item"><span class="label label-default">Descripción:</span> {{ $evento->descripcion }}</p>
            <p class="list-group-item"><span class="label label-default">Telefono:</span> {{ $evento->telefono }}</p>
            <p class="list-group-item"><span class="label label-default">Publicado:</span> {{ ($evento->publicar) ? 'Si' : 'No' }}</p>
      </div>

      @if(count($evento->masInfo))

      <div class="list-group">  
            <p class="list-group-item"><span class="label label-default">Moneda:</span> {{ $evento->moneda }}</p>
            <p class="list-group-item"><span class="label label-default">Costo:</span> {{ $evento->costo }}</p>
            <p class="list-group-item"><span class="label label-default">Edad mínima:</span> {{ $evento->min_edad }}</p>
            <p class="list-group-item"><span class="label label-default">Edad máxima:</span> {{ $evento->max_edad }}</p>
            <p class="list-group-item"><span class="label label-default">Cuenta con alcohol:</span> {{ ($evento->masInfo->alcohol) ? 'Si' : 'No' }}</p>
            <p class="list-group-item"><span class="label label-default">Acepta tarjeta de credito:</span> {{ ($evento->masInfo->tc) ? 'Si' : 'No' }}</p>
            <p class="list-group-item"><span class="label label-default">Acepta tarjeta de debito:</span> {{ ($evento->masInfo->td) ? 'Si' : 'No' }}</p>
            <p class="list-group-item"><span class="label label-default">Acepta efectivo:</span> {{ ($evento->masInfo->efectivo) ? 'Si' : 'No' }}</p>
            <p class="list-group-item"><span class="label label-default">Otra:</span> {{ $evento->masInfo->otra }}</p>
      </div>

      @endif

      @if($evento->is_especial && count($evento->especial))
      <div class="list-group">  
            <p class="list-group-item"><span class="label label-default">Web:</span>    {{ $evento->especial->web }}</p>
            <p class="list-group-item"><span class="label label-default">Email:</span>  {{ $evento->especial->email }}</p>
            <p class="list-group-item"><span class="label label-default">Mapa:</span>   
                  @if($mapa)            
                  {{ $mapa['html'] }}                  
                  @endif
            </p>
      </div>
      @foreach($evento->especial->imagenes as $imagen)
      <img src="{{Config::get('params.path_public_image').$imagen->path.$imagen->nombre}}" alt="{{ $imagen->alt }}" />
      @endforeach
      @endif



</div>

<div class="container">      
      <div class="row">
            {{ Form::label('comentario','¿Qué dicen los usuarios?') }}
            <div class="list-group" id='all_comments'>
                  @foreach($evento->comentarios as $comentario)
                  @include('layouts.show_comentario',array('comentario',$comentario))
                  @endforeach
            </div>
      </div>
      @if(Auth::check())
      <div class="row">
            <div class="add_comentario list-group-item">
                  {{ Form::open(array('route' => array('comentarios.store','id'=>$evento->id,'clase'=>get_class($evento)),'id'=>'add_comentario')) }}
                  {{ Form::label('comentario','Agrega tu comentario') }}
                  {{ Form::textArea('comentario', Input::old('comentario'), array('placeholder' => 'comentario', 'class'=>'form-control','id'=>'new_comentario')) }}
                  {{ Form::submit('agregar', array('class' => 'btn btn-sm btn-primary')) }}
                  {{ Form::close() }}                        
            </div>            
      </div>
      @else
      <p>{{ HTML::linkRoute('register.user','Regístrate como usuario para rankear el negocio ') }}</p> 
      @endif
</div>

@else

<h2>No seleccionó ningún evento</h2>

@endif

@stop

@section('scripts')

{{ HTML::script('js/comments.js') }}

@if($mapa)
{{ $mapa['js'] }}
@endif

<script>
      $("#btn_rank").click(function() {

            url = "{{ URL::route('miembro.add_rank',array(get_class($evento),$evento->id)) }}";
            $.post(url).done(function(data) {
                  if (data['error']) {
                        $("#rank").html(data['mensaje']);
                  } else {
                        $("#rank").html("rank: " + data['rank']);
                  }


            });
      });
</script>


@stop
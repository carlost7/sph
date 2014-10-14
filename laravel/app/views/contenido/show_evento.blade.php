@extends('layouts.webpage_master')

@section('wrapper')
<div class="container">

     <!-- @include('layouts.show_catalog',array('action'=>'cartelera'))-->

      @if($evento)

      <h2 class="title_cartelera">{{ $evento->nombre }}</h2>

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
            <p>¿Te gusta este evento? {{ HTML::linkRoute('register.user','Regístrate como usuario para rankear el evento ') }}</p> 
            @endif
      </div>

      @if(count($evento->imagen))
      <img src="{{Config::get('params.path_serve_image').$evento->imagen->path.$evento->imagen->nombre}}" alt="{{ $evento->imagen->alt }}" />
      @endif


      <div class="list-group">  
            <p class="list-group-item"><span class="label label-default info_detalle">Fecha:</span> {{ date('d-m-Y',strtotime($evento->fecha_inicio)).' - '.date('d-m-Y',strtotime($evento->fecha_fin)) }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Horario:</span> {{ date('H:i',strtotime($evento->hora_inicio)).' - '.date('H:i',strtotime($evento->hora_fin)) }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Lugar:</span> {{ $evento->lugar }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Dirección:</span> {{ $evento->direccion }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Descripción:</span> {{ $evento->descripcion }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Telefono:</span> {{ $evento->telefono }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Publicado:</span> {{ ($evento->publicar) ? 'Si' : 'No' }}
                        @if($evento->publicar)
                        {{HTML::image('img/si_no/cartelera/publicado_si.png','El evento está publicado',array('title'=>'El evento está publicado','data-toggle'=>'tooltip','data-placement'=>'bottom','class'=>'img_detalle')) }}
                        @else
                        {{HTML::image('img/si_no/cartelera/publicado_no.png','El evento no está publicado',array('title'=>'El evento no está publicado','data-toggle'=>'tooltip','data-placement'=>'bottom','class'=>'img_detalle')) }}
                        @endif
            </p>
      </div>

      @if(count($evento->masInfo))

      <div class="list-group">  
            <p class="list-group-item"><span class="label label-default info_detalle">Moneda:</span> {{ $evento->moneda }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Costo:</span> {{ $evento->costo }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Edad mínima:</span> {{ $evento->min_edad }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Edad máxima:</span> {{ $evento->max_edad }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Cuenta con alcohol:</span> {{ ($evento->masInfo->alcohol) ? 'Si' : 'No' }}
                        
                        @if(count($evento->masInfo))
                        @if($evento->masInfo->alcohol)
                        {{HTML::image('img/si_no/cartelera/alcohol_si.png','El evento cuenta con alcohol',array('title'=>'El evento cuenta con alcohol','data-toggle'=>'tooltip','data-placement'=>'bottom','class'=>'img_detalle')) }}
                        @else
                        {{HTML::image('img/si_no/cartelera/alcohol_no.png','El evento no cuenta con alcohol',array('title'=>'El evento no cuenta con alcohol','data-toggle'=>'tooltip','data-placement'=>'bottom','class'=>'img_detalle')) }}
                        @endif
            </p>
            
            <p class="list-group-item"><span class="label label-default info_detalle">Acepta tarjeta de credito:</span> {{ ($evento->masInfo->tc) ? 'Si' : 'No'}} 
                        @if($evento->masInfo->tc)
                        {{HTML::image('img/si_no/cartelera/tarjeta_si.png','Se acepta tarjeta de crédito',array('title'=>'Se acepta tarjeta de crédito','data-toggle'=>'tooltip','data-placement'=>'bottom','class'=>'img_detalle')) }}
                        @else
                        {{HTML::image('img/si_no/cartelera/tarjeta_no.png','No se acepta tarjeta de crédito',array('title'=>'No se acepta tarjeta de crédito','data-toggle'=>'tooltip','data-placement'=>'bottom','class'=>'img_detalle')) }}
                        @endif
            </p>
            <p class="list-group-item"><span class="label label-default info_detalle">Acepta tarjeta de debito:</span> {{ ($evento->masInfo->td) ? 'Si' : 'No' }}
                        @if($evento->masInfo->td)
                        {{HTML::image('img/si_no/cartelera/debito_si.png','Se acepta tarjeta de débito',array('title'=>'Se acepta tarjeta de débito','data-toggle'=>'tooltip','data-placement'=>'bottom','class'=>'img_detalle')) }}
                        @else
                        {{HTML::image('img/si_no/cartelera/debito_no.png','No se acepta tarjeta de débito',array('title'=>'No se acepta tarjeta de débito','data-toggle'=>'tooltip','data-placement'=>'bottom','class'=>'img_detalle')) }}
                        @endif
            </p>
            <p class="list-group-item"><span class="label label-default info_detalle">Acepta efectivo:</span> {{ ($evento->masInfo->efectivo) ? 'Si' : 'No' }}
                        
                        @if($evento->masInfo->efectivo)
                        {{HTML::image('img/si_no/cartelera/efectivo_si.png','Se acepta efectivo',array('title'=>'Se acepta efectivo','data-toggle'=>'tooltip','data-placement'=>'bottom','class'=>'img_detalle')) }}
                        @else
                        {{HTML::image('img/si_no/cartelera/efectivo_no.png','No se acepta efectivo',array('title'=>'No se acepta efectivo','data-toggle'=>'tooltip','data-placement'=>'bottom','class'=>'img_detalle')) }}
                        @endif
                        @endif
            </p>
            <p class="list-group-item"><span class="label label-default info_detalle">Otra:</span> {{ $evento->masInfo->otra }}</p>
      </div>

      @endif

      @if($evento->is_especial && count($evento->especial))
      <div class="list-group">  
            <p class="list-group-item"><span class="label label-default info_detalle">Web:</span>    {{ $evento->especial->web }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Email:</span>  {{ $evento->especial->email }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Mapa:</span>   
                  @if($mapa)            
                  {{ $mapa['html'] }}                  
                  @endif
            </p>
      </div>
      @foreach($evento->especial->imagenes as $imagen)
      <img src="{{Config::get('params.path_serve_image').$imagen->path.$imagen->nombre}}" alt="{{ $imagen->alt }}" />
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
            <div class="list-group-item">
                  {{ Form::open(array('route' => array('comentarios.store','id'=>$evento->id,'clase'=>get_class($evento)),'id'=>'add_res')) }}
                  {{ Form::label('comentario','Agrega tu comentario') }}
                  {{ Form::textArea('comentario', Input::old('comentario'), array('placeholder' => 'comentario', 'class'=>'form-control','id'=>'new_comentario')) }}
                  {{ Form::submit('agregar', array('class' => 'btn btn-sm btn-primary')) }}
                  {{ Form::close() }}                        
            </div>            
      </div>
      @else
      <p>{{ HTML::linkRoute('register.user','Regístrate como usuario para comentar') }}</p> 
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

<script>
   $(function () { $("[data-toggle='tooltip']").tooltip(); });
</script>

@stop







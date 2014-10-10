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
            <p>{{ HTML::linkRoute('register.user','Regístrate como usuario para rankear el negocio ') }}</p> 
            @endif
      </div>

      @if(count($evento->imagen))
      <img src="{{Config::get('params.path_public_image').$evento->imagen->path.$evento->imagen->nombre}}" alt="{{ $evento->imagen->alt }}" />
      @endif


      <div class="list-group">  
            <p class="list-group-item"><span class="label label-default info_detalle">Fecha:</span> {{ date('d-m-Y',strtotime($evento->fecha_inicio)).' - '.date('d-m-Y',strtotime($evento->fecha_fin)) }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Horario:</span> {{ date('H:i',strtotime($evento->hora_inicio)).' - '.date('H:i',strtotime($evento->hora_fin)) }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Lugar:</span> {{ $evento->lugar }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Dirección:</span> {{ $evento->direccion }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Descripción:</span> {{ $evento->descripcion }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Telefono:</span> {{ $evento->telefono }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Publicado:</span> {{ ($evento->publicar) ? 'Si' : 'No' }}</p>
      </div>

      @if(count($evento->masInfo))

      <div class="list-group">  
            <p class="list-group-item"><span class="label label-default info_detalle">Moneda:</span> {{ $evento->moneda }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Costo:</span> {{ $evento->costo }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Edad mínima:</span> {{ $evento->min_edad }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Edad máxima:</span> {{ $evento->max_edad }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Cuenta con alcohol:</span> {{ ($evento->masInfo->alcohol) ? 'Si' : 'No' }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Acepta tarjeta de credito:</span> {{ ($evento->masInfo->tc) ? 'Si' : 'No' }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Acepta tarjeta de debito:</span> {{ ($evento->masInfo->td) ? 'Si' : 'No' }}</p>
            <p class="list-group-item"><span class="label label-default info_detalle">Acepta efectivo:</span> {{ ($evento->masInfo->efectivo) ? 'Si' : 'No' }}</p>
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
      <img src="{{Config::get('params.path_public_image').$imagen->path.$imagen->nombre}}" alt="{{ $imagen->alt }}" />
      @endforeach
      @endif

      @else

      <h2>No seleccionó ningún negocio</h2>

      @endif

</div>



@stop

@section('scripts')

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
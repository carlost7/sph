@extends('layouts.webpage_master')

@section('wrapper')
<div class="container">
      @include('layouts.show_catalog')

      @if($negocio)

      <h2>{{ $negocio->nombre }}</h2>
      @if(count($negocio->imagen))
      <img src="{{Config::get('params.path_public_image').$negocio->imagen->path.$negocio->imagen->nombre}}" alt="{{ $negocio->imagen->alt }}" />
      @endif
      <div class="list-group">  
            <p class="list-group-item"><span class="label label-default">Teléfono:</span> {{ $negocio->direccion }}</p>
            <p class="list-group-item"><span class="label label-default">Dirección:</span> {{ $negocio->telefono }}</p>
            <p class="list-group-item"><span class="label label-default">Descripción:</span> {{ $negocio->descripcion }}</p>
            <p class="list-group-item"><span class="label label-default">Publicado:</span> {{ ($negocio->publicar) ? "Si" : "No" }}</p>
      </div>

      @if(count($negocio->masInfo))
      <div class="list-group">  
            <p class="list-group-item"><span class="label label-default">Entregan a Domicilio:</span>{{ ($negocio->masInfo->domicilio)  ? "Si" : "No" }}</p>
            <p class="list-group-item"><span class="label label-default">Para llevar:</span>{{ ($negocio->masInfo->llevar) ? "Si" : "No" }}</p>
            <p class="list-group-item"><span class="label label-default">Moneda:</span>{{ $negocio->masInfo->moneda }}</p>
            <p class="list-group-item"><span class="label label-default">Rango mínimo:</span>{{ $negocio->masInfo->rango_min}}</p>
            <p class="list-group-item"><span class="label label-default">Rango máximo:</span>{{ $negocio->masInfo->rango_max}}</p>
            <p class="list-group-item"><span class="label label-default">Acepta efectivo:</span>{{ ($negocio->masInfo->efectivo) ? "Si" : "No" }}</p>
            <p class="list-group-item"><span class="label label-default">Acepta tarjeta de crédito:</span>{{ ($negocio->masInfo->tc) ? "Si" : "No" }}</p>
            <p class="list-group-item"><span class="label label-default">Acepta tarjeta de débito:</span>{{ ($negocio->masInfo->td) ? "Si" : "No" }}</p>
            <p class="list-group-item"><span class="label label-default">Ambiente familiar:</span>{{ ($negocio->masInfo->familiar) ? "Si" : "No" }}</p>
            <p class="list-group-item"><span class="label label-default">Cuenta con alcohol:</span>{{ ($negocio->masInfo->alcohol) ? "Si" : "No" }}</p>
      </div>
      @endif

      @if(count($negocio->horario))
      <div class="list-group">  
            <p class="list-group-item"><span class="label label-default">Lunes:</span>    {{ date('H:i',strtotime($negocio->horario->lun_ini)).' - '.date('H:i',strtotime($negocio->horario->lun_fin)) }}</p>
            <p class="list-group-item"><span class="label label-default">Martes:</span>   {{ date('H:i',strtotime($negocio->horario->mar_ini)).' - '.date('H:i',strtotime($negocio->horario->mar_fin)) }}</p>
            <p class="list-group-item"><span class="label label-default">Miércoles:</span>{{ date('H:i',strtotime($negocio->horario->mie_ini)).' - '.date('H:i',strtotime($negocio->horario->mie_fin)) }}</p>
            <p class="list-group-item"><span class="label label-default">Jueves:</span>   {{ date('H:i',strtotime($negocio->horario->jue_ini)).' - '.date('H:i',strtotime($negocio->horario->jue_fin)) }}</p>
            <p class="list-group-item"><span class="label label-default">Viernes:</span>  {{ date('H:i',strtotime($negocio->horario->vie_ini)).' - '.date('H:i',strtotime($negocio->horario->vie_fin)) }}</p>
            <p class="list-group-item"><span class="label label-default">Sábado:</span>   {{ date('H:i',strtotime($negocio->horario->sab_ini)).' - '.date('H:i',strtotime($negocio->horario->sab_fin)) }}</p>
            <p class="list-group-item"><span class="label label-default">Domingo:</span>  {{ date('H:i',strtotime($negocio->horario->dom_ini)).' - '.date('H:i',strtotime($negocio->horario->dom_fin)) }}</p>
      </div>
      @endif

      @if($negocio->is_especial && count($negocio->especial))
      <div class="list-group">  
            <p class="list-group-item"><span class="label label-default">Web:</span>    {{ $negocio->especial->webpage }}</p>
            <p class="list-group-item"><span class="label label-default">Email:</span>  {{ $negocio->especial->email }}</p>
            <p class="list-group-item"><span class="label label-default">Mapa:</span>   
                  @if($mapa)            
                  {{ $mapa['html'] }}                  
                  @endif
            </p>
      </div>

      @foreach($negocio->especial->imagenes as $imagen)
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
@stop
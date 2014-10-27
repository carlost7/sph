@extends('layouts.webpage_master')

@section('wrapper')
<div class="container">
      <!-- @include('layouts.show_catalog',array('action'=>'negocio'))-->

      <div class="row">
            <div class="col-sm-10">
                  @if($negocio)

                  <h2 class="title_negocio">{{ $negocio->nombre }}</h2>

                  <div class="rank" id="rank">
                        @if(Auth::check() && Auth::user()->userable_type === 'Miembro')
                        @if($negocio->is_especial)    
                        @if($add_rank)
                        <button type="button" class="btn btn-small btn-primary" id="btn_rank"> + Rank</button>
                        rank: {{ $negocio->rank }}
                        @else

                        rank: {{ $negocio->rank }}

                        @endif
                        @else
                        <button type="button" class="btn btn-small btn-primary" id="btn_rank" disabled="disabled"> + Rank</button>                  
                        @endif                  
                        @else
                        <p>¿Te gusta este lugar? {{ HTML::linkRoute('register.user','Regístrate como usuario para rankear el negocio ') }}</p> 
                        @endif
                  </div>


                  @if(count($negocio->imagen))
                  <img src="{{Config::get('params.path_serve_image').$negocio->imagen->path.$negocio->imagen->nombre}}" alt="{{ $negocio->imagen->alt }}" />
                  @endif
                  <div class="list-group">  
                        <p class="list-group-item"><span class="label label-default info_detalle">Teléfono:</span> {{ $negocio->telefono }}</p>
                        <p class="list-group-item"><span class="label label-default info_detalle">Dirección:</span> {{ $negocio->direccion }}</p>
                        <p class="list-group-item"><span class="label label-default info_detalle">Descripción:</span> {{ $negocio->descripcion }}</p>
                        <p class="list-group-item"><span class="label label-default info_detalle">Publicado:</span> {{ ($negocio->publicar) ? "Si" : "No" }}</p>
                  </div>

                  <div class="list-group">
                      <p class="list-group-item"><span class="label label-default info_detalle">Categoría</span>{{$negocio->categoria->categoria}}</p>
                      <p class="list-group-item"><span class="label label-default info_detalle">Subcategoría</span>{{(count($negocio->subcategoria))?$negocio->subcategoria->subcategoria:""}}</p>
                      <p class="list-group-item"><span class="label label-default info_detalle">Estado</span>{{$negocio->estado->estado}}</p>
                      <p class="list-group-item"><span class="label label-default info_detalle">Zona</span>{{(count($negocio->zona))?$negocio->zona->zona:""}}</p>
                  </div>
                  
                  @if(count($negocio->masInfo))
                  <div class="list-group">  
                        <p class="list-group-item"><span class="label label-default">Acepta Efectivo:</span>{{ ($negocio->masInfo->efectivo)  ? "Si" : "No" }}</p>
                        <p class="list-group-item"><span class="label label-default">Acepta Tarjeta de Credito:</span>{{ ($negocio->masInfo->tc) ? "Si" : "No" }}</p>
                        <p class="list-group-item"><span class="label label-default">Acepta Tarjeta de Debito:</span>{{ ($negocio->masInfo->td)  ? "Si" : "No" }}</p>
                        <p class="list-group-item"><span class="label label-default">Es Ambiente Familiar:</span>{{ ($negocio->masInfo->familiar)  ? "Si" : "No"}}</p>
                        <p class="list-group-item"><span class="label label-default">Cuenta con Estacionamiento:</span>{{ ($negocio->masInfo->estacionamiento)  ? "Si" : "No"}}</p>
                        <p class="list-group-item"><span class="label label-default">Cuenta con Valet Parking:</span>{{ ($negocio->masInfo->valet_parking) ? "Si" : "No" }}</p>
                        <p class="list-group-item"><span class="label label-default">Cuenta con Wi-FiI:</span>{{ ($negocio->masInfo->wifi) ? "Si" : "No" }}</p>
                        <p class="list-group-item"><span class="label label-default">Se Permiten Mascotas:</span>{{ ($negocio->masInfo->mascotas) ? "Si" : "No" }}</p>      
                  </div>
                  @endif

                  @if(count($negocio->horario))
                  <div class="list-group">  
                        <p class="list-group-item"><span class="label label-default info_detalle">Lunes:</span>    {{ date('H:i',strtotime($negocio->horario->lun_ini)).' - '.date('H:i',strtotime($negocio->horario->lun_fin)) }}</p>
                        <p class="list-group-item"><span class="label label-default info_detalle">Martes:</span>   {{ date('H:i',strtotime($negocio->horario->mar_ini)).' - '.date('H:i',strtotime($negocio->horario->mar_fin)) }}</p>
                        <p class="list-group-item"><span class="label label-default info_detalle">Miércoles:</span>{{ date('H:i',strtotime($negocio->horario->mie_ini)).' - '.date('H:i',strtotime($negocio->horario->mie_fin)) }}</p>
                        <p class="list-group-item"><span class="label label-default info_detalle">Jueves:</span>   {{ date('H:i',strtotime($negocio->horario->jue_ini)).' - '.date('H:i',strtotime($negocio->horario->jue_fin)) }}</p>
                        <p class="list-group-item"><span class="label label-default info_detalle">Viernes:</span>  {{ date('H:i',strtotime($negocio->horario->vie_ini)).' - '.date('H:i',strtotime($negocio->horario->vie_fin)) }}</p>
                        <p class="list-group-item"><span class="label label-default info_detalle">Sábado:</span>   {{ date('H:i',strtotime($negocio->horario->sab_ini)).' - '.date('H:i',strtotime($negocio->horario->sab_fin)) }}</p>
                        <p class="list-group-item"><span class="label label-default info_detalle">Domingo:</span>  {{ date('H:i',strtotime($negocio->horario->dom_ini)).' - '.date('H:i',strtotime($negocio->horario->dom_fin)) }}</p>
                  </div>
                  @endif

                  @if($negocio->is_especial && count($negocio->especial))
                  <div class="list-group">  
                        <p class="list-group-item"><span class="label label-default info_detalle">Web:</span>    {{ $negocio->especial->webpage }}</p>
                        <p class="list-group-item"><span class="label label-default info_detalle">Email:</span>  {{ $negocio->especial->email }}</p>
                        <p class="list-group-item"><span class="label label-default info_detalle">Mapa:</span>   
                              @if($mapa)            
                              {{ $mapa['html'] }}                  
                              @endif
                        </p>
                  </div>

                  @foreach($negocio->especial->imagenes as $imagen)
                  <img src="{{Config::get('params.path_serve_image').$imagen->path.$imagen->nombre}}" alt="{{ $imagen->alt }}" />
                  @endforeach

                  @endif

                  @else

                  <h2>No seleccionó ningún negocio</h2>

                  @endif
            </div>
            <div class="col-sm-2">
                  @if($negocio && count($negocio->promociones))
                  @foreach($negocio->promociones as $promocion)
                  <h2>{{ $promocion->nombre }}</h2>
                  @if($promocion->imagen->count())
                  <img src="{{Config::get('params.path_serve_image').$promocion->imagen->path.$promocion->imagen->nombre}}" alt="{{ $promocion->imagen->alt }}" />
                  @endif
                  <div class="list-group">  
                        <p class="list-group-item"><span class="label label-default info_detalle">Negocio:</span> {{ $promocion->negocio->nombre }}</p>      
                        <p class="list-group-item"><span class="label label-default info_detalle">Nombre:</span> {{ $promocion->nombre }}</p>      
                        <p class="list-group-item"><span class="label label-default info_detalle">Código:</span> {{ $promocion->codigo }}</p>
                        <p class="list-group-item"><span class="label label-default info_detalle">Descripción:</span> {{ $promocion->descripcion }}</p>
                        <p class="list-group-item"><span class="label label-default info_detalle">Vigencia:</span> {{ date('d-m-Y H:i',strtotime($promocion->vigencia_inicio)).' - '.date('d-m-Y H:i',strtotime($promocion->vigencia_fin)) }}</p>                        
                  </div>
                  @endforeach
                  @endif
            </div>            
      </div>
</div>

<div class="container">      
      <div class="row">
            {{ Form::label('comentario','¿Qué dicen los usuarios?') }}
            <div class="list-group" id='all_comments'>
                  @foreach($negocio->comentarios as $comentario)
                  @include('layouts.show_comentario',array('comentario',$comentario))
                  @endforeach
            </div>
      </div>
      @if(Auth::check())
      <div class="row">
            <div class="list-group-item">
                  {{ Form::open(array('route' => array('comentarios.store','id'=>$negocio->id,'clase'=>get_class($negocio)),'id'=>'add_res')) }}
                  {{ Form::label('comentario','Agrega tu comentario') }}
                  {{ Form::textArea('comentario', Input::old('comentario'), array('placeholder' => 'comentario', 'class'=>'form-control','id'=>'new_comentario')) }}
                  {{ Form::submit('agregar', array('class' => 'btn btn-sm btn-primary')) }}
                  {{ Form::close() }}                        
            </div>            
      </div>
      @else
      <p>{{ HTML::linkRoute('register.user','Regístrate como usuario para comentar ') }}</p> 
      @endif
</div>


@stop

@section('scripts')

{{ HTML::script('js/comments.js') }}

@if($mapa)
{{ $mapa['js'] }}
@endif

<script>
      $("#btn_rank").click(function() {

            url = "{{ URL::route('miembro.add_rank',array(get_class($negocio),$negocio->id)) }}";
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

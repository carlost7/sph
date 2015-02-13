@extends('layouts.webpage_master')

@section('wrapper')
<div class="container">
@if($evento)
      <div class="row">
            <div class="col-sm-12">
                  <a href="{{ URL::previous() }}" >Regresar</a>
            </div>
            <div class="col-lg-12">
                  <!-- @include('layouts.show_catalog',array('action'=>'cartelera'))-->
                  <h2 class="title_cartelera">{{ $evento->nombre }}</h2>
                  <div class="rank" id="rank">
                        @if(Auth::check() && Auth::user()->userable_type == 'Miembro')
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
                              <p>¿Te gusta este lugar? {{ HTML::linkRoute('register.user','Regístrate como usuario para rankear el negocio ') }}</p> 
                        @endif
                  </div>
                  @if($evento->imagen_file_name != "")
                  <img src="{{ URL::to("/").$evento->imagen->url('medium') }}">
                  @endif

                  <div class="list-group">  
                        <p class="list-group-item"><span class="label label-default">Estado:</span> {{ $evento->estado->estado }}</p>
                        @if(count($evento->zona))
                        <p class="list-group-item"><span class="label label-default">Zona:</span> {{ $evento->zona->zona }}</p>
                        @endif
                        <p class="list-group-item"><span class="label label-default">Categoria:</span> {{ $evento->categoria->categoria }}</p>
                        @if(count($evento->subcategoria))
                        <p class="list-group-item"><span class="label label-default">Subcategoria:</span>    {{ $evento->subcategoria->subcategoria }}</p>      
                        @endif
                  </div>
                  
                  <div class="list-group">        
                        <p class="list-group-item"><span class="label label-default">Fecha:</span>{{(($evento->fecha_inicio != "")?$evento->fecha_inicio->format('d/m/Y'):"")." -".(($evento->fecha_fin != "")? $evento->fecha_fin->format('d/m/Y'):"")}}</p>      
                        <p class="list-group-item"><span class="label label-default">Horario:</span> {{ $evento->hora_inicio->format('H:i').' - '.$evento->hora_fin->format('H:i') }}</p>
                        <p class="list-group-item"><span class="label label-default">Lugar:</span> {{ $evento->lugar }}</p>
                        <p class="list-group-item"><span class="label label-default">Dirección:</span> {{ $evento->direccion }}</p>
                        <p class="list-group-item"><span class="label label-default">Descripción:</span> {{ $evento->descripcion }}</p>
                        <p class="list-group-item"><span class="label label-default">Telefono:</span> {{ $evento->telefono }}</p>      
                        <p class="list-group-item"><span class="label label-default">Web:</span>    {{ $evento->webpage }}</p>
                        <p class="list-group-item"><span class="label label-default">Email:</span>  {{ $evento->email }}</p>
                        <p class="list-group-item"><span class="label label-default">Rank:</span>   {{ $evento->likes }}</p>      
                        <p class="list-group-item"><span class="label label-default">Publicado:</span> {{ ($evento->publicar) ? 'Si' : 'No' }}</p>
                  </div>


                  @if(count($evento->masInfo))

                  <div class="list-group">  
                        <p class="list-group-item"><span class="label label-default">Moneda:</span> {{ $evento->masInfo->moneda }}</p>
                        <p class="list-group-item"><span class="label label-default">Costo:</span> {{ $evento->masInfo->costo }}</p>
                        <p class="list-group-item"><span class="label label-default">Edad mínima:</span> {{ $evento->masInfo->min_edad }}</p>
                        <p class="list-group-item"><span class="label label-default">Edad máxima:</span> {{ $evento->masInfo->max_edad }}</p>
                        <p class="list-group-item"><span class="label label-default">Cuenta con alcohol:</span> {{ ($evento->masInfo->alcohol) ? 'Si' : 'No' }}</p>
                        <p class="list-group-item"><span class="label label-default">Acepta tarjeta de credito:</span> {{ ($evento->masInfo->tc) ? 'Si' : 'No' }}</p>
                        <p class="list-group-item"><span class="label label-default">Acepta tarjeta de debito:</span> {{ ($evento->masInfo->td) ? 'Si' : 'No' }}</p>
                        <p class="list-group-item"><span class="label label-default">Acepta efectivo:</span> {{ ($evento->masInfo->efectivo) ? 'Si' : 'No' }}</p>      
                  </div>

                  @endif

                  @if(isset($evento->lat) && isset($evento->long))      
                  <div class="form-group">
                        <div id="map-canvas"></div>      
                        <div id="transparente"></div>
                        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
                        <script type="text/javascript">
                               var map;
                               var markers = [];
                               var lat = {{ $evento->lat }};
                               var long = {{ $evento->long }};
                               function initialize() {

                                         var mapOptions = {
                                         center: {lat: lat, lng: long},
                                                 zoom: 16
                                         };
                                       pos = new google.maps.LatLng(lat, long);
                                       map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                                       var marker = new google.maps.Marker({
                                       position: pos,
                                               map: map
                                       });
                               }

                                   google.maps.event.addDomListener(window, 'load', initialize);


                             </script>            
                  </div>
                  @endif

                  @if(count($evento->imagenes))
                  <div class="form-group">
                        <div class="row">
                              @foreach($evento->imagenes as $imagen)
                              <div class="col-sm-3">
                                    <img src="{{ URL::to("/").$imagen->imagen->url('medium')}}">
                              </div>      
                              @endforeach
                        </div>
                  </div>
                  @endif

                  
            </div>
      </div>
      <div class="row">
            <div class="col-sm-12">
                  {{ Form::label('comentario','¿Qué dicen los usuarios?') }}
                  <div class="list-group" id='all_comments'>
                        @foreach($evento->comentarios as $comentario)
                        @include('layouts.show_comentario',array('comentario',$comentario))
                        @endforeach
                  </div>
            </div>
      </div>
      <div class="row">
            <div class="col-sm-12">
                  @if(Auth::check())
                  <div class="list-group-item">
                        {{ Form::open(array('route' => array('comentarios.store','id'=>$evento->id,'clase'=>get_class($evento)),'id'=>'add_res')) }}
                        {{ Form::label('comentario','Agrega tu comentario') }}
                        {{ Form::textArea('comentario', Input::old('comentario'), array('placeholder' => 'comentario', 'class'=>'form-control','id'=>'new_comentario')) }}
                        {{ Form::submit('agregar', array('class' => 'btn btn-sm btn-primary')) }}
                        {{ Form::close() }}                        
                  </div>      
                  @else
                  <p>{{ HTML::linkRoute('register.user','Regístrate como usuario para comentar') }}</p> 
                  @endif      
            </div>      
      </div>
@else
      <h2>No seleccionó ningún evento</h2>
@endif
</div>


@stop

@section('scripts')

{{ HTML::script('js/comments.js') }}
<script>
$("#btn_rank").click(function () {
      url = "{{ URL::route('miembro.add_rank_evento',array($evento->id)) }}";
      $.post(url).done(function (data) {
            if (data['error']) {
                  $("#rank").html(data['mensaje']);
            } else {
                  $("#rank").html("rank: " + data['rank']);
            }
      });
});
</script>

<script>
      $(function () {
            $("[data-toggle='tooltip']").tooltip();
      });
</script>

@stop







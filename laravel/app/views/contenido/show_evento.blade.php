@extends('layouts.webpage_master')

@section('wrapper')
<div class="container">
@if($evento)
      <div class="row">
          
          
          
            <div class="col-sm-3 regresar_interno">
                  <a href="{{ URL::previous() }}"  >Regresar</a>
            </div>
          
          
            <div class="col-sm-9 rank_div">
                  <!-- @include('layouts.show_catalog',array('action'=>'cartelera'))-->
                  
                  <div class="rank" id="rank">
                        @if(Auth::check() && Auth::user()->userable_type == 'Miembro')
                              @if($evento->is_especial)    
                                    @if($add_rank)
                                     {{HTML::image('img/rank.png','Rank Sphellar')}} <button type="button" class="btn_chico" id="btn_rank"> + Rank</button>
                                    rank: {{ $evento->rank }}
                                    @else
                                    rank: {{ $evento->rank }}
                                    @endif
                              @else
                              <button type="button" class="btn_chico" id="btn_rank" disabled="disabled"> + Rank</button>                  
                              @endif                  
                        @else
                              <p>  {{HTML::image('img/rank.png','Rank Sphellar')}} ¿Te gusta este lugar? {{ HTML::linkRoute('register.user','Regístrate como usuario para rankear el negocio ') }}</p> 
                </div>         @endif
                  </div>
               </div>    
                  
                  <div class="img_negocio">
                  @if($evento->imagen_file_name != "")
                  <img src="{{ URL::to("/").$evento->imagen->url('medium') }}">
                  @endif
                  
                  </div>
                  
            
          
          
          
          
          
           <div class="col-sm-12 clear">
               
               <h2 class="title_eventodetalle">{{ $evento->nombre }}</h2>
               
               
           </div>

                  <div class="list-group principal_infoevento">  
                        <p class="list-group-item"><span class="label label-default">Estado:</span> {{ $evento->estado->estado }}</p>
                        @if(count($evento->zona))
                        <p class="list-group-item"><span class="label label-default">Zona:</span> {{ $evento->zona->zona }}</p>
                        @endif
                        <p class="list-group-item"><span class="label label-default">Categoria:</span> {{ $evento->categoria->categoria }}</p>
                        @if(count($evento->subcategoria))
                        <p class="list-group-item"><span class="label label-default">Subcategoria:</span>    {{ $evento->subcategoria->subcategoria }}</p>      
                        @endif
                  </div>
                  
                  <div class="list-group main_info">        
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

                  <div class="list-group especial_info">  
                      <p class="list-group-item"><span class="label label-default">Moneda:</span> <span class="etiquetado_masInfo">{{ $evento->masInfo->moneda }}</span></p>
                        <p class="list-group-item"><span class="label label-default">Costo:</span> <span class="etiquetado_masInfo">{{ $evento->masInfo->costo }}</span></p>
                        <p class="list-group-item"><span class="label label-default">Edad mínima:</span> <span class="etiquetado_masInfo">{{ $evento->masInfo->min_edad }}</span></p>
                        <p class="list-group-item"><span class="label label-default">Edad máxima:</span> <span class="etiquetado_masInfo">{{ $evento->masInfo->max_edad }}</span></p>
                        
                        
                        @if ($evento->masInfo->alcohol)  
                        <span><p class="list-group-item"><span class="label label-default">Cuenta con alcohol: </span>{{HTML::image('img/icons_masINFO/alcohol.png','Alcohol')}}</p></span>
                        @else
                        <span><p class="list-group-item"><span class="label label-default">Cuenta con alcohol: </span>{{HTML::image('img/icons_masINFO/alcohol_no.png','No se ingiere alcohol')}}</p></span>
                        @endif
                        
                        @if ($evento->masInfo->tc)  
                        <span><p class="list-group-item"><span class="label label-default">Acepta tarjeta de credito: </span>{{HTML::image('img/icons_masINFO/tarjeta.png','Tarjeta de crédito')}}</p></span>
                        @else
                        <span><p class="list-group-item"><span class="label label-default">Acepta tarjeta de credito: </span>{{HTML::image('img/icons_masINFO/tarjeta_no.png','No se acepta tarjeta de crédito')}}</p></span>
                        @endif
                        
                        @if ($evento->masInfo->td)  
                        <span><p class="list-group-item"><span class="label label-default">Acepta tarjeta de debito: </span>{{HTML::image('img/icons_masINFO/tarjeta.png','Tarjeta de débito')}}</p></span>
                        @else
                        <span><p class="list-group-item"><span class="label label-default">Acepta tarjeta de debito: </span>{{HTML::image('img/icons_masINFO/tarjeta_no.png','No se acepta tarjeta de débito')}}</p></span>
                        @endif
                        
                        
                        @if ($evento->masInfo->efectivo)  
                        <span><p class="list-group-item"><span class="label label-default">Acepta efectivo: </span>{{HTML::image('img/icons_masINFO/pagos_diferidos.png','Acepta efectivo')}}</p></span>
                        @else
                        <span><p class="list-group-item"><span class="label label-default">Acepta efectivo: </span>{{HTML::image('img/icons_masINFO/efectivo_no.png','No se acepta efectivo')}}</p></span>
                        @endif
                        
                        
                        
                        
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
                          <div class="main">
				<div id="fc-slideshow" class="fc-slideshow">
                                    
                                    
                                    <h2 class="title_index padding_especial"><span>Galería de imágenes</span></h2>
					<ul class="fc-slides">
                                            
                              @foreach($evento->imagenes as $imagen)
                              <li><img src="{{ URL::to("/").$imagen->imagen->url('large')}}"></li>
                              
                              @endforeach
                              
                                        </ul>
                        </div>
                  </div>
                  @endif
                  
                   </div>
                  
                   

                  
            
         <div class="row">
            <div class="col-sm-6">
                  {{HTML::image('img/comment.png','Comentarios Sphellar')}} {{ Form::label('comentario','¿Qué dicen los usuarios?') }}
                  <div class="list-group" id='all_comments'>
                        @foreach($evento->comentarios as $comentario)
                        @include('layouts.show_comentario',array('comentario',$comentario))
                        @endforeach
                  </div>
            </div>
      
            <div class="col-sm-6">
                  @if(Auth::check())
                  <div class="list-group-item">
                        {{ Form::open(array('route' => array('comentarios.store','id'=>$evento->id,'clase'=>get_class($evento)),'id'=>'add_res')) }}
                        {{HTML::image('img/comments_user.png','Agregar Comentarios')}}  {{ Form::label('comentario','Agrega tu comentario') }}
                        {{ Form::textArea('comentario', Input::old('comentario'), array('placeholder' => 'comentario', 'class'=>'form-control','id'=>'new_comentario')) }}
                        {{ Form::submit('agregar', array('class' => 'btn_chico')) }}
                        {{ Form::close() }}                        
                  </div>      
                  @else
                  <p class="rank_text"> {{HTML::image('img/comments_user.png','Comentarios Sphellar')}} {{ HTML::linkRoute('register.user','Regístrate como usuario para comentar') }}</p> 
                  @endif      
            </div>      
      </div>
@else
      <h2>No seleccionó ningún evento</h2>
@endif
</div>
    </div>


@stop

@section('scripts')



{{ HTML::script('js/comments.js') }}

{{ HTML::script('js/comments.js') }}

{{ HTML::script('js/vendor/galeria_circle/1.9.0.jquery.min.js') }}

{{ HTML::script('js/vendor/galeria_circle/jquery.flipshow.js') }}

{{ HTML::script('js/vendor/galeria_circle/modernizr.custom.js') }}

{{ HTML::style('css/galeria_circle/component.css') }} 
 
{{ HTML::style('css/galeria_circle/default.css') }}   

<script>
	$( function() {
				
	$( '#fc-slideshow' ).flipshow();

	} );
</script>


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







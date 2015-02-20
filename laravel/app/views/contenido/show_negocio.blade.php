@extends('layouts.webpage_master')

@section('wrapper')
<div class="container">
    
    
      <div class="row">
           
         
          
            <div class="col-sm-3 regresar_interno">
                  <a href="{{ URL::previous() }}"  >Regresar</a>
            </div>
          
          
         
                  
            @if($negocio)
            <div class="col-sm-9 rank_div">

                
                  
                  <div class="rank" id="rank">
                        @if(Auth::check() && Auth::user()->userable_type == 'Miembro')
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
                        
                        
                         
                              <p class="rank_text">  {{HTML::image('img/rank.png','Rank Sphellar')}} ¿Te gusta este lugar? {{ HTML::linkRoute('register.user','Regístrate como usuario para rankear el negocio ') }}</p> 
                        @endif
                  </div>
            </div>
            
            
      </div>
          
         
              
               <div class="img_negocio">
                  @if($negocio->imagen_file_name != "")
                  <img src="{{ URL::to("/").$negocio->imagen->url('medium')}}">
                  @endif
                  
                </div>
          
          
          <div class="col-sm-12">
          
                
                
                    <h2 class="title_negociodetalle">{{ $negocio->nombre }}</h2>
                
                  
               
                    
          </div>
              
         
    
    
    
              
                  
                  <div class="list-group principal_info">  
                        <p class="list-group-item"><span class="label label-default">Estado:</span> {{ $negocio->estado->estado }}</p>
                        @if(count($negocio->zona))
                        <p class="list-group-item"><span class="label label-default">Zona:</span> {{ $negocio->zona->zona }}</p>
                        @endif
                        <p class="list-group-item"><span class="label label-default">Categoria:</span> {{ $negocio->categoria->categoria }}</p>
                        @if(count($negocio->subcategoria))
                        <p class="list-group-item"><span class="label label-default">Subcategoria:</span>    {{ $negocio->subcategoria->subcategoria }}</p>      
                        @endif
                        
                        
                  </div>
                  
    
    
                   @if(count($negocio->masInfo))
                  <div class="list-group especial_info">  
                        @if ($negocio->masInfo->tc)  
                        <span><p class="list-group-item"><span class="label label-default">Tarjeta de crédito: </span>{{HTML::image('img/icons_masINFO/tarjeta.png','Tarjeta de crédito')}}</p></span>
                        @endif                        
                        @if ($negocio->masInfo->td)  
                        <span><p class="list-group-item"><span class="label label-default">Tarjeta de débito: </span>{{HTML::image('img/icons_masINFO/tarjeta.png','Tarjeta de crédito')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->estacionamiento)  
                        <span><p class="list-group-item"><span class="label label-default">Estacionamiento: </span>{{HTML::image('img/icons_masINFO/estacionamiento.png','Estacionamiento')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->valet)  
                        <span><p class="list-group-item"><span class="label label-default">Valet: </span>{{HTML::image('img/icons_masINFO/valet.png','Valet parking')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->envio_domicilio)  
                        <span><p class="list-group-item"><span class="label label-default">Envio_domicilio: </span>{{HTML::image('img/icons_masINFO/envio_domicilio.png','Envio a domicilio')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->wifi)  
                        <span><p class="list-group-item"><span class="label label-default">Wifi: </span>{{HTML::image('img/icons_masINFO/wifi.png','Wifi')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->paqueteria)  
                        <span><p class="list-group-item"><span class="label label-default">Paqueteria: </span>{{HTML::image('img/icons_masINFO/paqueteria.png','Paqueteria')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->mascotas)  
                        <span><p class="list-group-item"><span class="label label-default">Mascotas: </span>{{HTML::image('img/icons_masINFO/mascotas.png','Mascotas')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->barra_libre)  
                        <span><p class="list-group-item"><span class="label label-default">Barra_libre: </span>{{HTML::image('img/icons_masINFO/barra_libre.png','Barra libre')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->formal)  
                        <span><p class="list-group-item"><span class="label label-default">Formal: </span>{{HTML::image('img/icons_masINFO/formal.png','Formal')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->camara_perm)  
                        <span><p class="list-group-item"><span class="label label-default">Camara_perm: </span>{{HTML::image('img/icons_masINFO/camara.png','Cámara permanente')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->restaurante)  
                        <span><p class="list-group-item"><span class="label label-default">Restaurante: </span>{{HTML::image('img/icons_masINFO/restaurante.png','Restaurante')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->solo_mujeres)  
                        <span><p class="list-group-item"><span class="label label-default">Solo_mujeres: </span>{{HTML::image('img/icons_masINFO/solo_mujeres.png','Solo mujeres')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->solo_hombres)  
                        <span><p class="list-group-item"><span class="label label-default">Solo_hombres: </span>{{HTML::image('img/icons_masINFO/solo_hombres.png','Solo hombres')}}</p></span>
                        @endif
                        

                        @if ($negocio->masInfo->personalizado)  
                        <span><p class="list-group-item"><span class="label label-default">Personalizado: </span>{{HTML::image('img/icons_masINFO/personalizado.png','Personalizado')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->taller)  
                        <span><p class="list-group-item"><span class="label label-default">Taller: </span>{{HTML::image('img/icons_masINFO/taller.png','Taller')}}</p></span>
                        @endif
                        
                        @if ($negocio->masInfo->clases_extra)  
                        <span><p class="list-group-item"><span class="label label-default">Clases_extra: </span>{{HTML::image('img/icons_masINFO/clases_extra.png','Clases extra')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->informacion)  
                        <span><p class="list-group-item"><span class="label label-default">Informacion: </span>{{HTML::image('img/icons_masINFO/informacion.png','Informacion')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->lavanderia)  
                        <span><p class="list-group-item"><span class="label label-default">Lavanderia: </span>{{HTML::image('img/icons_masINFO/lavanderia.png','Lavanderia')}}</p></span>
                        @endif
                        
                        @if ($negocio->masInfo->gimnasio)  
                        <span><p class="list-group-item"><span class="label label-default">Gimnasio: </span>{{HTML::image('img/icons_masINFO/gimnasio.png','Gimnasio')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->membresia)  
                        <span><p class="list-group-item"><span class="label label-default">Membresia: </span>{{HTML::image('img/icons_masINFO/membresia.png','Membresia')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->cafeteria)  
                        <span><p class="list-group-item"><span class="label label-default">Cafeteria: </span>{{HTML::image('img/icons_masINFO/cafeteria.png','Cafetería')}}</p></span>
                        @endif

                       <!-- @if ($negocio->masInfo->pension)  
                        <span><p class="list-group-item"><span class="label label-default">Pension: </span>Si</p></span>
                        @endif
                       -->

                        @if ($negocio->masInfo->cambios)  
                        <span><p class="list-group-item"><span class="label label-default">Cambios: </span>{{HTML::image('img/icons_masINFO/cambios.png','Cambios')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->devoluciones)  
                        <span><p class="list-group-item"><span class="label label-default">Devoluciones: </span>{{HTML::image('img/icons_masINFO/devoluciones.png','Devoluciones')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->bicicleta)  
                        <span><p class="list-group-item"><span class="label label-default">Bicicleta: </span>{{HTML::image('img/icons_masINFO/bicicleta.png','Bicicleta')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->alcohol)  
                        <span><p class="list-group-item"><span class="label label-default">Alcohol:  </span>{{HTML::image('img/icons_masINFO/alcohol.png','Alcohol')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->familiar)  
                        <span><p class="list-group-item"><span class="label label-default">Familiar: </span>{{HTML::image('img/icons_masINFO/valet.png','Valet parking')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->cita)  
                        <span><p class="list-group-item"><span class="label label-default">Cita: </span>{{HTML::image('img/icons_masINFO/cita.png','Cita')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->pagos_diferidos)  
                        <span><p class="list-group-item"><span class="label label-default">Pagos_diferidos: </span>{{HTML::image('img/icons_masINFO/pagos_diferidos.png','Pagos_diferidos')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->facturacion)  
                        <span><p class="list-group-item"><span class="label label-default">Facturacion: </span>{{HTML::image('img/icons_masINFO/facturacion.png','Facturacion')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->mensajeria)  
                        <span><p class="list-group-item"><span class="label label-default">Mensajeria: </span>{{HTML::image('img/icons_masINFO/mensajeria.png','Mensajeria')}}</p></span>
                        @endif

                        @if ($negocio->masInfo->internacional)  
                        <span><p class="list-group-item"><span class="label label-default">Internacional: </span>{{HTML::image('img/icons_masINFO/internacional.png','Internacional')}}</p></span>
                        @endif
                        

                  </div>
                  @endif
                  
                  
                  
    
                  <div class="list-group main_info">  
                      
                        <p class="list-group-item"><span class="label label-default">Dirección:</span> {{ $negocio->direccion }}</p>
                        
                        <p class="list-group-item"><span class="label label-default">Teléfono:</span> {{ $negocio->telefono }}</p>
                        
                        <p class="list-group-item"><span class="label label-default">Descripción:</span> {{ $negocio->descripcion }}</p>
                        <p class="list-group-item"><span class="label label-default">Web:</span>    {{ $negocio->webpage }}</p>
                        <p class="list-group-item"><span class="label label-default">Email:</span>  {{ $negocio->email }}</p>
                        <p class="list-group-item"><span class="label label-default">Rank:</span>   {{ $negocio->likes }}</p>      
                        <p class="list-group-item"><span class="label label-default">Publicado:</span> {{ ($negocio->publicar) ? "Si" : "No" }}</p>
                  </div>

                 

                  @if(count($negocio->horario))
                  <div class="list-group horarios">  
                        <p class="list-group-item"><span class="label label-default">Lunes:</span>    {{ $negocio->horario->lun_ini.' - '.$negocio->horario->lun_fin }}</p>
                        <p class="list-group-item"><span class="label label-default">Martes:</span>   {{ $negocio->horario->mar_ini.' - '.$negocio->horario->mar_fin }}</p>
                        <p class="list-group-item"><span class="label label-default">Miércoles:</span>{{ $negocio->horario->mie_ini.' - '.$negocio->horario->mie_fin }}</p>
                        <p class="list-group-item"><span class="label label-default">Jueves:</span>   {{ $negocio->horario->jue_ini.' - '.$negocio->horario->jue_fin }}</p>
                        <p class="list-group-item"><span class="label label-default">Viernes:</span>  {{ $negocio->horario->vie_ini.' - '.$negocio->horario->vie_fin }}</p>
                        <p class="list-group-item"><span class="label label-default">Sábado:</span>   {{ $negocio->horario->sab_ini.' - '.$negocio->horario->sab_fin }}</p>
                        <p class="list-group-item"><span class="label label-default">Domingo:</span>  {{ $negocio->horario->dom_ini.' - '.$negocio->horario->dom_fin }}</p>
                  </div>
                  @endif
                  @if(isset($negocio->lat) && isset($negocio->long))      
                  <div class="form-group">
                        <div id="map-canvas"></div>      
                        <div id="transparente"></div>
                        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
                        <script type="text/javascript">
                        var map;
                        var markers = [];
                        var lat = {{ $negocio->lat }};
                        var long = {{ $negocio->long }};
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
                 
                
                  
                  <div class="row">
                      
                      
                       <div class="col-sm-6">
                  
                  <div class="form-group">
                       <div class="main">
				<div id="fc-slideshow" class="fc-slideshow">
                                    
                                    
                                    <h2 class="title_index padding_especial"><span>Galería de imágenes</span></h2>
					<ul class="fc-slides">
                                            
                                            
                                            @foreach($negocio->imagenes as $imagen)
                                          
                                            <li><img src="{{ URL::to("/").$imagen->imagen->url('large')}}">
                                                
                                                @if($imagen->alt)
                                                <h3>{{$imagen->alt}}</h3>
                                                @endif
                                                
                                            </li>
   
                                            @endforeach
                                            
						
					</ul>
				</div>
			</div>
                  </div>
                  
                       </div>
                           
                           
                   @if(count($promociones))
                   
                   
                   
          <div class="col-sm-6">
              
               <div class="form-group">
                       <div class="main">
				<div id="fc-slideshow-two" class="fc-slideshow">
                                    
                                    
                                    <h2 class="title_index padding_especial"><span>Promociones</span></h2>
					<ul class="fc-slides">
                                            
                                        @foreach($promociones as $promocion)
                                        <li> <a href="{{URL::route("promociones.show",array($promocion->id))}}"> <img src="{{ URL::to("/").$promocion->imagen->url('medium')}}"></a></li>
                                        @endforeach
                                        
                                        </ul>
          </div>
                           
                           </div>
			</div>
                  </div>
          @endif
                  
            
            
            
            @else
                  <h2>No seleccionó ningún negocio</h2>
            @endif
      </div>
                  
                  




     
            <div class="col-sm-6">
                  {{HTML::image('img/comment.png','Comentarios Sphellar')}}{{ Form::label('comentario','¿Qué dicen los usuarios?') }}
                  <div class="list-group" id='all_comments'>
                        @foreach($negocio->comentarios as $comentario)
                        @include('layouts.show_comentario',array('comentario',$comentario))
                        @endforeach
                  </div>                  
            </div>
     
            <div class="col-sm-6">
                  @if(Auth::check())
                  <div class="list-group-item">
                        {{ Form::open(array('route' => array('comentarios.store','id'=>$negocio->id,'clase'=>get_class($negocio)),'id'=>'add_res')) }}
                        {{ Form::label('comentario','Agrega tu comentario') }}
                        {{ Form::textArea('comentario', Input::old('comentario'), array('placeholder' => 'comentario', 'class'=>'form-control','id'=>'new_comentario')) }}
                        {{ Form::submit('agregar', array('class' => 'btn btn-sm btn-primary')) }}
                        {{ Form::close() }}                        
                  </div>     
                  @else
                         <p class="rank_text">   {{HTML::image('img/comments_user.png','Comentarios Sphellar')}} {{ HTML::linkRoute('register.user','Regístrate como usuario para comentar ') }}</p> 
                  @endif
            </div>
    
</div>


@stop

@section('scripts')

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
	$( function() {
				
	$( '#fc-slideshow-two' ).flipshow();

	} );
</script>

<script>
      $("#btn_rank").click(function() {
            url = "{{ URL::route('miembro.add_rank_negocio',array($negocio->id)) }}";
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

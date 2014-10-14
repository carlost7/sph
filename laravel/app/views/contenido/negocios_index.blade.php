@extends('layouts.webpage_master')

@section('wrapper')
<div class="container total">


      <div class="container total">
            <div id="negocio_opcion_interna">

                  <section class="invisible_interna ">

                        <a href="{{ URL::route('eventos.index') }}">

                              <p>Negocios</p>
                        </a>

                  </section>

            </div>

            @include('layouts.show_catalog',array('action'=>'negocio'))



            <!-- PUBLICIDAD BANNER GRANDE -->

            <section id="publicidad_uno_interna">

                  <article>

                        <a href="http://sphellar.com/mx/ target="new">
                           {{HTML::image('img/publicidad/banner_publicidad_2.jpg','Publicidad Sphellar')}}   
                  </a>

            </article>

      </section>


      <!-- PUBLICIDAD BANNER CHICOS (3) -->

      <section id="publicidad_tres">

            <article class="publi">

                  <a href="http://sphellar.com/mx/cultura/arte/23-el-poder-de-las-tormentas-en-la-fotografia-de-mike-olbinski.html" target="new">
                        {{HTML::image('img/publicidad/cuadro_1default.jpg','Publicidad uno')}} 
                  </a>

            </article>

            <article class="publi">

                  <a href="http://sphellar.com/mx/cultura/22-los-4-alimentos-mas-caros-del-mundo.html" target="new">
                        {{HTML::image('img/publicidad/cuadro_2default.jpg','Publicidad uno')}} 
                  </a>

            </article>

            <article class="publi">

                  <a href="http://sphellar.com/mx/cultura/literatura/21-encuentros-literarios-en-el-hay-festival-xalapa.html" target="new">
                        {{HTML::image('img/publicidad/cuadro_3default.jpg','Publicidad uno')}} 
                  </a>

            </article>

      </section>


      <!-- Comienza sección de Negocios -->



      <div class="row">
            <!--<h2 class="title_index">Negocios</h2>-->
            @foreach($negocios as $negocio)
            <div class="col-sm-6 cuadro_front_negocios">
                  @if(count($negocio->imagen))
                  <a href="{{ route('negocios.show',array($negocio->id,Str::slug($negocio->nombre))) }}"><img src="{{Config::get('params.path_serve_image').$negocio->imagen->path.$negocio->imagen->nombre}}" alt="{{ $negocio->imagen->alt }}" /></a>
                  @else
                  <a href="{{ route('negocios.show',array($negocio->id,Str::slug($negocio->nombre))) }}">{{HTML::image('img/negocio-default.jpg')}}</a>
                  @endif
                  <h3 class="title_negocio"><strong>{{ HTML::linkRoute('negocios.show',$negocio->nombre,array($negocio->id,Str::slug($negocio->nombre))) }}</strong></h3>

                  <p class="img_catego">{{ HTML::image("img/Categorias-icons/".Str::slug($negocio->categoria->categoria).".png",$negocio->categoria->categoria,array('title'=>$negocio->categoria->categoria,'data-toggle'=>'tooltip','data-placement'=>'bottom')) }}</p>


                  @if(count($negocio->subcategoria))
                  <p><span class="info_guia">Subcategoria:</span> {{ $negocio->subcategoria->subcategoria }}</p>
                  @endif



                  <table width="100%" border="0" class="tabla_negocios">

                        <tr>

                              <td>

                                    @if(count($negocio->masInfo))
                                    @if($negocio->masInfo->efectivo)
                                    {{ HTML::image('img/si_no/clientes/efectivo_si.png','Se acepta efectivo',array('title'=>'Se acepta efectivo','data-toggle'=>'tooltip','data-placement'=>'bottom')) }}

                                    @else
                                    {{HTML::image('img/si_no/clientes/efectivo_no.png','No se acepta efectivo',array('title'=>'No se acepta efectivo','data-toggle'=>'tooltip','data-placement'=>'bottom')) }}
                                    @endif

                              </td>

                              <td>


                                    @if($negocio->masInfo->tc)
                                    {{HTML::image('img/si_no/clientes/tarjeta_si.png','Se acepta tarjeta de crédito',array('title'=>'Se acepta tarjeta de crédito','data-toggle'=>'tooltip','data-placement'=>'bottom')) }}
                                    @else
                                    {{HTML::image('img/si_no/clientes/tarjeta_no.png','No se acepta tarjeta de crédito',array('title'=>'No se acepta tarjeta de crédito','data-toggle'=>'tooltip','data-placement'=>'bottom')) }}
                                    @endif

                              </td>

                              <td>

                                    @if($negocio->masInfo->llevar)
                                    {{HTML::image('img/si_no/clientes/llevar_si.png','Servicio a domicilio',array('title'=>'Servicio a domicilio','data-toggle'=>'tooltip','data-placement'=>'bottom')) }}
                                    @else
                                    {{HTML::image('img/si_no/clientes/llevar_no.png','Sin servicio a domicilio',array('title'=>'Sin servicio a domicilio','data-toggle'=>'tooltip','data-placement'=>'bottom')) }}
                                    @endif
                                    @endif
                              </td>

                        </tr>
                  </table>

                  <p class="txt_descripcion"><span class="info_guia">Descripción:</span> {{ $negocio->descripcion }}</p> 
            </div>
            @endforeach    


      </div>
      <div class="row">
            <div class="col-sm-12">
                  <div class="text-center">
                        {{ $negocios->links()}}      
                  </div>                  
            </div>    
      </div>
</div>

@stop




@section('scripts')

<script>
      $(function() {
            $("[data-toggle='tooltip']").tooltip();
      });
</script>

@stop

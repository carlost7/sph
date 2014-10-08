@extends('layouts.webpage_master')

@section('wrapper')
<div class="container total">
      @include('layouts.show_catalog',array('action'=>'cartelera'))
      
            
      
      <!-- PUBLICIDAD BANNER GRANDE -->

          <section id="publicidad_uno">
    
              <article>
        
                 <a href="http://sphellar.com/mx/ target="new">
                  {{HTML::image('img/publicidad/banner_publicidad_1.jpg','Publicidad Sphellar')}}   
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


<!-- Comienza sección de Cartelera -->


      <div class="row">
            
                   <h2 class="title_index">Cartelera</h2>
                  @foreach($eventos as $evento)
                  <div class="col-sm-6 cuadro_front_negocios">
                        @if(count($evento->imagen))
                        <a href="{{ route('eventos.show',array($evento->id,Str::slug($evento->nombre))) }}"><img src="{{Config::get('params.path_public_image').$evento->imagen->path.$evento->imagen->nombre}}" alt="{{ $evento->imagen->alt }}" /></a>
                        @else
                        <a href="{{ route('eventos.show',array($evento->id,Str::slug($evento->nombre))) }}">{{HTML::image('img/evento-default.jpg')}}</a>
                        @endif
                        <h3><strong>{{HTML::linkRoute('eventos.show',$evento->nombre,array($evento->id,Str::slug($evento->nombre))) }}</strong></h3>
                        <hr />
                        <p>Categoria: {{ $evento->categoria->categoria }}</p>
                        @if(count($evento->subcategoria))
                        <p>Subcategoria: {{ $evento->subcategoria->subcategoria }}</p>
                        @endif

                        <hr />                  
                        <p>Estado: {{ $evento->estado->estado }}</p>
                        @if(count($evento->subcategoria))
                        <p>Zona: {{ $evento->zona->zona }}</p>
                        @endif
                        <p>Dirección: {{ $evento->direccion }}</p>
                        @if(count($evento->especial))
                        <p>Web: <a href="{{$evento->especial->web}}">{{$evento->nombre}}</a></p>
                        @endif


                  </div>
                  @endforeach                  
            </div>
      </div>
      <div class="row">
            <div class="col-sm-12">
                  <div class="text-center">
                        {{ $eventos->links()}}      
                  </div>                  
            </div>            
      
</div>



@stop



@section('scripts')

<script>
   $(function () { $("[data-toggle='tooltip']").tooltip(); });
</script>

@stop

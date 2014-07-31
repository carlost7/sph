@extends('layouts.marketing_dashboard_master')

@section('content')
@if($cliente)

<h1>Nombre: {{ $cliente->name }}</h1>
<h2>Teléfono: {{$cliente->telephone}}</h2>
<h2>Correo: {{$cliente->user->email}}</h2>

<div class="panel-group" id="accordion">
      <div class="panel panel-info">
            <div class="panel-heading">
                  <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                              Negocios ({{ $negocios->count() }})
                        </a>
                  </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                  <div class="panel-body">
                        @if($negocios->count())

                        <div class="table-responsive text-center">            
                              <table class="table table-bordered table-condensed">
                                    <tr>
                                          <td><b>Negocio</b></td>                                          
                                          <td></td>
                                          <td></td>
                                          <td></td>

                                    </tr>                                    
                                    @foreach($negocios as $negocio)
                                    <tr>                                          
                                          <td>{{ $negocio->nombre }}</td>
                                          <td>{{ Form::Button('publicar',array('class'=>'btn btn-primary','onclick'=>'publicar('.$negocio->id.',"'.get_class($negocio).'")')) }}</td>
                                          <td>{{ Form::Button('no publicar',array('class'=>'btn btn-danger','onclick'=>'no_publicar('.$negocio->id.',"'.get_class($negocio).'")')) }}</td>
                                          <td>{{ Form::Button('pagar',array('class'=>'btn btn-success')) }}</td>                                          
                                    </tr>

                                    @endforeach                        

                              </table>
                        </div>

                        @else
                        <h2>No hay negocios por publicar</h2>
                        @endif

                  </div>
            </div>
      </div>
      <div class="panel panel-info">
            <div class="panel-heading">
                  <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                              Eventos ({{ $eventos->count() }})
                        </a>
                  </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                  <div class="panel-body">
                        @if($eventos->count())
                        <div class="table-responsive text-center">            
                              <table class="table table-bordered table-condensed">
                                    <tr>
                                          <td><b>Evento</b></td>                                          
                                          <td></td>
                                          <td></td>
                                          <td></td>

                                    </tr>                                    
                                    @foreach($eventos as $evento)
                                    <tr>
                                          <td>{{ $evento->nombre }}</td>                                          
                                          <td>{{ Form::Button('publicar',array('class'=>'btn btn-primary','onclick'=>'publicar('.$evento->id.',"'.get_class($evento).'")')) }}</td>
                                          <td>{{ Form::Button('no publicar',array('class'=>'btn btn-danger','onclick'=>'no_publicar('.$evento->id.',"'.get_class($evento).'")')) }}</td>
                                          <td>{{ Form::Button('pagar',array('class'=>'btn btn-success')) }}</td>                                          
                                    </tr>

                                    @endforeach                        

                              </table>
                        </div>
                        @else
                        <h2>No hay eventos por publicar</h2>
                        @endif
                  </div>
            </div>
      </div>
      <div class="panel panel-info">
            <div class="panel-heading">
                  <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                              Promociones ({{ $promociones->count() }})
                        </a>
                  </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                  <div class="panel-body">
                        @if($promociones->count())
                        <div class="table-responsive text-center">            
                              <table class="table table-bordered table-condensed">
                                    <tr>
                                          <td><b>Nombre</b></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                    </tr>                                    
                                    @foreach($promociones as $promocion)
                                    <tr>
                                          <td>{{ $promocion->nombre }}</td>                                          
                                          <td>{{ Form::Button('publicar',array('class'=>'btn btn-primary','onclick'=>'publicar('.$promocion->id.',"'.get_class($promocion).'")')) }}</td>
                                          <td>{{ Form::Button('no publicar',array('class'=>'btn btn-danger','onclick'=>'no_publicar('.$promocion->id.',"'.get_class($promocion).'")')) }}</td>
                                          <td>{{ Form::Button('pagar',array('class'=>'btn btn-success')) }}</td>                                          
                                    </tr>

                                    @endforeach                        

                              </table>
                        </div>
                        @else
                        <h2>No hay promociones por publicar</h2>
                        @endif
                  </div>
            </div>
      </div>
      <div class="panel panel-info">
            <div class="panel-heading">
                  <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                              Bitacora de cliente ({{$bitacoras->count()}})
                        </a>
                  </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse">
                  <div class="panel-body">
                        @if($bitacoras->count())
                        <div class="table-responsive">            
                              <table class="table table-bordered table-condensed">
                                    <tr>
                                          <td><b>Horario</b></td>
                                          <td><b>Mensaje</b></td>                                          
                                    </tr>                                    
                                    @foreach($bitacoras as $bitacora)
                                    <tr>
                                          <td>{{ $bitacora->horario }}</td>
                                          <td>{{ $bitacora->mensaje }}</td>                                          
                                    </tr>

                                    @endforeach                        

                              </table>
                        </div>
                        @else
                        <h2>Aún no hay bitacora de llamadas de este cliente</h2>
                        @endif
                  </div>
            </div>
      </div>
</div>


@else

<h2>No seleccionó ningún cliente</h2>

@endif

@stop

@section('scripts')

<script>
      function publicar(id, clase) {
            $message = show_prompt();
            $url = 'http://localhost/sph/public_html/index.php/marketing_avisos_publicar/'+id;
            $publicar = 1;

            $.post(
                  $url,
                  {'class':clase,'mensaje':'','publicar':$publicar}                 
            );


      }

      function no_publicar(id, clase) {
            $message = show_prompt();
            $url = 'http://localhost/sph/public_html/index.php/marketing_avisos_publicar/'+id;
            $publicar = 0;

            $.post(
                  $url,
                  {'class':clase,'mensaje':'','publicar':$publicar}
            );

      }

      function show_prompt() {

      }

</script>

@stop
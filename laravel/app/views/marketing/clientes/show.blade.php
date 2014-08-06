@extends('layouts.marketing_dashboard_master')

@section('content')
@if($cliente)

<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('marketing_clientes.index','Regresar') }}</li>            
      </ul>
</div>


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
                                          <td>¿Está publicado?</td>
                                          <td>¿Es especial?</td>

                                    </tr>                                    
                                    @foreach($negocios as $negocio)
                                    <tr>                                          
                                          <td>{{ $negocio->nombre }}</td>
                                          <td>
                                              {{ $negocio->publicar ? "si" : "no" }}
                                          </td>
                                          <td>
                                              {{ $negocio->is_especial ? "si" : "no" }}
                                          </td>                                          
                                    </tr>

                                    @endforeach                        

                              </table>
                        </div>

                        @else
                        <h2>El cliente no ha agregado ningún negocio</h2>
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
                                          <td>¿Está publicado?</td>
                                          <td>¿Es especial?</td>

                                    </tr>                                    
                                    @foreach($eventos as $evento)
                                    <tr>
                                          <td>{{ $evento->nombre }}</td>
                                          <td>
                                              {{ $negocio->publicar ? "si" : "no" }}
                                          </td>
                                          <td>
                                              {{ $negocio->is_especial ? "si" : "no" }}
                                          </td>
                                    </tr>

                                    @endforeach                        

                              </table>
                        </div>
                        @else
                        <h2>El cliente no ha agregado ningún evento</h2>
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
                                          <td>¿Está publicado?</td>
                                          <td>¿Es especial?</td>
                                    </tr>                                    
                                    @foreach($promociones as $promocion)
                                    <tr>
                                          <td>{{ $promocion->nombre }}</td>
                                          <td>
                                              {{ $negocio->publicar ? "si" : "no" }}
                                          </td>
                                          <td>
                                              {{ $negocio->is_especial ? "si" : "no" }}
                                          </td>                                          
                                    </tr>

                                    @endforeach                        

                              </table>
                        </div>
                        @else
                        <h2>El cliente no ha agregado ningun promocion</h2>
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
                                          <td>{{ $bitacora->fecha }}</td>
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

{{ HTML::script('js/vendor/bootbox.min.js') }}

<script>

      function show_prompt(form_id) {
            bootbox.prompt("¿Qué dijo el cliente?", function(result) {
                  if(result == null || result==""){
                        alert("Es necesario llenar el registro de usuario");
                  }else{
                        $('#' + form_id).find('[name="mensaje"]').val(result);
                        $('#' + form_id).submit();                        
                  }
            });
      }

</script>

@stop
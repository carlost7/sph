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
                                          <td>
                                                {{ Form::open(array('route'=> array('marketing_avisos_publicar.update',$negocio->id),'id'=>'neg_p_'.$negocio->id)) }}
                                                {{ Form::hidden('publicar',1)}}
                                                {{ Form::hidden('clase',get_class($negocio))}}
                                                {{ Form::hidden('mensaje','')}}
                                                {{ Form::button('publicar',array('class'=>'btn btn-primary','onclick'=>'show_prompt("neg_p_'.$negocio->id.'")')) }}
                                                {{ Form::close()}}
                                          </td>
                                          <td>
                                                {{ Form::open(array('route'=> array('marketing_avisos_publicar.update',$negocio->id),'id'=>'neg_np_'.$negocio->id)) }}
                                                {{ Form::hidden('publicar',0)}}
                                                {{ Form::hidden('clase',get_class($negocio))}}
                                                {{ Form::hidden('mensaje','')}}
                                                {{ Form::button('no publicar',array('class'=>'btn btn-danger','onclick'=>'show_prompt("neg_np_'.$negocio->id.'")')) }}
                                                {{ Form::close()}}

                                          </td>
                                          <td>
                                                {{ Form::Button('pagar',array('class'=>'btn btn-success')) }}
                                          </td>                                          
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
                                          <td>
                                                {{ Form::open(array('route'=> array('marketing_avisos_publicar.update',$evento->id),'id'=>'ev_p_'.$evento->id)) }}
                                                {{ Form::hidden('publicar',1)}}
                                                {{ Form::hidden('clase',get_class($evento))}}
                                                {{ Form::hidden('mensaje','')}}
                                                {{ Form::button('publicar',array('class'=>'btn btn-primary','onclick'=>'show_prompt("ev_p_'.$evento->id.'")')) }}
                                                {{ Form::close()}}
                                          </td>
                                          <td>
                                                {{ Form::open(array('route'=> array('marketing_avisos_publicar.update',$evento->id),'id'=>'ev_np_'.$evento->id)) }}
                                                {{ Form::hidden('publicar',0)}}
                                                {{ Form::hidden('clase',get_class($evento))}}
                                                {{ Form::hidden('mensaje','')}}
                                                {{ Form::button('no publicar',array('class'=>'btn btn-danger','onclick'=>'show_prompt("ev_np_'.$evento->id.'")')) }}
                                                {{ Form::close()}}

                                          </td>
                                          <td>
                                                {{ Form::Button('pagar',array('class'=>'btn btn-success')) }}
                                          </td>                                          
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
                                          <td>
                                                {{ Form::open(array('route'=> array('marketing_avisos_publicar.update',$promocion->id),'id'=>'pr_p_'.$promocion->id)) }}
                                                {{ Form::hidden('publicar',1)}}
                                                {{ Form::hidden('clase',get_class($promocion))}}
                                                {{ Form::hidden('mensaje','')}}
                                                {{ Form::button('publicar',array('class'=>'btn btn-primary','onclick'=>'show_prompt("pr_p_'.$promocion->id.'")')) }}
                                                {{ Form::close()}}
                                          </td>
                                          <td>
                                                {{ Form::open(array('route'=> array('marketing_avisos_publicar.update',$promocion->id),'id'=>'pr_np_'.$promocion->id)) }}
                                                {{ Form::hidden('publicar',0)}}
                                                {{ Form::hidden('clase',get_class($promocion))}}
                                                {{ Form::hidden('mensaje','')}}
                                                {{ Form::button('no publicar',array('class'=>'btn btn-danger','onclick'=>'show_prompt("frm_np_'.$promocion->id.'")')) }}
                                                {{ Form::close()}}

                                          </td>
                                          <td>
                                                {{ Form::Button('pagar',array('class'=>'btn btn-success')) }}
                                          </td>                                          
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

{{ HTML::script('js/vendor/bootbox.min.js') }}

<script>

      function show_prompt(form_id) {
            bootbox.prompt("¿Qué dijo el cliente?", function(result) {
                  $('#' + form_id).find('[name="mensaje"]').val(result);
                  $('#' + form_id).submit();
            });
      }

</script>

@stop
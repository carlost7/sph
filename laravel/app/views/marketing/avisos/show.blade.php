@extends('layouts.marketing_dashboard_master')

@section('content')
@if($cliente)

<h1>Nombre: {{ $cliente->nombre }}</h1>
<h2>Teléfono: {{$cliente->telefono}}</h2>
<h2>Correo: {{$cliente->user->email}}</h2>

<div class="panel-group" id="accordion">
      <div class="panel panel-info">
            <div class="panel-heading">
                  <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                              Contenido ({{ count($contenidos) }})
                        </a>
                  </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                  <div class="panel-body">
                        @if(count($contenidos))

                        <div class="table-responsive text-center">            
                              <table class="table table-bordered table-condensed">
                                    <tr>
                                          <td>Nombre</td>                                          
                                          <td>Tipo</td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          

                                    </tr>                                    
                                    @foreach($contenidos as $contenido)
                                    <tr>                                          
                                          <td>{{ $contenido->nombre }}</td>
                                          <td>{{ get_class($contenido) }}</td>
                                          <td>
                                                {{ Form::open(array('route'=> array('marketing_avisos_publicar.update',$contenido->id),'id'=>'neg_p_'.$contenido->id)) }}
                                                {{ Form::hidden('publicar',1)}}
                                                {{ Form::hidden('clase',get_class($contenido))}}
                                                {{ Form::hidden('mensaje','')}}
                                                {{ Form::button('publicar',array('class'=>'btn btn-primary','onclick'=>'show_prompt("neg_p_'.$contenido->id.'")')) }}
                                                {{ Form::close()}}
                                          </td>
                                          <td>
                                                {{ Form::open(array('route'=> array('marketing_avisos_publicar.update',$contenido->id),'id'=>'neg_np_'.$contenido->id)) }}
                                                {{ Form::hidden('publicar',0)}}
                                                {{ Form::hidden('clase',get_class($contenido))}}
                                                {{ Form::hidden('mensaje','')}}
                                                {{ Form::button('no publicar',array('class'=>'btn btn-danger','onclick'=>'show_prompt("neg_np_'.$contenido->id.'")')) }}
                                                {{ Form::close()}}

                                          </td>
                                          <td>
                                                @if($contenido->pago->pagado)
                                                {{ Form::open(array('route' => array('marketing_avisos.destroy',$contenido->aviso->id),'method'=>'DELETE')) }}
                                                <input type="submit" value="eliminar" name="eliminar" class='btn btn-danger btn-md'/>
                                                {{ Form::close() }}
                                                @else
                                                {{ HTML::linkRoute('pagar_contenido.get','pagar',array('id'=>$contenido->pago->id),array('class'=>'btn btn-sm btn-success')) }}
                                                @endif
                                          </td>                                          
                                    </tr>

                                    @endforeach                        

                              </table>
                        </div>

                        @else
                        <h2>No hay contenido por publicar</h2>
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
              if (result == null || result == ""){
              alert("Es necesario llenar el registro de usuario");
              } else{
              $('#' + form_id).find('[name="mensaje"]').val(result);
                      $('#' + form_id).submit();
              }
              });
              }

</script>

@stop
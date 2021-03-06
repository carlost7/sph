@extends('layouts.marketing_dashboard_master')

@section('content')

<h2>Clientes que requieren atención</h2>

@if($clientes->count())

<div class="list-group">
      <div class="table-responsive">            
            <table class="table table-striped table-bordered table-condensed">
                  <tr>
                        <th>Cliente</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                  </tr>

                  @foreach($clientes as $cliente)
                  <tr>
                        <td>{{ HTML::linkRoute('marketing_avisos.show',$cliente->nombre,$cliente->id)}}</td>
                        <td>{{$cliente->telefono}}</td>
                        <td>{{$cliente->user->email}}</td>
                  </tr>
                  @endforeach
            </table>      
      </div>
</div>

@else

<h3>Ningun cliente tiene aviso</h3>

@endif


@stop
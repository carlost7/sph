@extends('layouts.marketing_dashboard_master')

@section('content')

<h2>Lista de clientes</h2>

@if($clientes->count())

<div class="list-group">
      <table>
            <tr>
                  <th>Nombre</th>
                  <th>Teléfono</th>
                  <th>Correo</th>
            </tr>
            <tr>
                  @foreach($clientes as $cliente)
                  <td>{{$cliente->name}}</td>
                  <td>{{$cliente->telephone}}</td>
                  <td>{{$cliente->user->email}}</td>
                  @endforeach
            </tr>
      </table>      
</div>

@else

<h3>Ningun cliente ha agregado registros</h3>

@endif


@stop
@extends('layouts.client_dashboard_master')

@section('content')

<div class="col-xs-12">
      <ul class="nav nav-pills">
            <li>{{ HTML::linkRoute('publicar.cliente.edit','Editar Cuenta',array($cliente->id)) }}</li>
      </ul>
</div>

<h2>Bienvenido a Sphellar</h2>

<p>Selecciona en el menu las opciones que quieras agregar.</p>

<p>Una vez que lo agregues tendras la opcion de pagarlo o esperar a que un 
      representante de nuestro equipo lo revise para que aparezca en la pagina de Sphellar </p>




@stop
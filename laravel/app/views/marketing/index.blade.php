@extends('layouts.marketing_dashboard_master')

@section('content')

<div class="col-xs-12">
      <ul class="nav nav-pills">
            <li>{{ HTML::linkRoute('marketing.edit','Editar Cuenta') }}</li>
      </ul>
</div>

<h2>Sphellar</h2>

<p>Selecciona en el menu los uauarios que quieras checar.</p>

<p>Una vez que lo agregues tendras la opcion de pagarlo o esperar a que un 
      representante de nuestro equipo lo revise para que aparezca en la pagina de Sphellar </p>

@stop
@extends('layouts.webpage_master')

@section('wrapper')
<div class="row">
      <div class="col-sm-6 col-sm-push-3">
            @if($confirmation)
            <h1>Bienvenido a Sphellar.</h1>

            <h2>Usuario confirmado con éxito</h2>

            <h3>{{ HTML::link('/','Página Principal') }}</h3>
            @else
            <h2>Error al confirmar el usuario</h2>
            <h3>Intenta de nuevo, o ponte en contacto con nosotros</h3>
            @endif
      </div>
</div>
@stop
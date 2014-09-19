@extends('layouts.miembro_dashboard_master')

@section('content')

@if($miembro)
<div class="col-xs-12">
      <ul class="nav nav-pills">            
            <li>{{ HTML::linkRoute('miembros.edit','Editar Cuenta',$miembro->id) }}</li>            
      </ul>
</div>

<div class="row">
      <div class="col-sm-6">
            @if(count($miembro->imagen))
            <img src="{{Config::get('params.path_public_image').$miembro->imagen->path.$miembro->imagen->nombre}}" alt="{{ $miembro->imagen->alt }}" />
            @else
            {{HTML::image('img/profile_default.png')}}
            @endif            
      </div>
      <div class="col-sm-6">
            <h2> Miembro: {{ $miembro->username }} </h2>
            <p>Ingreso: {{$miembro->created_at}}</p>
      </div>
</div>



@else

<h2>No seleccionó ningún negocio</h2>

@endif


@stop
@extends('layouts.webpage_master')

@section('menu_links')
@if(Session::get('is_marketing'))
{{ HTML::linkRoute('marketing.index','Sphellar',null,array('class'=>'navbar-brand')) }}
@else
{{ HTML::link('/','Sphellar',array('class'=>'navbar-brand')) }}
@endif
@stop


@section('user_menu')
<li class="dropdown">                                          
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuario <span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
            <li>{{ HTML::linkRoute('session.destroy','Salir') }}</li> 
      </ul>
</li>
@stop

@section('wrapper')
            <div class="container">
                  <div class="row">
                        <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
                              <ul class="nav nav-pills">
                                    <li {{ Request::is('clientes_negocios*') ? "class='active'" : "" }}>{{ HTML::linkRoute('clientes_negocios.index','Negocios',null) }}</li>
                                    <li {{ Request::is('clientes_eventos*') ? "class='active'" : "" }}>{{ HTML::linkRoute('clientes_eventos.index','Eventos',null) }}</li>
                                    <li {{ Request::is('clientes_promociones*') ? "class='active'" : "" }}>{{ HTML::linkRoute('clientes_promociones.index','Promociones',null) }}</li>
                                    <li {{ Request::is('clientes_pagos*') ? "class='active'" : "" }}>{{ HTML::linkRoute('clientes_pagos.index','Pagos',null) }}</li>
                                    <li {{ Request::is('clientes') ? "class='active'" : "" }}>{{ HTML::linkRoute('clientes.index','Cuenta',null) }}</li>
                              </ul>
                        </div>
                        <div class="col-md-3 hidden-xs">
                              <ul class="nav nav-pills nav-stacked">
                                    <li {{ Request::is('clientes_negocios*') ? "class='active'" : "" }}>{{ HTML::linkRoute('clientes_negocios.index','Negocios',null) }}</li>
                                    <li {{ Request::is('clientes_eventos*') ? "class='active'" : "" }}>{{ HTML::linkRoute('clientes_eventos.index','Eventos',null) }}</li>
                                    <li {{ Request::is('clientes_promociones*') ? "class='active'" : "" }}>{{ HTML::linkRoute('clientes_promociones.index','Promociones',null) }}</li>
                                    <li {{ Request::is('clientes_pagos*') ? "class='active'" : "" }}><a href="{{URL::route('clientes_pagos.index')}}">Pagos 
                                                <span class="badge pull-right">{{ Auth::user()->userable->pagos->filter(function($pago){return $pago->pagado == false;})->count() ? Auth::user()->userable->pagos->filter(function($pago){return $pago->pagado == false;})->count() : '' }}</span>
                                          </a> 
                                    </li>
                                    <li {{ Request::is('clientes') ? "class='active'" : "" }}>{{ HTML::linkRoute('clientes.index','Cuenta',null) }}</li>
                              </ul>
                        </div>
                        <div class="col-xs-12 col-md-8 col-md-push-1">
                              @if(Session::has('message'))
                              <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{ Session::get('message') }}
                                    {{ Session::forget('message'); }}        
                              </div>                        
                              @endif
                              @if(Session::has('error'))
                              <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{ Session::get('error') }}
                                    {{ Session::forget('error'); }}
                              </div>                    
                              @endif
                              @yield('content')
                        </div>
                  </div>
            </div> <!-- /container -->        

@stop
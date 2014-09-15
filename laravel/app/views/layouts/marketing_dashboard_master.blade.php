@extends('layouts.webpage_master')

@section('menu_links')
@if(Session::get('is_marketing'))
{{ HTML::linkRoute('marketing.index','Sphellar',null,array('class'=>'navbar-brand')) }}
@else
{{ HTML::link('/','Sphellar',array('class'=>'navbar-brand')) }}
@endif
@stop


@section('user_menu')
<li>{{ HTML::linkRoute('marketing.index','Marketing') }}</li>
@stop

@section('wrapper')
<div class="container">
      <div class="row">
            <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
                  <ul class="nav nav-pills">
                        <li @if($section === 'Aviso') class='active' @endif>{{ HTML::linkRoute('marketing_avisos.index','Avisos',null) }}</li>
                        <li @if($section === 'Clientes') class='active' @endif>{{ HTML::linkRoute('marketing_clientes.index','Clientes',null) }}</li>
                        <li @if($section === 'Marketing') class='active' @endif>{{ HTML::linkRoute('marketing.index','Cuenta',null) }}</li>
                  </ul>
            </div>
            <div class="col-md-3 hidden-xs">
                  <ul class="nav nav-pills nav-stacked">
                        <li @if($section === 'Aviso') class='active' @endif>{{ HTML::linkRoute('marketing_avisos.index','Avisos',null) }}</li>
                        <li @if($section === 'Clientes') class='active' @endif>{{ HTML::linkRoute('marketing_clientes.index','Clientes',null) }}</li>
                        <li @if($section === 'Marketing') class='active' @endif>{{ HTML::linkRoute('marketing.index','Cuenta',null) }}</li>
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

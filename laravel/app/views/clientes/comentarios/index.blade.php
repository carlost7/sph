@extends('layouts.client_dashboard_master')

@section('content')

<h2>Lista de comentarios</h2>
@if($comentarios)

@foreach($comentarios as $comentario)
@include('layouts.show_comentario',array('comentario',$comentario,'objeto'=>$objeto))
@endforeach

@endif

@stop

@section('scripts')

{{ HTML::script('js/comments.js') }}

@stop
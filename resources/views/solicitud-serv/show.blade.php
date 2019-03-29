@extends('layouts.app')
@section('htmlheader_title')
Solicitud de Servicios
@endsection
@section('contentheader_title')
Servicio {{$Servicio->ID_SolSer}}
@endsection
@section('main-content')
	<div class="col-md-3">
		<label>Fecha: </label>
		<span>{{date('Y-m-d',strtotime($Servicio->created_at))}}</span>
	</div>
	<div class="col-md-3">
		<label>Auditable: </label>
		@if($Servicio->SolSerAuditable == 0)
			<span>No</span>
		@else
			<span>Si</span>
		@endif
	</div>
	<div class="col-md-3">
		<label>Empresa: </label>
		<span>{{}}</span>
	</div>
	<div class="col-md-3">
		<label>Nit: </label>
		<span>{{}}</span>
	</div>
	<div class="col-md-3">
		<label>Dirección: </label>
		<span>{{}}</span>
	</div>
	<div class="col-md-3">
		<label>Ciudad: </label>
		<span>{{}}</span>
	</div>
	<div class="col-md-3">
		<label>Fecha: </label>
		<span>{{}}</span>
	</div>
	<div class="col-md-3">
		<label>Fecha: </label>
		<span>{{}}</span>
	</div>
	<div class="col-md-3">
		<label>Fecha: </label>
		<span>{{}}</span>
	</div>
	<div class="col-md-3">
		<label>Fecha: </label>
		<span>{{}}</span>
	</div>
	<div class="col-md-3">
		<label>Fecha: </label>
		<span>{{}}</span>
	</div>
@endsection
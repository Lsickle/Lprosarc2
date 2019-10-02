@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.progvehictitle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.progvehictitle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.progvehiclist') }}</h3>
					@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC) || in_array(Auth::user()->UsRol2, Permisos::TODOPROSARC))
						<a href="/vehicle-programacion/create" class="btn btn-info pull-right"><i class="fas fa-calendar-alt"></i> {{ trans('adminlte_lang::message.progvehiccreatetext') }}</a>
					@endif
				</div>
				<div class="box box-info">
					<div class="box-body">
						<table id="ProgVehicleTable" class="table table-compact table-bordered table-striped" data-order='[[ 1, "desc"]]'>
							<thead>
								<tr>
									<th>{{ trans('adminlte_lang::message.progvehicclient') }}</th>
									<th>{{ trans('adminlte_lang::message.progvehicfech') }}</th>
									<th>{{ trans('adminlte_lang::message.progvehicvehic') }}</th>
									<th>{{ trans('adminlte_lang::message.progvehicsalida') }}</th>
									<th>{{ trans('adminlte_lang::message.progvehicayudan') }}</th>
									@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Conductor') || Auth::user()->UsRol2 <> trans('adminlte_lang::message.Conductor'))
										<th>{{ trans('adminlte_lang::message.progvehicconduc') }}</th>
										<th>{{ trans('adminlte_lang::message.progvehicllegada') }}</th>
										<th>{{ trans('adminlte_lang::message.progvehictype') }}</th>
									@endif
									@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2))
										<th>{{ trans('adminlte_lang::message.edit') }}</th>
									@endif
									<th>{{ trans('adminlte_lang::message.progvehicservi2') }}</th>
								</tr>
							</thead>
							<tbody id="readyTable">
								@foreach($programacions as $programacion)
								@php
									if($programacion->ProgVehtipo == 1){
										foreach($personals as $personal){
											if($programacion->FK_ProgAyudante == $personal->ID_Pers){
												$ayudante = $personal->PersFirstName.' '.$personal->PersLastName;
											}
										}
										foreach($personals as $personal){
											if($programacion->FK_ProgConductor == $personal->ID_Pers){
												$conductor = $personal->PersFirstName.' '.$personal->PersLastName;
											}
										}
										foreach ($vehiculos as $vehiculo) {
											if($programacion->FK_ProgVehiculo == $vehiculo->ID_Vehic){
												$vehiculoPlaca = $vehiculo->VehicPlaca;
											}
										}
									}
									elseif($programacion->ProgVehtipo == 2){
										foreach($personals as $personal){
											if($programacion->FK_ProgAyudante == $personal->ID_Pers){
												$ayudante = $personal->PersFirstName.' '.$personal->PersLastName;
											}
										}
										$conductor = 'No aplica';
										foreach ($vehiculos as $vehiculo) {
											if($programacion->FK_ProgVehiculo == $vehiculo->ID_Vehic){
												$vehiculoPlaca = $vehiculo->VehicPlaca;
											}
										}
									}
									else{
										$ayudante = 'No aplica';
										$conductor = $programacion->SolSerConductor;
										$vehiculoPlaca = $programacion->SolSerVehiculo;
									}
								@endphp
								<tr style="{{$programacion->ProgVehDelete === 1 ? 'color: red' : ''}}">
									<td>{{$programacion->CliShortname}}</td>
									<td>{{$programacion->ProgVehFecha}}</td>
									<td>{{$vehiculoPlaca}}</td>
									<td>{{date('h:i A', strtotime($programacion->ProgVehSalida))}}</td>
									<td>{{$ayudante}}</td>
									@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Conductor'))
										<td>{{$conductor}}</td>
										<td>{{$programacion->ProgVehEntrada <> null ? date('h:i A', strtotime($programacion->ProgVehEntrada)) : ''}}</td>
										<td>{{$programacion->ProgVehtipo == 1 ? 'Interno' : ($programacion->ProgVehtipo == 2 ? 'Alquilado': 'Externo')}}</td>
									@endif
									@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2))
										<td><a method='get' href='/vehicle-programacion/{{$programacion->ID_ProgVeh}}/edit' class='btn btn-warning btn-block'><i class="fas fa-edit"></i> <b>{{trans('adminlte_lang::message.edit')}}</b></a></td>
									@endif
									<td><a href="/solicitud-servicio/{{$programacion->SolSerSlug}}"class='btn btn-info btn-block' title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i> {{$programacion->ID_SolSer}}</a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
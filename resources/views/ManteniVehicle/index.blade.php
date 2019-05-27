@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.mantvehititle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.mantvehititle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.mantvehititlelist') }}</h3>
					@if(Auth::user()->UsRol == trans('adminlte_lang::message.Programador') ||Auth::user()->UsRol == trans('adminlte_lang::message.JefeLogistica') || Auth::user()->UsRol == trans('adminlte_lang::message.AuxiliarLogistica') || Auth::user()->UsRol == trans('adminlte_lang::message.AsistenteLogistica'))
					<a href="/vehicle-programacion/create" class="btn btn-info pull-right"><i class="fas fa-calendar-alt"></i> {{ trans('adminlte_lang::message.progvehiccreatetext') }}</a>
					@endif
				</div>
				<div class="box-body">
					<table id="MantVehicleTable" class="table table-compact table-bordered table-striped"  data-order='[[ 6, "desc"]]'>
						<thead>
							<tr>
								<th>{{ trans('adminlte_lang::message.mantvehivehic') }}</th>
								<th>{{ trans('adminlte_lang::message.mantvehikm') }}</th>
								<th>{{ trans('adminlte_lang::message.mantvehistatus') }}</th>
								<th>{{ trans('adminlte_lang::message.mantvehitype') }}</th>
								<th>{{ trans('adminlte_lang::message.mantvehiinicio1') }}</th>
								<th>{{ trans('adminlte_lang::message.mantvehiinicio') }}</th>
								<th>{{ trans('adminlte_lang::message.mantvehifin1') }}</th>
								<th>{{ trans('adminlte_lang::message.mantvehifin') }}</th>
								<th>{{ trans('adminlte_lang::message.edit') }}</th>
							</tr>
						</thead>
						<tbody  hidden onload="renderTable()" id="readyTable">
							{{-- <h1 id="loadingTable">LOADING...</h1> --}}
							@include('layouts.partials.spinner')
							@foreach ($MantVehicles as $MantVehicle)
							<tr @if($MantVehicle->MvDelete === 1)
								style="color: red;"
								@endif
								>
								<td>{{$MantVehicle->VehicPlaca}}</td>
								<td>{{$MantVehicle->MvKm}}</td>
								@if($MantVehicle->HoraMavFin >= now())
								<td>{{ trans('adminlte_lang::message.mantvehistatustrue') }}</td>
								@else
								<td>{{ trans('adminlte_lang::message.mantvehistatusfalse') }}</td>
								@endif
								<td>{{$MantVehicle->MvType}}</td>
								<td>{{date('Y/m/d', strtotime($MantVehicle->HoraMavInicio))}}</td>
								<td>{{date('h:i A', strtotime($MantVehicle->HoraMavInicio))}}</td>
								<td>{{date('Y/m/d', strtotime($MantVehicle->HoraMavFin))}}</td>
								<td>{{date('h:i A', strtotime($MantVehicle->HoraMavFin))}}</td>
								<td><a href='/vehicle-mantenimiento/{{$MantVehicle->ID_Mv}}/edit' class='btn btn-block btn-warning'>{{ trans('adminlte_lang::message.edit') }}</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
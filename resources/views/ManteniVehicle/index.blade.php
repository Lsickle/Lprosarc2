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
					@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic1))
					<a href="/vehicle-programacion/create" class="btn btn-info pull-right"><i class="fas fa-calendar-alt"></i> {{ trans('adminlte_lang::message.progvehiccreatetext') }}</a>
					@endif
				</div>
				<div class="box box-info">
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
									@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic1))
									<th>{{ trans('adminlte_lang::message.edit') }}</th>
									@endif
								</tr>
							</thead>
							<tbody id="readyTable">
								@foreach ($MantVehicles as $MantVehicle)
								<tr style="{{$MantVehicle->MvDelete === 1 ? 'color: red' : ''}}">
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
									@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic1))
									<td><a href='/vehicle-mantenimiento/{{$MantVehicle->ID_Mv}}/edit' class='btn btn-block btn-warning'>{{ trans('adminlte_lang::message.edit') }}</a></td>
									@endif
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
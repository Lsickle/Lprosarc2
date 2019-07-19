@extends('layouts.app')
@section('htmlheader_title')
{{trans('adminlte_lang::message.vehicletitle')}}
@endsection
@section('contentheader_title')
{{trans('adminlte_lang::message.vehicletitle')}}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{trans('adminlte_lang::message.vehiclelist')}}</h3>
					@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic1))
					<a href="/vehicle/create" class="btn btn-primary pull-right">{{trans('adminlte_lang::message.create')}}</a>
					@endif
				</div>
				<!-- /.box-header -->
				<div class="box box-info">
					<div class="box-body">
						<table id="VehicleTable" class="table table-compact table-bordered table-striped">
							<thead>
								<tr>
									<th>{{trans('adminlte_lang::message.vehicplaca')}}</th>
									<th>{{trans('adminlte_lang::message.vehictipo')}}</th>
									<th>{{trans('adminlte_lang::message.vehiccapacidad')}}</th>
									<th>{{trans('adminlte_lang::message.vehickm')}}</th>
									<th>{{trans('adminlte_lang::message.vehicsedes')}}</th>
									<th>{{trans('adminlte_lang::message.vehicdateregister')}}</th>
									@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic1))
									<th>{{trans('adminlte_lang::message.edit')}}</th>
									@endif
								</tr>
							</thead>
							<tbody id="readyTable">
								@foreach ($Vehicles as $Vehicle)
									<tr style="{{$Vehicle->VehicDelete === 1 ? 'color: red' : ''}}">
										<td>{{$Vehicle->VehicPlaca}}</td>
										<td>{{$Vehicle->VehicTipo}}</td>
										<td>{{$Vehicle->VehicCapacidad}} kg</td>
										<td>{{$Vehicle->VehicKmActual}}</td>
										<td>{{$Vehicle->SedeName}}</td>
										<td>{{$Vehicle->created_at}}</td>
										@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic1))
										<td><a href='/vehicle/{{$Vehicle->VehicPlaca}}/edit' class='btn btn-warning btn-block'><i class="fas fa-edit"></i> <b>{{trans('adminlte_lang::message.edit')}}</b></a></td>
										@endif
									</tr>
								@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
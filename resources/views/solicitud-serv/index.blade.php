@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.solsertitleindex') }}</h3>
					@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
						<a href="solicitud-servicio/create" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.create') }}</a>
					@endif
				</div>
				<div class="box box-info">
					<div class="box-body">
						<table id="SolicitudservicioTable" class="table table-compact table-bordered table-striped">
							<thead>
								<tr>
									<th>{{trans('adminlte_lang::message.solsershowdate')}}</th>
									<th>{{trans('adminlte_lang::message.solserindexnumber')}}</th>
									@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
									<th>{{trans('adminlte_lang::message.clientcliente')}}</th>
									@endif
									<th>{{trans('adminlte_lang::message.solserpersonal')}}</th>
									<th>{{trans('adminlte_lang::message.solserindextrans')}}</th>
									<th>{{trans('adminlte_lang::message.solseraddrescollect')}}</th>
									<th>{{trans('adminlte_lang::message.seemore')}}</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($Servicios as $Servicio)
										<tr style="{{$Servicio->SolSerDelete == 1 ? 'color: red' : ''}}">
											<td style="text-align: center;">{{date('Y-m-d', strtotime($Servicio->created_at))}}</td>
											<td style="text-align: center;">{{$Servicio->ID_SolSer}}</td>
											@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
											<td><a title="Ver Cliente" href="/clientes/{{$Servicio->CliSlug}}" target="_blank"><i class="fas fa-external-link-alt"></i></a> {{$Servicio->CliShortname}}</td>
											@endif
											<td><a title="Ver Personal" href="/personal/{{$Servicio->PersSlug}}" target="_blank"><i class="fas fa-external-link-alt"></i></a> {{$Servicio->PersFirstName.' '.$Servicio->PersLastName}}</td>
											<td>{{$Servicio->SolSerNameTrans}}</td>
											<td>{{$Servicio->SolSerCollectAddress == null ? 'N/A' : $Servicio->SolSerCollectAddress}}</td>
											<td style="text-align: center;"><a href='/solicitud-servicio/{{$Servicio->SolSerSlug}}' class="btn btn-info" title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i></a></td>
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
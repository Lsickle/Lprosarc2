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
					@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
						<a href="solicitud-servicio/create" class="btn btn-primary" style="float: right;">{{ trans('adminlte_lang::message.create') }}</a>
					@endif
				</div>
				<div class="box box-info">
					<div class="box-body">
						<table id="SolicitudservicioTable" class="table table-compact table-bordered table-striped">
							<thead>
								<tr>
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
										@if($Servicio->SolSerDelete == 1)
											<tr style="color: red;">
										@else
											<tr>
										@endif
											<td style="text-align: center;">{{$Servicio->ID_SolSer}}</td>
											@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
											<td><a title="Ver Cliente" href="/clientes/{{$Servicio->CliSlug}}" target="_blank"><i class="fas fa-external-link-alt"></i></a> {{$Servicio->CliShortname}}</td>
											@endif
											<td><a title="Ver Personal" href="/personal/{{$Servicio->PersSlug}}" target="_blank"><i class="fas fa-external-link-alt"></i></a> {{$Servicio->PersFirstName.' '.$Servicio->PersLastName}}</td>
											<td>{{$Servicio->SolSerNameTrans}}</td>
											<td>{{$Servicio->SolSerCollectAddress}}</td>
											<td style="text-align: center;"><a href='/solicitud-servicio/{{$Servicio->SolSerSlug}}' class="btn btn-info"><i class="fas fa-clipboard-list"></i></a></td>
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
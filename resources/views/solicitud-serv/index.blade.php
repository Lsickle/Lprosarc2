@extends('layouts.app')
@section('htmlheader_title')
Solicitud de Servicios
@endsection
@section('contentheader_title')
Servicios
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- /.box -->
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Datos de las solicitudes de los servicios</h3>
					<a href="solicitud-servicio/create" class="btn btn-primary" style="float: right;">Crear</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="SolicitudservicioTable" class="table table-compact table-bordered table-striped">
						<thead>
							<tr>
								<th>N° de Solicitud</th>
								@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
								<th>Cliente</th>
								@endif
								<th>Estado</th>
								<th>Persona encargada</th>
								<th>Transportador</th>
								<th>Ver Más</th>
							</tr>
						</thead>
						<tbody>
							@include('layouts.partials.spinner')
							@foreach ($Servicios as $Servicio)
									@if($Servicio->SolSerDelete == 1)
										<tr style="color: red;">
									@else
										<tr>
									@endif
										<td>{{$Servicio->ID_SolSer}}</td>
										@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
										<td>{{$Servicio->CliShortname}} <a title="Ver Cliente" href="/clientes/{{$Servicio->CliSlug}}" target="_blank"><i class="fas fa-external-link-alt"></i></a></td>
										@endif
										<td>{{$Servicio->SolSerStatus}}</td>
										<td>{{$Servicio->PersFirstName.' '.$Servicio->PersLastName}} <a title="Ver Personal" href="/personal/{{$Servicio->PersSlug}}" target="_blank"><i class="fas fa-external-link-alt"></i></a></td>
										<td>{{$Servicio->SolSerNameTrans}}</td>
										<td><a href='/solicitud-servicio/{{$Servicio->SolSerSlug}}' class='btn btn-info'><i class="fas fa-clipboard-list"></i></a></td>
									</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</div>
@endsection
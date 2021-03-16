@extends('layouts.app')
@section('htmlheader_title')
Residuos Almacenados en Planta
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #d4fc79, #00C851); padding-right:30vw; position:relative; overflow:hidden;">
	Residuos Almacenados en Planta
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	@component('layouts.partials.modal')
		@slot('slug')
			{{-- {{$SolicitudServicio->SolSerSlug}} --}}
		@endslot
		@slot('textModal')
			{{-- la solicitud <b>N° {{$SolicitudServicio->ID_SolSer}}</b> --}}
		@endslot
	@endcomponent
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-12" id="titulo" style="font-size: 1.2em; text-align:center;">
						Residuos Almacenados en Planta	
					</div>
					@if ($errors->any())
					<div class="alert alert-danger" role="alert">
						<ul>
						@foreach ($errors->all() as $error)
							<p>{{$error}}</p>
						@endforeach
						</ul>
					</div>
					@endif
				</div>
				<div class="box-body">
					<table id="RespelStorageTable" class="table table-compact table-bordered table-striped">
						<thead>
							<tr>
								<th>Servicio</th>
								<th>Cliente</th>
								<th>Residuo</th>
								<th>Tratamiento <br> Gestor</th>
								<th>Pretratamientos</th>
								<th>Cantidad<br>recibida</th>
								<th>Cantidad<br>conciliada</th>
								<th>Cantidad<br>tratada</th>
								<th>Cantidad<br>faltante</th>
							</tr>
						</thead>
						<tbody>
							@foreach($SolicitudesServicios as $SolicitudServicio)
							@foreach ($SolicitudServicio->SolicitudResiduo as $Residuo)
							@if($Residuo->SolResKgConciliado != $Residuo->SolResKgTratado)
							<tr>
								<td><a href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}"class='btn btn-info btn-block' title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i> #{{$SolicitudServicio->ID_SolSer}}</td>
								<td><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Persona de Contacto</b>" data-content="<p>Datos de la persona de Contacto para esta Solicitud de Servicio</p><ul><li>{{$SolicitudServicio->Personal->PersFirstName}} {{$SolicitudServicio->Personal->PersLastName}}</li><li>{{$SolicitudServicio->Personal->PersEmail}}</li><li>{{$SolicitudServicio->Personal->PersCellphone}}</li></ul><p>Haga click para ver detalles adicionales de este cliente..." href="/clientes/{{$SolicitudServicio->cliente->CliSlug}}" target="_blank"><i class="fas fa-user"></i></a>{{$SolicitudServicio->cliente->CliName}}</td>
								<td>{{$Residuo->requerimiento->respel->RespelName}}</td>
								<td>{{$Residuo->requerimiento->tratamiento->TratName}} - {{$Residuo->requerimiento->tratamiento->gestor->clientes->CliName}}</td>
								<td>
									<ul>
										@foreach ($Residuo->requerimiento->pretratamientosSelected as $pretratamiento)
										</li>{{$pretratamiento->PreTratName}}<li>
										@endforeach
									</ul>
								</td>
								<td>{{$Residuo->SolResKgRecibido}}</td>
								<td>{{$Residuo->SolResKgConciliado}}</td>
								<td>{{$Residuo->SolResKgTratado}}</td>
								<td>{{$Residuo->SolResKgConciliado - $Residuo->SolResKgTratado}}</td>
							</tr>
							@endif
							@endforeach
							@endforeach
						</tbody>
						<tfoot>
							@foreach ($cantidadesXtratamiento as $key => $value)
							<tr>
								<th colspan="5">SubTotal: {{$key}}</th>
								<th style="text-align: right; white-space: nowrap;"> {{$value['recibido']}} kg</th>
								<th style="text-align: right; white-space: nowrap;"> {{$value['conciliado']}} kg</th>
								<th style="text-align: right; white-space: nowrap;"> {{$value['tratado']}} kg</th>
								<th style="text-align: right; white-space: nowrap;"> {{$value['conciliado'] - $value['tratado']}} kg</th>
							</tr>
							@endforeach
							<tr>
								<th colspan="5">{{trans('adminlte_lang::message.solsershowcantitotal')}}</th>
								<th style="text-align: right; white-space: nowrap;"> {{$total['recibido']}} kg</th>
								<th style="text-align: right; white-space: nowrap;"> {{$total['conciliado']}} kg</th>
								<th style="text-align: right; white-space: nowrap;"> {{$total['tratado']}} kg</th>
								<th style="text-align: right; white-space: nowrap;"> {{$total['conciliado'] - $total['tratado']}} kg</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('NewScript')

@endsection
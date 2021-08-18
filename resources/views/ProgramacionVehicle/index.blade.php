@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.progvehictitle') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #fbc2eb, #aa66cc); padding-right:30vw; position:relative; overflow:hidden;">
	{{'Programación'}}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
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
									{{-- @if(Auth::user()->UsRol <> trans('adminlte_lang::message.Conductor') || Auth::user()->UsRol2 <> trans('adminlte_lang::message.Conductor')) --}}
									<th>{{ trans('adminlte_lang::message.progvehicconduc') }}</th>
									<th>Puntos de recolección</th>
									<th>{{ trans('adminlte_lang::message.progvehicllegada') }}</th>
									<th>{{ trans('adminlte_lang::message.progvehictype') }}</th>
									<th>Autorización</th>
									{{-- @endif --}}
									@if(in_array(Auth::user()->UsRol, Permisos::CONDUCTOR) || in_array(Auth::user()->UsRol2, Permisos::CONDUCTOR))
									<th>ver programación</th>
									@endif
									<th>{{ trans('adminlte_lang::message.progvehicservi2') }}</th>
									@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2))
									<th>{{ trans('adminlte_lang::message.edit') }}</th>
									@endif
									@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi))
									<th>{{ trans('adminlte_lang::message.progvehicserauth') }}</th>
									@endif
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
									if (!isset($ayudante)) {
										$ayudante = 'No definido';
									}
									if (!isset($conductor)) {
										$conductor = 'No definido';
									}
								@endphp
								<tr style="{{$programacion->ProgVehDelete === 1 ? 'color: red' : ''}}">
									<td>{{$programacion->CliName}}</td>
									<td>{{$programacion->ProgVehFecha}}</td>
									<td>{{$vehiculoPlaca}}</td>
									<td>{{date('h:i A', strtotime($programacion->ProgVehSalida))}}</td>
									<td>{{$ayudante}}</td>
									{{-- @if(Auth::user()->UsRol <> trans('adminlte_lang::message.Conductor')) --}}
										<td>{{$conductor}}</td>
										<td><ul class="list-group">
											@foreach($programacion->puntosderecoleccion as $Punto)
										    <li data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Dirección de los Puntos</b>" data-content="<p style='width: 50%'>
										    	<ul class='list-group'>
										    	    <li class='list-group-item'><b>Generador:</b>{{$Punto->generadors->GenerName}}<br><b>Sede:</b>{{$Punto->GSedeName}}<br><b>Dirección:</b>{{$Punto->GSedeAddress}}<br><b>Cel:</b>{{$Punto->GSedeCelular}}</li>
										    	</ul>
										    	<br>Para mas detalles comuníquese con su <b>Jefe de Logistica</b> </p>" class="list-group-item">{{$Punto->GSedeName}}</li>
										    @endforeach
										</ul></td>
										<td>{{$programacion->ProgVehEntrada <> null ? date('h:i A', strtotime($programacion->ProgVehEntrada)) : ''}}</td>
										<td>
                                            @if ($programacion->ProgVehtipo == 1)
                                                Interno<br>
                                                @if ($programacion->ProgVehExclusive == 1)
                                                (Exclusivo)
                                                @else
                                                (Recorrido)
                                                @endif
                                            @elseif($programacion->ProgVehtipo == 2)
                                                Alquilado
                                            @else
                                                Externo
                                            @endif
                                        </td>
										<td>{{$programacion->ProgVehStatus}}</td>
									{{-- @endif --}}

									@if(in_array(Auth::user()->UsRol, Permisos::CONDUCTOR) || in_array(Auth::user()->UsRol2, Permisos::CONDUCTOR))
										<td><a method='get' href='/vehicle-programacion/{{$programacion->ID_ProgVeh}}' class='btn btn-info btn-block'><i class="fas fa-search"></i> <b>Datos</b></a></td>
									@endif
									<td><a href="/solicitud-servicio/{{$programacion->SolSerSlug}}"class='btn btn-info btn-block' title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i> #{{$programacion->ID_SolSer}}</a></td>
									@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2))
										<td><a method='get' href='/vehicle-programacion/{{$programacion->ID_ProgVeh}}/edit' class='btn btn-warning btn-block'><i class="fas fa-edit"></i> <b>{{trans('adminlte_lang::message.edit')}}</b></a></td>
									@endif

									@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi))
									@php
										$Status = ['Aprobado', 'Programado', 'Notificado'];
									@endphp
									<td>
										<a onclick="ModalStatus('{{$programacion->ID_ProgVeh}}', '{{$programacion->ID_SolSer}}', '{{in_array($programacion->SolSerStatus, $Status)}}', 'Programado', 'Notificar')" style="text-align: center;" class="btn btn-{{$programacion->SolSerStatus == 'Programado' ? 'success' : ($programacion->SolSerStatus == 'Notificado' ? 'info' : 'default')}}"><i class="fas fa-sign-out-alt"></i> {{ trans('adminlte_lang::message.progvehicserauth')}}</a>
									</td>
									@endif
								</tr>
								@endforeach
								<div id="ModalStatus"></div>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('NewScript')
<script>
	var observacion = ``;
	function updatecaracteres() {
		var area = document.getElementById("textDescription");
		var message = document.getElementById("caracteresrestantes");
		var maxLength = 4000;
		message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
		observacion = area.value;

	}
	function ModalStatus(slug, idServicio, boolean, value, text){
		if(boolean == 1){
			$('#ModalStatus').empty();
			$('#ModalStatus').append(`
				<div class="modal modal-default fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-body">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<div text-align: center; margin: auto;">
									<span style=""><p>¿Quiere `+text+` la fecha programada para la solicitud <b>N° `+idServicio+`</b>?</p></span>
									<form action="/vehicle-programacion/`+slug+`/updateStatus" method="POST" data-toggle="validator" id="SolSer">
										@csrf
										@method('PUT')
										<div class="form-group col-md-12">
											<label  color: black; text-align: left;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="Observaciones de Logistica: <b>(Opcional)</b>" data-content="redacte los detalles u observaciones que desea enviar junto a la notificación de la programación para el servicio #`+idServicio+`"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Observaciones de Logistica:</label>
											<small id="caracteresrestantes" class="help-block with-errors">`+(status == 'No Deacuerdo' ? '*' : '')+`</small>
											<textarea onchange="updatecaracteres()" id="textDescription" rows ="5" style="resize: vertical;" maxlength="4000" class="form-control col-xs-12" required name="solserdescript">`+observacion+`</textarea>
										</div>
										<input type="submit" id="Cambiar`+slug+`" style="display: none;">
										<input type="text" name="solserslug" value="`+slug+`" style="display: none;">
										<input type="text" name="solserstatus" value="`+value+`" style="display: none;">
									</form>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
								<label for="Cambiar`+slug+`" class='btn btn-success'>Enviar</label>
							</div>
						</div>
					</div>
				</div>
			`);
			$('#SolSer').validator('update');
			popover();
			envsubmit();
			$('#myModal').modal();
		}
	}
</script>
@endsection

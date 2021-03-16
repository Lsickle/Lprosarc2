@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.progvehictitle') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #d4fc79, #00C851); padding-right:30vw; position:relative; overflow:hidden;">
	{{'Programación-Express'}}
	<div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.progvehicedit') }}</h3>
					@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic1))
					@php
					$Status = ['Aprobado', 'Programado', 'Notificado'];
					@endphp
					<td>
						<a onclick="ModalStatus('{{$programacion->ID_ProgVeh}}', '{{$programacion->servicio->ID_SolSer}}', '{{in_array($programacion->servicio->SolSerStatus, $Status)}}', 'vehiprog-edit', 'Notificar')" style="text-align: center;" class="btn col-md-offset-3 btn-{{$programacion->servicio->SolSerStatus == 'Programado' ? 'success' : ($programacion->servicio->SolSerStatus == 'Notificado' ? 'info' : 'default')}}"><i class="fas fa-sign-out-alt"></i> {{ trans('adminlte_lang::message.progvehicserauth')}}</a>
					</td>
					<td>
						@if($programacion->ProgVehtipo == 1 && $programacion->servicio->SolSerStatus == 'Notificado')
						<a onclick="ModalParafiscales('{{$programacion->ID_ProgVeh}}', '{{$programacion->servicio->ID_SolSer}}', '{{in_array($programacion->servicio->SolSerStatus, $Status)}}', 'vehiprog-edit', 'Notificar')" style="text-align: center;" class="btn col-md-offset-3 btn-{{$programacion->servicio->SolSerStatus == 'Programado' ? 'success' : ($programacion->servicio->SolSerStatus == 'Notificado' ? 'info' : 'default')}}"><i class="fas fa-sign-out-alt"></i> Enviar parafiscales</a>
						@else
						<a disabled style="text-align: center;" class="btn col-md-offset-3 btn-default"><i class="fas fa-sign-out-alt"></i> Enviar parafiscales</a>
						@endif
					</td>

					@component('layouts.partials.modal')
					@slot('slug')
					{{$programacion->ID_ProgVeh}}
					@endslot
					@slot('textModal')
					la programación del servicio <b>N° - {{$programacion->FK_ProgServi}}</b>
					@endslot
					@endcomponent
					@if($programacion->ProgVehDelete == 0)
					<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$programacion->ID_ProgVeh}}' class='btn btn-danger pull-right'><i class="fas fa-trash-alt"></i><b> {{ trans('adminlte_lang::message.delete') }}</b></a>
					<form action='/programacion-express/{{$programacion->ID_ProgVeh}}' method='POST'>
						@method('DELETE')
						@csrf
						<input type="submit" id="Eliminar{{$programacion->ID_ProgVeh}}" style="display: none;">
					</form>
					@else
					<form action='/programacion-express/{{$programacion->ID_ProgVeh}}' method='POST' class="pull-right">
						@method('DELETE')
						@csrf
						<button type="submit" class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.add') }}</button>
					</form>
					@endif
					@endif
				</div>
				{{--  Modal --}}
				{{-- <div class="modal modal-default fade in" id="CrearProgVehic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="titleModalCreate">{{ trans('adminlte_lang::message.progvehictitle') }}</h4>
			</div>
			<div class="modal-body">
				<div style="text-align: center; margin: auto;" id="descripModalCreate">
					<form action="/programacion-express" method="POST" id="formularioCreate">
						@csrf
						@if ($errors->create->any())
						<div class="alert alert-danger" role="alert">
							<ul>
								@foreach ($errors->create->all() as $error)
								<p>{{$error}}</p>
								@endforeach
							</ul>
						</div>
						@endif
						<input type="hidden" name="FK_ProgServi" id="FK_ProgServi1" value="{{$programacion->FK_ProgServi}}">
						<div class="box-body">
							<div class="col-xs-12 col-md-6">
								<label for="ProgVehFecha">{{ trans('adminlte_lang::message.progvehicfech') }}</label>
								<input class="form-control" type="date" id="ProgVehFecha1" name="ProgVehFecha" value="{{date('Y-m-d')}}">
							</div>
							<div class="col-xs-12 col-md-6">
								<label for="ProgVehSalida1">{{ trans('adminlte_lang::message.progvehicsalida') }}</label>
								<input class="form-control" type="time" id="ProgVehSalida1" name="ProgVehSalida" value="{{date('H:i')}}">
							</div>
							<div class="col-xs-12 col-md-12">
								<label>Tipo de Transportador</label>
								<select name="typetransportador" id="typetransportador" class="form-control">
									<option value="">Seleccione...</option>
									<option onclick="TranspotadorProsarc()" value="0">Prosarc S.A. ESP</option>
									<option onclick="TranspotadorAlquilado()" value="1">Alquilado</option>
								</select>
							</div>
							<div class="col-xs-12 col-md-12">
								<label for="FK_ProgVehiculo">{{ trans('adminlte_lang::message.progvehicvehic') }}</label>
								<select name="FK_ProgVehiculo" id="FK_ProgVehiculo1" class="form-control">
									<option value="">Seleccione...</option>
									@foreach($vehiculos as $vehiculo)
									<option value="{{$vehiculo->ID_Vehic}}">{{$vehiculo->VehicPlaca}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-md-12">
								<label for="FK_ProgConductor1">{{ trans('adminlte_lang::message.progvehicconduc') }}</label>
								<select name="FK_ProgConductor" id="FK_ProgConductor1" class="form-control">
									<option value="">Seleccione...</option>
									@foreach($conductors as $conductor)
									<option value="{{$conductor->ID_Pers}}">{{$conductor->PersFirstName.' '.$conductor->PersLastName}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-md-12">
								<label for="FK_ProgAyudante1">{{ trans('adminlte_lang::message.progvehicayudan') }}</label>
								<select name="FK_ProgAyudante" id="FK_ProgAyudante1" class="form-control">
									<option value="">Seleccione...</option>
									@foreach($ayudantes as $ayudante)
									<option value="{{$ayudante->ID_Pers}}">{{$ayudante->PersFirstName.' '.$ayudante->PersLastName}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-xs-12 col-md-12">
								<label for="ProgVehColor1">{{ trans('adminlte_lang::message.progvehiccolor') }}</label>
								<input class="form-control" type="color" style="height: 34px;" id="ProgVehColor1" name="ProgVehColor" value="{{$programacion->ProgVehColor}}">
							</div>
							<input type="submit" hidden="true" id="submit1" name="submit1">
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<label for="submit1" class="btn btn-success">{{ trans('adminlte_lang::message.add') }}</label>
			</div>
		</div>
	</div>
</div> --}}
{{-- END Modal --}}

{{--  Modal --}}
<div class="modal modal-default fade in" id="CrearProgVehic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="titleModalCreate">{{ trans('adminlte_lang::message.progvehictitle') }} Interno / Alquilado</h4>
			</div>
			<div class="box box-info">
				<div class="modal-body">
					<div style="margin: auto;" id="descripModalCreate">
						<form action="/programacion-express/{{$programacion->FK_ProgServi}}/añadirVehiculo" method="POST" id="formularioCreate" data-toggle="validator">
							@csrf
							@if ($errors->create->any())
							<div class="alert alert-danger" role="alert">
								<ul>
									@foreach ($errors->create->all() as $error)
									<p>{{$error}}</p>
									@endforeach
								</ul>
							</div>
							@endif
							<input type="text" hidden name="FK_ProgServi" id="FK_ProgServi">
							<input type="text" hidden name="StatusProgServi" id="FK_ProgServi" value="{{$programacion->ProgVehStatus}}">
							<div class="box-body">
								<div class="form-group col-xs-12 col-md-6">
									<label for="modalProgVehFecha">{{ trans('adminlte_lang::message.progvehicfech') }}</label>
									<input class="form-control ProgVehFecha" readonly type="date" id="modalProgVehFecha" name="ProgVehFecha" value="{{date('Y-m-d', strtotime($programacion->ProgVehFecha))}}" value="{{old('ProgVehFecha')}}">
								</div>
								<div class="form-group col-xs-12 col-md-6">
									<label for="modalProgVehSalida">{{ trans('adminlte_lang::message.progvehicsalida') }}</label>
									<input class="form-control" type="time" required id="{{-- ProgVehSalida --}}" name="ProgVehSalida" value="{{old('ProgVehSalida')}}">
									<small class="help-block with-errors"></small>
								</div>
								<div class="form-group col-md-12">
									<label>Tipo de Transportador</label>
									<select name="typetransportador" id="typetransportador" class="form-control">
										<option value="">Seleccione...</option>
										<option onclick="TranspotadorProsarc()" value="0">Prosarc S.A. ESP</option>
										<option onclick="TranspotadorAlquilado()" value="1">Alquilado</option>
									</select>
								</div>
								<div class="form-group col-md-12 vehiculoAlquilado" hidden="true">
									<label>Transportador</label>
									<small class="help-block with-errors">*</small>
									<select name="transport" id="modaltransport" class="form-control">
										<option value="">Seleccione...</option>
										@foreach($transportadores as $transportador)
										<option value="{{$transportador->CliSlug}}">{{$transportador->CliName}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-md-12 vehiculoAlquilado" hidden="true">
									<label for="modalProgVehDocConductorEXT">{{ trans('adminlte_lang::message.progvehdocext') }}</label>
									<input type="text" maxlength="15" data-minlength="6" class="form-control document" id="modalProgVehDocConductorEXT" name="ProgVehDocConductorEXT">
								</div>
								<div class="form-group col-md-12 vehiculoAlquilado" hidden="true">
									<label for="modalProgVehNameConductorEXT">{{ trans('adminlte_lang::message.progvehnameext') }}</label>
									<input type="text" maxlength="50" class="form-control" id="modalProgVehNameConductorEXT" name="ProgVehNameConductorEXT">
								</div>
								<div class="form-group col-md-12 vehiculoAlquilado" hidden="true">
									<label for="modalProgVehDocAuxiliarEXT">{{ trans('adminlte_lang::message.progvehdocauxext') }}</label>
									<input type="text" maxlength="15" data-minlength="6" class="form-control document" id="modalProgVehDocAuxiliarEXT" name="ProgVehDocAuxiliarEXT">
								</div>
								<div class="form-group col-md-12 vehiculoAlquilado" hidden="true">
									<label for="modalProgVehNameAuxiliarEXT">{{ trans('adminlte_lang::message.progvehnameauxext') }}</label>
									<input type="text" maxlength="50" class="form-control" id="modalProgVehNameAuxiliarEXT" name="ProgVehNameAuxiliarEXT">
								</div>
								<div class="form-group col-md-12 vehiculoAlquilado" hidden="true">
									<label for="modalProgVehPlacaEXT">{{ trans('adminlte_lang::message.progvehplacaext') }}</label>
									<input type="text" class="form-control placa" id="modalProgVehPlacaEXT" name="ProgVehPlacaEXT" data-minlength="7">
								</div>
								<div class="form-group col-md-12 vehiculoAlquilado" hidden="true">
									<label for="modalProgVehTipoEXT">{{ trans('adminlte_lang::message.progvehtipoext') }}</label>
									<input type="text" maxlength="16" class="form-control" id="modalProgVehTipoEXT" name="ProgVehTipoEXT">
								</div>
								<div class="form-group col-md-12 vehiculoAlquilado" hidden="true">
									<label>Placa Vehiculo Provicional</label><a class="loadvehicalqui"></a>
									<small class="help-block with-errors">*</small>
									<select name="vehicalqui" id="modalvehicalqui" class="form-control">
										<option value="">Seleccione...</option>
									</select>
								</div>
								<div class="form-group col-xs-12 col-md-12 vehiculoProsarc" hidden="true">
									<label for="modalFK_ProgVehiculo">{{ trans('adminlte_lang::message.progvehicvehic') }}</label>
									<small class="help-block with-errors">*</small>
									<select name="FK_ProgVehiculo" id="modalFK_ProgVehiculo" class="form-control" required>
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										@foreach($vehiculos as $vehiculo)
										<option value="{{$vehiculo->ID_Vehic}}" {{old('FK_ProgVehiculo') == $vehiculo->ID_Vehic ? 'selected' : ''}}>{{$vehiculo->VehicPlaca}}</option>
										@endforeach
									</select>

								</div>
								<div class="form-group col-xs-12 col-md-12 vehiculoProsarc" hidden="true">
									<label for="modalFK_ProgConductor">{{ trans('adminlte_lang::message.progvehicconduc') }}</label>
									<small class="help-block with-errors">*</small>
									<select name="FK_ProgConductor" id="modalFK_ProgConductor" class="form-control" required>
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										@foreach($conductors as $conductor)
										<option value="{{$conductor->ID_Pers}}" {{old('FK_ProgConductor') == $conductor->ID_Pers ? 'selected' : ''}}>{{$conductor->PersFirstName.' '.$conductor->PersLastName}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-xs-12 col-md-12 ambos" hidden="true">
									<label for="modalFK_ProgAyudante">{{ trans('adminlte_lang::message.progvehicayudan') }}</label>
									<small class="help-block with-errors">*</small>
									<select name="FK_ProgAyudante" id="modalFK_ProgAyudante" class="form-control" required>
										<option value="">{{ trans('adminlte_lang::message.select') }}</option>
										@foreach($ayudantes as $ayudante)
										<option value="{{$ayudante->ID_Pers}}" {{old('FK_ProgAyudante') == $ayudante->ID_Pers ? 'selected' : ''}}>{{$ayudante->PersFirstName.' '.$ayudante->PersLastName}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group col-xs-12 col-md-12 vehiculoProsarc" hidden="true">
									<label for="modalProgVehColor">{{ trans('adminlte_lang::message.progvehiccolor') }}</label>
									<input class="form-control" type="color" style="height: 34px;" id="modalProgVehColor" name="ProgVehColor" value="{{old('ProgVehColor') == null ? '#0000f6' : old('ProgVehColor')}}">
								</div>
								<input type="submit" hidden="true" id="submit1" name="submit1">
							</div>
						</form>
					</div>
				</div>
				<div class="box box-info">
					<div class="modal-footer">
						<label for="submit1" class="btn btn-success">{{ trans('adminlte_lang::message.add') }}</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- END Modal --}}

@if($programacion->ProgVehtipo == 1)
{{-- formulario para vehiculos internos prosarc --}}

<div class="box box-info">
	<form role="form" action="/programacion-express/{{$programacion->ID_ProgVeh}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
		@csrf
		@method('PUT')
		@if ($errors->edit->any())
		<div class="alert alert-danger" role="alert">
			<ul>
				@foreach ($errors->edit->all() as $error)
				<p>{{$error}}</p>
				@endforeach
			</ul>
		</div>
		@endif
		<div class="box-body">
			<div class="form-group col-md-3">
				<label for="">Servicio N°</label>
				<input disabled type="text" class="form-control" value="{{$programacion->FK_ProgServi}}">
			</div>
			<div class="form-group col-md-3">
				<label for="">Status</label>
				<input disabled type="text" class="form-control" value="{{$programacion->ProgVehStatus}}">
			</div>
			<div class="form-group col-md-6">
				<label for="ProgVehFecha">{{ trans('adminlte_lang::message.progvehicfech') }}</label>
				<small class="help-block with-errors">*</small>
				<input type="date" class="form-control" id="ProgVehFecha" name="ProgVehFecha" value="{{date('Y-m-d', strtotime($programacion->ProgVehFecha))}}" required="" disabled="">
			</div>
			<div class="form-group col-md-6">
				<label for="ProgVehSalida">{{ trans('adminlte_lang::message.progvehicsalida') }}</label>
				<small class="help-block with-errors">*</small>
				<input type="time" class="form-control" id="ProgVehSalida" name="ProgVehSalida" value="{{date('H:i', strtotime($programacion->ProgVehSalida))}}" required="" disabled="">
			</div>
			<div class="form-group col-md-6">
				<label for="ProgVehEntrada">{{ trans('adminlte_lang::message.progvehicllegada') }}</label>
				<small class="help-block with-errors">*</small>
				<input type="time" class="form-control" id="ProgVehEntrada" name="ProgVehEntrada" value="{{$programacion->ProgVehEntrada <> null ? date('H:i', strtotime($programacion->ProgVehEntrada)) : ''}}" disabled="">
			</div>
			<div class="form-group col-md-6">
				<label for="FK_ProgVehiculo">{{ trans('adminlte_lang::message.progvehicvehic') }}</label>
				<small class="help-block with-errors">*</small>
				<select name="FK_ProgVehiculo" id="FK_ProgVehiculo" class="form-control select" required="" disabled="">
					@foreach($vehiculos as $vehiculo)
					<option value="{{$vehiculo->ID_Vehic}}" {{$vehiculo->ID_Vehic == $programacion->FK_ProgVehiculo ? 'selected' : ''}}>{{$vehiculo->VehicPlaca}}</option>
					@endforeach
				</select>
				@if(in_array(Auth::user()->UsRol, Permisos::ASISTENTELOGISTICA) || in_array(Auth::user()->UsRol2, Permisos::ASISTENTELOGISTICA))
				<input type="text" hidden="true" value="{{$programacion->FK_ProgVehiculo}}" name="FK_ProgVehiculo">
				@endif
				{{-- @foreach($vehiculos as $vehiculo)
										@if($vehiculo->ID_Vehic == $programacion->FK_ProgVehiculo)
											<input name="FK_ProgVehiculo" hidden aria-hidden="true" value="{{$vehiculo->ID_Vehic}}">
				@endif
				@endforeach --}}
				@if(in_array(Auth::user()->UsRol, Permisos::ASISTENTELOGISTICA) || in_array(Auth::user()->UsRol2, Permisos::ASISTENTELOGISTICA))
				@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1))
				@else
				<input hidden type="text" name="FK_ProgVehiculo" value="{{$programacion->FK_ProgVehiculo}}">
				<input hidden type="text" name="ProgVehFecha" value="{{$programacion->ProgVehFecha}}">
				<input hidden type="text" name="ProgVehSalida" value="{{$programacion->ProgVehSalida}}">
				<input hidden type="text" name="FK_ProgConductor" value="{{$programacion->FK_ProgConductor}}">
				<input hidden type="text" name="FK_ProgAyudante" value="{{$programacion->FK_ProgAyudante}}">
				@endif
				@endif
			</div>
			<div class="form-group col-md-6">
				<label for="progVehKm">{{ trans('adminlte_lang::message.progvehickm') }}</label>
				<small class="help-block with-errors">*</small>
				<input type="text" class="form-control number" id="progVehKm" name="progVehKm" value="{{$programacion->progVehKm}}" disabled="">
			</div>
			<div class="form-group col-md-6">
				<label for="FK_ProgConductor">{{ trans('adminlte_lang::message.progvehicconduc') }}</label>
				<small class="help-block with-errors">*</small>
				<select name="FK_ProgConductor" id="FK_ProgConductor" class="form-control select" required="" disabled="">
					@foreach($conductors as $conductor)
					<option value="{{$conductor->ID_Pers}}" {{$conductor->ID_Pers == $programacion->FK_ProgConductor ? 'selected' : ''}}>{{$conductor->PersFirstName.' '.$conductor->PersLastName}}</option>
					@endforeach
				</select>
				@if(in_array(Auth::user()->UsRol, Permisos::ASISTENTELOGISTICA) || in_array(Auth::user()->UsRol2, Permisos::ASISTENTELOGISTICA))
				<input type="text" hidden="true" value="{{$programacion->FK_ProgConductor}}" name="FK_ProgConductor">
				@endif
				{{-- @foreach($conductors as $conductor)
										@if($conductor->ID_Pers == $programacion->FK_ProgConductor)
											<input name="FK_ProgConductor" hidden aria-hidden="true" value="{{$conductor->ID_Pers}}">
				@endif
				@endforeach --}}
			</div>
			<div class="form-group col-md-6">
				<label for="FK_ProgAyudante">{{ trans('adminlte_lang::message.progvehicayudan') }}</label>
				<small class="help-block with-errors">*</small>
				<select name="FK_ProgAyudante" id="FK_ProgAyudante" class="form-control select" required="" disabled="">
					@foreach($ayudantes as $ayudante)
					<option value="{{$ayudante->ID_Pers}}" {{$ayudante->ID_Pers == $programacion->FK_ProgAyudante ? 'selected' : ''}}>{{$ayudante->PersFirstName.' '.$ayudante->PersLastName}}</option>
					@endforeach
				</select>
			</div>

			<div class="col-md-6">
				<label for="select2sedes" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Copiar información del residuo</b>" data-content="<p style='width: 50%'><ul class='list-group'>
									    @foreach($recolectPointsService as $punto)
								        @foreach($recolectPointsProg as $puntoelegido)
								        @if($punto->ID_GSede == $puntoelegido->FK_ColectSgen)
								        <li class='list-group-item'>{{$punto->generadors->GenerName}} => {{$punto->GSedeAddress}}</li>
								        @endif
								        @endforeach
								        @endforeach
									</ul></p>">
					<span><i style="color: Dodgerblue;" class="fas fa-info-circle fa-spin"></i></span>Puntos de Recolección</label>
				<select class="form-control select" id="select2sedes" name="ProgGenerSedes[]" multiple="multiple">
					@foreach($recolectPointsService as $punto)
					<option @foreach($recolectPointsProg as $puntoelegido) @if($punto->ID_GSede == $puntoelegido->FK_ColectSgen)
						selected="true"
						@endif
						@endforeach
						title="{{$punto->GSedeAddress}}" value="{{$punto->ID_GSede}}">{{$punto->generadors->GenerName}} - </option>
					@endforeach
				</select>
			</div>





			<div class="col-md-6" id="containerDePrecintos">
				@if ($programacion->ProgVehPrecintos != null)
				@foreach($programacion->ProgVehPrecintos as $precinto)
				<div class="row" id="precintos{{$loop->index}}">
					<div class="col-md-10">
						<label>Precintos</label>
					</div>
					<div class="form-group col-md-10">
						<input type="text" maxlength="16" class="form-control" id="ProgVehPrecintos" name="ProgVehPrecintos[]" value="{{$precinto}}">
					</div>
					<div class="col-md-2">
						<a class="btn btn-danger dropprecintoedit" type="button" id="button-addon2" onclick="dropPrecinto({{$loop->index}})">Eliminar</a>
					</div>
				</div>
				@endforeach
				@else
				<div class="row" id="precintos0">
					<div class="col-md-10">
						<label>Precintos</label>
					</div>
					<div class="form-group col-md-10">
						<input type="text" maxlength="16" class="form-control" id="ProgVehPrecintos" name="ProgVehPrecintos[]" value="'sin precintos'">
					</div>
					<div class="col-md-2">
						<a class="btn btn-danger dropprecintoedit" type="button" id="button-addon2" onclick="dropPrecinto(0)">Eliminar</a>
					</div>
				</div>
				@endif
			</div>









			<div class="form-group col-md-6 col-md-offset-5">
				<label for="ProgVehColor">{{ trans('adminlte_lang::message.progvehiccolor') }}</label>
				<input type="color" class="form-control" id="ProgVehColor" name="ProgVehColor" style="width: 30%; height: 34px;" value="{{$programacion->ProgVehColor}}" disabled="">
				@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2))
				{{-- <br><a href='/PdfManiCarg/{{$programacion->ID_ProgVeh}}' class="btn btn-primary"><i class="fas fa-file-pdf fa-lg"></i> {{trans('adminlte_lang::message.generatemanicargpdf')}}</a> --}}
				<br><a href='/programacion-express/{{$programacion->ID_ProgVeh}}' class="btn btn-primary"><i class="fas fa-file-pdf fa-lg"></i> {{'Manifiesto de carga'}}</a>
				@endif
			</div>
		</div>
		<div class="box box-info">
			<div class="box-footer">
				<div class="col-md-2">
					@if((in_array(Auth::user()->UsRol, Permisos::ProgVehic1) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic1)) && (date("Y-m-d",strtotime($programacion->ProgVehFecha."+ 0 days")) >= date('Y-m-d')))
					<a href='#' data-toggle='modal' data-target="#CrearProgVehic" class="btn btn-primary pull-left">{{ trans('adminlte_lang::message.progvehicadd') }}</a>
					@endif
				</div>
				<div class="col-md-2">
					<a class="btn btn-primary addprecinto pull-left" id="addprecinto" onclick="addPrecinto()">Añadir Precinto</a>
				</div>

				<div class="col-md-8">
					<button type="submit" class="btn btn-success pull-right" id="update">{{ trans('adminlte_lang::message.update') }}</button>
				</div>
			</div>
			{{-- <div class="col-md-2">
									<a class="btn btn-success addprecinto" id="addprecinto" onclick="addPrecinto()">Añadir Precinto</a>
								</div> --}}
		</div>
		<!-- /.box-body -->
	</form>
</div>
@elseif($programacion->ProgVehtipo == 0)
{{-- formulario para vehiculos externos --}}

<div class="box box-info">
	<form role="form" action="/programacion-express/{{$programacion->ID_ProgVeh}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
		@csrf
		@method('PUT')
		<div class="box-body">
			<div class="form-group col-md-3">
				<label for="">Servicio N°</label>
				<input disabled type="text" class="form-control" value="{{$programacion->FK_ProgServi}}">
			</div>
			<div class="form-group col-md-3">
				<label for="">Status</label>
				<input disabled type="text" class="form-control" value="{{$programacion->ProgVehStatus}}">
			</div>
			<div class="form-group col-md-6">
				<label for="ProgVehFecha">{{ trans('adminlte_lang::message.progvehicfech') }}</label><small class="help-block with-errors">*</small>
				<input type="date" required="" class="form-control" id="ProgVehFecha" name="ProgVehFecha" value="{{date('Y-m-d', strtotime($programacion->ProgVehFecha))}}" value="{{date('Y-m-d', strtotime($programacion->ProgVehFecha))}}" required="" disabled="">
			</div>
			<div class="form-group col-md-6">
				<label for="ProgVehSalida">{{ trans('adminlte_lang::message.progvehicsalida2') }}</label><small class="help-block with-errors">*</small>
				<input type="time" required="" class="form-control" id="ProgVehSalida" name="ProgVehSalida" value="{{date('H:i', strtotime($programacion->ProgVehSalida))}}" required="" disabled="">
			</div>
			<div class="form-group col-md-6">
				<label for="ProgVehEntrada">{{ trans('adminlte_lang::message.progvehicllegada2') }}</label><small class="help-block with-errors">*</small>
				<input type="time" class="form-control" id="ProgVehEntrada" name="ProgVehEntrada" value="{{$programacion->ProgVehEntrada <> null ? date('H:i', strtotime($programacion->ProgVehEntrada)) : ''}}" disabled="">
			</div>
		</div>
		<div class="box box-info">
			<div class="box-footer">
				<button type="submit" class="btn btn-success pull-right" id="update">{{ trans('adminlte_lang::message.update') }}</button>
			</div>
		</div>
		<!-- /.box-body -->
	</form>
</div>
@else
{{-- formulario para vehiculos alquilados --}}
<div class="box box-info">
	<form role="form" action="/programacion-express/{{$programacion->ID_ProgVeh}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
		@csrf
		@method('PUT')
		<div class="box-body">
			<div class="form-group col-md-3">
				<label for="">Servicio N°</label>
				<input disabled type="text" class="form-control" value="{{$programacion->FK_ProgServi}}">
			</div>
			<div class="form-group col-md-3">
				<label for="">Status</label>
				<input disabled type="text" class="form-control" value="{{$programacion->ProgVehStatus}}">
			</div>
			<div class="form-group col-md-6">
				<label for="ProgVehFecha">{{ trans('adminlte_lang::message.progvehicfech') }}</label><small class="help-block with-errors">*</small>
				<input type="date" class="form-control" id="ProgVehFecha" name="ProgVehFecha" value="{{date('Y-m-d', strtotime($programacion->ProgVehFecha))}}" required="" disabled="">
			</div>
			<div class="form-group col-md-6">
				<label for="ProgVehSalida">{{ trans('adminlte_lang::message.progvehicsalida2') }}</label><small class="help-block with-errors">*</small>
				<input type="time" required="" class="form-control" id="ProgVehSalida" name="ProgVehSalida" value="{{date('H:i', strtotime($programacion->ProgVehSalida))}}" required="" disabled="">
			</div>
			<div class="form-group col-md-6">
				<label for="ProgVehEntrada">{{ trans('adminlte_lang::message.progvehicllegada2') }}</label><small class="help-block with-errors">*</small>
				<input type="time" class="form-control" id="ProgVehEntrada" name="ProgVehEntrada" value="{{$programacion->ProgVehEntrada <> null ? date('H:i', strtotime($programacion->ProgVehEntrada)) : ''}}" disabled="">
			</div>
			<div class="form-group col-md-6">
				<label for="ProgVehDocConductorEXT">{{ trans('adminlte_lang::message.progvehdocext') }}</label><small class="help-block with-errors">*</small>
				<input type="text" maxlength="15" data-minlength="6" class="form-control document" id="ProgVehDocConductorEXT" name="ProgVehDocConductorEXT" value="{{$programacion->ProgVehDocConductorEXT}}">
			</div>
			<div class="form-group col-md-6">
				<label for="ProgVehNameConductorEXT">{{ trans('adminlte_lang::message.progvehnameext') }}</label><small class="help-block with-errors">*</small>
				<input type="text" maxlength="50" class="form-control" id="ProgVehNameConductorEXT" name="ProgVehNameConductorEXT" value="{{$programacion->ProgVehNameConductorEXT}}">
			</div>
			<div class="form-group col-md-6">
				<label for="ProgVehDocAuxiliarEXT">{{ trans('adminlte_lang::message.progvehdocauxext') }}</label><small class="help-block with-errors">*</small>
				<input type="text" maxlength="15" data-minlength="6" class="form-control document" id="ProgVehDocAuxiliarEXT" name="ProgVehDocAuxiliarEXT" value="{{$programacion->ProgVehDocAuxiliarEXT}}">
			</div>
			<div class="form-group col-md-6">
				<label for="ProgVehNameAuxiliarEXT">{{ trans('adminlte_lang::message.progvehnameauxext') }}</label><small class="help-block with-errors">*</small>
				<input type="text" maxlength="50" class="form-control" id="ProgVehNameAuxiliarEXT" name="ProgVehNameAuxiliarEXT" value="{{$programacion->ProgVehNameAuxiliarEXT}}">
			</div>
			<div class="form-group col-md-6">
				<label for="ProgVehPlacaEXT">{{ trans('adminlte_lang::message.progvehplacaext') }}</label><small class="help-block with-errors">*</small>
				<input type="text" class="form-control placa" id="ProgVehPlacaEXT" name="ProgVehPlacaEXT" data-minlength="7" value="{{$programacion->ProgVehPlacaEXT}}">
			</div>
			<div class="form-group col-md-6">
				<label for="ProgVehTipoEXT">{{ trans('adminlte_lang::message.progvehtipoext') }}</label><small class="help-block with-errors">*</small>
				<input type="text" maxlength="16" class="form-control" id="ProgVehTipoEXT" name="ProgVehTipoEXT" value="{{$programacion->ProgVehTipoEXT}}">
			</div>





			<div class="col-md-6" id="containerDePrecintos">
				@if ($programacion->ProgVehPrecintos != null)
				@foreach($programacion->ProgVehPrecintos as $precinto)
				<div class="row" id="precintos{{$loop->index}}">
					<div class="col-md-10">
						<label>Precintos</label>
					</div>
					<div class="form-group col-md-10">
						<input type="text" maxlength="16" class="form-control" id="ProgVehPrecintos" name="ProgVehPrecintos[]" value="{{$precinto}}">
					</div>
					<div class="col-md-2">
						<button class="btn btn-danger dropprecintoedit" type="button" id="button-addon2" onclick="dropPrecinto({{$loop->index}})">Eliminar</button>
					</div>
				</div>
				@endforeach
				@else
				<div class="row" id="precintos0">
					<div class="col-md-10">
						<label>Precintos</label>
					</div>
					<div class="form-group col-md-10">
						<input type="text" maxlength="16" class="form-control" id="ProgVehPrecintos" name="ProgVehPrecintos[]" value="'sin precintos'">
					</div>
					<div class="col-md-2">
						<button class="btn btn-danger dropprecintoedit" type="button" id="button-addon2" onclick="dropPrecinto(0)">Eliminar</button>
					</div>
				</div>
				@endif
			</div>






			<div class="form-group col-md-6">
				<label for="select2sedes" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Copiar información del residuo</b>" data-content="<p style='width: 50%'><ul class='list-group'>
									    @foreach($recolectPointsService as $punto)
								        @foreach($recolectPointsProg as $puntoelegido)
								        @if($punto->ID_GSede == $puntoelegido->FK_ColectSgen)
								        <li class='list-group-item'>{{$punto->generadors->GenerName}} => {{$punto->GSedeAddress}}</li>
								        @endif
								        @endforeach
								        @endforeach
									</ul></p>">
					<span><i style="color: Dodgerblue;" class="fas fa-info-circle fa-spin"></i></span>Puntos de Recolección</label>
				<select class="form-control select" id="select2sedes" name="ProgGenerSedes[]" multiple="multiple">
					@foreach($recolectPointsService as $punto)
					<option @foreach($recolectPointsProg as $puntoelegido) @if($punto->ID_GSede == $puntoelegido->FK_ColectSgen)
						selected="true"
						@endif
						@endforeach
						title="{{$punto->GSedeAddress}}" value="{{$punto->ID_GSede}}">{{$punto->generadors->GenerName}} - </option>
					@endforeach
				</select>
			</div>
			<div class="form-group col-md-6">
				<label>Placa Vehiculo Provicional</label><a class="loadvehicalqui"></a>
				<small class="help-block with-errors">*</small>
				<select name="vehicalqui" id="vehicalqui" class="form-control" required="" disabled="">
					@foreach($Vehiculos2 as $Vehiculo)
					<option value="{{$Vehiculo->ID_Vehic}}" {{$Vehiculo->ID_Vehic == $programacion->FK_ProgVehiculo ? 'selected' : ''}}>{{$Vehiculo->VehicPlaca}}</option>
					@endforeach
				</select>
				@if(in_array(Auth::user()->UsRol, Permisos::ASISTENTELOGISTICA) || in_array(Auth::user()->UsRol2, Permisos::ASISTENTELOGISTICA))
				@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1))
				@else
				<input hidden type="text" name="vehicalqui" value="{{$programacion->FK_ProgVehiculo}}">
				<input hidden type="text" name="ProgVehFecha" value="{{$programacion->ProgVehFecha}}">
				<input hidden type="text" name="ProgVehSalida" value="{{$programacion->ProgVehSalida}}">
				@endif
				@endif
			</div>
			<div class="form-group col-md-6">
				<label for="FK_ProgAyudante">{{ trans('adminlte_lang::message.progvehicayudan') }}</label>
				<small class="help-block with-errors">*</small>
				<select name="FK_ProgAyudante" id="FK_ProgAyudante" class="form-control select" required="">
					@foreach($ayudantes as $ayudante)
					<option value="{{$ayudante->ID_Pers}}" {{$ayudante->ID_Pers == $programacion->FK_ProgAyudante ? 'selected' : ''}}>{{$ayudante->PersFirstName.' '.$ayudante->PersLastName}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group col-md-6 col-md-offset-5">
				{{-- <label for="ProgVehColor">{{ trans('adminlte_lang::message.progvehiccolor') }}</label> --}}
				{{-- <input type="color" class="form-control" id="ProgVehColor" name="ProgVehColor" style="width: 30%; height: 34px;" value="{{$programacion->ProgVehColor}}" disabled=""> --}}
				@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2))
				{{-- <br><a href='/PdfManiCarg/{{$programacion->ID_ProgVeh}}' class="btn btn-primary"><i class="fas fa-file-pdf fa-lg"></i> {{trans('adminlte_lang::message.generatemanicargpdf')}}</a> --}}
				<br><a href='/programacion-express/{{$programacion->ID_ProgVeh}}' class="btn btn-primary"><i class="fas fa-file-pdf fa-lg"></i> {{'Manifiesto de carga'}}</a>
				@endif
			</div>
			<div class="col-md-12 col-xs-12 box box-info"></div>
			<div class="box-footer">
				<div class="col-md-2">
					@if((in_array(Auth::user()->UsRol, Permisos::ProgVehic1) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic1)) && (date("Y-m-d",strtotime($programacion->ProgVehFecha."+ 0 days")) >= date('Y-m-d')))
					<a href='#' data-toggle='modal' data-target="#CrearProgVehic" class="btn btn-primary pull-left">{{ trans('adminlte_lang::message.progvehicadd') }}</a>
					@endif
				</div>
				<div class="col-md-2">
					<a class="btn btn-primary addprecinto pull-left" id="addprecinto" onclick="addPrecinto()">Añadir Precinto</a>
				</div>

				<div class="col-md-8">
					<button type="submit" class="btn btn-success pull-right" id="update">{{ trans('adminlte_lang::message.update') }}</button>
				</div>
			</div>
		</div>

		<!-- /.box-body -->
	</form>
</div>
@endif
</div>
</div>
</div>
<div id="ModalStatus"></div>
</div>
@endsection
@section('NewScript')
<script>
	@if(session('mensaje'))
		NotifiTrue('{{session('mensaje')}}');
	@endif
	@if($programacion->ProgVehtipo == 1)
		$(document).ready(function(){
			@if ($errors->create->any())
				$('#CrearProgVehic').modal("show");
			@endif
			$("#CrearProgVehic").on("hidden.bs.modal", function () {
				$('#FK_ProgVehiculo1').val("");
				$('#FK_ProgConductor1').val("");
				$('#ProgVehSalida1').val("{{date('H:i')}}");
				$('#FK_ProgAyudante1').val("");
				$('#ProgVehFecha1').val("{{date('Y-m-d')}}");
				$('#ProgVehColor1').val("#0000f6");
			});
			
			@if($programacion->ProgVehEntrada !== null)
				console.log('no tiene fecha de entrada');
				// $(".select2-selection").css("background-image", "none");
				$("#ProgVehFecha").prop("disabled", false);
				$("#ProgVehSalida").prop("disabled", false);
				$("#FK_ProgVehiculo").prop("disabled", false);
				$("#FK_ProgConductor").prop("disabled", false);
				$("#FK_ProgAyudante").prop("disabled", false);
				$("#ProgVehEntrada").prop("disabled", false);
				$("#progVehKm").prop("disabled", false);
				$("#ProgVehColor").prop("disabled", false);
				$("#update").prop("disabled", false);
			@else
				@if(in_array(Auth::user()->UsRol, Permisos::JEFELOGISTICA) || in_array(Auth::user()->UsRol2, Permisos::JEFELOGISTICA))
					// $(".select2-selection").css("background-image", "none");
					$("#ProgVehFecha").prop('disabled', false);
					$("#ProgVehSalida").prop('disabled', false);
					$("#FK_ProgVehiculo").prop('disabled', false);
					$("#FK_ProgConductor").prop('disabled', false);
					$("#FK_ProgAyudante").prop('disabled', false);
					$("#ProgVehColor").prop("disabled", false);
				@endif
				@if(in_array(Auth::user()->UsRol, Permisos::ASISTENTELOGISTICA) || in_array(Auth::user()->UsRol2, Permisos::ASISTENTELOGISTICA))
					@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1))
					@else
						$(".select2-container--disabled").css("background-color", "#EEE");
						$("#ProgVehEntrada").prop('required', true);
						$("#progVehKm").prop('required', true);
						$("#ProgVehEntrada").prop('disabled', false);
						$("#progVehKm").prop('disabled', false);
					@endif
				@endif
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
				$("#ProgVehFecha").prop('disabled', false);
				$("#ProgVehSalida").prop('disabled', false);
				$("#ProgVehEntrada").prop('disabled', false);
				$("#progVehKm").prop('disabled', false);
				$("#FK_ProgVehiculo").prop('disabled', false);
				$("#FK_ProgConductor").prop('disabled', false);
				$("#FK_ProgAyudante").prop('disabled', false);
				$("#ProgVehColor").prop("disabled", false);
				$("#ProgVehEntrada").prop('required', false);
				$("#progVehKm").prop('required', false);
			@endif
		});
	@elseif($programacion->ProgVehtipo == 0)
		@if($programacion->ProgVehEntrada <> null)
			$("#ProgVehFecha").prop("disabled", false);
			$(".select2-selection").css("background-image", "none");
			$("#ProgVehSalida").prop("disabled", false);
			$("#ProgVehEntrada").prop("disabled", true);
			$("#update").prop("disabled", false);
		@else
			@if(in_array(Auth::user()->UsRol, Permisos::ASISTENTELOGISTICA) || in_array(Auth::user()->UsRol2, Permisos::ASISTENTELOGISTICA))
			@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1))
			@else
				$("#ProgVehEntrada").prop("required", true);
				$("#ProgVehEntrada").prop("disabled", false);
			@endif
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::JEFELOGISTICA) || in_array(Auth::user()->UsRol2, Permisos::JEFELOGISTICA))
				$("#ProgVehFecha").prop("disabled", false);
				$("#ProgVehSalida").prop("disabled", false);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
				$("#ProgVehEntrada").prop("disabled", false);
				$("#ProgVehFecha").prop("disabled", false);
				$("#ProgVehSalida").prop("disabled", false);
				$("#ProgVehEntrada").prop('required', false);
			@endif
		@endif
	@else
		@if($programacion->ProgVehEntrada <> null)
			$("#ProgVehFecha").prop("disabled", false);
			$(".select2-selection").css("background-image", "none");
			$("#vehicalqui").prop("disabled", false);
			$("#ProgVehSalida").prop("disabled", false);
			$("#ProgVehEntrada").prop("disabled", true);
			$("#update").prop("disabled", false);
			$("#ProgVehDocConductorEXT").prop('disabled', false);
			$("#ProgVehNameConductorEXT").prop('disabled', false);
			$("#ProgVehDocAuxiliarEXT").prop('disabled', false);
			$("#ProgVehNameAuxiliarEXT").prop('disabled', false);
			$("#ProgVehPlacaEXT").prop('disabled', false);
			$("#ProgVehTipoEXT").prop('disabled', false);
			$("#select2sedes").prop('disabled', false);
		@else
			@if(in_array(Auth::user()->UsRol, Permisos::ASISTENTELOGISTICA) || in_array(Auth::user()->UsRol2, Permisos::ASISTENTELOGISTICA))
			@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1))
			@else
				$("#ProgVehEntrada").prop('required', true);
				$("#ProgVehEntrada").prop('disabled', false);
				$("#FK_ProgAyudante").prop('disabled', true);
				$("#ProgVehDocConductorEXT").prop('required', true);
				$("#ProgVehDocConductorEXT").prop('disabled', false);
				$("#ProgVehNameConductorEXT").prop('required', true);
				$("#ProgVehNameConductorEXT").prop('disabled', false);
				$("#ProgVehDocAuxiliarEXT").prop('required', false);
				$("#ProgVehDocAuxiliarEXT").prop('disabled', false);
				$("#ProgVehNameAuxiliarEXT").prop('required', false);
				$("#ProgVehNameAuxiliarEXT").prop('disabled', false);
				$("#ProgVehPlacaEXT").prop('required', true);
				$("#ProgVehPlacaEXT").prop('disabled', false);
				$("#ProgVehTipoEXT").prop('required', true);
				$("#ProgVehTipoEXT").prop('disabled', false);
			@endif
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::JEFELOGISTICA) || in_array(Auth::user()->UsRol2, Permisos::JEFELOGISTICA))
				$("#ProgVehFecha").prop("disabled", false);
				$("#vehicalqui").prop("disabled", false);
				$("#ProgVehSalida").prop("disabled", false);
				$("#FK_ProgAyudante").prop('disabled', false);
				$("#ProgVehDocConductorEXT").prop('required', false);
				$("#ProgVehDocConductorEXT").prop('disabled', false);
				$("#ProgVehNameConductorEXT").prop('required', false);
				$("#ProgVehNameConductorEXT").prop('disabled', false);
				$("#ProgVehDocAuxiliarEXT").prop('required', false);
				$("#ProgVehDocAuxiliarEXT").prop('disabled', false);
				$("#ProgVehNameAuxiliarEXT").prop('required', false);
				$("#ProgVehNameAuxiliarEXT").prop('disabled', false);
				$("#ProgVehPlacaEXT").prop('required', false);
				$("#ProgVehPlacaEXT").prop('disabled', false);
				$("#ProgVehTipoEXT").prop('required', false);
				$("#ProgVehTipoEXT").prop('disabled', false);
			@endif
			@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
				$("#ProgVehEntrada").prop('disabled', false);
				$("#ProgVehFecha").prop("disabled", false);
				$("#vehicalqui").prop("disabled", false);
				$("#ProgVehSalida").prop("disabled", false);
				$("#ProgVehEntrada").prop('required', false);
				$("#FK_ProgAyudante").prop('disabled', false);
			@endif
		@endif
	@endif
	@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic1))
	function TranspotadorProsarc(){
		$('.vehiculoAlquilado').attr('hidden', true);
		$('.vehiculoProsarc').attr('hidden', false);
		$('.ambos').attr('hidden', false);
		$('#modaltransport').attr('required', false);
		$('#modalvehicalqui').attr('required', false);
		$('#modalFK_ProgVehiculo').attr('required', true);
		$('#modalFK_ProgConductor').attr('required', true);
		$('#modalFK_ProgAyudante').attr('required', true);
	}
	function TranspotadorAlquilado(){
		$('.vehiculoProsarc').attr('hidden', true);
		$('.vehiculoAlquilado').attr('hidden', false);
		$('.ambos').attr('hidden', false);
		$('#modaltransport').attr('required', true);
		$('#modalvehicalqui').attr('required', true);
		$('#modalFK_ProgVehiculo').attr('required', false);
		$('#modalFK_ProgConductor').attr('required', false);
		$('#modalFK_ProgAyudante').attr('required', true);
	}
	$('#modaltransport').on('change', function() { 
		var id = $('#modaltransport').val();
		if(id != 0){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});
			$.ajax({
				url: "{{url('/vehicle-transport')}}/"+id,
				method: 'GET',
				data:{},
				beforeSend: function(){
					$(".loadvehicalqui").append('<i class="fas fa-sync-alt fa-spin"></i>');
					$("#modalvehicalqui").prop('disabled', true);
				},
				success: function(res){
					if(res != ''){
						$("#modalvehicalqui").empty();
						var vehiculos = new Array();
						$("#modalvehicalqui").append(`<option value="">{{ trans('adminlte_lang::message.select') }}</option>`);
						for(var i = res.length -1; i >= 0; i--){
							if ($.inArray(res[i].ID_Vehic, vehiculos) < 0) {
								$("#modalvehicalqui").append(`<option value="${res[i].ID_Vehic}">${res[i].VehicPlaca}</option>`);
								vehiculos.push(res[i].ID_Vehic);
							}
						}
					}
					else{
						$("#modalvehicalqui").empty();
						$("#modalvehicalqui").append(`<option value="">{{ trans('adminlte_lang::message.select') }}</option>`);
						NotifiFalse('EL transportador no tiene vehiculos asignados');
					}
				},
				complete: function(){
					$(".loadvehicalqui").empty();
					$("#modalvehicalqui").prop('disabled', false);
				}
			})
		}
	});
	@endif
</script>
<script type="text/javascript">
	@if ($programacion->ProgVehPrecintos != null)
		@foreach($programacion->ProgVehPrecintos as $precinto)
			var contadorPrecintos = {{$loop->count - 1}};
			@break
		@endforeach
	@else
		var contadorPrecintos = 0;
	@endif
		function addPrecinto(){
			contadorPrecintos++
			container = $('#containerDePrecintos')
			container.append(`
			<div class="row" id="precintos`+contadorPrecintos+`">
				<div class="col-md-12">
					<label for="ProgVehPrecintos`+contadorPrecintos+`">Precintos</label>
				</div>
				<div class="col-md-10">
					<input type="text" name="ProgVehPrecintos[]" class="form-control" id="ProgVehPrecintos`+contadorPrecintos+`">
				</div>
				<div class="col-md-2">
					<a class="btn btn-danger dropprecinto" type="button" id="button-addon2" onclick="dropPrecinto(`+contadorPrecintos+`)">Borrar</a>
				</div>
			</div>`)
		};



		function dropPrecinto(id){
			var id = $('#precintos'+id).remove();
		};

</script>
<script>
	var observacion = ``;
	function updatecaracteres() {
		var area = document.getElementById("textDescription");
		var message = document.getElementById("caracteresrestantes");
		var maxLength = 4000;
		message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
		observacion = area.value;
		
	}
	function ModalStatus(idvehiprog, idServicio, boolean, destino, text){
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
									<form action="/programacion-express/`+idvehiprog+`/updateStatus" method="POST" data-toggle="validator" id="SolSer">
										@csrf
										@method('PUT')
										<div class="form-group col-md-12">
											<label  color: black; text-align: left;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="Observaciones de Logistica: <b>(Opcional)</b>" data-content="redacte los detalles u observaciones que desea enviar junto a la notificación de la programación para el servicio #`+idServicio+`"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Observaciones de Logistica:</label>
											<small id="caracteresrestantes" class="help-block with-errors">*</small>
											<textarea onchange="updatecaracteres()" id="textDescription" rows ="5" style="resize: vertical;" maxlength="4000" class="form-control col-xs-12" required name="solserdescript">`+observacion+`</textarea>
										</div>
										<input type="submit" id="Cambiar`+idvehiprog+`" style="display: none;">
										<input type="text" name="destino" value="`+destino+`" style="display: none;">
									</form>
								</div> 
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
								<label for="Cambiar`+idvehiprog+`" class='btn btn-success'>Enviar</label>
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
<script>
	function ModalParafiscales(idvehiprog, idServicio, boolean, destino, text){
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
									<form action="/programacion-express/`+idvehiprog+`/sendParafiscales" method="POST" data-toggle="validator" id="SolSer">
										@csrf
										<div class="form-group col-md-12">
											<label  color: black; text-align: left;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="Observaciones de Logistica: <b>(Opcional)</b>" data-content="redacte los detalles u observaciones que desea enviar junto a la notificación de la programación para el servicio #`+idServicio+`"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Observaciones de Logistica:</label>
											<small id="caracteresrestantes" class="help-block with-errors">*</small>
											<textarea onchange="updatecaracteres()" id="textDescription" rows ="5" style="resize: vertical;" maxlength="4000" class="form-control col-xs-12" required name="solserdescript">`+observacion+`</textarea>
											
										</div>
										<div class="form-group col-md-12">
										<label color: black; text-align: left;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="Observaciones de Logistica: <b>(Opcional)</b>" data-content="redacte los detalles u observaciones que desea enviar junto a la notificación de la programación para el servicio #`+idServicio+`"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Parafiscales a enviar:</label>
										<select class="form-control col-md-12 select" id="select2parafiscales" name="personalParafiscales[]" multiple="multiple">
											@foreach($personalconparafiscales as $ayudante)
												<option @if(($ayudante->ID_Pers == $programacion->FK_ProgAyudante && $ayudante->PersParafiscalesExpire > today()) || ($ayudante->ID_Pers == $programacion->FK_ProgConductor && $ayudante->PersParafiscalesExpire > today()))
												selected="true"
												@endif
												@if($ayudante->PersParafiscalesExpire < today())
												disabled="disabled"
												@endif
												title="{{$ayudante->PersDocNumber}}" value="{{$ayudante->ID_Pers}}">{{$ayudante->PersFirstName}} {{$ayudante->PersLastName}}
												@if($ayudante->PersParafiscalesExpire < today())
												<span class="text-danger">(vencido)</span>
												@endif
												</option>
											@endforeach
										</select>
										</div>
										<input type="submit" id="Cambiar`+idvehiprog+`" style="display: none;">
										<input type="text" name="destino" value="`+destino+`" style="display: none;">
									</form>
								</div> 
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
								<label for="Cambiar`+idvehiprog+`" class='btn btn-success'>Enviar</label>
							</div>
						</div>
					</div>
				</div>
			`);
			$('#SolSer').validator('update');
			popover();
			envsubmit();
			$('#select2parafiscales').select2({
				placeholder: "Seleccione...",
				allowClear: true,
				tags: true,
				width: 'resolve',
				width: '100%',
				theme: "classic"
			});
			$('#myModal').modal();
		}
	}
</script>
@endsection
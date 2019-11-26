@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.progvehictitle') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #fbc2eb, #aa66cc); padding-right:30vw; position:relative; overflow:hidden;">
	{{'Servicios-Programación'}}
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
						<a href="/vehicle-programacion/create" class="btn btn-info col-md-offset-3"><i class="fas fa-calendar-alt"></i> {{ trans('adminlte_lang::message.progvehiccreatetext') }}</a>
						@component('layouts.partials.modal')
							@slot('slug')
								{{$programacion->ID_ProgVeh}}
							@endslot
							@slot('textModal')
								la programación del servicio <b>N° - {{$programacion->FK_ProgServi}}</b>
							@endslot
						@endcomponent
						@if($programacion->ProgVehDelete == 0)
							<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$programacion->ID_ProgVeh}}'  class='btn btn-danger pull-right'><i class="fas fa-trash-alt"></i><b> {{ trans('adminlte_lang::message.delete') }}</b></a>
							<form action='/vehicle-programacion/{{$programacion->ID_ProgVeh}}' method='POST'>
								@method('DELETE')
								@csrf
								<input  type="submit" id="Eliminar{{$programacion->ID_ProgVeh}}" style="display: none;">
							</form>
						@else
							<form action='/vehicle-programacion/{{$programacion->ID_ProgVeh}}' method='POST' class="pull-right">
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
									<form action="/vehicle-programacion" method="POST" id="formularioCreate">
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
												<input  class="form-control" type="date" id="ProgVehFecha1" name="ProgVehFecha" value="{{date('Y-m-d')}}">
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
														<option value="{{$conductor->ID_Pers}}" >{{$conductor->PersFirstName.' '.$conductor->PersLastName}}</option>
													@endforeach
												</select>
											</div>
											<div class="col-xs-12 col-md-12">
												<label for="FK_ProgAyudante1">{{ trans('adminlte_lang::message.progvehicayudan') }}</label>
												<select name="FK_ProgAyudante" id="FK_ProgAyudante1" class="form-control">
													<option value="">Seleccione...</option>
													@foreach($ayudantes as $ayudante)
														<option value="{{$ayudante->ID_Pers}}" >{{$ayudante->PersFirstName.' '.$ayudante->PersLastName}}</option>
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
								<h4 class="modal-title" id="titleModalCreate">{{ trans('adminlte_lang::message.progvehictitle') }} Interno</h4>
							</div>
							<div class="box box-info">
								<div class="modal-body">
									<div style="margin: auto;" id="descripModalCreate">
										<form action="/vehicle-programacion/{{$programacion->FK_ProgServi}}/añadirVehiculo" method="POST" id="formularioCreate" data-toggle="validator">
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
											<input type="text" hidden name="FK_ProgServi" class="FK_ProgServi" id="FK_ProgServi">
											<div class="box-body">
												<div class="form-group col-xs-12 col-md-6">
													<label for="modalProgVehFecha">{{ trans('adminlte_lang::message.progvehicfech') }}</label>
													<input  class="form-control ProgVehFecha" readonly type="date" id="modalProgVehFecha" name="ProgVehFecha" min="{{ $programacion->ProgVehFecha >= date('Y-m-d', strtotime(today())) ? date('Y-m-d', strtotime(today())) : date('Y-m-d', strtotime($programacion->ProgVehFecha)) }}" value="{{date('Y-m-d', strtotime($programacion->ProgVehFecha))}}" value="{{old('ProgVehFecha')}}">
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
													<input type="text" maxlength="15" data-minlength="6" class="form-control document" id="modalProgVehDocConductorEXT"  name="ProgVehDocConductorEXT">
												</div>
												<div class="form-group col-md-12 vehiculoAlquilado" hidden="true">
													<label for="modalProgVehNameConductorEXT">{{ trans('adminlte_lang::message.progvehnameext') }}</label>
													<input type="text" maxlength="50" class="form-control" id="modalProgVehNameConductorEXT"  name="ProgVehNameConductorEXT" >
												</div>
												<div class="form-group col-md-12 vehiculoAlquilado" hidden="true">
													<label for="modalProgVehDocAuxiliarEXT">{{ trans('adminlte_lang::message.progvehdocauxext') }}</label>
													<input type="text" maxlength="15" data-minlength="6" class="form-control document" id="modalProgVehDocAuxiliarEXT"  name="ProgVehDocAuxiliarEXT" >
												</div>
												<div class="form-group col-md-12 vehiculoAlquilado" hidden="true">
													<label for="modalProgVehNameAuxiliarEXT">{{ trans('adminlte_lang::message.progvehnameauxext') }}</label>
													<input type="text" maxlength="50" class="form-control" id="modalProgVehNameAuxiliarEXT"  name="ProgVehNameAuxiliarEXT" >
												</div>
												<div class="form-group col-md-12 vehiculoAlquilado" hidden="true">
													<label for="modalProgVehPlacaEXT">{{ trans('adminlte_lang::message.progvehplacaext') }}</label>
													<input type="text" class="form-control placa" id="modalProgVehPlacaEXT"  name="ProgVehPlacaEXT" data-minlength="7">
												</div>
												<div class="form-group col-md-12 vehiculoAlquilado" hidden="true">
													<label for="modalProgVehTipoEXT">{{ trans('adminlte_lang::message.progvehtipoext') }}</label>
													<input type="text" maxlength="16" class="form-control" id="modalProgVehTipoEXT"  name="ProgVehTipoEXT">
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
					<div class="box box-info">
						<form role="form" action="/vehicle-programacion/{{$programacion->ID_ProgVeh}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
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
								<div class="form-group col-md-6">
									<label for="">Servicio N°</label>
									<input disabled type="text" class="form-control" value="{{$programacion->FK_ProgServi}}">
								</div>
								<div class="form-group col-md-6">
									<label for="ProgVehFecha">{{ trans('adminlte_lang::message.progvehicfech') }}</label>
									<small class="help-block with-errors">*</small>
									<input type="date" class="form-control" id="ProgVehFecha" name="ProgVehFecha"  min="{{ $programacion->ProgVehFecha >= date('Y-m-d', strtotime(today())) ? date('Y-m-d', strtotime(today())) : date('Y-m-d', strtotime($programacion->ProgVehFecha)) }}" value="{{date('Y-m-d', strtotime($programacion->ProgVehFecha))}}" required="" disabled="">
								</div>
								<div class="form-group col-md-6">
									<label for="ProgVehSalida">{{ trans('adminlte_lang::message.progvehicsalida') }}</label>
									<small class="help-block with-errors">*</small>
									<input type="time" class="form-control" id="ProgVehSalida"  name="ProgVehSalida" value="{{date('H:i', strtotime($programacion->ProgVehSalida))}}" required="" disabled="">
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
									@foreach($vehiculos as $vehiculo)
										@if($vehiculo->ID_Vehic == $programacion->FK_ProgVehiculo)
											<input name="FK_ProgVehiculo" hidden aria-hidden="true" value="{{$vehiculo->ID_Vehic}}">
										@endif
									@endforeach
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
									@foreach($conductors as $conductor)
										@if($conductor->ID_Pers == $programacion->FK_ProgConductor)
											<input name="FK_ProgConductor" hidden aria-hidden="true" value="{{$conductor->ID_Pers}}">
										@endif
									@endforeach
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
								<div class="form-group col-md-6 col-md-offset-5">
									<label for="ProgVehColor">{{ trans('adminlte_lang::message.progvehiccolor') }}</label>
									<input type="color" class="form-control" id="ProgVehColor" name="ProgVehColor" style="width: 30%; height: 34px;" value="{{$programacion->ProgVehColor}}" disabled="">
									@if(in_array(Auth::user()->UsRol, Permisos::ProgVehic1) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic1))
										<br><a href='/PdfManiCarg/{{$programacion->ID_ProgVeh}}' class="btn btn-primary"><i class="fas fa-file-pdf fa-lg"></i> {{trans('adminlte_lang::message.generatemanicargpdf')}}</a>
									@endif
								</div>
							</div>
							<div class="box box-info">
								<div class="box-footer">
									@if((in_array(Auth::user()->UsRol, Permisos::ProgVehic1) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic1)) && (date("Y-m-d",strtotime($programacion->ProgVehFecha."+ 0 days")) >= date('Y-m-d') && $programacion->ProgVehEntrada == null))
									<a href='#' data-toggle='modal' data-target="#CrearProgVehic" class="btn btn-primary pull-left">{{ trans('adminlte_lang::message.progvehicadd') }}</a>
									@endif
									<button type="submit" class="btn btn-success pull-right" id="update">{{ trans('adminlte_lang::message.update') }}</button>
								</div>
							</div>
							<!-- /.box-body -->
						</form>
					</div>
				@elseif($programacion->ProgVehtipo == 0)
					<div class="box box-info">
						<form role="form" action="/vehicle-programacion/{{$programacion->ID_ProgVeh}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
							@csrf
							@method('PUT')
							<div class="box-body">
								<div class="form-group col-md-6">
									<label for="">Servicio N°</label>
									<input disabled type="text" class="form-control" value="{{$programacion->FK_ProgServi}}">
								</div>
								<div class="form-group col-md-6">
									<label for="ProgVehFecha">{{ trans('adminlte_lang::message.progvehicfech') }}</label><small class="help-block with-errors">*</small>
									<input type="date" required="" class="form-control" id="ProgVehFecha" name="ProgVehFecha" min="{{ $programacion->ProgVehFecha >= date('Y-m-d', strtotime(today())) ? date('Y-m-d', strtotime(today())) : date('Y-m-d', strtotime($programacion->ProgVehFecha)) }}" value="{{date('Y-m-d', strtotime($programacion->ProgVehFecha))}}" value="{{date('Y-m-d', strtotime($programacion->ProgVehFecha))}}" required="" disabled="">
								</div>
								<div class="form-group col-md-6">
									<label for="ProgVehSalida">{{ trans('adminlte_lang::message.progvehicsalida2') }}</label><small class="help-block with-errors">*</small>
									<input type="time" required="" class="form-control" id="ProgVehSalida"  name="ProgVehSalida" value="{{date('H:i', strtotime($programacion->ProgVehSalida))}}" required="" disabled="">
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
					<div class="box box-info">
						<form role="form" action="/vehicle-programacion/{{$programacion->ID_ProgVeh}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
							@csrf
							@method('PUT')
							<div class="box-body">
								<div class="form-group col-md-6">
									<label for="">Servicio N°</label>
									<input disabled type="text" class="form-control" value="{{$programacion->FK_ProgServi}}">
								</div>
								<div class="form-group col-md-6">
									<label for="ProgVehFecha">{{ trans('adminlte_lang::message.progvehicfech') }}</label><small class="help-block with-errors">*</small>
									<input type="date" class="form-control" id="ProgVehFecha" name="ProgVehFecha"  min="{{ $programacion->ProgVehFecha >= date('Y-m-d', strtotime(today())) ? date('Y-m-d', strtotime(today())) : date('Y-m-d', strtotime($programacion->ProgVehFecha)) }}" value="{{date('Y-m-d', strtotime($programacion->ProgVehFecha))}}" required="" disabled="">
								</div>
								<div class="form-group col-md-6">
									<label for="ProgVehSalida">{{ trans('adminlte_lang::message.progvehicsalida2') }}</label><small class="help-block with-errors">*</small>
									<input type="time" required="" class="form-control" id="ProgVehSalida"  name="ProgVehSalida" value="{{date('H:i', strtotime($programacion->ProgVehSalida))}}" required="" disabled="">
								</div>
								<div class="form-group col-md-6">
									<label for="ProgVehEntrada">{{ trans('adminlte_lang::message.progvehicllegada2') }}</label><small class="help-block with-errors">*</small>
									<input type="time" class="form-control" id="ProgVehEntrada" name="ProgVehEntrada" value="{{$programacion->ProgVehEntrada <> null ? date('H:i', strtotime($programacion->ProgVehEntrada)) : ''}}" disabled="">
								</div>
								<div class="form-group col-md-6">
									<label for="ProgVehDocConductorEXT">{{ trans('adminlte_lang::message.progvehdocext') }}</label><small class="help-block with-errors">*</small>
									<input type="text" maxlength="15" data-minlength="6" class="form-control document" id="ProgVehDocConductorEXT"  name="ProgVehDocConductorEXT" value="{{$programacion->ProgVehDocConductorEXT}}">
								</div>
								<div class="form-group col-md-6">
									<label for="ProgVehNameConductorEXT">{{ trans('adminlte_lang::message.progvehnameext') }}</label><small class="help-block with-errors">*</small>
									<input type="text" maxlength="50" class="form-control" id="ProgVehNameConductorEXT"  name="ProgVehNameConductorEXT" value="{{$programacion->ProgVehNameConductorEXT}}">
								</div>
								<div class="form-group col-md-6">
									<label for="ProgVehDocAuxiliarEXT">{{ trans('adminlte_lang::message.progvehdocauxext') }}</label><small class="help-block with-errors">*</small>
									<input type="text" maxlength="15" data-minlength="6" class="form-control document" id="ProgVehDocAuxiliarEXT"  name="ProgVehDocAuxiliarEXT" value="{{$programacion->ProgVehDocAuxiliarEXT}}">
								</div>
								<div class="form-group col-md-6">
									<label for="ProgVehNameAuxiliarEXT">{{ trans('adminlte_lang::message.progvehnameauxext') }}</label><small class="help-block with-errors">*</small>
									<input type="text" maxlength="50" class="form-control" id="ProgVehNameAuxiliarEXT"  name="ProgVehNameAuxiliarEXT" value="{{$programacion->ProgVehNameAuxiliarEXT}}">
								</div>
								<div class="form-group col-md-6">
									<label for="ProgVehPlacaEXT">{{ trans('adminlte_lang::message.progvehplacaext') }}</label><small class="help-block with-errors">*</small>
									<input type="text" class="form-control placa" id="ProgVehPlacaEXT"  name="ProgVehPlacaEXT" data-minlength="7" value="{{$programacion->ProgVehPlacaEXT}}">
								</div>
								<div class="form-group col-md-6">
									<label for="ProgVehTipoEXT">{{ trans('adminlte_lang::message.progvehtipoext') }}</label><small class="help-block with-errors">*</small>
									<input type="text" maxlength="16" class="form-control" id="ProgVehTipoEXT"  name="ProgVehTipoEXT" value="{{$programacion->ProgVehTipoEXT}}">
								</div>
								<div class="fomr-group col-md-6" style="margin-bottom: 30px;">
									<label>Placa Vehiculo Provicional</label><a class="loadvehicalqui"></a>
									<small class="help-block with-errors">*</small>
									<select name="vehicalqui" id="vehicalqui" class="form-control" required="" disabled="">
										@foreach($Vehiculos2 as $Vehiculo)
											<option value="{{$Vehiculo->ID_Vehic}}" {{$Vehiculo->ID_Vehic == $programacion->FK_ProgVehiculo ? 'selected' : ''}}>{{$Vehiculo->VehicPlaca}}</option>
										@endforeach
									</select>
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
								<div class="col-md-12 col-xs-12 box box-info"></div>
								<div class="box-footer">
									@if((in_array(Auth::user()->UsRol, Permisos::ProgVehic1) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic1)) && (date("Y-m-d",strtotime($programacion->ProgVehFecha."+ 0 days")) >= date('Y-m-d') && $programacion->ProgVehEntrada == null))
									<a href='#' data-toggle='modal' data-target="#CrearProgVehic" class="btn btn-primary pull-left">{{ trans('adminlte_lang::message.progvehicadd') }}</a>
									@endif
									<button type="submit" class="btn btn-success pull-right" id="update">{{ trans('adminlte_lang::message.update') }}</button>
								</div>
							</div>

							<!-- /.box-body -->
						</form>
					</div>
				@endif
			</div>
		</div>
	</div>
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
				$("#ProgVehFecha").prop("disabled", true);
				$("#ProgVehSalida").prop("disabled", true);
				$("#FK_ProgVehiculo").prop("disabled", true);
				$("#FK_ProgConductor").prop("disabled", true);
				$("#FK_ProgAyudante").prop("disabled", true);
				$("#ProgVehEntrada").prop("disabled", true);
				$("#progVehKm").prop("disabled", true);
				$("#ProgVehColor").prop("disabled", true);
				$("#update").prop("disabled", true);
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
					$(".select2-container--disabled").css("background-color", "#EEE");
					$("#ProgVehEntrada").prop('required', true);
					$("#progVehKm").prop('required', true);
					$("#ProgVehEntrada").prop('disabled', false);
					$("#progVehKm").prop('disabled', false);
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
			$("#ProgVehFecha").prop("disabled", true);
			$(".select2-selection").css("background-image", "none");
			$("#ProgVehSalida").prop("disabled", true);
			$("#ProgVehEntrada").prop("disabled", true);
			$("#update").prop("disabled", true);
		@else
			@if(in_array(Auth::user()->UsRol, Permisos::ASISTENTELOGISTICA) || in_array(Auth::user()->UsRol2, Permisos::ASISTENTELOGISTICA))
				$("#ProgVehEntrada").prop("required", true);
				$("#ProgVehEntrada").prop("disabled", false);
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
			$("#ProgVehFecha").prop("disabled", true);
			$(".select2-selection").css("background-image", "none");
			$("#vehicalqui").prop("disabled", true);
			$("#ProgVehSalida").prop("disabled", true);
			$("#ProgVehEntrada").prop("disabled", true);
			$("#update").prop("disabled", true);
			$("#ProgVehDocConductorEXT").prop('disabled', true);
			$("#ProgVehNameConductorEXT").prop('disabled', true);
			$("#ProgVehDocAuxiliarEXT").prop('disabled', true);
			$("#ProgVehNameAuxiliarEXT").prop('disabled', true);
			$("#ProgVehPlacaEXT").prop('disabled', true);
			$("#ProgVehTipoEXT").prop('disabled', true);
		@else
			@if(in_array(Auth::user()->UsRol, Permisos::ASISTENTELOGISTICA) || in_array(Auth::user()->UsRol2, Permisos::ASISTENTELOGISTICA))
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
@endsection
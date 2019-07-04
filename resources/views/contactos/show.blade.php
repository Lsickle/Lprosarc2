@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientcontacto') }}
@endsection
@section('contentheader_title')
	{{ trans('adminlte_lang::message.clientcontacto') }}
@endsection	
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-body box-profile">
					<div class="col-md-12 col-xs-12">
						@if($Cliente->CliDelete == 0)
							<a href="/contactos/{{$Cliente->CliSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{ trans('adminlte_lang::message.edit') }}</b></a>
						@endif
						@component('layouts.partials.modal')
							@slot('slug')
								{{$Cliente->ID_Cli}}
							@endslot
							@slot('textModal')
								el transportador <b>{{$Cliente->CliShortname}}</b>
							@endslot
						@endcomponent
						@if($Cliente->CliDelete == 0)
							<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Cliente->ID_Cli}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i><b> {{ trans('adminlte_lang::message.delete') }}</b></a>
							<form action='/contactos/{{$Cliente->CliSlug}}' method='POST'  class="col-12 pull-right">
								@method('DELETE')
								@csrf
								<input type="submit" id="Eliminar{{$Cliente->ID_Cli}}" style="display: none;">
							</form>
						@else
							<form action='/contactos/{{$Cliente->CliSlug}}' method='POST' class="pull-left">
								@method('DELETE')
								@csrf
								<button type="submit" class='btn btn-success btn-block'>
									<i class="fas fa-plus-square"></i><b> {{ trans('adminlte_lang::message.add') }}</b>
								</button>
							</form>
						@endif
					</div>
					{{-- <ul class="list-group list-group-unbordered"> --}}
						<h3 class="profile-username text-center">{{$Cliente->CliShortname}}</h3>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientcategoría') }}</b> <a class="pull-right">{{$Cliente->CliCategoria}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clirazonsoc') }}</b> <a class="pull-right">{{$Cliente->CliName}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b> <a class="pull-right">{{$Cliente->CliShortname}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientNIT') }}</b> <a class="pull-right">{{$Cliente->CliNit}}</a>
						</li>
					{{-- </ul> --}}
				</div>
			   
				<div class="box-body box-profile">
						<h3 class="profile-username text-center">{{ trans('adminlte_lang::message.sclientsede') }}</h3>
					{{-- <ul class="list-group list-group-unbordered"> --}}
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.sclientnamesede') }}</b> <a class="pull-right">{{$Sede->SedeName}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.address') }}</b>
							<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.adddress') }}')"><i class="far fa-copy"></i></a>
							<a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.adddress') }}" title="{{ trans('adminlte_lang::message.address') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Sede->SedeAddress}} ({{$Municipio->MunName}} - {{$Departamento->DepartName}})</p>">{{$Sede->SedeAddress}} ({{$Municipio->MunName}} - {{$Departamento->DepartName}})</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.phone') }}</b> <a class="pull-right">{{$Sede->SedePhone1}} - {{$Sede->SedeExt1}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.phone') }} 2</b> <a class="pull-right">{{$Sede->SedePhone2}} - {{$Sede->SedeExt2}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.email') }}</b>
							<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.emailaddress') }}')"><i class="far fa-copy"></i></a>
							<a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.emailaddress') }}" title="{{ trans('adminlte_lang::message.emailaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Sede->SedeEmail}}</p>">{{$Sede->SedeEmail}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.mobile') }}</b> <a class="pull-right">{{$Sede->SedeCelular}}</a>
						</li>
					{{-- </ul> --}}
				</div>
			</div>
		</div>
		{{-- modal de Crear un Vehiculo --}}
		<form role="form" action="/contacto-vehiculo-create/{{$Sede->SedeSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
			@csrf
			<div class="modal modal-default fade in create" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<div style="font-size: 5em; color: green; text-align: center; margin: auto;">
								<i class="fas fa-plus-circle"></i>
								<span style="font-size: 0.3em; color: black;"><p>{{ trans('adminlte_lang::message.vehiculocreate') }}</p></span>
							</div> 
						</div>
						@if ($errors->any() && !old('validate'))
							<div class="alert alert-danger" role="alert">
								<ul>
									@foreach ($errors->all() as $error)
										<p>{{$error}}</p>
									@endforeach
								</ul>
							</div>
						@endif
						<div class="modal-header">
							<div class="form-group col-md-12">
								<label for="VehicPlaca" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.vehicplaca') }}</b>" data-content="Placa de un vehiculo del Tranportador">
									<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
									{{ trans('adminlte_lang::message.vehicplaca') }}
								</label>
								<small class="help-block with-errors">*</small>
								<input type="text" name="CreateVehicPlaca" class="form-control placa" id="VehicPlaca" data-minlength="7" maxlength="7" data-error="{{ trans('adminlte_lang::message.data-error-minlength6') }}" placeholder="{{ trans('adminlte_lang::message.placaplaceholder') }}" value="{{old('CreateVehicPlaca')}}" required>
							</div>
							<div class="col-md-12 form-group">
								<label for="VehicTipo" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.vehictipo') }}</b>" data-content="{{ trans('adminlte_lang::message.contacvehictipomessage') }}">
									<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
									{{ trans('adminlte_lang::message.vehictipo') }}
								</label>
								<small class="help-block with-errors">*</small>
								<input type="text" name="CreateVehicTipo" class="form-control" id="VehicTipo" maxlength="64" value="{{old('CreateVehicTipo')}}" required>
							</div>
							<div class="col-md-12 form-group">
								<label for="VehicCapacidad" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.vehiccapacidad') }}</b>" data-content="{{ trans('adminlte_lang::message.contacvehiccapacidadmessage') }}">
									<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
									{{ trans('adminlte_lang::message.vehiccapacidad') }}
								</label>
								<small class="help-block with-errors">*</small>
								<input type="number" name="CreateVehicCapacidad" class="form-control" id="VehicCapacidad" maxlength="64" min="0" value="{{old('CreateVehicCapacidad')}}" required>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.add') }}</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		{{-- final del modal --}}
		<div class="col-md-6">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active box-info"><a href="#vehiculo" data-toggle="tab">{{ trans('adminlte_lang::message.vehiculos') }}</a></li>
				</ul>
				<div class="tab-content">
					<div class="active tab-pane" id="vehiculo">
						<div class="text-center">
							{{-- BOTON DE CREAR VEHICULO --}}
							@if($Cliente->CliDelete == 0)
								<a method='get' href='#' data-toggle='modal' data-target='#create'  id="createvehiculo" class="btn btn-success text-center"><i class="fas fa-plus-circle"></i><b> {{ trans('adminlte_lang::message.addvehiculo') }}</b></a>
							@endif
						</div>
						<div style='overflow-y:auto; max-height:463px;'>
							@foreach ($Vehiculos as $Vehiculo)
								<div class="box-body box-profile">
									{{-- BOTONES DE ELIMINAR Y EDITAR --}}
									@if ($Vehiculo->VehicDelete === 0)
										<a method='get' href='#' data-toggle='modal' data-target='#edit{{$Vehiculo->ID_Vehic}}'  id="editvehiculo" onclick="editvehiculo(`{{$Vehiculo->ID_Vehic}}`, `{{$Vehiculo->VehicPlaca}}`, `{{$Vehiculo->VehicTipo}}`, `{{$Vehiculo->VehicCapacidad}}`)" title="Editar" class="btn btn-warning pull-right"><i class="fas fa-edit"></i></a>
										<a method='get' href='#' data-toggle='modal' data-target='#contactosdelete'  id="deletevehiculo" onclick="deletevehiculo(`{{$Vehiculo->ID_Vehic}}`, `{{$Vehiculo->VehicPlaca}}`)" title="Eliminar" class="btn btn-danger pull-left"><i class="fas fa-trash-alt"></i></a>
										<div id="editvehiculocontacto"></div>
										<div id="deletevehiculocontacto"></div>
									@else
										@if ($Cliente->CliDelete === 0)
											<form action='/contacto-vehiculo-delete/{{$Vehiculo->ID_Vehic}}' method='POST' class="pull-left">
												@method('DELETE')
												@csrf
												<button type="submit" class='btn btn-success' title="Añadir">
													<i class="fas fa-plus-square"></i>
												</button>
											</form>
										@endif
									@endif
									<h3 class="profile-username text-center">{{$Vehiculo->VehicPlaca}}</h3>
									<li class="list-group-item">
										<b>{{ trans('adminlte_lang::message.vehicplaca') }}</b> <a class="pull-right">{{$Vehiculo->VehicPlaca}}</a>
									</li>
									<li class="list-group-item">
										<b>{{ trans('adminlte_lang::message.vehictipo') }}</b> <a class="pull-right">{{$Vehiculo->VehicTipo}}</a>
									</li>
									<li class="list-group-item">
										<b>{{ trans('adminlte_lang::message.vehiccapacidad') }}</b> <a class="pull-right">{{$Vehiculo->VehicCapacidad}}</a>
									</li>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('NewScript')
<script>
	function editvehiculo(id, placa, tipo, capacidad){
		$('#editvehiculocontacto').empty();
		$('#editvehiculocontacto').append(`
		<form role="form" action="/contacto-vehiculo-edit/`+id+`" method="POST" enctype="multipart/form-data" data-toggle="validator" id="formedit">
			@csrf
			@method('PUT')
			<div class="modal modal-default fade in edit`+id+`" id="edit`+id+`" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<div style="font-size: 5em; color: orange; text-align: center; margin: auto;">
								<i class="fas fa-edit"></i>
								<span style="font-size: 0.3em; color: black;"><p>{{ trans('adminlte_lang::message.vehiculoedit') }}</p></span>
							</div>
						</div>
						<div id="errors"></div>
						<div class="modal-header">
							<div class="form-group col-md-12">
								<label for="VehicPlaca">{{ trans('adminlte_lang::message.vehicplaca') }}</label><small class="help-block with-errors">*</small>
								<input type="text" name="VehicPlaca" class="form-control placa" id="VehicPlaca" data-minlength="7" maxlength="7" data-error="{{ trans('adminlte_lang::message.data-error-minlength6') }}" placeholder="{{ trans('adminlte_lang::message.placaplaceholder') }}" value="`+placa+`" required>
							</div>
							<div class="col-md-12 form-group">
								<label for="VehicTipo"> {{ trans('adminlte_lang::message.vehictipo') }}</label><small class="help-block with-errors">*</small>
								<input type="text" name="VehicTipo" class="form-control" id="VehicTipo" maxlength="64" value="`+tipo+`" required>
							</div>
							<div class="col-md-12 form-group">
								<label for="VehicCapacidad">{{ trans('adminlte_lang::message.vehiccapacidad') }}</label><small class="help-block with-errors">*</small>
								<input type="number" name="VehicCapacidad" maxlength="7" min="0" class="form-control" id="VehicCapacidad" maxlength="64" value="`+capacidad+`" required>
							</div>
						</div>
						<input type="text" name="validate" hidden value="`+id+`">
						<div class="modal-footer">
							<button type="submit" class="btn btn-warning pull-right">{{ trans('adminlte_lang::message.update') }}</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		`);
		$('#formedit').validator('update');
	}
	function deletevehiculo(id, placa){
		$('#deletevehiculocontacto').empty();
		$('#deletevehiculocontacto').append(`
		<form action='/contacto-vehiculo-delete/`+id+`' method='POST' class="col-12 pull-right">
			@method('DELETE')
			@csrf
			<div class="modal modal-default fade in" id="contactosdelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<div style="font-size: 5em; color: red; text-align: center; margin: auto;">
								<i class="fas fa-exclamation-triangle"></i>
								<span style="font-size: 0.3em; color: black;">
									<p>{{ trans('adminlte_lang::message.deletevehiculo') }} <b><i>`+placa+`</i></b> {{ trans('adminlte_lang::message.?') }} </p>
								</span>
							</div> 
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success pull-left" data-dismiss="modal">{{ trans('adminlte_lang::message.modalexit') }}</button>
							<label for="delete" class='btn btn-danger'>{{ trans('adminlte_lang::message.modaldelete') }}</label>
						</div>
					</div>
				</div>
			</div>
			<input type="submit" id="delete" style="display: none;">
		</form>
		`);
	}
	function errorNull(){
		$('#errors').empty();
		$('#errors').append(`
			@if ($errors->any() && old('validate'))
				<div class="alert alert-danger" role="alert">
					<ul>
						@foreach ($errors->all() as $error)
							<p>{{$error}}</p>
						@endforeach
					</ul>
				</div>
			@endif
		`);
	}
</script>
@if ($errors->any() && old('validate'))
	<script>
		$(document).ready(function() {
			editvehiculo(`{{old('validate')}}`, `{{old('VehicPlaca')}}`, `{{old('VehicTipo')}}`, `{{old('VehicCapacidad')}}`);
			errorNull();
			$(".edit{{old('validate')}}").modal("show");
		});
	</script>
@else
	@if($errors->any())
		<script>
			$(document).ready(function() {
				$(".create").modal("show");
			});
		</script>
	@endif
@endif
@endsection
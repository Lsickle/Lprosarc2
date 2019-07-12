<div id="Respels">
	<div id="Residuo">
		{{-- <div id="form-step-0" role="form" data-toggle="validator"> --}}
			<div class="col-md-6 form-group has-feedback">
				<label>{{ trans('adminlte_lang::message.name') }}</label>
				<input maxlength="128" name="RespelName" type="text" class="form-control" placeholder="Nombre del Residuo" required value="{{$Respels->RespelName}}">
			</div>
			<div class="col-md-6 form-group has-feedback">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' data-delay='{"show": 500}' title="{{ trans('adminlte_lang::LangRespel.respeldescriptittle') }}" data-content="{{ trans('adminlte_lang::LangRespel.respeldescriptinfo') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::LangRespel.descripcion') }}</label>
				<input required maxlength="512" name="RespelDescrip" type="text" class="form-control" placeholder="Descripcion del Residuo" value="{{$Respels->RespelDescrip}}">
			</div>
			<div class="col-md-6 form-group has-feedback">
				<label>{{ trans('adminlte_lang::LangRespel.estadofisico') }}</label>
				<select name="RespelEstado" class="form-control" required>
					<option value="">{{ trans('adminlte_lang::LangRespel.select') }}</option>
					<option {{ ($Respels->RespelEstado === trans('adminlte_lang::LangRespel.estadofisico1') ? "selected" : "" )}} value="{{ trans('adminlte_lang::LangRespel.estadofisico1') }}">{{ trans('adminlte_lang::LangRespel.estadofisico1') }}</option>
					<option {{ ($Respels->RespelEstado === trans('adminlte_lang::LangRespel.estadofisico2') ? "selected" : "" )}} value="{{ trans('adminlte_lang::LangRespel.estadofisico2') }}">{{ trans('adminlte_lang::LangRespel.estadofisico2') }}</option>
					<option {{ ($Respels->RespelEstado === trans('adminlte_lang::LangRespel.estadofisico3') ? "selected" : "" )}} value="{{ trans('adminlte_lang::LangRespel.estadofisico3') }}">{{ trans('adminlte_lang::LangRespel.estadofisico3') }}</option>
					<option {{ ($Respels->RespelEstado === trans('adminlte_lang::LangRespel.estadofisico4') ? "selected" : "" )}} value="{{ trans('adminlte_lang::LangRespel.estadofisico4') }}">{{ trans('adminlte_lang::LangRespel.estadofisico4') }}</option>
				</select>
			</div>
			<div class="col-md-6 form-group has-feedback">
				<label>{{ trans('adminlte_lang::LangRespel.danger') }}</label>
				<select id="selectDanger0" name="RespelIgrosidad" class="form-control" required>
					<option value="">{{ trans('adminlte_lang::LangRespel.select')}}</option>

					<option value = "{{ trans('adminlte_lang::LangRespel.danger1')}}" {{ ($Respels->RespelIgrosidad === 'No peligroso' ? 'selected' : '' )}} onclick="setNoDanger(0)">
						{{ trans('adminlte_lang::LangRespel.danger1') }}
					</option>

					<option value = "{{ trans('adminlte_lang::LangRespel.danger2')}}" {{ ($Respels->RespelIgrosidad === trans('adminlte_lang::LangRespel.danger2') ? 'selected' : '') }} onclick="setDanger(0)">
						{{ trans('adminlte_lang::LangRespel.danger2') }}
					</option>

					<option value = "{{ trans('adminlte_lang::LangRespel.danger3')}}" {{ ($Respels->RespelIgrosidad === trans('adminlte_lang::LangRespel.danger3') ? 'selected' : '') }} onclick="setDanger(0)">
						{{ trans('adminlte_lang::LangRespel.danger3') }}
					</option>

					<option value = "{{ trans('adminlte_lang::LangRespel.danger4')}}" {{ ($Respels->RespelIgrosidad === trans('adminlte_lang::LangRespel.danger4') ? 'selected' : '') }} onclick="setDanger(0)">
						{{ trans('adminlte_lang::LangRespel.danger4') }}
					</option>

					<option value = "{{ trans('adminlte_lang::LangRespel.danger5')}}" {{ ($Respels->RespelIgrosidad === trans('adminlte_lang::LangRespel.danger5') ? 'selected' : '') }} onclick="setDanger(0)">
						{{ trans('adminlte_lang::LangRespel.danger5') }}
					</option>

					<option value = "{{ trans('adminlte_lang::LangRespel.danger5')}}" {{ ($Respels->RespelIgrosidad === trans('adminlte_lang::LangRespel.danger5') ? 'selected' : '') }} onclick="setDanger(0)">
						{{ trans('adminlte_lang::LangRespel.danger6') }}
					</option>

					<option value = "{{ trans('adminlte_lang::LangRespel.danger7')}}" {{ ($Respels->RespelIgrosidad === trans('adminlte_lang::LangRespel.danger7') ? 'selected' : '') }} onclick="setDanger(0)">
						{{ trans('adminlte_lang::LangRespel.danger7') }}
					</option>

					<option value = "{{ trans('adminlte_lang::LangRespel.danger8')}}" {{ ($Respels->RespelIgrosidad === trans('adminlte_lang::LangRespel.danger8') ? 'selected' : '') }} onclick="setDanger(0)">
						{{ trans('adminlte_lang::LangRespel.danger8') }}
					</option>

				</select>
			</div>
			@if($Respels->RespelIgrosidad !== 'No peligroso')
			<div class="col-md-6 form-group has-feedback" style="max-height: 2em; text-align: center;" id="danger0">
				<label>Tipo de clasificación</label><br>
				@if(is_null($Respels->ARespelClasf4741))
				<a class="btn btn-success" onclick="AgregarY(0)">Y</a>
				<a class="btn btn-default" onclick="AgregarA(0)">A</a>
				@else
				<a class="btn btn-default" onclick="AgregarY(0)">Y</a>
				<a class="btn btn-success" onclick="AgregarA(0)">A</a>
				@endif
			</div>
			<div class="col-md-6 form-group has-feedback" id="Clasif0">
				@if(is_null($Respels->ARespelClasf4741))
					@include('layouts.RespelPartials.layoutsRes.ClasificacionYEdit')
				@else
					@include('layouts.RespelPartials.layoutsRes.ClasificacionAEdit')
				@endif
			</div>
			@else
			<div class="col-md-6 form-group has-feedback" style="max-height: 2em; text-align: center;" id="danger0" hidden="">
				<label>Tipo de clasificación</label><br>
				<a class="btn btn-success"  id="ClasifY0" onclick="AgregarY(0)">Y</a>
				<a class="btn btn-default"  id="ClasifA0" onclick="AgregarA(0)">A</a>
			</div>
			<div class="col-md-6 form-group has-feedback" id="Clasif0" hidden="">
			</div>
			@endif
			{{-- input de la hoja de seguridad --}}
			<div class="col-md-6 form-group has-feedback">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>{{ trans('adminlte_lang::LangRespel.hojadeseguridad') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.hojapopoverinfo') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::LangRespel.hojadeseguridad') }}</label>
				<small class="help-block with-errors">*</small>
				@if($Respels->RespelHojaSeguridad !== 'RespelHojaDefault.pdf')
				<div class="input-group">
					<input id="hoja0" name="RespelHojaSeguridad" type="file" data-filesize="2048" class="form-control" data-accept="pdf" accept=".pdf">
					<div class="input-group-btn">
						<a method='get' href='/img/HojaSeguridad/{{$Respels->RespelHojaSeguridad}}' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
					</div>
				</div>
				@else
					@if($Respels->RespelIgrosidad !== 'No peligroso')
					<div class="input-group">
						<input required id="hoja0" name="RespelHojaSeguridad" type="file" data-filesize="2048" class="form-control" data-accept="pdf" accept=".pdf">
						<div class="input-group-btn">
							<a method='get' target='_blank' class='btn btn-default'><i class='fas fa-ban fa-lg'></i></a>
						</div>
					</div>
					@else
					<div class="input-group">
						<input id="hoja0" name="RespelHojaSeguridad" type="file" data-filesize="2048" class="form-control" data-accept="pdf" accept=".pdf">
						<div class="input-group-btn">
							<a method='get' target='_blank' class='btn btn-default'><i class='fas fa-ban fa-lg'></i></a>
						</div>
					</div>
					@endif
				@endif
			</div>
			{{-- input de la tarjeta de emergencia --}}
			<div class="col-md-6 form-group has-feedback">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.tarjetapopoverinfo') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}</label>
				<small class="help-block with-errors">*</small>
				@if($Respels->RespelTarj!=='RespelTarjetaDefault.pdf')
				<div class="input-group">
					<input id="hoja0" name="RespelTarj" type="file" data-filesize="2048" class="form-control" data-accept="pdf" accept=".pdf">
					<div class="input-group-btn">
						<a method='get' href='/img/TarjetaEmergencia/{{$Respels->RespelTarj}}' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
					</div>
				</div>
				@else
				<div class="input-group">
					<input id="hoja0" name="RespelTarj" type="file" data-filesize="2048" class="form-control" data-accept="pdf" accept=".pdf">
					<div class="input-group-btn">
						<a method='get' target='_blank' class='btn btn-default'><i class='fas fa-ban fa-lg'></i></a>
					</div>
				</div>	
				@endif
			</div>
			{{-- input de la foto del residuo --}}
			<div class="col-md-6 form-group has-feedback">
				<label style="margin-bottom: 3px;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>{{ trans('adminlte_lang::LangRespel.foto') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.fotopopoverinfo') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::LangRespel.fotolabel') }}</label>
				<small class="help-block with-errors"></small>
				{{-- <input id="foto0" name="RespelFoto" type="file" class="form-control" accept=".jpg,.png" data-filesize="2048" data-filetype="png">
				<span class="form-control-feedback fa fa-camera" style="margin-right: 1.8em;" aria-hidden="true"><span> --}}
				@if($Respels->RespelFoto!=='RespelFotoDefault.png')
				<div class="input-group">
					<input id="foto0" name="RespelFoto" type="file" class="form-control" data-accept="jpg, jpeg, png" accept=".jpg,.jpeg,.png" data-filesize="2048" data-filetype="png">
					<div class="input-group-btn">
						<a method='get' href='/img/fotoRespelCreate/{{$Respels->RespelFoto}}' target='_blank' class='btn btn-success'><i class='fas fa-image fa-lg'></i></a>
					</div>
				</div>
				@else
				<div class="input-group">
					<input id="foto0" name="RespelFoto" type="file" class="form-control" data-accept="jpg, jpeg, png" accept=".jpg,.jpeg,.png" data-filesize="2048" data-filetype="png">
					<div class="input-group-btn">
						<a method='get' target='_blank' class='btn btn-default'><i class='fas fa-ban fa-lg'></i></a>
					</div>
				</div>
				@endif
			</div>
			<div class="col-md-6 form-group has-feedback">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::LangRespel.resolucion1tittle') }}" data-content="{{ trans('adminlte_lang::LangRespel.resolucion1descrip') }}">{{ trans('adminlte_lang::LangRespel.controlx') }}
					<a href="{{ trans('adminlte_lang::LangRespel.resolucion1link') }}" target="_blank">{{ trans('adminlte_lang::LangRespel.resolucion1') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></a>
				</label>
				<select id="selectControl0" name="SustanciaControlada" class="form-control" required>
					<option value="">{{ trans('adminlte_lang::LangRespel.select') }}</option>
					<option value="0" onclick="setNoControlada(0)" {{ ($Respels->SustanciaControlada === 0 ? 'selected' : '') }}>{{ trans('adminlte_lang::LangRespel.no') }}</option>
					<option value="1" onclick="setControlada(0)" {{ ($Respels->SustanciaControlada === 1 ? 'selected' : '') }}>{{ trans('adminlte_lang::LangRespel.yes') }}</option>
				</select>
			</div>
			<div class="col-md-6 form-group has-feedback" id="sustanciaFormtype0" style="text-align: center;" hidden="">
				<label style="margin-bottom: 0">Tipo de sustancia</label><br>
				<a class="btn btn-success" id="Controlada0" onclick="AgregarControlada(0)"> Controlada</a>
				<a class="btn btn-default" id="Masivo0" onclick="AgregarMasivo(0)">Uso masivo</a>
			</div>
			<div class="col-md-6 form-group has-feedback" id="sustanciaFormName0" hidden="">
			</div>
			<div class="col-md-6 form-group has-feedback" id="sustanciaFormDoc0" hidden="">
			</div>
			<div class="col-md-6 form-group has-feedback">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::LangRespel.aceptaciontittlepopover') }}" data-content="{{ trans('adminlte_lang::LangRespel.aceptacioninfopopover') }}">
					<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::LangRespel.aceptacionlabel') }}
				</label>
				<select id="selectDdeclaracion0" name="RespelDeclaracion" class="form-control" required>
					<option value="" selected>{{ trans('adminlte_lang::LangRespel.select')}}</option>
					<option value="1">{{ trans('adminlte_lang::LangRespel.yes') }}</option>
				</select>
			</div>
			{{--
		</div> --}}
	</div>
</div>
<script>
var contador = 1;
@if(!is_null($Respels->SustanciaControladaNombre))
		setControlada(0);
		@if($Respels->SustanciaControladaTipo == 0)
			AgregarControlada(0);
		@else
			AgregarMasivo(0);
		@endif
@endif
function attachPopover() {
	$('[data-toggle="popover"]').popover({
		html: true,
		trigger: 'hover',
		placement: 'auto',
	});
}
function setDanger(id) {
	AgregarY(id);
	$("#danger" + id).removeAttr("hidden");
	$("#Clasif" + id).removeAttr("hidden");
	$("#myform").validator('destroy');
	$("#hoja" + id).prop('required', true);
	$("#myform").validator('update');
	attachPopover();
}

function setNoDanger(id) {
	$("#danger" + id).attr("hidden", true);
	$("#Clasif" + id).attr("hidden", true);
	$("#Clasif" + id+" > select").prop('required', false);
	$("#hoja" + id).prop('required', false);
	$("#myform").validator('destroy');
	$("#myform").validator('update');
}

function setControlada(id) {
	AgregarControlada(id);
	$("#sustanciaFormtype" + id).removeAttr('hidden');
	$("#sustanciaFormName" + id).removeAttr('hidden');
	$("#sustanciaFormFile" + id).prop('required', true);
	$("#sustanciaFormDoc" + id).removeAttr('hidden');
	$("#sustanciaFormName" + id + " > select").prop('required', true);
	$("#myform").validator('update');
	attachPopover();
}

function setNoControlada(id) {
	$("#sustanciaFormtype" + id).attr("hidden", true);
	$("#sustanciaFormName" + id).attr("hidden", true);
	$("#sustanciaFormFile" + id).prop('required', false);
	$("#sustanciaFormDoc" + id).attr("hidden", true);
	$("#sustanciaFormName" + id + " > select").prop('required', false);
	$("#myform").validator('update');
}


function AgregarY(id) {
	var ClasifY = `@include('layouts.RespelPartials.layoutsRes.ClasificacionYEdit')`;
	$("#ClasifY" + id).removeClass("btn-default");
	$("#ClasifY" + id).addClass("btn-success");
	$("#ClasifA" + id).removeClass("btn-success");
	$("#ClasifA" + id).addClass("btn-default");
	$("#Clasif" + id).empty();
	$("#Clasif" + id).append(ClasifY);
	$("#myform").validator('update');
	attachPopover();
	Selects();
}

function AgregarA(id) {
	var ClasifA = `@include('layouts.RespelPartials.layoutsRes.ClasificacionAEdit')`;
	$("#ClasifA" + id).removeClass("btn-default");
	$("#ClasifA" + id).addClass("btn-success");
	$("#ClasifY" + id).removeClass("btn-success");
	$("#ClasifY" + id).addClass("btn-default");
	$("#Clasif" + id).empty();
	$("#Clasif" + id).append(ClasifA);
	$("#myform").validator('update');
	attachPopover();
	Selects();
}

function AgregarControlada(id) {
	var ControladaName = `@include('layouts.RespelPartials.layoutsRes.ControladaEditName')`;
	var ControladaDoc = `@include('layouts.RespelPartials.layoutsRes.ControladaEditDoc')`;
	$("#Controlada" + id).removeClass("btn-default");
	$("#Controlada" + id).addClass("btn-success");
	$("#Masivo" + id).removeClass("btn-success");
	$("#Masivo" + id).addClass("btn-default");
	$("#sustanciaFormDoc" + id).empty();
	$("#sustanciaFormDoc" + id).append(ControladaDoc);
	$("#sustanciaFormName" + id).empty();
	$("#sustanciaFormName" + id).append(ControladaName);
	$("#myform").validator('update');
	attachPopover();
	Selects();
}

function AgregarMasivo(id) {
	var MasivoName = `@include('layouts.RespelPartials.layoutsRes.MasivoEditName')`;
	var MasivoDoc = `@include('layouts.RespelPartials.layoutsRes.MasivoEditDoc')`;
	$("#Masivo" + id).removeClass("btn-default");
	$("#Masivo" + id).addClass("btn-success");
	$("#Controlada" + id).removeClass("btn-success");
	$("#Controlada" + id).addClass("btn-default");
	$("#sustanciaFormDoc" + id).empty();
	$("#sustanciaFormDoc" + id).append(MasivoDoc);
	$("#sustanciaFormName" + id).empty();
	$("#sustanciaFormName" + id).append(MasivoName);
	$("#myform").validator('update');
	attachPopover();
	Selects();
}

</script>

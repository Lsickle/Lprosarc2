<div id="Respels">
	<div id="Residuo">
		{{-- <div id="form-step-0" role="form" data-toggle="validator"> --}}
			<div class="col-md-12">
				<hr>
			</div>
			<div class="col-md-6 form-group has-feedback">
				<label>{{ trans('adminlte_lang::message.name') }}</label>
				<input maxlength="128" name="RespelName" type="text" class="form-control" placeholder="Nombre del Residuo" required value="{{$Respels->RespelName}}">
			</div>
			<div class="col-md-6 form-group has-feedback">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' data-delay='{"show": 500}' title="{{ trans('adminlte_lang::LangRespel.respeldescriptittle') }}" data-content="{{ trans('adminlte_lang::LangRespel.respeldescriptinfo') }}">{{ trans('adminlte_lang::LangRespel.descripcion') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
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
			<div id="danger0">
				@if($Respels->RespelIgrosidad !== 'No peligroso')
				<div class="col-md-6 form-group has-feedback" style="max-height: 2em; text-align: center;">
				    <label>Tipo de clasificación</label><br>
				    @if(is_null($Respels->ARespelClasf4741))
				    <a class="btn btn-success" onclick="AgregarY(`+id+`)">Y</a>
				    <a class="btn btn-default" onclick="AgregarA(`+id+`)">A</a>
				    @else
				    <a class="btn btn-default" onclick="AgregarY(`+id+`)">Y</a>
				    <a class="btn btn-success" onclick="AgregarA(`+id+`)">A</a>
				    @endif
				</div>
				<div class="col-md-6 form-group has-feedback" id="Clasif`+id+`">
					@if(is_null($Respels->ARespelClasf4741))
				    	@include('layouts.RespelPartials.layoutsRes.ClasificacionYEdit')
				    @else
				    	@include('layouts.RespelPartials.layoutsRes.ClasificacionAEdit')
				    @endif
				</div>
				@else
				<select name="YRespelClasf4741" hidden="">
					<option value="" selected></option>
				</select>
				<select name="ARespelClasf4741" hidden="">
					<option value="" selected></option>
				</select>
				@endif
			</div>
			{{-- input de la hoja de seguridad --}}
			<div class="col-md-6 form-group has-feedback">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>{{ trans('adminlte_lang::LangRespel.hojadeseguridad') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.hojapopoverinfo') }}">{{ trans('adminlte_lang::LangRespel.hojadeseguridad') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
				<small class="help-block with-errors">*</small>
				@if($Respels->RespelHojaSeguridad!=='RespelHojaDefault.pdf')
				<div class="input-group">
					<input id="hoja0" name="RespelHojaSeguridad" type="file" data-filesize="2048" class="form-control" accept=".pdf">
					<div class="input-group-btn">
						<a method='get' href='/img/HojaSeguridad/{{$Respels->RespelHojaSeguridad}}' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
					</div>
				</div>
				@else
				<div class="input-group">
					<input required id="hoja0" name="RespelHojaSeguridad" type="file" data-filesize="2048" class="form-control" accept=".pdf">
					<div class="input-group-btn">
						<a method='get' target='_blank' class='btn btn-default'><i class='fas fa-ban fa-lg'></i></a>
					</div>
				</div>	
				@endif
			</div>
			{{-- input de la tarjeta de emergencia --}}
			<div class="col-md-6 form-group has-feedback">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.tarjetapopoverinfo') }}">{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
				<small class="help-block with-errors">*</small>
				@if($Respels->RespelTarj!=='RespelTarjetaDefault.pdf')
				<div class="input-group">
					<input id="hoja0" name="RespelTarj" type="file" data-filesize="2048" class="form-control" accept=".pdf">
					<div class="input-group-btn">
						<a method='get' href='/img/TarjetaEmergencia/{{$Respels->RespelTarj}}' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
					</div>
				</div>
				@else
				<div class="input-group">
					<input required id="hoja0" name="RespelTarj" type="file" data-filesize="2048" class="form-control" accept=".pdf">
					<div class="input-group-btn">
						<a method='get' target='_blank' class='btn btn-default'><i class='fas fa-ban fa-lg'></i></a>
					</div>
				</div>	
				@endif
			</div>
			{{-- input de la foto del residuo --}}
			<div class="col-md-6 form-group has-feedback">
				<label style="margin-bottom: 0" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>{{ trans('adminlte_lang::LangRespel.foto') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.fotopopoverinfo') }}">{{ trans('adminlte_lang::LangRespel.fotolabel') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
				<small class="help-block with-errors">*</small>
				<input id="foto0" name="RespelFoto" type="file" class="form-control" accept=".jpg,.png" data-filesize="2048" data-filetype="png">
				<span class="form-control-feedback fa fa-camera" style="margin-right: 1.8em;" aria-hidden="true"><span>
				@if($Respels->RespelTarj!=='RespelTarjetaDefault.pdf')
				<div class="input-group">
					<input id="foto0" name="RespelFoto" type="file" class="form-control" accept=".jpg,.png" data-filesize="2048" data-filetype="png">
					<span class="form-control-feedback fa fa-camera" style="margin-right: 1.8em;" aria-hidden="true"><span>
					<div class="input-group-btn">
						<a method='get' href='/img/fotoRespelCreate/{{$Respels->RespelFoto}}' target='_blank' class='btn btn-success'><i class='fas fa-image fa-lg'></i></a>
					</div>
				</div>
				@else
				<div class="input-group">
					<input id="foto0" name="RespelFoto" type="file" class="form-control" accept=".jpg,.png" data-filesize="2048" data-filetype="png">
					<span class="form-control-feedback fa fa-camera" style="margin-right: 1.8em;" aria-hidden="true"><span>
					<div class="input-group-btn">
						<a method='get' target='_blank' class='btn btn-default'><i class='fas fa-ban fa-lg'></i></a>
					</div>
				</div>	
				@endif
			</div>
			<div class="col-md-6 form-group has-feedback">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::LangRespel.resolucion1tittle') }}" data-content="{{ trans('adminlte_lang::LangRespel.resolucion1descrip') }}">{{ trans('adminlte_lang::LangRespel.controlx') }}
					<a href="{{route('ClasificacionA')}}" target="_blank">{{ trans('adminlte_lang::LangRespel.resolucion1') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></a>
				</label>
				<select id="selectControl0" name="SustanciaControlada" class="form-control" required>
					<option value="">{{ trans('adminlte_lang::LangRespel.select') }}</option>
					<option value="0" onclick="setNoControlada(0)" {{ ($Respels->SustanciaControlada === 0 ? 'selected' : '') }}>{{ trans('adminlte_lang::LangRespel.no') }}</option>
					<option value="1" onclick="setControlada(0)" {{ ($Respels->SustanciaControlada === 1 ? 'selected' : '') }}>{{ trans('adminlte_lang::LangRespel.yes') }}</option>
				</select>
			</div>
			<div id="SustanciaControlada0">
				@if(!is_null($Respels->SustanciaControladaNombre))
					<div class="col-md-6 form-group has-feedback" id="sustanciaFormtype`+id+`" style="text-align: center;">
					    <label style="margin-bottom: 0">Tipo de sustancia</label><br>
					    @if($Respels->SustanciaControladaTipo == 0)
					    <a class="btn btn-success" {{-- style="padding-top: 0; padding-bottom: 0;" --}} id="Controlada`+id+`" onclick="AgregarControlada(`+id+`)"> Controlada</a>
					    <a class="btn btn-default" {{-- style="padding-top: 0; padding-bottom: 0;" --}} id="Masivo`+id+`" onclick="AgregarMasivo(`+id+`)">Uso masivo</a>
					    @else
					    <a class="btn btn-default" {{-- style="padding-top: 0; padding-bottom: 0;" --}} id="Controlada`+id+`" onclick="AgregarControlada(`+id+`)"> Controlada</a>
					    <a class="btn btn-success" {{-- style="padding-top: 0; padding-bottom: 0;" --}} id="Masivo`+id+`" onclick="AgregarMasivo(`+id+`)">Uso masivo</a>
					    @endif
					</div>
					@if($Respels->SustanciaControladaTipo == 0)
						<div class="col-md-6 form-group has-feedback" id="sustanciaFormName`+id+`">
						    @include('layouts.RespelPartials.layoutsRes.ControladaEditName')
						</div>
						<div class="col-md-6 form-group has-feedback" id="sustanciaFormDoc`+id+`">
						    @include('layouts.RespelPartials.layoutsRes.ControladaEditDoc')
						</div>
					@else
						<div class="col-md-6 form-group has-feedback" id="sustanciaFormName`+id+`">
						    @include('layouts.RespelPartials.layoutsRes.MasivoEditName')
						</div>
						<div class="col-md-6 form-group has-feedback" id="sustanciaFormDoc`+id+`">
						    @include('layouts.RespelPartials.layoutsRes.MasivoEditDoc')
						</div>
					@endif
				@else
					<input type="text" hidden="" style="display:none" name="SustanciaControladaTipo" value="">
					<input type="text" hidden="" style="display:none" name="SustanciaControladaNombre" value="">
					<input type="file" hidden="" style="display:none" name="SustanciaControladaDocumento">
				@endif
			</div>
			<div class="col-md-6 form-group has-feedback">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::LangRespel.aceptaciontittlepopover') }}" data-content="{{ trans('adminlte_lang::LangRespel.aceptacioninfopopover') }}">{{ trans('adminlte_lang::LangRespel.aceptacionlabel') }}
					<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
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

function attachPopover() {
	$('[data-toggle="popover"]').popover({
		html: true,
		trigger: 'hover',
		placement: 'auto',
	});
}
function setDanger(id) {
	var ifDangerRespeledit = `@include('layouts.RespelPartials.layoutsRes.ifDangerRespeledit')`;
	$("#danger" + id).empty();
	$("#danger" + id).append(ifDangerRespeledit);
	$("#hoja" + id).prop('required', true);
	$("#myform").validator('update');
	attachPopover();
}

function setNoDanger(id) {
	var ifNotDangerRespel = `@include('layouts.RespelPartials.layoutsRes.ifNotDangerRespel')`;
	$("#danger" + id).empty();
	$("#danger" + id).append(ifNotDangerRespel);
	$("#hoja" + id).prop('required', false)
	$("#myform").validator('update');
}

function setControlada(id) {
	var ifControladaRespel = `@include('layouts.RespelPartials.layoutsRes.ifControladaRespeledit')`;
	$("#SustanciaControlada" + id).empty();
	$("#SustanciaControlada" + id).append(ifControladaRespel);
	$("#myform").validator('update');
	attachPopover();
}

function setNoControlada(id) {
	var ifNotControladaRespel = `@include('layouts.RespelPartials.layoutsRes.ifNotControladaRespel')`;
	$("#SustanciaControlada" + id).empty();
	$("#SustanciaControlada" + id).append(ifNotControladaRespel);
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
}

</script>

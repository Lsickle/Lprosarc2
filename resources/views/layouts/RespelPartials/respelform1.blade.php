<div id="Respels">
	<div id="Residuo">
		{{-- <div class="col-md-12">
			<hr>
		</div> --}}
		<div class="col-md-6 form-group has-feedback">
			<label>{{ trans('adminlte_lang::message.name') }}</label>
			<small class="help-block with-errors">*</small>
			<input maxlength="128" name="RespelName[]" type="text" class="form-control" placeholder="Nombre del Residuo" required value="{{ old('RespelName.0') }}">
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' data-delay='{"show": 500}' title="{{ trans('adminlte_lang::LangRespel.respeldescriptittle') }}" data-content="{{ trans('adminlte_lang::LangRespel.respeldescriptinfo') }}">{{ trans('adminlte_lang::LangRespel.descripcion') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
			<small class="help-block with-errors">*</small>
			<input required maxlength="512" name="RespelDescrip[]" type="text" class="form-control" placeholder="Descripcion del Residuo" value="{{ old('RespelDescrip.0') }}">
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label>{{ trans('adminlte_lang::LangRespel.estadofisico') }}</label><small class="help-block with-errors">*</small>
			<select name="RespelEstado[]" class="form-control" required>
				<option value="">{{ trans('adminlte_lang::LangRespel.select') }}</option>
				<option {{ (old('RespelEstado.0') === trans('adminlte_lang::LangRespel.estadofisico1') ? "selected" : "" )}} value="{{ trans('adminlte_lang::LangRespel.estadofisico1') }}">{{ trans('adminlte_lang::LangRespel.estadofisico1') }}</option>
				<option {{ (old('RespelEstado.0') === trans('adminlte_lang::LangRespel.estadofisico2') ? "selected" : "" )}} value="{{ trans('adminlte_lang::LangRespel.estadofisico2') }}">{{ trans('adminlte_lang::LangRespel.estadofisico2') }}</option>
				<option {{ (old('RespelEstado.0') === trans('adminlte_lang::LangRespel.estadofisico3') ? "selected" : "" )}} value="{{ trans('adminlte_lang::LangRespel.estadofisico3') }}">{{ trans('adminlte_lang::LangRespel.estadofisico3') }}</option>
				<option {{ (old('RespelEstado.0') === trans('adminlte_lang::LangRespel.estadofisico4') ? "selected" : "" )}} value="{{ trans('adminlte_lang::LangRespel.estadofisico4') }}">{{ trans('adminlte_lang::LangRespel.estadofisico4') }}</option>
			</select>
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label>{{ trans('adminlte_lang::LangRespel.danger') }}</label>
			<small class="help-block with-errors">*</small>
			<select id="selectDanger0" name="RespelIgrosidad[]" class="form-control" required>
				<option value="">{{ trans('adminlte_lang::LangRespel.select')}}</option>

				<option value ="{{ trans('adminlte_lang::LangRespel.danger1')}}" {{ (old('RespelIgrosidad.0') === 'No peligroso' ? 'selected' : '' )}} onclick="setNoDanger(0)">
					{{ trans('adminlte_lang::LangRespel.danger1') }}
				</option>

				<option value = "{{ trans('adminlte_lang::LangRespel.danger2')}}" {{ (old('RespelIgrosidad.0') === trans('adminlte_lang::LangRespel.danger2') ? 'selected' : '') }} onclick="setDanger(0)">
					{{ trans('adminlte_lang::LangRespel.danger2') }}
				</option>

				<option value = "{{ trans('adminlte_lang::LangRespel.danger3')}}" {{ (old('RespelIgrosidad.0') === trans('adminlte_lang::LangRespel.danger3') ? 'selected' : '') }} onclick="setDanger(0)">
					{{ trans('adminlte_lang::LangRespel.danger3') }}
				</option>

				<option value = "{{ trans('adminlte_lang::LangRespel.danger4')}}" {{ (old('RespelIgrosidad.0') === trans('adminlte_lang::LangRespel.danger4') ? 'selected' : '') }} onclick="setDanger(0)">
					{{ trans('adminlte_lang::LangRespel.danger4') }}
				</option>

				<option value = "{{ trans('adminlte_lang::LangRespel.danger5')}}" {{ (old('RespelIgrosidad.0') === trans('adminlte_lang::LangRespel.danger5') ? 'selected' : '') }} onclick="setDanger(0)">
					{{ trans('adminlte_lang::LangRespel.danger5') }}
				</option>

				<option value = "{{ trans('adminlte_lang::LangRespel.danger6')}}" {{ (old('RespelIgrosidad.0') === trans('adminlte_lang::LangRespel.danger5') ? 'selected' : '') }} onclick="setDanger(0)">
					{{ trans('adminlte_lang::LangRespel.danger6') }}
				</option>

				<option value = "{{ trans('adminlte_lang::LangRespel.danger7')}}" {{ (old('RespelIgrosidad.0') === trans('adminlte_lang::LangRespel.danger7') ? 'selected' : '') }} onclick="setDanger(0)">
					{{ trans('adminlte_lang::LangRespel.danger7') }}
				</option>

				<option value = "{{ trans('adminlte_lang::LangRespel.danger8')}}" {{ (old('RespelIgrosidad.0') === trans('adminlte_lang::LangRespel.danger8') ? 'selected' : '') }} onclick="setDanger(0)">
					{{ trans('adminlte_lang::LangRespel.danger8') }}
				</option>

			</select>
		</div>
		<div id="danger0">
			<div hidden="true">
				<select name="YRespelClasf4741[]">
					<option value="" selected></option>
				</select>
			</div>
			<div hidden="true">
				<select name="ARespelClasf4741[]">
					<option value="" selected></option>
				</select>
			</div>
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>{{ trans('adminlte_lang::LangRespel.hojadeseguridad') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.hojapopoverinfo') }}">{{ trans('adminlte_lang::LangRespel.hojadeseguridad') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
			<small class="help-block with-errors">*</small>
			<input id="hoja0" name="RespelHojaSeguridad[]" type="file" data-validate="true" required data-filesize="2048" class="form-control" data-accept="pdf" accept=".pdf">
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.tarjetapopoverinfo') }}">{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
			<small class="help-block with-errors"></small>
			<input name="RespelTarj[]" type="file" data-filesize="2048" class="form-control" data-accept="pdf" accept=".pdf">
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label style="margin-bottom: 0" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>{{ trans('adminlte_lang::LangRespel.foto') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.fotopopoverinfo') }}">{{ trans('adminlte_lang::LangRespel.fotolabel') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
			<small class="help-block with-errors"></small>
			<input id="foto0" name="RespelFoto[]" type="file" class="form-control" data-accept="jpg, jpeg, png" accept=".jpg,.jpeg,.png" data-filesize="2048" value="{{ old('RespelFoto.0') }}">
			<span class="form-control-feedback fa fa-camera" style="margin-right: 1.8em;" aria-hidden="true"><span>
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::LangRespel.resolucion1tittle') }}" data-content="{{ trans('adminlte_lang::LangRespel.resolucion1descrip') }}">{{ trans('adminlte_lang::LangRespel.controlx') }}
				<a href="{{ trans('adminlte_lang::LangRespel.resolucion1link') }}" target="_blank">{{ trans('adminlte_lang::LangRespel.resolucion1') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></a>
			</label>
			<small class="help-block with-errors">*</small>
			<select id="selectControl0" name="SustanciaControlada[]" class="form-control" required>
				<option value="">{{ trans('adminlte_lang::LangRespel.select') }}</option>
				<option value="0" onclick="setNoControlada(0)">{{ trans('adminlte_lang::LangRespel.no') }}</option>
				<option value="1" onclick="setControlada(0)">{{ trans('adminlte_lang::LangRespel.yes') }}</option>
			</select>
		</div>
		<div id="SustanciaControlada0">
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::LangRespel.aceptaciontittlepopover') }}" data-content="{{ trans('adminlte_lang::LangRespel.aceptacioninfopopover') }}">{{ trans('adminlte_lang::LangRespel.aceptacionlabel') }}
				<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
			</label>
			<small class="help-block with-errors">*</small>
			<select id="selectDdeclaracion0" name="RespelDeclaracion[]" class="form-control" required>
				<option value="" selected>{{ trans('adminlte_lang::LangRespel.select')}}</option>
				<option value="1">{{ trans('adminlte_lang::LangRespel.yes') }}</option>
			</select>
		</div>
	</div>
</div>
<script type="application/javascript">
var contador = 1;

function attachPopover() {
	$('[data-toggle="popover"]').popover({
		html: true,
		trigger: 'hover',
		placement: 'auto',
	});
}

function setDanger(id) {
	var ifDangerRespel = `@include('layouts.RespelPartials.layoutsRes.ifDangerRespel')`;
	$("#danger" + id).empty();
	$("#danger" + id).append(ifDangerRespel);
	$("#myform").validator('destroy');
	$("#hoja" + id).prop('required', true);
	$("#myform").validator('update');
	attachPopover();
}

function setNoDanger(id) {
	var ifNotDangerRespel = `@include('layouts.RespelPartials.layoutsRes.ifNotDangerRespel')`;
	$("#danger" + id).empty();
	$("#danger" + id).append(ifNotDangerRespel);
	$("#hoja" + id).prop('required', false)
	$("#myform").validator('destroy');
	$("#myform").validator('update');
}

function setControlada(id) {
	var ifControladaRespel = `@include('layouts.RespelPartials.layoutsRes.ifControladaRespel')`;
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


function AgregarRes() {
	var Residuo = `@include('layouts.RespelPartials.layoutsRes.CreateResiduos')`;
	$("#Respels").append(Residuo);
	// $("#Clasif" + contador).append(ClasifY);
	$("#myform").validator('update');
	contador = parseInt(contador) + 1;
	attachPopover();
}

function AgregarY(id) {
	var ClasifY = `@include('layouts.RespelPartials.layoutsRes.ClasificacionYCreate')`;
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
	var ClasifA = `@include('layouts.RespelPartials.layoutsRes.ClasificacionACreate')`;
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
	var ControladaName = `@include('layouts.RespelPartials.layoutsRes.ControladaCreateName')`;
	var ControladaDoc = `@include('layouts.RespelPartials.layoutsRes.ControladaCreateDoc')`;
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
	var MasivoName = `@include('layouts.RespelPartials.layoutsRes.MasivoCreateName')`;
	var MasivoDoc = `@include('layouts.RespelPartials.layoutsRes.MasivoCreateDoc')`;
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

function EliminarRes(id) {
	$("#Residuo" + id).remove();
	$("#myform").validator('update');
}

</script>

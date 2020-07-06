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
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' data-delay='{"show": 500}' title="{{ trans('adminlte_lang::LangRespel.respeldescriptittle') }}" data-content="{{ trans('adminlte_lang::LangRespel.respeldescriptinfo') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::LangRespel.descripcion') }}</label>
			<small class="help-block with-errors">*</small>
			<input required maxlength="512" name="RespelDescrip[]" type="text" class="form-control" placeholder="Descripcion del Residuo" value="{{ old('RespelDescrip.0') }}">
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label>{{ trans('adminlte_lang::LangRespel.estadofisico') }}</label><small class="help-block with-errors">*</small>
			<select name="RespelEstado[]" class="form-control" required>
				<option value="">{{ trans('adminlte_lang::LangRespel.select') }}</option>
				<option value="{{ trans('adminlte_lang::LangRespel.estadofisico1') }}">{{ trans('adminlte_lang::LangRespel.estadofisico1') }}</option>
				<option value="{{ trans('adminlte_lang::LangRespel.estadofisico2') }}">{{ trans('adminlte_lang::LangRespel.estadofisico2') }}</option>
				<option value="{{ trans('adminlte_lang::LangRespel.estadofisico3') }}">{{ trans('adminlte_lang::LangRespel.estadofisico3') }}</option>
				<option value="{{ trans('adminlte_lang::LangRespel.estadofisico4') }}">{{ trans('adminlte_lang::LangRespel.estadofisico4') }}</option>
			</select>
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label>{{ trans('adminlte_lang::LangRespel.danger') }}</label>
			<small class="help-block with-errors">*</small>
			<select id="selectDanger0" name="RespelIgrosidad[]" class="form-control" required>
				<option value="">{{ trans('adminlte_lang::LangRespel.select')}}</option>

				<option value ="{{ trans('adminlte_lang::LangRespel.danger1')}}" onclick="setNoDanger(0)">
					{{ trans('adminlte_lang::LangRespel.danger1') }}
				</option>

				<option value = "{{ trans('adminlte_lang::LangRespel.danger2')}}" onclick="setDanger(0)">
					{{ trans('adminlte_lang::LangRespel.danger2') }}
				</option>

				<option value = "{{ trans('adminlte_lang::LangRespel.danger3')}}" onclick="setDanger(0)">
					{{ trans('adminlte_lang::LangRespel.danger3') }}
				</option>

				<option value = "{{ trans('adminlte_lang::LangRespel.danger4')}}" onclick="setDanger(0)">
					{{ trans('adminlte_lang::LangRespel.danger4') }}
				</option>

				<option value = "{{ trans('adminlte_lang::LangRespel.danger5')}}" onclick="setDanger(0)">
					{{ trans('adminlte_lang::LangRespel.danger5') }}
				</option>

				<option value = "{{ trans('adminlte_lang::LangRespel.danger6')}}" onclick="setDanger(0)">
					{{ trans('adminlte_lang::LangRespel.danger6') }}
				</option>

				<option value = "{{ trans('adminlte_lang::LangRespel.danger7')}}" onclick="setDanger(0)">
					{{ trans('adminlte_lang::LangRespel.danger7') }}
				</option>

				<option value = "{{ trans('adminlte_lang::LangRespel.danger8')}}" onclick="setDanger(0)">
					{{ trans('adminlte_lang::LangRespel.danger8') }}
				</option>

			</select>
		</div>
		<div class="col-md-6 form-group has-feedback" style="max-height: 2em; text-align: center;" id="danger0" hidden="">
			<label>Tipo de clasificación</label><br>
			<a class="btn btn-success"  id="ClasifY0" onclick="AgregarY(0)">Y</a>
			<a class="btn btn-default"  id="ClasifA0" onclick="AgregarA(0)">A</a>
		</div>
		<div class="col-md-6 form-group has-feedback" id="Clasif0" hidden="">
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>{{ trans('adminlte_lang::LangRespel.hojadeseguridad') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.hojapopoverinfo') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::LangRespel.hojadeseguridad') }}</label>
			<small class="help-block with-errors">*</small>
			<input id="hoja0" name="RespelHojaSeguridad[]" type="file" data-validate="true" required data-filesize="10240" class="form-control" data-accept="pdf" accept=".pdf">
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.tarjetapopoverinfo') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}</label>
			<small class="help-block with-errors"></small>
			<input name="RespelTarj[]" type="file" data-filesize="5120" class="form-control" data-accept="pdf" accept=".pdf">
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label style="margin-bottom: 3px;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>{{ trans('adminlte_lang::LangRespel.foto') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.fotopopoverinfo') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::LangRespel.fotolabel') }}</label>
			<small class="help-block with-errors"></small>
			<input id="foto0" name="RespelFoto[]" type="file" class="form-control" data-accept="jpg, jpeg, png" accept=".jpg,.jpeg,.png" data-filesize="5120" value="{{ old('RespelFoto.0') }}">
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
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>tratamiento<b>" data-content="Elija el tratamiento para su residuo según lo que se acordó con el representante comercial de PROSARC S.A. ESP">
				<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Tratamiento
			</label>
			<small class="help-block with-errors">*</small>
			<select id="selectTratamiento" name="RespelTratamiento" class="form-control" required>
				<option value="">Seleccione un Tratamiento</option>
				@foreach ($tratamientos as $tratamiento)
					<option value="{{$tratamiento->ID_Trat}}">{{$tratamiento->TratName }}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>{{ trans('adminlte_lang::LangRespel.aceptaciontittlepopover') }}<b>" data-content="{{ trans('adminlte_lang::LangRespel.aceptacioninfopopover') }}">
				<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::LangRespel.aceptacionlabel') }}
			</label>
			<small class="help-block with-errors">*</small>
			<select id="selectDdeclaracion0" name="RespelDeclaracion[]" class="form-control" required>
				<option value="" selected>{{ trans('adminlte_lang::LangRespel.select')}}</option>
				<option value="1">{{ trans('adminlte_lang::LangRespel.yes') }}</option>
			</select>
		</div>
		<div id="NodangerNoclasf0">
		</div>
		<div id="Nocontrol0">
		</div>
	</div>
</div>
@section('NewScript')
<script type="application/javascript">
var contador = 1;
$(document).ready(function(){
	$("#myform").validator('destroy');
	$("#myform").validator('update');
})
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
	$("#NodangerNoclasf" + id).empty();
	$("#myform").validator('update');
	attachPopover();
}

function setNoDanger(id) {
	$("#danger" + id).attr("hidden", true);
	$("#Clasif" + id).attr("hidden", true);
	$("#Clasif" + id+" > select").prop('required', false);
	$("#hoja" + id).prop('required', false);
	$("#NodangerNoclasf" + id).append('<input hidden type="text" name="YRespelClasf4741[]" value=""><input hidden type="text" name="ARespelClasf4741[]" value="">');
	$("#myform").validator('destroy');
	$("#myform").validator('update');
}

function setControlada(id) {
	AgregarControlada(id);
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
	/*se habilitan los campos correspondientes*/
	$("#sustanciaFormtype" + id).removeAttr('hidden');
	$("#sustanciaFormName" + id).removeAttr('hidden');
	$("#sustanciaFormFile" + id).prop('required', true);
	$("#sustanciaFormDoc" + id).removeAttr('hidden');
	$("#sustanciaFormName" + id + " > select").prop('required', true);
	$("#Nocontrol" + id).empty();
	$("#myform").validator('update');
	attachPopover();
}

function setNoControlada(id) {
	$("#sustanciaFormtype" + id).attr("hidden", true);
	$("#sustanciaFormName" + id).attr("hidden", true);
	$("#sustanciaFormFile" + id).prop('required', false);
	$("#sustanciaFormDoc" + id).attr("hidden", true);
	$("#sustanciaFormName" + id + " > select").prop('required', false);
	$("#sustanciaFormDoc" + id).empty();
	$("#sustanciaFormName" + id).empty();
	$("#Nocontrol" + id).append('<input hidden type="text" name="SustanciaControladaTipo[]" value=""><input hidden type="text" name="SustanciaControladaNombre[]" value=""><input style="display:none;" type="file" name="SustanciaControladaDocumento[]">');
	$("#myform").validator('update');
}


function AgregarRes() {
	AgregarY(contador);
	AgregarControlada(contador);
	var Residuo = `@include('layouts.RespelPartials.layoutsRes.CreateResiduos')`;
	$("#Respels").append(Residuo);
	// $("#Clasif" + contador).append(ClasifY);
	$("#myform").validator('update');
	contador = parseInt(contador) + 1;
	attachPopover();
	Selects();
	ChangeSelect();
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
	Selects();
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
	Selects();
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
	Selects();
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
	Selects();
}

function EliminarRes(id) {
	$("#Residuo" + id).remove();
	$("#myform").validator('update');
}

</script>
@endsection


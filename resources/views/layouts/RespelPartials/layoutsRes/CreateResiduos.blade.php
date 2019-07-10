<div id="Residuo`+contador+`">
	<div class="col-md-12">
		<hr style="height:3px; border:none; color:rgb(60,90,180); background-color:rgb(60,90,180);">
	</div>
	<div class="col-md-12">
		<label class="btn-box-tool" onclick="EliminarRes(`+contador+`)" style="float: right; color: red; margin-top: 0; font-size: 1.3em;">
			<i class="fas fa-trash-alt"></i>
		</label>
	</div>
	<div class="col-md-6 form-group has-feedback">
		<label>{{ trans('adminlte_lang::message.name') }}</label>
		<small class="help-block with-errors">*</small>
		<input maxlength="128" name="RespelName[]" type="text" class="form-control" placeholder="Nombre del Residuo" required value="">
	</div>
	<div class="col-md-6 form-group has-feedback">
		<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::LangRespel.respeldescriptittle') }}" data-content="{{ trans('adminlte_lang::LangRespel.respeldescriptinfo') }}">{{ trans('adminlte_lang::LangRespel.descripcion') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
		<small class="help-block with-errors">*</small>
		<input required maxlength="512" name="RespelDescrip[]" type="text" class="form-control" placeholder="Descripcion del Residuo">
	</div>
	<div class="col-md-6 form-group has-feedback">
		<label>{{ trans('adminlte_lang::LangRespel.estadofisico') }}</label>
		<small class="help-block with-errors">*</small>
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
		<select id="selectDanger`+contador+`" name="RespelIgrosidad[]" class="form-control" required>
			<option value="">{{ trans('adminlte_lang::LangRespel.select') }}</option>
			<option onclick="setNoDanger(`+contador+`)">{{ trans('adminlte_lang::LangRespel.danger1') }}</option>
			<option onclick="setDanger(`+contador+`)">{{ trans('adminlte_lang::LangRespel.danger2') }}</option>
			<option onclick="setDanger(`+contador+`)">{{ trans('adminlte_lang::LangRespel.danger3') }}</option>
			<option onclick="setDanger(`+contador+`)">{{ trans('adminlte_lang::LangRespel.danger4') }}</option>
			<option onclick="setDanger(`+contador+`)">{{ trans('adminlte_lang::LangRespel.danger5') }}</option>
			<option onclick="setDanger(`+contador+`)">{{ trans('adminlte_lang::LangRespel.danger6') }}</option>
			<option onclick="setDanger(`+contador+`)">{{ trans('adminlte_lang::LangRespel.danger7') }}</option>
			<option onclick="setDanger(`+contador+`)">{{ trans('adminlte_lang::LangRespel.danger8') }}</option>
		</select>
	</div>
	<div class="col-md-6 form-group has-feedback" style="max-height: 2em; text-align: center;" id="danger`+contador+`" hidden="">
		<label>Tipo de clasificación</label><br>
		<a class="btn btn-success"  id="ClasifY`+contador+`" onclick="AgregarY(`+contador+`)">Y</a>
		<a class="btn btn-default"  id="ClasifA`+contador+`" onclick="AgregarA(`+contador+`)">A</a>
	</div>
	<div class="col-md-6 form-group has-feedback" id="Clasif`+contador+`" hidden="">
	</div>
	<div class="col-md-6 form-group has-feedback">
		<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>{{ trans('adminlte_lang::LangRespel.hojadeseguridad') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.hojapopoverinfo') }}">{{ trans('adminlte_lang::LangRespel.hojadeseguridad') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
		<small class="help-block with-errors">*</small>
		<input required id="hoja`+contador+`" name="RespelHojaSeguridad[]" type="file" data-filesize="2048" class="form-control" accept=".pdf">
	</div>
	<div class="col-md-6 form-group has-feedback">
		<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.tarjetapopoverinfo') }}">{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
		<input id="tarj`+contador+`" name="RespelTarj[]" type="file" data-filesize="2048" class="form-control" accept=".pdf">
	</div>
	<div class="col-md-6 form-group has-feedback">
		<label style="margin-bottom: 3px;" class="control-label" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>{{ trans('adminlte_lang::LangRespel.foto') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.fotopopoverinfo') }}">{{ trans('adminlte_lang::LangRespel.fotolabel') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
		<small class="help-block with-errors"></small>
		<input id="foto`+contador+`" name="RespelFoto[]" type="file" class="form-control" accept=".jpg,.png" data-filesize="2048" data-filetype="png">
		<span class="form-control-feedback fa fa-camera" style="margin-right: 1.8em;" aria-hidden="true"><span>
		{{-- <span class="far fa-building fa-fw form-control-feedback fa-pull-left" style="margin-right: 1.8em;" aria-hidden="true"></span> --}}
	</div>
	<div class="col-md-6 form-group has-feedback">
		<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::LangRespel.resolucion1tittle') }}" data-content="{{ trans('adminlte_lang::LangRespel.resolucion1descrip') }}">{{ trans('adminlte_lang::LangRespel.controlx') }}
					<a href="{{ trans('adminlte_lang::LangRespel.resolucion1link') }}" target="_blank">{{ trans('adminlte_lang::LangRespel.resolucion1') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></a>
				</label>
				<small class="help-block with-errors">*</small>
		<select id="selectControl`+contador+`" name="SustanciaControlada[]" class="form-control" required>
			<option value="">{{ trans('adminlte_lang::LangRespel.select') }}</option>
			<option value="0" onclick="setNoControlada(`+contador+`)">{{ trans('adminlte_lang::LangRespel.no') }}</option>
			<option value="1" onclick="setControlada(`+contador+`)">{{ trans('adminlte_lang::LangRespel.yes') }}</option>
		</select>
	</div>
	<div class="col-md-6 form-group has-feedback" id="sustanciaFormtype`+contador+`" style="text-align: center;" hidden="">
		<label style="margin-bottom: 0">Tipo de sustancia</label><br>
		<a class="btn btn-success" id="Controlada`+contador+`" onclick="AgregarControlada(`+contador+`)"> Controlada</a>
		<a class="btn btn-default" id="Masivo`+contador+`" onclick="AgregarMasivo(`+contador+`)">Uso masivo</a>
	</div>
	<div class="col-md-6 form-group has-feedback" id="sustanciaFormName`+contador+`" hidden="">
	</div>
	<div class="col-md-6 form-group has-feedback" id="sustanciaFormDoc`+contador+`" hidden="">
	</div>
	<div class="col-md-6 form-group has-feedback">
		<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::LangRespel.aceptaciontittlepopover') }}" data-content="{{ trans('adminlte_lang::LangRespel.aceptacioninfopopover') }}">{{ trans('adminlte_lang::LangRespel.aceptacionlabel') }}
			<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
		</label>
		<small class="help-block with-errors">*</small>
		<select id="selectDdeclaracion`+contador+`" name="RespelDeclaracion[]" class="form-control" required>
			<option value="" selected>{{ trans('adminlte_lang::LangRespel.select')}}</option>
			<option value="1">{{ trans('adminlte_lang::LangRespel.yes') }}</option>
		</select>
	</div>
	
	
	
</div>

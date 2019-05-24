<div id="Residuo`+contador+`">
	<div class="col-md-12">
		<hr style="height:3px; border:none; color:rgb(60,90,180); background-color:rgb(60,90,180);">
	</div>
	<div class="col-md-12">
		<label onclick="EliminarRes(`+contador+`)" style="float: right; color: red; margin-top: 0; font-size: 1.5em;">
			<i class="fas fa-trash-alt"></i>
		</label>
	</div>
	<div class="col-md-6 form-group">
		<label>{{ trans('adminlte_lang::message.name') }}</label>
		<input maxlength="128" name="RespelName[]" type="text" class="form-control" placeholder="Nombre del Residuo" required value="{{ old('RespelName')}}">
	</div>
	<div class="col-md-6 form-group">
		<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="{{ trans('adminlte_lang::LangRespel.respeldescriptittle') }}" data-content="{{ trans('adminlte_lang::LangRespel.respeldescriptinfo') }}">{{ trans('adminlte_lang::LangRespel.descripcion') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
		<input maxlength="512" name="RespelDescrip[]" type="text" class="form-control" placeholder="Descripcion del Residuo">
	</div>
	<div class="col-md-6 form-group">
		<label>{{ trans('adminlte_lang::LangRespel.danger') }}</label>
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
	<div class="col-md-6 form-group">
		<label>{{ trans('adminlte_lang::LangRespel.estadofisico') }}</label>
		<select name="RespelEstado[]" class="form-control" required>
			<option value="">{{ trans('adminlte_lang::LangRespel.select') }}</option>
			<option value="{{ trans('adminlte_lang::LangRespel.estadofisico1') }}">{{ trans('adminlte_lang::LangRespel.estadofisico1') }}</option>
			<option value="{{ trans('adminlte_lang::LangRespel.estadofisico2') }}">{{ trans('adminlte_lang::LangRespel.estadofisico2') }}</option>
			<option value="{{ trans('adminlte_lang::LangRespel.estadofisico3') }}">{{ trans('adminlte_lang::LangRespel.estadofisico3') }}</option>
			<option value="{{ trans('adminlte_lang::LangRespel.estadofisico4') }}">{{ trans('adminlte_lang::LangRespel.estadofisico4') }}</option>
		</select>
	</div>
	<div id="danger`+contador+`">
	</div>
	<div class="col-md-6 form-group">
		<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::LangRespel.hojadeseguridad') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.hojapopoverinfo') }}">{{ trans('adminlte_lang::LangRespel.hojadeseguridad') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
		<input required id="hoja`+contador+`" name="RespelHojaSeguridad[]" type="file" class="form-control" accept=".pdf">
	</div>
	<div class="col-md-6 form-group">
		<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.tarjetapopoverinfo') }}">{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
		<input name="RespelTarj[]" type="file" class="form-control" accept=".pdf">
	</div>
	<div id="SustanciaControlada`+contador+`">
	</div>
	<div class="col-md-6 form-group">
		<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="{{ trans('adminlte_lang::LangRespel.resolucion1tittle') }}" data-content="{{ trans('adminlte_lang::LangRespel.resolucion1descrip') }}">{{ trans('adminlte_lang::LangRespel.controlx') }}
					<a href="{{route('ClasificacionA')}}" target="_blank">{{ trans('adminlte_lang::LangRespel.resolucion1') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></a>
				</label>
		<select id="selectControl`+contador+`" name="SustanciaControlada[]" class="form-control" required>
			<option onclick="setNoControlada(`+contador+`)">{{ trans('adminlte_lang::LangRespel.no') }}</option>
			<option onclick="setControlada(`+contador+`)">{{ trans('adminlte_lang::LangRespel.yes') }}</option>
		</select>
	</div>
	<div class="col-md-6 form-group">
		<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::LangRespel.foto') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.fotopopoverinfo') }}">{{ trans('adminlte_lang::LangRespel.fotolabel') }}<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
		<input id="foto`+contador+`" name="RespelFoto[]" type="file" class="form-control" accept=".jpg,.png" data-max-size="2048" >
	</div>
	
</div>

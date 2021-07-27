<div class="box-tools col-md-12">
	<button type="button" class="btn btn-box-tool boton pull-right" style="color: red; font-size: 1.3em;" onclick="RemoveGenerador(`+contadorGenerador+`)" title="Eliminar"><i class="fa fa-times"></i></button>
</div>
<div id="Generador`+contadorGenerador+`" class="box box-success col-md-12">
	<div class="form-group col-md-16">
		<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserselectgener') }}</b>" data-content="{{ trans('adminlte_lang::message.solserselectgenerdescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solserselectgener') }}</label>
		<small class="help-block with-errors">*</small>
		<button type="button" class="btn btn-box-tool boton" style="color: #00a65a;" data-toggle="collapse" data-target=".Respel`+contadorGenerador+`" onclick="AnimationMenusForm('.Respel`+contadorGenerador+`')" title="Reducir/Ampliar"> <i class="fa fa-plus"></i></button>
		<select name="SGenerador[`+contadorGenerador+`]" id="SGenerador" class="form-control" required>
			<option onclick="HiddenResiduosGener(`+contadorGenerador+`)" value="">{{ trans('adminlte_lang::message.select') }}</option>
		</select>
		<br>
	</div>
	<div id="DivRepel`+contadorGenerador+`" class="form-group col-md-16">
	</div>
</div>

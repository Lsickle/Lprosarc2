<div class="col-md-6" id="pretratname`+contador+`">
	<label for="input[]">{{ trans('adminlte_lang::LangTratamiento.pretratname') }} `+contador+`</label>
	<div class="input-group">
		<input id="input[]" class="form-control" type="text" name="PreTratName[]">
		<span onclick="EliminarPreTrat(`+contador+`)" class="input-group-addon" style=" color: red;"><i class="fas fa-backspace"></i></span>
	</div>
</div>

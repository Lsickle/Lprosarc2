{{-- ingreso de inputs para el pretratamiento --}}
<hr class="col-md-10 col-md-offset-1 align-self-center"  id="pretratsparator`+contador+`" />
<div class="col-md-6" id="pretratname`+contador+`">
	<label for="input[]">{{ trans('adminlte_lang::LangTratamiento.pretratname') }} </label>
	<div class="input-group">
		<input id="input[]" class="form-control" type="text" name="PreTratName[]">
		<a onclick="EliminarPreTrat(`+contador+`)" class="input-group-addon" style=" color: red;" data-toggle="popover" title="{{ trans('adminlte_lang::LangTratamiento.pretratname') }}" data-content="{{ trans('adminlte_lang::LangTratamiento.popoverdescript1') }}"><i class="fas fa-backspace"></i></a>
	</div><br>		
</div>

<div class="col-md-6" id="pretratdescription`+contador+`">
	<label for="inputdescript[]">{{ trans('adminlte_lang::LangTratamiento.pretratdescript') }} </label>
	<div class="input-group">
		<input id="inputdescript[]" class="form-control" type="text" name="PreTratDescription[]">
		<a href="#" class="input-group-addon" data-toggle="popover" title="{{ trans('adminlte_lang::LangTratamiento.popovertittle2') }}" data-content="<p style='width: 50%'>{{ trans('adminlte_lang::LangTratamiento.popoverdescript2') }}</p>"><i class="fas fa-info-circle"></i></a>
	</div>
</div>
{{-- fin de ingreso de inputs para el pretratamiento --}}
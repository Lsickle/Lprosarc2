{{-- ingreso de inputs para el pretratamiento --}}
<div id="pretratamiento`+contador+`Container">
	{{-- <hr class="col-md-10 col-md-offset-1 align-self-center"  id="pretratsparator`+contador+`" /> --}}
	<div class="col-md-12">
	    <label for="pretratamiento`+contador+`">Pretratamiento</label>
	    <select multiple="multiple" class="form-control" id="pretratamiento`+contador+`" name="FK_ReqTrata[]">
	        <option disabled="true">primero elija un tratamiento...</option>
	    </select>
	</div>
{{-- 	<div class="col-md-6" id="pretratdescription`+contador+`">
		<label for="inputdescript[]">{{ trans('adminlte_lang::LangTratamiento.pretratdescript') }} </label>
		<div class="input-group">
			<input maxlength="250" id="inputdescript[]" class="form-control" type="text" name="PreTratDescription[]">
			<a class="input-group-addon" data-toggle="popover" title="{{ trans('adminlte_lang::LangTratamiento.popovertittle2') }}" data-content="<p style='width: 50%'>{{ trans('adminlte_lang::LangTratamiento.popoverdescript2') }}</p>"><i class="fas fa-info-circle"></i></a>
		</div>
	</div> --}}
</div>
{{-- fin de ingreso de inputs para el pretratamiento --}}
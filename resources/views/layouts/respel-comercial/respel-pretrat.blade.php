<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
<div class="panel post clearfix" id="boxpretrat`+contador+`">
  <div class="box-header with-border">
    <h4 class="box-title">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapse`+contador+`">
        {{ trans('adminlte_lang::LangTratamiento.pretrat') }} `+contador+`
      </a>
    </h4>
    <span class=""><i class="fas fa-info-circle"></i></span>
  </div>
  <div id="collapse`+contador+`" class="panel-collapse collapse">
    <div class="box-body">
    	{{-- ingreso de inputs para el pretratamiento --}}
      <div class="col-md-6" id="pretratname`+contador+`">
      	<label for="input[]">{{ trans('adminlte_lang::LangTratamiento.pretratname') }} `+contador+`</label>
      	<div class="input-group">
      		<input id="input[]" class="form-control" type="text" name="PreTratName[]">
      		<span onclick="EliminarPreTrat(`+contador+`)" class="input-group-addon" style=" color: red;"><i class="fas fa-backspace"></i></span>
      	</div>
      </div>

      <div class="col-md-6" id="pretratdescription`+contador+`">
      	<label for="inputdescript[]">{{ trans('adminlte_lang::LangTratamiento.pretratdescript') }} `+contador+`</label>
      	<div class="input-group">
      		<input id="inputdescript[]" class="form-control" type="text" name="PreTratDescription[]">
      		<span class="input-group-addon"><i class="fas fa-info-circle"></i></span>
      	</div>
      </div>
      {{-- fin de ingreso de inputs para el pretratamiento --}}
    </div>
  </div>
</div>


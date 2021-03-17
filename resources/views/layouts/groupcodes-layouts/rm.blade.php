{{-- ingreso de inputs para el pretratamiento --}}
<div class="col-md-3" id="vcrm`+contador+`">
	<label for="VC_RM[]">Recibo de Materiales (RM)</label>
	<div class="input-group">
		<input maxlength="60" id="VC_RM[]" class="form-control" type="text" name="VC_RM[]">
		<a onclick="EliminarRM(`+contador+`)" class="input-group-addon" style=" color: red;" ><i class="fas fa-trash-alt"></i></a>
	</div><br>
</div>

{{-- fin de ingreso de inputs para el pretratamiento --}}
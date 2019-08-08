<div id="tarifa`+contador+`Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	<div id="rango`+contador+`Container" class="col-md-7" style="margin-bottom: 0.25em;">
		<div class="col-md-4" id="rango`+contador+`0">
			<label style="font-size: 0.8em;">Desde 0 </label>
			<input name="Opcion[`+contador+`][TarifaPrecio][]" type="text" class="form-control" placeholder="Descripcion del Residuo" value="{{$Respels->RespelDescrip}}">
			<input name="Opcion[`+contador+`][TarifaDesde][]" hidden value="0">
		</div>
	</div>
	<div class="pull-right col-md-1">
		<label for="addrangeButton`+contador+`">Más</label>
		<button style="cursor: cell;" onclick="AgregarRango(`+contador+`)" class="btn btn-primary addrangeButton" id="addrangeButton`+contador+`"> <i class="fa fa-plus"></i></button>
	</div>
	<div class="pull-right col-md-2">
		<label for="typerangeSelect`+contador+`">Tipo</label>
		<select id="typerangeSelect`+contador+`" name="Opcion[`+contador+`][Tarifatipo]">
			<option>Kilos</option>
			<option>Litros</option>
			<option>Unidades</option>
		</select>
	</div>
	<div class="pull-right col-md-2">
		<label for="frecrangeSelect`+contador+`">Frec.</label>
		<select id="frecrangeSelect`+contador+`" name="Opcion[`+contador+`][TarifaFrecuencia]">
			<option>mensual</option>
			<option>servicio</option>
		</select>
	</div>
</div>
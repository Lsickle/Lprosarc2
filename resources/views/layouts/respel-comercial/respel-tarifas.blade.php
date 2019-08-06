<div id="tarifa`+contador+`Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	<div id="rango`+contador+`Container" class="col-md-9" style="margin-bottom: 0.25em;">
		<div class="col-md-3" id="rango0">
			<label style="font-size: 0.8em;">Desde 0 </label>
			<input name="Tratamiento[Tarifas[`+contador+`][]]" type="text" class="form-control" placeholder="Descripcion del Residuo" value="{{$Respels->RespelDescrip}}">
		</div>
	</div>
	<input name="Tratamiento[Tarifas[`+contador+`][]]" hidden>
	<div class="pull-right col-md-1">
		<label for="minusrangeButton">Más</label>
		<button style="cursor: cell;" onclick="AgregarRango(`+contador+`)" class="btn btn-primary addrangeButton" id="addrangeButton`+contador+`"> <i class="fa fa-plus"></i></button>
	</div>
	<div class="pull-right col-md-2">
		<label for="typerangeSelect`+contador+`">Tipo</label>
		<select id="typerangeSelect`+contador+`">
			<option>Kilos</option>
			<option>Litros</option>
			<option>Unidades</option>
		</select>
	</div>
</div>
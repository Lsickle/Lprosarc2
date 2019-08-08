<div id="tarifa`+contador+`Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	<div id="rango`+contador+`Container" class="col-md-9" style="margin-bottom: 0.25em;">
		<div class="col-md-3" id="rango`+contador+`0">
			<label style="font-size: 0.8em;">Desde 0 </label>
			<input name="Tratamiento[TarifasPrecio[`+contador+`][0]]" type="text" class="form-control" placeholder="Descripcion del Residuo" value="{{$Respels->RespelDescrip}}">
			<input name="Tratamiento[TarifasDesde[`+contador+`][0]]" hidden value="0">
		</div>
	</div>
	<div class="pull-right col-md-1">
		<label for="addrangeButton`+contador+`">Más</label>
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
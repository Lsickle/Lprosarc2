<div id="tarifa`+contador+`Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	<div class="col-md-10" style="margin-bottom: 0.25em;">
		<div class="col-md-3" id="rango0">
			<label>Desde 0</label>
			<input name="RespelDescrip" type="text" class="form-control" placeholder="Descripcion del Residuo" value="{{$Respels->RespelDescrip}}" disabled>
		</div>
	</div>
	<div class="pull-right col-md-2">
		<label for="addrangeButton">+/-</label>
		<label for="minusrangeButton">rangos</label>
		<button onclick="AgregarRango(`+contador+`)" class="btn btn-primary addrangeButton" id="addrangeButton`+contador+`"> <i class="fa fa-plus"></i></button>
		<button onclick="EliminarRango(`+contador+`)" class="btn btn-danger minusrangeButton" id="minusrangeButton`+contador+`"> <i class="fa fa-minus"></i></button>
	</div>
</div>
<div id="tarifa`+contador+`Container">
	<div class="col-md-2" id="rango`+contadorRango+`">
		<label>rango 1</label>
		<input name="RespelDescrip" type="text" class="form-control" placeholder="Descripcion del Residuo" value="{{$Respels->RespelDescrip}}" disabled>
		<p class="lectorrango"></p>
	</div>

	<div class="float-right col-md-2">
		<label for="addrangeButton">+/-</label>
		<label for="minusrangeButton">rangos</label>
		<button onclick="AgregarRango(`+contadorRango+`)" class="btn btn-primary addrangeButton" id="addrangeButton"> <i class="fa fa-plus"></i></button>
		<button onclick="EliminarRango(`+contadorRango+`)" class="btn btn-danger minusrangeButton" id="minusrangeButton"> <i class="fa fa-minus"></i></button>
	</div>
</div>

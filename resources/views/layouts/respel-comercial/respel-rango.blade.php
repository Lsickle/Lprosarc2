<div class="col-md-3" id="rango`+opcion+``+last+`">
	<label for="rangopriceinput`+opcion+`0" style="font-size: 0.8em;">Desde `+rango+`</label><a onclick="EliminarRango(`+opcion+`,`+last+`)" id="minusrangeButton`+contadorRango[contador]+`"><i style="color:red; margin: 0; padding: 0; margin-top: 0.25em; cursor: pointer;" class="fa fa-trash-alt pull-right"></i></a>
	<input id="rangopriceinput`+opcion+``+last+`" name="Opcion[`+opcion+`][TarifaPrecio][]" type="text" class="form-control">
	<input name="Opcion[`+opcion+`][TarifaDesde][]" hidden value="`+rango+`">
</div>
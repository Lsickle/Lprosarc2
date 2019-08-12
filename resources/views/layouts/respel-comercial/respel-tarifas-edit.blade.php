<div id="tarifa{{$contadorphp}}Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	<div id="rango{{$contadorphp}}Container" class="col-md-12" style="margin-bottom: 0.25em;">
		<div class="pull-left col-md-3" style="max-height: 2.3em;">
			<label for="expireRange{{$contadorphp}}" style="font-size: 0.9em;">Vencimiento</label>
			<input id="expireRange{{$contadorphp}}" name="Opcion[{{$contadorphp}}][TarifaVencimiento]" type="date" class="form-control" value="<?php echo date('Y-m-d', strtotime('+1 year')); ?>">
		</div>
		<div class="pull-right col-md-1">
			<label for="addrangeButton{{$contadorphp}}">Más</label>
			<button style="cursor: cell;" onclick="AgregarRango({{$contadorphp}})" class="btn btn-primary addrangeButton" id="addrangeButton{{$contadorphp}}"> <i class="fa fa-plus"></i></button>
		</div>
		<div class="pull-left col-md-3">
			<label style="font-size: 0.9em;" data-trigger="hover" data-toggle="popover" title="<b>Frecuencia</b>" data-content="<p> se tomara en cuenta para la aplicación de la tarifa respectiva y el calculo del precio según la frecuencia de la cantidad puesta en planta Prosarc S.A. ESP</p>" for="frecrangeSelect{{$contadorphp}}">Frec.</label>
			<select id="frecrangeSelect{{$contadorphp}}" name="Opcion[{{$contadorphp}}][TarifaFrecuencia]">
				<option>N/A</option>
				<option>mensual</option>
				<option>servicio</option>
			</select>
		</div>
		<div class="pull-left col-md-2">
			<label style="font-size: 0.9em;" for="typerangeSelect{{$contadorphp}}">Tipo</label>
			<select id="typerangeSelect{{$contadorphp}}" name="Opcion[{{$contadorphp}}][Tarifatipo]">
				<option>Kg</option>
				<option>Lt</option>
				<option>Unid</option>
			</select>
		</div>
		<div class="col-md-3" id="rango{{$contadorphp}}0">
			<label style="font-size: 0.8em;" for="rangopriceinput{{$contadorphp}}0">Desde 0 </label>
			<input id="rangopriceinput{{$contadorphp}}0" name="Opcion[{{$contadorphp}}][TarifaPrecio][]" type="text" class="form-control" placeholder="Precio">
			<input name="Opcion[{{$contadorphp}}][TarifaDesde][]" hidden value="0">
		</div>
	</div>
	
	

</div>
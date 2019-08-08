<div id="tarifa`+contador+`Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	<div id="rango`+contador+`Container" class="col-md-12" style="margin-bottom: 0.25em;">
		<div class="pull-left col-md-3" style="max-height: 2.3em;">
			<label for="expireRange`+contador+`" style="font-size: 0.9em;">Vencimiento</label>
			<input id="expireRange`+contador+`" name="Opcion[`+contador+`][TarifaVencimiento]" type="date" class="form-control" value="<?php echo date('Y-m-d', strtotime('+1 year')); ?>">
		</div>
		<div class="pull-right col-md-1">
			<label for="addrangeButton`+contador+`">Más</label>
			<button style="cursor: cell;" onclick="AgregarRango(`+contador+`)" class="btn btn-primary addrangeButton" id="addrangeButton`+contador+`"> <i class="fa fa-plus"></i></button>
		</div>
		<div class="pull-left col-md-3">
			<label style="font-size: 0.9em;" data-trigger="hover" data-toggle="popover" title="<b>Frecuencia</b>" data-content="<p> se tomara en cuenta para la aplicación de la tarifa respectiva y el calculo del precio según la frecuencia de la cantidad puesta en planta Prosarc S.A. ESP</p>" for="frecrangeSelect`+contador+`">Frec.</label>
			<select id="frecrangeSelect`+contador+`" name="Opcion[`+contador+`][TarifaFrecuencia]">
				<option>N/A</option>
				<option>mensual</option>
				<option>servicio</option>
			</select>
		</div>
		<div class="pull-left col-md-2">
			<label style="font-size: 0.9em;" for="typerangeSelect`+contador+`">Tipo</label>
			<select id="typerangeSelect`+contador+`" name="Opcion[`+contador+`][Tarifatipo]">
				<option>Kg</option>
				<option>Lt</option>
				<option>Unid</option>
			</select>
		</div>
		<div class="col-md-3" id="rango`+contador+`0">
			<label style="font-size: 0.8em;">Desde 0 </label>
			<input name="Opcion[`+contador+`][TarifaPrecio][]" type="text" class="form-control" placeholder="Descripcion del Residuo" value="{{$Respels->RespelDescrip}}">
			<input name="Opcion[`+contador+`][TarifaDesde][]" hidden value="0">
		</div>
	</div>
	
	

</div>
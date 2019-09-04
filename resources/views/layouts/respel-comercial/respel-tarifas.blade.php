<div id="tarifa`+contador+`Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	<div id="rango`+contador+`Container" class="col-md-12" style="margin-bottom: 0.25em;">
		<div class="pull-left col-md-3" style="max-height: 2.3em;">
			<label for="expireRange`+contador+`" style="font-size: 0.9em;">Vencimiento</label>
			<input {{in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial) ? '' : 'disabled' }} id="expireRange`+contador+`" name="Opcion[`+contador+`][TarifaVencimiento]" type="date" class="form-control" value="<?php echo date('Y-m-d', strtotime('+1 year')); ?>">
			@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
		   		<input type="date" hidden name="Opcion[`+contador+`][TarifaVencimiento]" value="<?php echo date('Y-m-d', strtotime('+1 year')); ?>">
		    @endif
		</div>
		<div class="pull-right col-md-1">
			<label for="addrangeButton`+contador+`">Más</label>
			<button {{in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial) ? '' : 'disabled' }} style="cursor: cell;" onclick="AgregarRango(`+contador+`)" class="btn btn-primary addrangeButton" id="addrangeButton`+contador+`"> <i class="fa fa-plus"></i></button>
		</div>
		<div class="pull-left col-md-3">
			<label style="font-size: 0.9em;" data-trigger="hover" data-toggle="popover" title="<b>Frecuencia</b>" data-content="<p> se tomara en cuenta para la aplicación de la tarifa respectiva y el calculo del precio según la frecuencia de la cantidad puesta en planta Prosarc S.A. ESP</p>" for="frecrangeSelect`+contador+`">Frec.</label>
			<select {{in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial) ? '' : 'disabled' }} id="frecrangeSelect`+contador+`" name="Opcion[`+contador+`][TarifaFrecuencia]">
				<option>N/A</option>
				<option>Mensual</option>
				<option>Servicio</option>
			</select>
			@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
		   		<input hidden name="Opcion[`+contador+`][TarifaFrecuencia]" value="N/A">
		    @endif
		</div>
		<div class="pull-left col-md-2">
			<label style="font-size: 0.9em;" for="typerangeSelect`+contador+`">Tipo</label>
			<select {{in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial) ? '' : 'disabled' }} id="typerangeSelect`+contador+`" name="Opcion[`+contador+`][Tarifatipo]">
				<option>Kg</option>
				<option>Lt</option>
				<option>Unid</option>
			</select>
			@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
		   		<input hidden name="Opcion[`+contador+`][Tarifatipo]" value="Kg">
		    @endif
		</div>
		<div class="col-md-3" id="rango`+contador+`0">
			<label style="font-size: 0.8em;" for="rangopriceinput`+contador+`0">Desde 0 </label>
			<input {{in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial) ? '' : 'disabled' }} id="rangopriceinput`+contador+`0" name="Opcion[`+contador+`][TarifaPrecio][]" type="number" class="form-control" placeholder="Precio" min="10">
			<input name="Opcion[`+contador+`][TarifaDesde][]" hidden value="0">
			@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
		   		<input hidden name="Opcion[`+contador+`][TarifaPrecio]">
		    @endif
		</div>
	</div>
	
	

</div>
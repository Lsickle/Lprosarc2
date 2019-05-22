<div id="Residuo`+contador+`">
	<div class="col-md-12">
		<hr style="height:3px; border:none; color:rgb(60,90,180); background-color:rgb(60,90,180);">
	</div>
	<div class="col-md-12">
		<label onclick="EliminarRes(`+contador+`)" style="float: right; color: red; margin-top: 0; font-size: 1.5em;">
			<i class="fas fa-trash-alt"></i>
		</label>
	</div>
	<div class="col-md-6 form-group">
		<label>Nombre</label>
		<input maxlength="128" name="RespelName[]" type="text" class="form-control" placeholder="Nombre del Residuo" required>
	</div>
	<div class="col-md-6 form-group">
		<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Descripción del residuo</b>" data-content="<p style='width: 50%'> brinde una descripcion del residuo según sus caracteristicas, con el fin de facilitar la evaluacion del mismo y la asignación de tratamientos viables adecuados</p>">Descripción <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
		<input maxlength="512" name="RespelDescrip[]" type="text" class="form-control" placeholder="Descripcion del Residuo">
	</div>
	<div class="col-md-6 form-group">
		<label>Peligrosidad</label>
		<select id="selectDanger`+contador+`" name="RespelIgrosidad[]" class="form-control" required>
			<option value="">Selecione...</option>
			<option onclick="setDanger(`+contador+`)">Corrosivo</option>
			<option onclick="setDanger(`+contador+`)">Reactivo</option>
			<option onclick="setDanger(`+contador+`)">Explosivo</option>
			<option onclick="setDanger(`+contador+`)">Toxico</option>
			<option onclick="setDanger(`+contador+`)">Inflamable</option>
			<option onclick="setDanger(`+contador+`)">Patogeno - Infeccioso</option>
			<option onclick="setDanger(`+contador+`)">Radiactivo</option>
			<option onclick="setNoDanger(`+contador+`)">No peligroso</option>
		</select>
	</div>
	<div class="col-md-6 form-group">
		<label>Estado fisico</label>
		<select name="RespelEstado[]" class="form-control" required>
			<option value="">Selecione...</option>
			<option value="Liquido">Liquido</option>
			<option value="Solido">Solido</option>
			<option value="Gaseoso">Gaseoso</option>
			<option value="Mezcla">Mezcla</option>
		</select>
	</div>
	<div id="danger`+contador+`">
	</div>
	<div class="col-md-6 form-group">
		<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Hoja de seguridad</b>" data-content="<p style='width: 50%'> Si el campo <b><i>Peligrosidad del residuo</i></b> es diferente a: <i>No peligroso</i>, entonces, este campo es Obligatorio</p>">Hoja de seguridad <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
		<input required id="hoja`+contador+`" name="RespelHojaSeguridad[]" type="file" class="form-control" accept=".pdf">
	</div>
	<div class="col-md-6 form-group">
		<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Hoja de seguridad</b>" data-content="<p style='width: 50%'> Si el campo <b><i>Peligrosidad del residuo</i></b> es diferente a: <i>No peligroso</i>, entonces, este campo es Obligatorio... sin embargo, podra postponer la carga de la <b>Tarjeta de Emergencia</b> hasta el momento en el que vaya a realizar un solicitud de servicio</p>">Tarjeta De Emergencia <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
		<input name="RespelTarj[]" type="file" class="form-control" accept=".pdf">
	</div>
	<div class="col-md-6 form-group">
		<label>¿Sustancia controlada?
			<a href="{{route('ClasificacionA')}}" target="_blank"> Resolución Número 1 del 2015 <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></a>
		</label>
		<select id="selectControl`+contador+`" name="SustanciaControlada[]" class="form-control" required>
			<option onclick="setNoControlada(`+contador+`)">No</option>
			<option onclick="setControlada(`+contador+`)">Si</option>
		</select>
	</div>
	<div id="SustanciaControlada`+contador+`">
	</div>
</div>

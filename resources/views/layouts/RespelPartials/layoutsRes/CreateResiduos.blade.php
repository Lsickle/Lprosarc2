<div id="Residuo`+contador+`">
	<div class="col-md-12">
		<label onclick="EliminarRes(`+contador+`)" style="float: right; color: red; margin-top: 0; font-size: 2em;">
			<i class="fas fa-times-circle"></i>
		</label>
	</div>
	<div class="col-md-6">
		<label>Nombre</label>
		<input name="RespelName[]" type="text" class="form-control" placeholder="Nombre del Residuo" required>
	</div>
	<div class="col-md-6">
		<label>Descripcion</label>
		<input name="RespelDescrip[]" type="text" class="form-control" placeholder="Descripcion del Residuo">
	</div>
	<div class="col-md-6" style="padding-top: 18px;">
		<label>Tipo de clasificación</label>
		<label style="margin: 0 3em;">
			<spam> Y</spam>
			<input type="radio" id="ClasifY`+contador+`" checked="" onclick="Agregar(`+contador+`)" name="ResTippCasif" value="Y">
		</label>
		<label>
			<spam> A</spam>
			<input type="radio" id="ClasifA`+contador+`" onclick="Agregar(`+contador+`)" name="ResTippCasif" value="A">
		</label>
	</div>
	<div class="col-md-6" id="Clasif`+contador+`">
	</div>
	<div class="col-md-6">
		<label>Peligrosidad del residuo</label>
		<select name="RespelIgrosidad[]" class="form-control" required>
			<option value="Inflamable">Selecione...</option>
			<option>Inflamable</option>
			<option>Toxico</option>
			<option>Biologico</option>
			<option>Corrosivo</option>
			<option>Reactivo</option>
		</select>
	</div>
	<div class="col-md-6">
		<label>Estado del residuo</label>
		<select name="RespelEstado[]" class="form-control" required>
			<option value="">Selecione...</option>
			<option value="Liquido">Liquido</option>
			<option value="Solido">Solido</option>
			<option value="Gaseoso">Gaseoso</option>
			<option value="Mezcla">Mezcla</option>
		</select>
	</div>
	<div class="col-md-6">
		<label>Hoja de seguridad</label>
		<input name="RespelHojaSeguridad[]" type="file" class="form-control" accept=".png, .jpg, .jpeg,.pdf" required>
	</div>
	<div class="col-md-6">
		<label>Tarjeta De Emergencia</label>
		<input name="RespelTarj[]" type="file" class="form-control" accept=".png, .jpg, .jpeg,.pdf">
	</div>
	<div class="col-md-12">
		<hr>
	</div>
</div>
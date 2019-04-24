<div id="Residuo`+contador+`">
	<div class="col-md-12"> <hr> </div>
	<div class="col-md-12">
		<label onclick="EliminarRes(`+contador+`)" style="float: right; color: red; margin-top: 0; font-size: 2em;">
			<i class="fas fa-times-circle"></i>
		</label>
	</div>
	<div class="col-md-6 form-group">
		<label>Nombre</label>
		<input name="RespelName[]" type="text" class="form-control" placeholder="Nombre del Residuo" required>
	</div>
	<div class="col-md-6 form-group">
		<label>Descripcion</label>
		<input name="RespelDescrip[]" type="text" class="form-control" placeholder="Descripcion del Residuo">
	</div>
	<div class="col-md-6 form-group" style="text-align: center;">
		<label>Tipo de clasificación</label><br>
		<a class="btn btn-success" id="ClasifY`+contador+`" onclick="AgregarY(`+contador+`)">Y</a>
		<a class="btn btn-primary" id="ClasifA`+contador+`" onclick="AgregarA(`+contador+`)">A</a>
	</div>
	<div class="col-md-6 form-group" id="Clasif`+contador+`">
	</div>
	<div class="col-md-6 form-group">
		<label>Peligrosidad del residuo</label>
		<select name="RespelIgrosidad[]" class="form-control" required>
			<option value="">Selecione...</option>
			<option>Inflamable</option>
			<option>Toxico</option>
			<option>Biologico</option>
			<option>Corrosivo</option>
			<option>Reactivo</option>
		</select>
	</div>
	<div class="col-md-6 form-group">
		<label>Estado del residuo</label>
		<select name="RespelEstado[]" class="form-control" required>
			<option value="">Selecione...</option>
			<option value="Liquido">Liquido</option>
			<option value="Solido">Solido</option>
			<option value="Gaseoso">Gaseoso</option>
			<option value="Mezcla">Mezcla</option>
		</select>
	</div>
	<div class="col-md-6 form-group">
		<label>Hoja de seguridad</label>
		<input name="RespelHojaSeguridad[]" type="file" class="form-control" accept=".png, .jpg, .jpeg,.pdf" required>
	</div>
	<div class="col-md-6 form-group">
		<label>Tarjeta De Emergencia</label>
		<input name="RespelTarj[]" type="file" class="form-control" accept=".png, .jpg, .jpeg,.pdf">
	</div>
</div>
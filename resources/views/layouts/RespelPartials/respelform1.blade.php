<div id="Respels">
	<div id="Residuo">
		<div class="col-md-6">
			<label>Nombre</label>
			<input name="RespelName[]" type="text" class="form-control" placeholder="Nombre del Residuo" required>
		</div> 
		<div class="col-md-6">
			<label>Descripcion</label>
			<input name="RespelDescrip[]" type="text" class="form-control" placeholder="Descripcion del Residuo">
		</div> 
		<div class="col-md-6" style="padding-top: 18px;">
			<label>Tipo de clasificación</label> <label style="margin: 0 3em;"> <spam> Y </spam>
				<input type="radio" id="ClasifY0" checked="" onclick="Agregar(0)" name="ResTippCasif" value="Y"> </label>
			<label> <spam> A </spam>
			<input type="radio" id="ClasifA0" onclick="Agregar(0)" name="ResTippCasif" value="A"> </label>
		</div> 
		<div class="col-md-6" id="Clasif0">
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
			<input name="RespelHojaSeguridad[]" type="file" class="form-control" accept=".pdf" required>
		</div> 
		<div class="col-md-6">
			<label>Tarjeta De Emergencia</label>
			<input name="RespelTarj[]" type="file" class="form-control" accept=".pdf">
		</div> 
		<div class="col-md-12"> <hr>
		</div> 
	</div>
</div>

<script>
	var contador = 1;
	var ClasifY = `@include('layouts.RespelPartials.layoutsRes.ClasificacionYCreate')`;
	var ClasifA = `@include('layouts.RespelPartials.layoutsRes.ClasificacionACreate')`;
	window.onload = function(){ $("#Clasif0").append(ClasifY); }
	function AgregarRes(){
		var Residuo = `@include('layouts.RespelPartials.layoutsRes.CreateResiduos')`;
		$("#Respels").append(Residuo);
		$("#Clasif"+contador).append(ClasifY);
		contador= parseInt(contador)+1;
	}
	function Agregar(id)
		{
			if ($("#ClasifY"+id).prop('checked')){
				$("#Clasif"+id).empty();
				$("#Clasif"+id).append(ClasifY);
			}
			else{
				$("#Clasif"+id).empty();
				$("#Clasif"+id).append(ClasifA);
			}
		}
	function EliminarRes(id){
		$("#Residuo"+id).remove();
	}
</script>
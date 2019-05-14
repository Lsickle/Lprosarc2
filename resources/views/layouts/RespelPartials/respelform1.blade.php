<div id="Respels">
	<div id="Residuo">
		{{-- <div id="form-step-0" role="form" data-toggle="validator"> --}}
			<div class="col-md-12"> <hr> </div>
			<div class="col-md-6 form-group">
				<label>Nombre</label>
				<input name="RespelName[]" type="text" class="form-control" placeholder="Nombre del Residuo" required>
			</div> 
			<div class="col-md-6 form-group">
				<label>Descripcion</label>
				<input name="RespelDescrip[]" type="text" class="form-control" placeholder="Descripcion del Residuo">
			</div> 
			<div class="col-md-6 form-group">
				<label>Peligrosidad</label>
				<select id="selectDanger0" name="RespelIgrosidad[]" class="form-control" required>
					<option value="">Selecione...</option>
					<option onclick="setDanger(0)">Corrosivo</option>
					<option onclick="setDanger(0)">Reactivo</option>
					<option onclick="setDanger(0)">Explosivo</option>
					<option onclick="setDanger(0)">Toxico</option>
					<option onclick="setDanger(0)">Inflamable</option>
					<option onclick="setDanger(0)">Patogeno - Infeccioso</option>
					<option onclick="setDanger(0)">Radiactivo</option> 
					<option onclick="setNoDanger(0)">No peligroso</option>
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
			<div id="danger0">
				
			</div>
			<div class="col-md-6 form-group">
			    <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Hoja de seguridad</b>" data-content="<p style='width: 50%'> Si el campo <b><i>Peligrosidad del residuo</i></b> es diferente a: <i>No peligroso</i>, entonces, este campo es Obligatorio</p>">Hoja de seguridad <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
			    <input required id="hoja0" name="RespelHojaSeguridad[]" type="file" class="form-control" accept=".pdf">
			    
			</div> 
			<div class="col-md-6 form-group">
			    <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Hoja de seguridad</b>" data-content="<p style='width: 50%'> Si el campo <b><i>Peligrosidad del residuo</i></b> es diferente a: <i>No peligroso</i>, entonces, este campo es Obligatorio... sin embargo, podra postponer la carga de la <b>Tarjeta de Emergencia</b> hasta el momento en el que vaya a realizar un solicitud de servicio</p>">Tarjeta De Emergencia <i  style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></label>
			    <input name="RespelTarj[]" type="file" class="form-control" accept=".pdf">
			</div> 
			
		{{-- </div> --}}
	</div>
</div>

<script>
	var contador = 1;
	function setDanger(id){
		var ifDangerRespel = `@include('layouts.RespelPartials.layoutsRes.ifDangerRespel')`;
	    $("#danger"+id).empty();
	    $("#danger"+id).append(ifDangerRespel);
	    $("#hoja"+id).prop('required', true);
	}
	function setNoDanger(id){
	    $("#danger"+id).empty();
	    $("#hoja"+id).prop('required', false)
	}
	var ClasifY = `@include('layouts.RespelPartials.layoutsRes.ClasificacionYCreate')`;
	var ClasifA = `@include('layouts.RespelPartials.layoutsRes.ClasificacionACreate')`;
	function AgregarRes(){
		var Residuo = `@include('layouts.RespelPartials.layoutsRes.CreateResiduos')`;
		$("#Respels").append(Residuo);
		$("#myform").validator('update');
		$("#Clasif"+contador).append(ClasifY);
		contador= parseInt(contador)+1;
		$('[data-toggle="popover"]').popover({
            html: true,
            trigger: 'hover',
            placement: 'auto'
        });
	}
	function AgregarY(id){
		$("#ClasifY"+id).removeClass("btn-default");
		$("#ClasifY"+id).addClass("btn-success");
		$("#ClasifA"+id).removeClass("btn-success");
		$("#ClasifA"+id).addClass("btn-default");
		$("#Clasif"+id).empty();
		$("#Clasif"+id).append(ClasifY);
		$("#myform").validator('update');
	}
	function AgregarA(id){
		$("#ClasifA"+id).removeClass("btn-default");
		$("#ClasifA"+id).addClass("btn-success");
		$("#ClasifY"+id).removeClass("btn-success");
		$("#ClasifY"+id).addClass("btn-default");
		$("#Clasif"+id).empty();
		$("#Clasif"+id).append(ClasifA);
		$("#myform").validator('update');
	}
	function EliminarRes(id){
		$("#Residuo"+id).remove();
		$("#myform").validator('update');
	}

</script>
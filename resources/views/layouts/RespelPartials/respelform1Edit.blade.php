<div class="col-md-6">
<label>Nombre</label>
<input name="RespelName" type="text" class="form-control" placeholder="Nombre del Residuo" value="{{$Respels->RespelName}}" required>
</div>
<div class="col-md-6">
<label>Descripcion</label>
<input name="RespelDescrip" type="text" class="form-control" placeholder="Descripcion del Residuo" value="{{$Respels->RespelDescrip}}" required>
</div>
<div class="col-md-6" style="text-align: center;">
	<label>Tipo de clasificación</label><br>
	@if($Respels->YRespelClasf4741 <> null)
		<a class="btn btn-success" id="ClasifY" onclick="AgregarY()">Y</a>
		<a class="btn btn-primary" id="ClasifA" onclick="AgregarA()">A</a>
	@else
		<a class="btn btn-primary" id="ClasifY" onclick="AgregarY()">Y</a>
		<a class="btn btn-success" id="ClasifA" onclick="AgregarA()">A</a>
	@endif
</div>
<div class="col-md-6" id="Clasif">
	@if($Respels->YRespelClasf4741 <> null)
		@include('layouts.RespelPartials.layoutsRes.ClasificacionYEdit')
	@else
		@include('layouts.RespelPartials.layoutsRes.ClasificacionAEdit')
	@endif
</div>
<div class="col-md-6">
	<label>Peligrosidad del residuo</label>
	<select name="RespelIgrosidad" class="form-control" required>
		<option {{$Respels->RespelIgrosidad == 'Inflamable' ? 'selected' : '' }}>Inflamable</option>
		<option {{$Respels->RespelIgrosidad == 'Toxico' ? 'selected' : '' }}>Toxico</option>
		<option {{$Respels->RespelIgrosidad == 'Biologico' ? 'selected' : '' }}>Biologico</option>
		<option {{$Respels->RespelIgrosidad == 'Corrosivo' ? 'selected' : '' }}>Corrosivo</option>
		<option {{$Respels->RespelIgrosidad == 'Reactivo' ? 'selected' : '' }}>Reactivo</option> 
	</select>
</div>
<div class="col-md-6">
	<label>Estado del residuo</label>
	<select name="RespelEstado" class="form-control" >
		<option {{$Respels->RespelEstado == 'Liquido' ? 'selected' : '' }}>Liquido</option>
		<option {{$Respels->RespelEstado == 'Solido' ? 'selected' : '' }}>Solido</option>
		<option {{$Respels->RespelEstado == 'Gaseoso' ? 'selected' : '' }}>Gaseoso</option>
		<option {{$Respels->RespelEstado == 'Mezcla' ? 'selected' : '' }}>Mezcla</option>
	</select>
</div>
<div class="col-md-4">
	<label>Hoja de seguridad</label>
	<input type="text" class="form-control" id="HojaSeguridadActual" readonly="" name="RespelHojaSeguridad" value="{{$Respels->RespelHojaSeguridad}}">
</div>
<div class="col-md-2">
	<label>Ver y/o Cambiar</label><br>
	<a method='get' href='/img/HojaSeguridad/{{$Respels->RespelHojaSeguridad}}' target='_blank' class='btn btn-success'><i class='fas fa-search'></i></a>
	<label for="RespelHojaSeguridad" class='btn btn-warning'><i class="fas fa-exchange-alt"></i></label>
	<input id="RespelHojaSeguridad" name="RespelHojaSeguridad" style="display: none;" type="file" accept=".pdf" class="form-control">
</div>
<div class="col-md-4">
	<label>Tarjeta De Emergencia</label>
	<input type="text" class="form-control" id="TarjActual" readonly="" name="RespelTarj" value="{{$Respels->RespelTarj}}">
</div>
<div class="col-md-2">
	<label>Ver y/o Cambiar</label><br>
	<a method='get' href='/img/TarjetaEmergencia/{{$Respels->RespelTarj}}' target='_blank' class='btn btn-success'><i class='fas fa-search'></i></a>
	<label for="RespelTarj" class='btn btn-warning'><i class="fas fa-exchange-alt"></i></label>
	<input id="RespelTarj" name="RespelTarj" type="file" class="form-control" style="display: none;" accept=".pdf">
</div>
@if(Auth::user()->UsRol=='Programador'||Auth::user()->UsRol=='admin'||Auth::user()->UsRol=='JefeOperacion')
	<div class="col-md-12">
		<label>Estado de aprobación</label>
		<select name="RespelStatus" class="form-control">
			<option {{$Respels->RespelStatus == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
			<option {{$Respels->RespelStatus == 'Negado' ? 'selected' : '' }}>Negado</option>
			<option {{$Respels->RespelStatus == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
			<option {{$Respels->RespelStatus == 'Incompleto' ? 'selected' : '' }}>Incompleto</option>
		</select>
	</div>
@elseif(Auth::user()->UsRol=='Cliente')
	<input type="text" hidden="" name="RespelStatus" value="Pendiente">
@endif

<script>
	var ClasifY = `@include('layouts.RespelPartials.layoutsRes.ClasificacionYEdit')`;
	var ClasifA = `@include('layouts.RespelPartials.layoutsRes.ClasificacionAEdit')`;
	@if($Respels->YRespelClasf4741 <> null)
		window.onload = function(){ 
			$("#RespelHojaSeguridad").change(function() {
				var HojaSeguridadName = $("#RespelHojaSeguridad")[0].files[0]['name'];
				$("#HojaSeguridadActual").val(HojaSeguridadName);
			});
			$("#RespelTarj").change(function() {
				var HojaSeguridadName = $("#RespelTarj")[0].files[0]['name'];
				$("#TarjActual").val(HojaSeguridadName);
			});
		}
	@else
		window.onload = function(){
			$("#RespelHojaSeguridad").change(function() {
				var HojaSeguridadName = $("#RespelHojaSeguridad")[0].files[0]['name'];
				$("#HojaSeguridadActual").val(HojaSeguridadName);
			});
			$("#RespelTarj").change(function() {
				var HojaSeguridadName = $("#RespelTarj")[0].files[0]['name'];
				$("#TarjActual").val(HojaSeguridadName);
			});
		}
	@endif
	function AgregarY(){
		$("#ClasifY").addClass("btn btn-success");
		$("#ClasifA").removeClass("btn btn-success");
		$("#ClasifA").addClass("btn btn-primary");
		$("#Clasif").empty();
		$("#Clasif").append(ClasifY);
	}
	function AgregarA(){
		$("#ClasifA").addClass("btn btn-success");
		$("#ClasifY").removeClass("btn btn-success");
		$("#ClasifY").addClass("btn btn-primary");
		$("#Clasif").empty();
		$("#Clasif").append(ClasifA);
	}
</script>
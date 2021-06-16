<div class="col-md-6">
<label>Nombre</label>
<input name="RespelName" type="text" class="form-control" placeholder="Nombre del Residuo" value="{{$Respels->RespelName}}" disabled>
</div>
<div class="col-md-6">
<label>Descripcion</label>
<input name="RespelDescrip" type="text" class="form-control" placeholder="Descripcion del Residuo" value="{{$Respels->RespelDescrip}}" disabled>
</div>
{{-- <div class="col-md-6" style="text-align: center;">
	<label>Tipo de clasificación</label><br>
	@if($Respels->YRespelClasf4741 <> null)
		<a class="btn btn-success" id="ClasifY" onclick="AgregarY()">Y</a>
		<a class="btn btn-primary" id="ClasifA" onclick="AgregarA()">A</a>
	@else
		<a class="btn btn-primary" id="ClasifY" onclick="AgregarY()">Y</a>
		<a class="btn btn-success" id="ClasifA" onclick="AgregarA()">A</a>
	@endif
</div> --}}
@if ($Respels->YRespelClasf4741 != 'No peligroso')
	@if($Respels->YRespelClasf4741 <> null)
	<div class="col-md-6" id="Clasif">
		@include('layouts.RespelPartials.layoutsRes.ClasYdisabled')
	</div>
	@elseif($Respels->ARespelClasf4741 <> null)
	<div class="col-md-6" id="Clasif">
		@include('layouts.RespelPartials.layoutsRes.ClasAdisabled')
	</div>
	@else
	<div class="col-md-6" id="Clasif">
		<label>Clasificación</label>
		<input type="text" class="form-control" disabled value="N/D">
	</div>
	@endif
@else
	<div class="col-md-6" id="Clasif">
		<label>Clasificación</label>
		<input type="text" class="form-control" disabled value="N/A">
	</div>
@endif

<div class="col-md-6">
	<label>Peligrosidad</label>
	<select name="RespelIgrosidad" class="form-control" disabled>
		<option {{$Respels->RespelIgrosidad == 'Inflamable' ? 'selected' : '' }}>Inflamable</option>
		<option {{$Respels->RespelIgrosidad == 'Toxico' ? 'selected' : '' }}>Toxico</option>
		<option {{$Respels->RespelIgrosidad == 'Biologico' ? 'selected' : '' }}>Biologico</option>
		<option {{$Respels->RespelIgrosidad == 'Corrosivo' ? 'selected' : '' }}>Corrosivo</option>
		<option {{$Respels->RespelIgrosidad == 'Reactivo' ? 'selected' : '' }}>Reactivo</option> 
	</select>
</div>
<div class="col-md-6">
	<label>Estado Físico</label>
	<select name="RespelEstado" class="form-control" disabled>
		<option {{$Respels->RespelEstado == 'Liquido' ? 'selected' : '' }}>Liquido</option>
		<option {{$Respels->RespelEstado == 'Solido' ? 'selected' : '' }}>Solido</option>
		<option {{$Respels->RespelEstado == 'Gaseoso' ? 'selected' : '' }}>Gaseoso</option>
		<option {{$Respels->RespelEstado == 'Mezcla' ? 'selected' : '' }}>Mezcla</option>
	</select>
</div>
<div class="col-md-5">
	<label>Hoja de seguridad</label>
	<input type="text" class="form-control" id="HojaSeguridadActual" readonly="" name="RespelHojaSeguridad" value="{{$Respels->RespelHojaSeguridad}}" disabled>
</div>
<div class="col-md-1">
	<label>Ver</label><br>
	<a method='get' href='{{ asset("/img/HojaSeguridad/".$Respels->RespelHojaSeguridad)}}' target='_blank' class='btn btn-success'><i class='fas fa-search'></i></a>
</div>
<div class="col-md-5">
	<label>Tarjeta De Emergencia</label>
	<input type="text" class="form-control" id="TarjActual" readonly="" name="RespelTarj" value="{{$Respels->RespelTarj}}">
</div>
<div class="col-md-1">
	<label>Ver</label><br>
	<a method='get' href='{{ asset("/img/TarjetaEmergencia/".$Respels->RespelTarj)}}' target='_blank' class='btn btn-success'><i class='fas fa-search'></i></a>
</div>
	
	
<script>


</script>
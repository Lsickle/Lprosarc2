
	<div class="col-md-6 form-group">
			<label>Nombre</label>
			<input type="text" class="form-control" value="{{$Respels->RespelName}}" disabled>
	</div>



	<div class="col-md-6 form-group">
			<label>Descripción</label>
			<input type="text" class="form-control" value="{{$Respels->RespelDescrip}}" disabled>
	</div>



	
	@if ($Respels->RespelIgrosidad != 'No peligroso')
		@if($Respels->YRespelClasf4741 <> null)
		<div class="col-md-6 form-group">
			<label>Clasificación Y, según
				<a href="{{route('ClasificacionY')}}" target="_blank"> Decreto Número 4741</a>
			</label>
			<input type="text" class="form-control" value="{{$Respels->YRespelClasf4741}}" disabled>
		</div>
		@elseif($Respels->ARespelClasf4741 <> null)
		<div class="col-md-6 form-group">
			<label>Clasificación A, según
				<a href="{{route('ClasificacionA')}}" target="_blank"> Decreto Número 4741</a>
			</label>
			<input type="text" class="form-control" value="{{$Respels->ARespelClasf4741}}" disabled>
		</div>
		@else
		<div class="col-md-6 form-group">
			<label>Clasificación</label>
			<input type="text" class="form-control" value="N/D" disabled>
		</div>

		@endif
	@else
	<div class="col-md-6 form-group">
		<label>Clasificación</label>
		<input type="text" class="form-control" value="N/A" disabled>
	</div>
	@endif
		
	

<div class="col-md-6 form-group">

		<label>Peligrosidad</label>
		<input type="text" class="form-control" value="{{$Respels->RespelIgrosidad}}" disabled>

</div>

<div class="col-md-6 form-group">

		<label>Estado Físico</label>
		<input type="text" class="form-control" value="{{$Respels->RespelEstado}}" disabled>

</div>

{{-- hoja de seguridad --}}
@if($Respels->RespelHojaSeguridad!=='RespelHojaDefault.pdf')
	<div class="col-md-6 form-group">

			<label>Hoja de seguridad</label>
		<div class="input-group">
			<input type="text" class="form-control" value="Ver documento adjunto" disabled>
			<div class="input-group-btn">
				<a method='get' href='{{ asset("/img/HojaSeguridad/".$Respels->RespelHojaSeguridad)}}' target='_blank' class='btn btn-success' style="height: auto; max-height: 2.4em;"><i class='fas fa-file-pdf fa-lg'></i></a>
			</div>
		</div>	
	</div>
@else
	<div class="col-md-6 form-group">

			<label>Hoja de seguridad</label>
			<input type="text" class="form-control" value="No adjuntado" disabled>

	</div>
@endif

{{-- tarjeta de emergencia --}}
@if($Respels->RespelTarj!=='RespelTarjetaDefault.pdf')
	<div class="col-md-6 form-group">

			<label>Tarjeta De Emergencia </label>
			<div class="input-group">
				<input type="text" class="form-control" value="Ver documento adjunto" disabled>
				<div class="input-group-btn">
					<a method='get' href='{{ asset("/img/TarjetaEmergencia/".$Respels->RespelTarj)}}' target='_blank' class='btn btn-success' style="height: auto; max-height: 2.4em;"><i class='fas fa-file-pdf fa-lg'></i></a>
				</div>
			</div>	

	</div>
@else
	<div class="col-md-6 form-group">

			<label>Tarjeta De Emergencia </label>
			<input type="text" class="form-control" value="No adjuntado" disabled>

	</div>
@endif

{{-- Fotografía del residuo --}}
@if($Respels->RespelFoto!=='RespelFotoDefault.png')
	<div class="col-md-6 form-group">

			<label>Fotografía del Residuo </label>
			<div class="input-group">
				<input type="text" class="form-control" value="Ver documento adjunto" disabled>
				<div class="input-group-btn">
					<a method='get' href='{{ asset("/img/fotoRespelCreate/".$Respels->RespelFoto)}}' target='_blank' class='btn btn-success' style="height: auto; max-height: 2.4em;"><i class='fas fa-image'></i></a>

				</div>
			</div>	

	</div>
@else
	<div class="col-md-6 form-group">

			<label>Fotografía del residuo</label>
			<input type="text" class="form-control" value="No adjuntado" disabled>

	</div>
@endif


{{-- sustancia controlada --}}
@if($Respels->SustanciaControlada !== 0)
	<div class="col-md-6 form-group">

			<label>¿Sustancia controlada?</label>
			<input type="text" class="form-control" value="Si" disabled>

	</div>
	<div class="col-md-6 form-group">

			<label>Tipo de sustancia Controlada</label>
			@if($Respels->SustanciaControladaTipo !== 0)
				<input type="text" class="form-control" value="Uso Masivo" disabled>
			@else
				<input type="text" class="form-control" value="Sustancia Controlada" disabled>
			@endif

	</div>
	<div class="col-md-6 form-group">

			<label>Nombre de la Sustancia</label>
			<input type="text" class="form-control" value="{{$Respels->SustanciaControladaNombre}}" disabled>

	</div>
	{{-- documente de la sustancia controlada --}}
	@if($Respels->SustanciaControladaTipo !== 0)
		<div class="col-md-6 form-group">

				<label>Certificado de Registro </label>
				<div class="input-group">
					<input type="text" class="form-control" value="Ver documento adjunto" disabled>
					<div class="input-group-btn">
						<a method='get' href='{{ $Respels->SustanciaControladaDocumento === "SustanciaControlDocDefault.pdf" ? asset('/img/'.$Respels->SustanciaControladaDocumento) : asset('/img/SustanciaControlDoc/'.$Respels->SustanciaControladaDocumento) }}' target='_blank' class='btn btn-success' style="height: auto; max-height: 2.4em;"><i class='fas fa-file-pdf fa-lg'></i></a>
					</div>
				</div>	

		</div>
	@else
		<div class="col-md-6 form-group">

				<label>Certificado de Carencia </label>
				<div class="input-group">
					<input type="text" class="form-control" value="Ver documento adjunto" disabled>
					<div class="input-group-btn">
						<a method='get' href='{{ $Respels->SustanciaControladaDocumento === "SustanciaControlDocDefault.pdf" ? asset('/img/'.$Respels->SustanciaControladaDocumento) : asset('/img/SustanciaControlDoc/'.$Respels->SustanciaControladaDocumento) }}' target='_blank' class='btn btn-success' style="height: auto; max-height: 2.4em;"><i class='fas fa-file-pdf fa-lg'></i></a>
					</div>
				</div>	

		</div>
	@endif
@else
	<div class="col-md-6 form-group">

			<label>¿Sustancia controlada?</label>
			<input type="text" class="form-control" value="No" disabled>

	</div>
@endif
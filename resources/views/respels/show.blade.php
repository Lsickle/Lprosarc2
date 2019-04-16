@extends('layouts.app')

@section('htmlheader_title', 'Respel')

@section('main-content')
	@component('layouts.partials.modal')
		{{$Respels->RespelSlug}}
	@endcomponent
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-12">
						@if(Auth::user()->UsRol === "Cliente" && $Respels->RespelStatus <> "Aprobado")
							@if($Respels->RespelDelete == 0)
								<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Respels->RespelSlug}}' class='btn btn-danger' style="float: right;">Eliminar</a>
								<form action='/respels/{{$Respels->RespelSlug}}' method='POST'>
									@method('DELETE')
									@csrf
									<input  type="submit" id="Eliminar{{$Respels->RespelSlug}}" style="display: none;">
								</form>
							@else
								<form action='/respels/{{$Respels->RespelSlug}}' method='POST' style="float: right;">
									@method('DELETE')
									@csrf
									<input type="submit" class='btn btn-success' value="Añadir">
								</form>
							@endif
						@endif
						<a href="/respels/{{$Respels->RespelSlug}}/edit" class="btn btn-warning" style="float: right; margin-right: 5px;">Editar</a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="box box-primary">
							<div class="box box-primary">
								<table id="Clasificacion" class="table table-bordered table-striped">
									<tr>
										<th colspan="2">
											<h2>{{$Respels->RespelName}}</h2>
										</th>
									</tr>
									<tr>
										<th>Estado de aprobación:</th>
										<td>
											<h4>{{$Respels->RespelStatus}}</h4>
										</td>
									</tr>
									<tr>
										<th>N° de cotizacion:</th>
										<td>
											<h4>{{$Respels->FK_RespelCoti}}</h4>
										</td>
									</tr>
									<tr>
										<th>Descripción:</th>
										<td>
											<h4>{{$Respels->RespelDescrip}}</h4>
										</td>
									</tr>
									<tr>
										<th>Corriente de clasificacion Y:</th>
										<td>
											<h4>{{$Respels->YRespelClasf4741}}</h4>
										</td>
									</tr>
									<tr>
										<th>Corriente de clasificacion A:</th>
										<td>
											<h4>{{$Respels->ARespelClasf4741}}</h4>
										</td>
									</tr>
									<tr>
										<th>Peligrosidad del residuo:</th>
										<td>
											<h4>{{$Respels->RespelIgrosidad}}</h4>
										</td>
									</tr>
									<tr>
										<th>Estado del residuo:</th>
										<td>
											<h4>{{$Respels->RespelEstado}}</h4>
										</td>
									</tr>
									<tr>
										<th>Hoja de seguridad:</th>
										<td>
											<h4>
												<a method='get' href='/img/HojaSeguridad/{{$Respels->RespelHojaSeguridad}}' target='_blank' class='btn btn-primary'><i class="fas fa-search"></i></a>
											</h4>
										</td>
									</tr>
									<tr>
										<th>Tarjeta De Emergencia:</th>
										<td>
											<h4>
												<a method='get' href='/img/TarjetaEmergencia/{{$Respels->RespelTarj}}' target='_blank' class='btn btn-primary'><i class="fas fa-search"></i></a>
											</h4>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

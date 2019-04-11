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
						@if($Respels->RespelDelete == 0)
							<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Respels->RespelSlug}}' class='btn btn-danger' style="float: right;">Eliminar</a>
							<form action='/respels/{{$Respels->RespelSlug}}' method='POST'>
								@method('DELETE')
								@csrf
								<input  type="submit" id="Eliminar{{$Respels->RespelSlug}}" style="display: none;">
							</form>
						@else
							<form action='/solicitud-Respels/{{$Respels->RespelSlug}}' method='POST' style="float: right;">
								@method('DELETE')
								@csrf
								<input type="submit" class='btn btn-success' value="Añadir">
							</form>
						@endif
						<a href="/respels/{{$Respels->RespelSlug}}/edit" class="btn btn-warning" style="float: right; margin-right: 5px;">Editar</a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="box box-primary">
							<div class="box box-primary">
								<table class="col-md-12 text-aline-center" border="2px">
									<tr>
										<th colspan="2">
											<h2>{{$Respels->RespelName}}</h2>
										</th>
									</tr>
									<tr>
										<td>
											<h4>Estado de aprobación:</h4>
											<td>
												<h4>{{$Respels->RespelStatus}}</h4>
											</td>
										</td>
									</tr>
									<tr>
										<td>
											<h4>N° de cotizacion:</h4>
											<td>
												<h4>{{$Respels->FK_RespelCoti}}</h4>
											</td>
										</td>
									</tr>
									<tr>
										<td>
											<h4>Descripción:</h4>
											<td>
												<h4>{{$Respels->RespelDescrip}}</h4>
											</td>
										</td>
									</tr>
									<tr>
										<td>
											<h4>Corriente de clasificacion Y:</h4>
											<td>
												<h4>{{$Respels->YRespelClasf4741}}</h4>
											</td>
										</td>
									</tr>
									<tr>
										<td>
											<h4>Corriente de clasificacion A:</h4>
											<td>
												<h4>{{$Respels->ARespelClasf4741}}</h4>
											</td>
										</td>
									</tr>
									<tr>
										<td>
											<h4>Peligrosidad del residuo:</h4>
											<td>
												<h4>{{$Respels->RespelIgrosidad}}</h4>
											</td>
										</td>
									</tr>
									<tr>
										<td>
											<h4>Estado del residuo:</h4>
											<td>
												<h4>{{$Respels->RespelEstado}}</h4>
											</td>
										</td>
									</tr>
									<tr>
										<td>
											<h4>Hoja de seguridad:</h4>
											<td>
												<h4>
													<a method='get' href='/img/{{$Respels->RespelHojaSeguridad}}' target='_blank' class='btn btn-primary'><i class="fas fa-search"></i></a>
												</h4>
											</td>
										</td>
									</tr>
									<tr>
										<td>
											<h4>Tarjeta De Emergencia:</h4>
											<td>
												<h4>
													<a method='get' href='/img/{{$Respels->RespelTarj}}' target='_blank' class='btn btn-primary'><i class="fas fa-search"></i></a>
												</h4>
											</td>
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

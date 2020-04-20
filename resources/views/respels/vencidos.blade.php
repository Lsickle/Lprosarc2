@extends('layouts.app')
@section('htmlheader_title', trans('adminlte_lang::LangRespel.Respellist'))
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #FF856D, #CC0000); padding-right:30vw; position:relative; overflow:hidden;">
	{{ trans('adminlte_lang::LangRespel.respelmenu') }}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">
				<div class="box">
					<div class="box-header">
						
					</div>
					<div class="box box-info">
						<div class="box-body">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										@if($user == 'Comercial')
											<th>Nombre</th>
											<th>Tarifa</th>
											<th>Fecha de Vencimiento</th>
											<th>Cliente</th>
										@else
											<th>Nombre</th>
											<th>Tarifa</th>
											<th>Fecha de Vencimiento</th>
											<th>Cliente</th>
											<th>Comercial Asignado</th>
										@endif
									</tr>
								</thead>
								<tbody id="readyTable">
									
										@if($user == 'Comercial')
											@foreach($requerimientos as $requerimiento)
												<tr>
													<th>{{$requerimiento->respel->RespelName}}</th>
													<th class="text-center">
													@foreach($requerimiento->tarifa->rangos as $rango)
														<li>{{$rango->TarifaPrecio}}</li>
													@endforeach
													</th>
													<th>{{$requerimiento->tarifa->TarifaVencimiento}}</th>
													<th>{{$requerimiento->respel->cotizacion->sede->clientes->CliName}}</th>
												</tr>
											@endforeach
										@else
											@foreach($requerimientos as $requerimiento)
												<tr>
													<th>{{$requerimiento->respel->RespelName}}</th>
													<th class="text-center">
													@foreach($requerimiento->tarifa->rangos as $rango)
														<li>{{$rango->TarifaPrecio}}</li>
													@endforeach
													</th>
													<th>{{$requerimiento->tarifa->TarifaVencimiento}}</th>
													<th>{{$requerimiento->respel->cotizacion->sede->clientes->CliName}}</th>
													<th>
														@foreach($personals as $personal)
															@if($requerimiento->respel->cotizacion->sede->clientes->CliComercial == $personal->ID_Pers)
																{{$personal->PersFirstName}} {{$personal->PersLastName}}
															@endif
														@endforeach
													</th>
												</tr>
											@endforeach
										@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
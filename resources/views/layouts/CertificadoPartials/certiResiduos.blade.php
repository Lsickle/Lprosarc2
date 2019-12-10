<div class="col-md-12" style="border-top:#00a65a solid 3px; padding-top: 20px; margin-top: 20px;">
	<table id="SolserGenerTable" class="table table-compact table-bordered table-striped">
		@php 
			// $TotalEnv = 0;
			// $TotalRec = 0;
			// $TotalCons = 0;
			// $TotalTrat = 0;
		@endphp
		<thead>
			<tr>
				<th>{{trans('adminlte_lang::message.solserrespel')}}</th>
				<th>Corriente</th>
				<th>{{trans('adminlte_lang::message.solserembaja')}}</th> 
				@if(in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL))
					<th>Tarifa</th>
				@endif
				<th>{{trans('adminlte_lang::message.solsercantidad')}} <br> {{trans('adminlte_lang::message.solsercanticonsi')}}</th>
				<th>{{trans('adminlte_lang::message.solsercantidad')}} <br> {{trans('adminlte_lang::message.solsercantitrat')}}</th>		
			</tr>
		</thead>
		<tbody>
		@foreach($certificado->SolicitudServicio->SolicitudResiduo as $Residuo)
		@if($Residuo->requerimiento->FK_ReqTrata == $certificado->FK_CertTrat)
			@php
				// $TotalEnv = $Residuo->generespel->respels->SolResKgEnviado+$TotalEnv;
				// $TotalRec = $Residuo->generespel->respels->SolResKgRecibido+$TotalRec;
				// $TotalCons = $Residuo->generespel->respels->SolResKgConciliado+$TotalCons;
				// $TotalTrat = $Residuo->generespel->respels->SolResKgTratado+$TotalTrat;
				switch ($Residuo->SolResTypeUnidad) {
					case 'Unidad':
						$TypeUnidad = 'Unidades';
						break;
					case 'Litros':
						$TypeUnidad = 'Litros';
						break;
					default:
						$TypeUnidad = 'Kilogramos';
						break;
				}
			@endphp
			<tr>
				<td><a title="Ver Residuo" href="/respels/{{$Residuo->generespel->respels->RespelSlug}}" target="_blank" ><i class="fas fa-external-link-alt"></i></a>
					 {{$Residuo->generespel->respels->RespelName}}</td>
				<td>{{$Residuo->generespel->respels->YRespelClasf4741}}{{$Residuo->generespel->respels->ARespelClasf4741}}</td>
				<td>{{$Residuo->SolResEmbalaje}}</td>
				@if(in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL))
					<td style="text-align: center;">
					{{$Residuo->SolResPrecio}}
						 Pesos
					</td>
				@endif
			
				<td style="text-align: center;">
					@if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
						{{$Residuo->SolResCantiUnidadConciliada === null ? 'N/A' : $Residuo->SolResCantiUnidadConciliada }}
					@else
						{{$Residuo->SolResKgConciliado === null ? 'N/A' : $Residuo->SolResKgConciliado }}
					@endif
					 {{$TypeUnidad}}
				</td>
				<td style="text-align: center;">
					@if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
						{{$Residuo->SolResCantiUnidadTratada === null ? 'N/A' : $Residuo->SolResCantiUnidadTratada }}
					@else
						{{$Residuo->SolResKgTratado === null ? 'N/A' : $Residuo->SolResKgTratado }}
					@endif
					 {{$TypeUnidad}}
				</td>
			</tr>
		@endif
		@endforeach
		</tbody>
	</table>
</div>
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
				<th># RM</th>
				<th>{{trans('adminlte_lang::message.solserembaja')}}</th>
				<th>{{trans('adminlte_lang::message.solserrespel')}}</th>
				<th>Corriente</th>
				@if(in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL))
					<th>Tarifa</th>
				@endif
				<th>{{trans('adminlte_lang::message.solsercantidad')}} <br> {{trans('adminlte_lang::message.solsercanticonsi')}}</th>
				@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)||in_array(Auth::user()->UsRol2, Permisos::PROGRAMADOR))
				<th>{{trans('adminlte_lang::message.solsercantidad')}} <br> {{trans('adminlte_lang::message.solsercantitrat')}}</th>
				@endif
			</tr>
		</thead>
		<tbody>
		@foreach($certificado->SolicitudServicio->SolicitudResiduo as $Residuo)
		@foreach ($certificado->certdato as $certdato)
		@if($Residuo->ID_SolRes == $certdato->FK_DatoCertSolRes)
			@php
				// $TotalEnv = $Residuo->generespel->respels->SolResKgEnviado+$TotalEnv;
				// $TotalRec = $Residuo->generespel->respels->SolResKgRecibido+$TotalRec;
				// $TotalCons = $Residuo->generespel->respels->SolResKgConciliado+$TotalCons;
				// $TotalTrat = $Residuo->generespel->respels->SolResKgTratado+$TotalTrat;
				switch ($Residuo->SolResTypeUnidad) {
					case 'Unidad':
						$TypeUnidad = 'Unid.';
						break;
					case 'Litros':
						$TypeUnidad = 'Lt.';
						break;
					default:
						$TypeUnidad = 'Kg.';
						break;
				}
			@endphp
			<tr>
				<td>
				@if ($Residuo->SolResRM2 !== null && is_Array($Residuo->SolResRM2))
					@foreach ($Residuo->SolResRM2 as $rm => $value)
						{{$value}}<br>
					@endforeach
				@else
					{{'RM Invalido -> '}} {{$Residuo->SolResRM}}
				@endif
				</td>
				<td><a title="Ver Residuo" href="/respels/{{$Residuo->generespel->respels->RespelSlug}}" target="_blank" ><i class="fas fa-external-link-alt"></i></a>{{$Residuo->SolResEmbalaje}}</td>
				<td>{{$Residuo->generespel->respels->RespelName}}</td>
				@if ($Residuo->generespel->respels->RespelIgrosidad!= 'No peligroso')
					@if ($Residuo->generespel->respels->YRespelClasf4741 <> null )
						<td>{{$Residuo->generespel->respels->YRespelClasf4741}}</td>
					@elseif($Residuo->generespel->respels->ARespelClasf4741 <> null)
						<td>{{$Residuo->generespel->respels->ARespelClasf4741}}</td>
					@else
						<td>N/D</td>
					@endif
				@else
					<td>N/A</td>
				@endif
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
				@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)||in_array(Auth::user()->UsRol2, Permisos::PROGRAMADOR))
					<td style="text-align: center;">
						@if($Residuo->SolResTypeUnidad == 'Litros' || $Residuo->SolResTypeUnidad == 'Unidad')
							{{$Residuo->SolResCantiUnidadTratada === null ? 'N/A' : $Residuo->SolResCantiUnidadTratada }}
						@else
							{{$Residuo->SolResKgTratado === null ? 'N/A' : $Residuo->SolResKgTratado }}
						@endif
						{{$TypeUnidad}}
					</td>
				@endif
			</tr>
		@endif
		@endforeach
		@endforeach
		</tbody>
	</table>
</div>

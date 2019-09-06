@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.solsertitleindex') }}</h3>
					@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
						@if(isset($Cliente)&&($Cliente->CliStatus=="Autorizado"))
							<a href="solicitud-servicio/create" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.create') }}</a>
						@else
							<a href="#" disabled class="btn btn-default pull-right" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Solicitudes nuevas deshabilitadas</b>" data-content="<p style='width: 50%'> Actualmente se encuentra deshabilitado para realizar nuevas solicitudes de servicio <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>">{{ trans('adminlte_lang::message.create') }}</a>
						@endif
					@endif
				</div>
				<div class="box box-info">
					<div class="box-body">
						<div id="ModalStatus"></div>
						<table id="SolicitudservicioTable" class="table table-compact table-bordered table-striped">
							<thead>
								<tr>
									<th>{{trans('adminlte_lang::message.solsershowdate')}}</th>
									<th>N°</th>
									<th>Status</th>

									@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
										<th>{{trans('adminlte_lang::message.clientcliente')}}</th>
									@endif
									@if(in_array(Auth::user()->UsRol, Permisos::SEDECOMERCIAL))
										<th>Facturación</th>
										<th>Nuevas Solicitudes</th>
									@endif
									@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
										<th>Comercial Asignado</th>
									@endif
									<th>{{trans('adminlte_lang::message.solserindextrans')}}</th>
									<th>{{trans('adminlte_lang::message.solseraddrescollect')}}</th>
									<th>{{trans('adminlte_lang::message.seemore')}}</th>
									@if(in_array(Auth::user()->UsRol, Permisos::SOLSERACEPTADO) || in_array(Auth::user()->UsRol2, Permisos::SOLSERACEPTADO))
										<th>Aprobar</th>
									@endif
									@if(in_array(Auth::user()->UsRol, Permisos::SolSerCertifi) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi))
										<th>{{trans('adminlte_lang::message.solserstatuscertifi')}}</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach ($Servicios as $Servicio)
									<tr style="{{$Servicio->SolSerDelete == 1 ? 'color: red' : ''}}">
										<td style="text-align: center;">{{date('d-m-y', strtotime($Servicio->created_at))}}</td>
										<td style="text-align: center;">{{$Servicio->ID_SolSer}}</td>
										<td style="text-align: center;">{{$Servicio->SolSerStatus}}</td>
										@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
												<td><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Persona de Contacto</b>" data-content="<p>Datos de la persona de Contacto para esta Solicitud de Servicio</p><ul><li>{{$Servicio->PersFirstName}} {{$Servicio->PersLastName}}</li><li>{{$Servicio->PersEmail}}</li><li>{{$Servicio->PersCellphone}}</li></ul><p>Haga click para ver detalles adicionales de este cliente..." href="/clientes/{{$Servicio->CliSlug}}" target="_blank"><i class="fas fa-user"></i></a>{{$Servicio->CliShortname}}</td>
										@endif
										@if(in_array(Auth::user()->UsRol, Permisos::SEDECOMERCIAL))
											<th>{{$Servicio->TipoFacturacion}}</th>
											<th>{{$Servicio->CliStatus}}</th>
										@endif
										@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
											<td><i data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Comercial Asignado</b>" data-content="<ul><li>{{$Servicio->ComercialPersFirstName}} {{$Servicio->ComercialPersLastName}}</li><li>{{$Servicio->ComercialPersEmail}}</li><li>{{$Servicio->ComercialPersCellphone}}</li></ul>" class="fas fa-user-tie" style="color:green;"></i> {{$Servicio->ComercialPersFirstName.' '.$Servicio->ComercialPersLastName}}</td>
										@endif
										<td>{{$Servicio->SolSerNameTrans}}</td>
										<td>{{$Servicio->SolSerCollectAddress == null ? 'N/A' : $Servicio->SolSerCollectAddress}}</td>
										<td style="text-align: center;"><a href='/solicitud-servicio/{{$Servicio->SolSerSlug}}' class="btn btn-info" title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i></a></td>
										@php
											$Status = ['Conciliado', 'Tratado'];
										@endphp
										@if(in_array(Auth::user()->UsRol, Permisos::SOLSERACEPTADO) || in_array(Auth::user()->UsRol2, Permisos::SOLSERACEPTADO))
											<td>
												<a onclick="ModalStatus('{{$Servicio->SolSerSlug}}', '{{$Servicio->ID_SolSer}}', '{{$Servicio->SolSerStatus === 'Pendiente'}}', 'Aceptada', 'aprobar')" {{$Servicio->SolSerStatus === 'Pendiente' ? '' :  'disabled'}} style="text-align: center;" class="btn btn-success"><i class="fas fa-check-circle"></i> Aprobar</a>
											</td>
										@endif
										@if(in_array(Auth::user()->UsRol, Permisos::SolSerCertifi) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi))
											<td>
												<a onclick="ModalStatus('{{$Servicio->SolSerSlug}}', '{{$Servicio->ID_SolSer}}', '{{in_array($Servicio->SolSerStatus, $Status)}}', 'Certificada', 'certificar')" {{in_array($Servicio->SolSerStatus, $Status) ? '' :  'disabled'}} style="text-align: center;" class="btn btn-success"><i class="fas fa-certificate"></i> {{trans('adminlte_lang::message.solserstatuscertifi')}}</a>
											</td>
										@endif
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('NewScript')
<script>
	function ModalStatus(slug, id, boolean, value, text){
		if(boolean == 1){
			$('#ModalStatus').empty();
			$('#ModalStatus').append(`
				<div class="modal modal-default fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-body">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
									<i class="fas fa-exclamation-triangle"></i>
									<span style="font-size: 0.3em; color: black;"><p>¿Seguro(a) quiere `+text+` la solicitud <b>N° `+id+`</b>?</p></span>
									<form action="/solicitud-servicio/changestatus" method="POST" data-toggle="validator" id="SolSer">
										@csrf
										<input type="submit" id="Cambiar`+slug+`" style="display: none;">
										<input type="text" name="solserslug" value="`+slug+`" style="display: none;">
										<input type="text" name="solserstatus" value="`+value+`" style="display: none;">
									</form>
								</div> 
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">No, salir</button>
								<label for="Cambiar`+slug+`" class='btn btn-success'>Si, acepto</label>
							</div>
						</div>
					</div>
				</div>
			`);
			$('#SolSer').validator('update');
			popover();
			envsubmit();
			$('#myModal').modal();
		}
	}
</script>
@endsection
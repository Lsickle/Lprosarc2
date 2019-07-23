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
						<a href="solicitud-servicio/create" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.create') }}</a>
					@endif
				</div>
				<div class="box box-info">
					<div class="box-body">
						<div id="ModalStatus"></div>
						<table id="SolicitudservicioTable" class="table table-compact table-bordered table-striped">
							<thead>
								<tr>
									<th>{{trans('adminlte_lang::message.solsershowdate')}}</th>
									<th>{{trans('adminlte_lang::message.solserindexnumber')}}</th>
									@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
										<th>{{trans('adminlte_lang::message.clientcliente')}}</th>
									@endif
									<th>{{trans('adminlte_lang::message.solserpersonal')}}</th>
									<th>{{trans('adminlte_lang::message.solserindextrans')}}</th>
									<th>{{trans('adminlte_lang::message.solseraddrescollect')}}</th>
									<th>{{trans('adminlte_lang::message.seemore')}}</th>
									@if(in_array(Auth::user()->UsRol, Permisos::SOLSERVERIFICADO) || in_array(Auth::user()->UsRol2, Permisos::SOLSERVERIFICADO))
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
										<td style="text-align: center;">{{date('Y-m-d', strtotime($Servicio->created_at))}}</td>
										<td style="text-align: center;">{{$Servicio->ID_SolSer}}</td>
										@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
											<td><a title="Ver Cliente" href="/clientes/{{$Servicio->CliSlug}}" target="_blank"><i class="fas fa-external-link-alt"></i></a> {{$Servicio->CliShortname}}</td>
										@endif
										<td><a title="Ver Personal" href="/personal/{{$Servicio->PersSlug}}" target="_blank"><i class="fas fa-external-link-alt"></i></a> {{$Servicio->PersFirstName.' '.$Servicio->PersLastName}}</td>
										<td>{{$Servicio->SolSerNameTrans}}</td>
										<td>{{$Servicio->SolSerCollectAddress == null ? 'N/A' : $Servicio->SolSerCollectAddress}}</td>
										<td style="text-align: center;"><a href='/solicitud-servicio/{{$Servicio->SolSerSlug}}' class="btn btn-info" title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i></a></td>
										@php
											$Status = ['Conciliado', 'Tratado'];
										@endphp
										@if(in_array(Auth::user()->UsRol, Permisos::SolSerCertifi) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi))
											<td>
												<a onclick="ModalStatus('{{$Servicio->SolSerSlug}}', '{{$Servicio->ID_SolSer}}', '{{in_array($Servicio->SolSerStatus, $Status)}}', 'Certificada', 'certificar')" {{in_array($Servicio->SolSerStatus, $Status) ? '' :  'disabled'}} style="text-align: center;" class="btn btn-success"><i class="fas fa-certificate"></i> {{trans('adminlte_lang::message.solserstatuscertifi')}}</a>
											</td>
										@endif
										@if(in_array(Auth::user()->UsRol, Permisos::SOLSERVERIFICADO) || in_array(Auth::user()->UsRol2, Permisos::SOLSERVERIFICADO))
											<td>
												<a onclick="ModalStatus('{{$Servicio->SolSerSlug}}', '{{$Servicio->ID_SolSer}}', '{{$Servicio->SolSerStatus === 'Pendiente'}}', 'Verificada', 'aprobar')" {{$Servicio->SolSerStatus === 'Pendiente' ? '' :  'disabled'}} style="text-align: center;" class="btn btn-success"><i class="fas fa-check-circle"></i> Aprobar</a>
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
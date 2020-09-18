@extends('layouts.app')
@section('htmlheader_title')
Lista de Certificados
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #F1B378, #D66841); padding-right:30vw; position:relative; overflow:hidden;">
	Certificados
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">
				<div class="box">
					<div class="box-header with-border">
						{{-- <a href="/solicitud-servicio/documentos/create" class="btn btn-success"><i class="fas fa-file-contract"></i> Añadir Certificado</a> --}}
						{{-- <a disabled href="" class="btn btn-success"><i class="fas fa-file-invoice"></i> Añadir Manifiesto</a> --}}
					</div>
					<div class="box-body">
						<div id="ModalStatus"></div>
						<table class="table table-compact table-bordered table-striped">
							<thead>
								<th>Fecha recepción</th>
								@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
									<th>Cliente</th>
									<th># RM</th>
								@endif
								<th>Servicio</th>
								<th>Tratamiento</th>
								<th># Documento</th>
								<th>Observación</th>
								<th>Archivo</th>
								@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
									<th>Aprobación Director Planta</th>
									<th>Aprobación Logística</th>
									<th>Aprobación Operaciones</th>
								@endif
								
								
								@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
									<th>Ver</th>
								@endif
								@if(in_array(Auth::user()->UsRol, Permisos::SIGNMANIFCERT))
									<th>Aprobar</th>
								@endif
								@if(in_array(Auth::user()->UsRol, Permisos::SolSerCertifi) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi))
									<th>{{trans('adminlte_lang::message.solserstatuscertifi')}}</th>
								@endif
								<th>Actualizado el:</th>
							</thead>
							<tbody>
								@foreach($certificados as $certificado)
								<tr>
									<td>{{date('Y/m/d', strtotime($certificado->recepcion))}}</td>
									@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
										<th class="text-center">{{$certificado->cliente}}</th>
										<td class="text-center">{{$certificado->CertNumRm}}</td>
									@endif
									<td class="text-center">#{{$certificado->FK_CertSolser}}</td>
									<td class="text-center">{{$certificado->tratamiento->TratName}}</td>
									<td class="text-center">
									@switch($certificado->CertType)
										@case(0)
											{{$certificado->CertNumero}}
											@break
										@case(1)
											{{$certificado->CertManifNumero}}
											@break
										@case(2)
											{{$certificado->CertNumeroExt}}
											@break
										@default
											{{$certificado->ID_Cert}}
									@endswitch
									</td>
									<td>{{$certificado->CertObservacion}}</td>
									@switch($certificado->CertType)
										@case(0)
											@if($certificado->CertSrc!=="CertificadoDefault.pdf")
												<td class="text-center"><a method='get' href='/img/Certificados/{{$certificado->CertSrc}}' target='_blank' class='btn btn-success'><i class='fas fa-file-contract fa-lg'></a></td>
											@else
												<td class="text-center"><a disabled method='get' href='/img/CertificadoDefault.pdf' class='btn btn-default'><i class='fas fa-file-contract fa-lg'></a></td>
											@endif
											@break
										@case(1)
											@if($certificado->CertSrcManif!=="CertificadoDefault.pdf")
												<td class="text-center"><a method='get' href='/img/Manifiestos/{{$certificado->CertSrcManif}}' target='_blank' class='btn btn-primary'><i class='far fa-file-alt fa-lg'></a></td>
											@else
												<td class="text-center"><a disabled method='get' href='/img/CertificadoDefault.pdf' target='_blank' class='btn btn-default'><i class='far fa-file-alt fa-lg'></a></td>
											@endif
											@break
										@case(2)
											@if($certificado->CertSrcExt!=="CertificadoDefault.pdf")
												<td class="text-center"><a method='get' href='/img/CertificadosEXT/{{$certificado->CertSrcExt}}' target='_blank' class='btn btn-warning'><i class='far fa-file-alt fa-lg'></a></td>
											@else
												<td class="text-center"><a disabled method='get' href='/img/CertificadoDefault.pdf' target='_blank' class='btn btn-default'><i class='far fa-file-alt fa-lg'></a></td>
											@endif
											@break
										@default
											
									@endswitch
									
									
									@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
										<td class="text-center">
											@switch($certificado->CertAuthDp)
												@case(0)
													<p>Pendiente</p>
													@break

												@case(1)
													<i class='fas fa-signature fa-lg'></i>
													<p>Director de Planta</p>
													@break
												
												@case(2)
													<i class='fas fa-signature fa-lg'></i>
													<p>Jefe de Logística</p>
													@break
												
												@case(3)
													<i class='fas fa-signature fa-lg'></i>
													<p>Jefe de Operaciones</p>
													@break
												
												@case(4)
													<i class='fas fa-signature fa-lg'></i>
													<p>Supervisor de Turno</p>
													@break
												
												@case(5)
													<i class='fas fa-signature fa-lg'></i>
													<p>Ingeniero HSEQ</p>
													@break
													
												@case(6)
													<i class='fas fa-signature fa-lg'></i>
													<p>Asistente de Logística</p>
													@break

												@case(7)
													<i class='fas fa-signature fa-lg'></i>
													<p>Programador</p>
													@break

												@default
												<p>Error en Firma Digital</p>
											@endswitch
										</td>
										{{-- <td class="text-center">
											@if($certificado->CertAuthJo !== 0)
												<i class='fas fa-signature fa-lg'></i>
												@switch($certificado->CertAuthJo)
													@case(1)
														<i class='fas fa-signature fa-lg'></i>
														@break
		
													@case(2)
														Second case...
														@break

													@default
														Default case...
												@endswitch
											@else
												<p>Pendiente </p>
											@endif
										</td> --}}
										<td class="text-center">
											@switch($certificado->CertAuthJl)
												@case(0)
													<p>Pendiente</p>
													@break

												@case(1)
													<i class='fas fa-signature fa-lg'></i>
													<p>Director de Planta</p>
													@break
												
												@case(2)
													<i class='fas fa-signature fa-lg'></i>
													<p>Jefe de Logística</p>
													@break
												
												@case(3)
													<i class='fas fa-signature fa-lg'></i>
													<p>Jefe de Operaciones</p>
													@break
												
												@case(4)
													<i class='fas fa-signature fa-lg'></i>
													<p>Supervisor de Turno</p>
													@break
												
												@case(5)
													<i class='fas fa-signature fa-lg'></i>
													<p>Ingeniero HSEQ</p>
													@break
													
												@case(6)
													<i class='fas fa-signature fa-lg'></i>
													<p>Asistente de Logística</p>
													@break

												@case(7)
													<i class='fas fa-signature fa-lg'></i>
													<p>Programador</p>
													@break

												@default
												<p>Error en Firma Digital</p>
											@endswitch
										</td>
										
										<td class="text-center">
											@switch($certificado->CertAuthJo)
												@case(0)
													<p>Pendiente</p>
													@break

												@case(1)
													<i class='fas fa-signature fa-lg'></i>
													<p>Director de Planta</p>
													@break
												
												@case(2)
													<i class='fas fa-signature fa-lg'></i>
													<p>Jefe de Logística</p>
													@break
												
												@case(3)
													<i class='fas fa-signature fa-lg'></i>
													<p>Jefe de Operaciones</p>
													@break
												
												@case(4)
													<i class='fas fa-signature fa-lg'></i>
													<p>Supervisor de Turno</p>
													@break
												
												@case(5)
													<i class='fas fa-signature fa-lg'></i>
													<p>Ingeniero HSEQ</p>
													@break
													
												@case(6)
													<i class='fas fa-signature fa-lg'></i>
													<p>Asistente de Logística</p>
													@break

												@case(7)
													<i class='fas fa-signature fa-lg'></i>
													<p>Programador</p>
													@break

												@default
												<p>Error en Firma Digital</p>
											@endswitch
										</td>
									@endif

									@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
									<td class="text-center"><a method='get' href='/certificados/{{$certificado->CertSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Información Adicional</b>" data-content="<p style='width: 50%'>Puede ver la información adicional relevante para la generación del certificado </p>" class='btn fixed_widthbtn btn-info'><i class='fas fa-lg fa-search'></i></a></td>
									@endif
									@if(in_array(Auth::user()->UsRol, Permisos::SIGNMANIFCERT))
									<td class="text-center"><a method='get' href='/certificados/{{$certificado->CertSlug}}/firmar' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Firmar Certificado</b>" data-content="<p style='width: 50%'>Este boton le permite marcar el certificado como firmado en la Base de datos </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-file-signature'></i></a></td>
									@endif
									@php
										$Status = ['Conciliado', 'Tratado'];
									@endphp
									@if(in_array(Auth::user()->UsRol, Permisos::SolSerCertifi) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi))
										<td>
											<a onclick="ModalStatus('{{$certificado->SolicitudServicio->SolSerSlug}}', '{{$certificado->SolicitudServicio->ID_SolSer}}', '{{in_array($certificado->SolicitudServicio->SolSerStatus, $Status)}}', 'Certificada', 'certificar')" {{in_array($certificado->SolicitudServicio->SolSerStatus, $Status) ? '' :  'disabled'}} style="text-align: center;" class="btn btn-{{in_array($certificado->SolicitudServicio->SolSerStatus, $Status) ? 'success' : 'default'}}"><i class="fas fa-certificate"></i> {{trans('adminlte_lang::message.solserstatuscertifi')}}</a>
										</td>
									@endif
									<td>{{$certificado->updated_at}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
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
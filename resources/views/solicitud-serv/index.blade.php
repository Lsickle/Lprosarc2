@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #fbc2eb, #aa66cc); padding-right:30vw; position:relative; overflow:hidden;">
	Servicios-Solicitudes
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.solsertitleindex') }}</h3>
					@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
						{{-- @if(isset($Cliente)&&($Cliente->CliStatus=="Autorizado"))
							<a href="solicitud-servicio/create" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.create') }}</a>
						@else
							<a href="#" disabled class="btn btn-default pull-right" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Solicitudes nuevas deshabilitadas</b>" data-content="<p style='width: 50%'> Actualmente se encuentra deshabilitado para realizar nuevas solicitudes de servicio <br>Para más detalles comuníquese con su <b>Asesor Comercial</b> </p>">{{ trans('adminlte_lang::message.create') }}</a>
						@endif --}}
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
									<th>{{trans('adminlte_lang::message.solsershowdateRPDA')}}</th>
									<th>N°</th>
									<th nowrap>Status</th>
									@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
										<th>{{trans('adminlte_lang::message.clientcliente')}}</th>
										<th>Comercial Asignado</th>
									@endif
									<th>{{trans('adminlte_lang::message.solserindextrans')}}</th>
									<th>{{trans('adminlte_lang::message.solseraddrescollect')}}</th>
									<th>{{trans('adminlte_lang::message.seemore')}}</th>
									@if(in_array(Auth::user()->UsRol, Permisos::SolSerCertifi) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi))
										<th>{{trans('adminlte_lang::message.solserstatuscertifi')}}</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach ($Servicios as $Servicio)
									<tr style="{{$Servicio->SolSerDelete == 1 ? 'color: red' : ''}}">
										<td style="text-align: center;">{{date('Y/m/d', strtotime($Servicio->created_at))}}</td>
										<td style="text-align: center;">
											@if($Servicio->recepcion == null)
											{{null}}
											@else
											{{date('Y/m/d', strtotime($Servicio->recepcion))}}
											@endif
										</td>
										<td style="text-align: center;">#{{$Servicio->ID_SolSer}}</td>
										@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE))
											@switch($Servicio->SolSerStatus)
												@case('Pendiente')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Status Pendiente</b>" data-content="<p style='width: 50%'>La información de su solicitud sera procesada a la brevedad posible... <br>Para más detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-default'><i class='fas fa-lg fa-hourglass-start'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Aceptado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Status Aceptado</b>" data-content="<p style='width: 50%'>Su solicitud de servicio ha sido admitida... <br>Para más detalles comuníquese con su <b>Asesor Comercial</b></p>" class='btn fixed_widthbtn btn-info'><i class='fas fa-lg fa-thumbs-up'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Aprobado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Status Aprobado</b>" data-content="<p style='width: 50%'>La solicitud de servicio ha sido revisada y actualmente se está ubicando un espacio según la disponibilidad en nuestra agenda para la recolección de sus residuos... <br>Para más detalles comuníquese con su <b>Asesor Comercial</b></p>" class='btn fixed_widthbtn btn-info'><i class='fas fa-lg fa-tasks'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Programado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Status Programado</b>" data-content="<p style='width: 50%'>La solicitud de servicio ha sido revisada y actualmente se está ubicando un espacio según la disponibilidad en nuestra agenda para la recolección de sus residuos...  <br>Para más detalles comuníquese con su <b>Asesor Comercial</b></p>" class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-calendar-alt'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Notificado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Status Notificado</b>" data-content="<p style='width: 50%'>La fecha programada para la recolección de sus residuos ha sido aprobada por favor revise el correo electrónico de la persona de contacto para tener le información de las fechas o ingrese a los detalles de esta solicitud, haciendo click en el icono azul con una lupa... <br>Para más detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-primary'><i class='far fa-lg fa-envelope'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Recibido')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Status Recibido</b>" data-content="<p style='width: 50%'>Los residuos correspondientes a esta solicitud han sido recibidos y se están verificando las cantidades... <br>Para más detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-thumbs-up'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Completado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Status Completado</b>" data-content="<p style='width: 50%'>Los residuos correspondientes a esta solicitud de servicio han sido recibidos en nuestra planta de procesos por favor verifique las cantidades recibidas en cada uno de los residuos, para luego marcar la solicitud como Conciliada/No Conciliada según corresponda... <br>Para más detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-truck-loading'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Conciliado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Status Conciliado</b>" data-content="<p style='width: 50%'>Su solicitud de servicio ha sido conciliada correctamente y pronto se realizará el tratamiento de los residuos y la correspondiente carga de los Certificados/Manifiestos... <br>Por favor comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-balance-scale'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('No Conciliado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Status No Conciliado</b>" data-content="<p style='width: 50%'>Alguna de las cantidades recibidas no corresponde con los valores esperados y se realizaran las respectivas validaciones entre <b>Prosarc S.A. ESP.</b> y la persona de Contacto adicionalmente puede revisar el registro fotográfico ingresando a los detalles de cada residuo... <br>Para más detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-balance-scale-right'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Corregido')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Status Corregido</b>" data-content="<p style='width: 50%'>Todos los residuos de esta solicitud de servicio han sido revisados para ajustar las cantidades según acuerdo con el Cliente...  adicionalmente se envió un correo electrónico a la persona de contacto de esta solicitud para que revise las cantidades conciliadas... se deberá esperar a que el cliente acepte o rechace los pesos enviados a conciliación <br>Para más detalles comuníquese con <b>Logistica</b> </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-weight'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Tratado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Status Tratado</b>" data-content="<p style='width: 50%'>Todos los residuos de esta solicitud de servicio han sido tratados satisfactoriamente y en breve se cargarán en el sistema <b>SisPRO</b> los archivos de Certificados/Manifiestos Según Corresponda... <br>Para más detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-dumpster-fire'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Facturado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Status Facturado</b>" data-content="<p style='width: 50%'>El Servicio ya fue facturado... proximamente podra disponer de los certificados/manifiestos en la aplicación <b>SisPRO</b> <br>Para más detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-default'><i class='fas fa-lg fa-receipt'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Certificacion')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Status Certificación</b>" data-content="<p style='width: 50%'>Los archivos correspondientes a Certificados ya se encuentran disponibles para su visualización y descarga... se le enviara una notificación por correo en el momento que los Manifiestos ya estén disponibles para su descarga desde el sistema <b>SisPRO</b>... <br>Para más detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-certificate'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Cancelado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Status Cancelado</b>" data-content="<p style='width: 50%'>Ingrese en las Observaciones del Servicio para validar el motivo de la cancelación... <br>Para más detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-ban'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@default
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Status Indefinido</b>" data-content="<p style='width: 50%'>Status Indefinido... <br>Para más detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-thumbs-up'></i></a><br>{{$Servicio->SolSerStatus}}</td>
											@endswitch
										@else
											@switch($Servicio->SolSerStatus)
												@case('Pendiente')
													<td class="text-center"><a class='btn fixed_widthbtn btn-default'><i class='fas fa-lg fa-hourglass-start'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Aceptado')
													<td class="text-center"><a class='btn fixed_widthbtn btn-info'><i class='fas fa-lg fa-thumbs-up'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Aprobado')
													<td class="text-center"><a class='btn fixed_widthbtn btn-info'><i class='fas fa-lg fa-tasks'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Programado')
													<td class="text-center"><a class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-calendar-alt'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Notificado')
													<td class="text-center"><a class='btn fixed_widthbtn btn-primary'><i class='far fa-lg fa-envelope'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Cancelado')
												@case('Recibido')
													<td class="text-center"><a class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-calendar-times'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Completado')
													<td class="text-center"><a class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-truck-loading'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Conciliado')
													<td class="text-center"><a class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-balance-scale'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('No Conciliado')
													<td class="text-center"><a class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-balance-scale-right'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Corregido')
													<td class="text-center"><a class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-weight'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Tratado')
													<td class="text-center"><a class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-dumpster-fire'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Facturado')
													<td class="text-center"><a class='btn fixed_widthbtn btn-default'><i class="fas fa-receipt"></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@case('Certificacion')
													<td class="text-center"><a class='btn fixed_widthbtn btn-success'><i class='fas fas fa-lg fa-certificate'></i></a><br>{{$Servicio->SolSerStatus}}</td>
													@break
												@default
													<td class="text-center"><a class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-ban'></i></a><br>{{$Servicio->SolSerStatus}}</td>
											@endswitch
										@endif
										@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
												<td><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>Persona de Contacto</b>" data-content="<p>Datos de la persona de Contacto para esta Solicitud de Servicio</p><ul><li>{{$Servicio->PersFirstName}} {{$Servicio->PersLastName}}</li><li>{{$Servicio->PersEmail}}</li><li>{{$Servicio->PersCellphone}}</li></ul><p>Haga click para ver detalles adicionales de este cliente..." href="/clientes/{{$Servicio->CliSlug}}" target="_blank"><i class="fas fa-user"></i></a>{{$Servicio->CliName}}</td>
										@endif
										@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
											<td>{{$Servicio->ComercialPersFirstName.' '.$Servicio->ComercialPersLastName}}</td>
										@endif
										<td>{{$Servicio->SolSerNameTrans}}</td>
										<td>{{$Servicio->SolSerCollectAddress == null ? 'N/A' : $Servicio->SolSerCollectAddress}}</td>
										<td style="text-align: center;"><a href='/solicitud-servicio/{{$Servicio->SolSerSlug}}' class="btn btn-info" title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i></a></td>
										@if(in_array(Auth::user()->UsRol, Permisos::SolSerCertifi) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi))
											@php
											$Status = ['Conciliado', 'Tratado'];
											@endphp
											<td>
												<button id="{{'buttonCertStatus'.$Servicio->SolSerSlug}}" onclick="ModalCertificacion('{{$Servicio->SolSerSlug}}', '{{$Servicio->ID_SolSer}}', '{{in_array($Servicio->SolSerStatus, $Status)}}', 'Certificada', 'certificar')" {{in_array($Servicio->SolSerStatus, $Status) ? '' :  'disabled'}} style="text-align: center;" class="{{'classCertStatus'.$Servicio->SolSerSlug}} btn btn-{{$Servicio->SolSerStatus == 'Certificacion' ? 'default' : 'success'}}"><i class="fas fa-certificate"></i> {{trans('adminlte_lang::message.solserstatuscertifi')}}</button>
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
	function ModalCertificacion(slug, id, boolean, value, text){
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
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">No, salir</button>
								<button type="button" id="buttonCertStatusOK`+slug+`" data-dismiss="modal" class='btn btn-success'>Si, acepto</button>
							</div>
						</div>
					</div>
				</div>
			`);
			popover();
			envsubmit();
			$('#myModal').modal();
			$('#buttonCertStatusOK'+slug).on( "click", function() {
				$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
				});
				$.ajax({
				url: "{{url('/certificarservicio')}}/"+slug,
				method: 'GET',
				data:{},
				beforeSend: function(){
					let buttonsubmit = $('.classCertStatus'+slug);
					buttonsubmit.each(function() {
								$(this).on('click', function(event) {
									event.preventDefault();
								});
								$(this).disabled = true;
								$(this).prop('disabled', true);
							});
					buttonsubmit.empty();
					buttonsubmit.append(`<i class="fas fa-sync fa-spin"></i> Actualizando...`);
				},
				success: function(res){
					let buttonsubmit = $('.classCertStatus'+slug);
					switch (res['code']) {
						case 200:
							buttonsubmit.each(function() {
								$(this).on('click', function(event) {
									event.preventDefault();
								});
								$(this).disabled = true;
								$(this).prop('disabled', true);
							});
							buttonsubmit.prop('class', 'btn btn-default');
							buttonsubmit.empty();
							buttonsubmit.append(`<i class="fas fa-certificate"></i> Certificado`);

							toastr.success(res['message']);
							break;

						default:
							buttonsubmit.each(function() {
								$(this).on('click', function(event) {
									event.preventDefault();
								});
								$(this).disabled = false;
								$(this).prop('disabled', false);
							});
							buttonsubmit.prop('class', 'btn btn-success classCertStatus'+slug);
							buttonsubmit.empty();
							buttonsubmit.append(`<i class="fas fa-certificate"></i> Certificar`);

							toastr.error(res['error']);
							break;
					}
				},
				error: function(error){
					let buttonsubmit = $('.classCertStatus'+slug);
					switch (error['responseJSON']['code']) {
						case 400:
							buttonsubmit.each(function() {
								$(this).on('click', function(event) {
									event.preventDefault();
								});
								$(this).disabled = true;
								$(this).prop('disabled', true);
							});
							buttonsubmit.prop('class', 'btn btn-default');
							buttonsubmit.empty();
							buttonsubmit.append(`<i class="fas fa-certificate"></i> Certificado`);

							break;

						default:
							buttonsubmit.each(function() {
								$(this).on('click', function(event) {
									event.preventDefault();
								});
								$(this).disabled = false;
								$(this).prop('disabled', false);
							});
							buttonsubmit.prop('class', 'btn btn-success classCertStatus'+slug);
							buttonsubmit.empty();
							buttonsubmit.append(`<i class="fas fa-certificate"></i> Certificar`);

							break;
					}
					toastr.error(error['responseJSON']['message']);
				},
				complete: function(){
					//
				}
				})
			});
		}
	}
</script>

<script>
	function ModalFacturacion(slug, id, boolean, value, text){
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
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">No, salir</button>
								<button type="button" id="buttonCertStatusOK`+slug+`" data-dismiss="modal" class='btn btn-success'>Si, acepto</button>
							</div>
						</div>
					</div>
				</div>
			`);
			popover();
			envsubmit();
			$('#myModal').modal();
			$('#buttonCertStatusOK'+slug).on( "click", function() {
				$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
				});
				$.ajax({
				url: "{{url('/certificarservicio')}}/"+slug,
				method: 'GET',
				data:{},
				beforeSend: function(){
					let buttonsubmit = $('.classCertStatus'+slug);
					buttonsubmit.each(function() {
								$(this).on('click', function(event) {
									event.preventDefault();
								});
								$(this).disabled = true;
								$(this).prop('disabled', true);
							});
					buttonsubmit.empty();
					buttonsubmit.append(`<i class="fas fa-sync fa-spin"></i> Actualizando...`);
				},
				success: function(res){
					let buttonsubmit = $('.classCertStatus'+slug);
					switch (res['code']) {
						case 200:
							buttonsubmit.each(function() {
								$(this).on('click', function(event) {
									event.preventDefault();
								});
								$(this).disabled = true;
								$(this).prop('disabled', true);
							});
							buttonsubmit.prop('class', 'btn btn-default');
							buttonsubmit.empty();
							buttonsubmit.append(`<i class="fas fa-certificate"></i> Certificado`);

							toastr.success(res['message']);
							break;

						default:
							buttonsubmit.each(function() {
								$(this).on('click', function(event) {
									event.preventDefault();
								});
								$(this).disabled = false;
								$(this).prop('disabled', false);
							});
							buttonsubmit.prop('class', 'btn btn-success classCertStatus'+slug);
							buttonsubmit.empty();
							buttonsubmit.append(`<i class="fas fa-certificate"></i> Certificar`);

							toastr.error(res['error']);
							break;
					}
				},
				error: function(error){
					let buttonsubmit = $('.classCertStatus'+slug);
					switch (error['responseJSON']['code']) {
						case 400:
							buttonsubmit.each(function() {
								$(this).on('click', function(event) {
									event.preventDefault();
								});
								$(this).disabled = true;
								$(this).prop('disabled', true);
							});
							buttonsubmit.prop('class', 'btn btn-default');
							buttonsubmit.empty();
							buttonsubmit.append(`<i class="fas fa-certificate"></i> Certificado`);

							break;

						default:
							buttonsubmit.each(function() {
								$(this).on('click', function(event) {
									event.preventDefault();
								});
								$(this).disabled = false;
								$(this).prop('disabled', false);
							});
							buttonsubmit.prop('class', 'btn btn-success classCertStatus'+slug);
							buttonsubmit.empty();
							buttonsubmit.append(`<i class="fas fa-certificate"></i> Certificar`);

							break;
					}
					toastr.error(error['responseJSON']['message']);
				},
				complete: function(){
					//
				}
				})
			});
		}
	}
</script>
@endsection

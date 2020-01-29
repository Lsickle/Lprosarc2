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
									@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
										<th nowrap><span data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 100}' title="Status de la Solicitud" data-content="
									<p class='row'>
										<div class='col-md-6 col-sd-12 col-xs-12'>
											<ul>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-default'><i class='fas fa-lg fa-hourglass-start'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Pendiente</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-info'><i class='fas fa-lg fa-thumbs-up'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Aceptado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-info'><i class='fas fa-lg fa-tasks'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Aprobado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-success'><i class='fas fa-lg fa-calendar-alt'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Programado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-primary'><i class='far fa-lg fa-envelope'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Notificado</b> </li>
											</ul>
										</div>
										<div class='col-md-6 col-sd-12 col-xs-12'>
											<ul>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-success'><i class='fas fa-lg fa-truck-loading'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Completado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-warning'><i class='fas fa-lg fa-balance-scale-right'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>No Conciliado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-success'><i class='fas fa-lg fa-balance-scale'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Conciliado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-primary'><i class='fas fa-lg fa-dumpster-fire'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Tratado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-success'><i class='fas fa-lg fa-certificate'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Certificada</b> </li>
											</ul>
										</div>
									</p>
									"><i style="color: Dodgerblue;" class="fas fa-info-circle fa-spin"></i></span>{{trans('adminlte_lang::LangRespel.Respelevaluar')}}</th>
									@else
										<th nowrap><span data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 100}' title="Status del Residuo" data-content="
									<p class='row'>
										<div class='col-md-6 col-sd-12 col-xs-12'>
											<ul>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-default'><i class='fas fa-lg fa-hourglass-start'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Pendiente</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-info'><i class='fas fa-lg fa-thumbs-up'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Aceptado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-info'><i class='fas fa-lg fa-tasks'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Aprobado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-success'><i class='fas fa-lg fa-calendar-alt'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Programado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-primary'><i class='far fa-lg fa-envelope'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Notificado</b> </li>
											</ul>
										</div>
										<div class='col-md-6 col-sd-12 col-xs-12'>
											<ul>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-success'><i class='fas fa-lg fa-truck-loading'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Completado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-warning'><i class='fas fa-lg fa-balance-scale-right'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>No Conciliado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-success'><i class='fas fa-lg fa-balance-scale'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Conciliado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-primary'><i class='fas fa-lg fa-dumpster-fire'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Tratado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-success'><i class='fas fa-lg fa-certificate'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Certificada</b> </li>
											</ul>
										</div>
									</p>"><i style="color: Dodgerblue;" class="fas fa-info-circle fa-spin"></i></span>Status</th>
									@endif

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
										<td style="text-align: center;">{{date('Y/m/d', strtotime($Servicio->created_at))}}</td>
										<td style="text-align: center;">#{{$Servicio->ID_SolSer}}</td>
										@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE))
											@switch($Servicio->SolSerStatus)
												{{-- evaluación pendiente --}}
												@case('Pendiente')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Pendiente</b>" data-content="<p style='width: 50%'>La información de su solicitud sera procesada a la brevedad posible... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-default'><i class='fas fa-lg fa-hourglass-start'></i></a></td>
													@break
												{{-- residuo Rechazado --}}
												@case('Aceptado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Rechazado</b>" data-content="<p style='width: 50%'>Su solicitud de servicio ha sido admitida... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b></p>" class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-ban'></i></a></td>
													@break
												{{-- residuo Evaluado --}}
												@case('Aprobado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Evaluado</b>" data-content="<p style='width: 50%'>la solicitud de servicio ha sido revisada y actualmente se esta ubicando un espacio según la disponibilidad en nuestra agenda para la recoleccion de sus residuos... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b></p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-list'></i></a></td>
													@break
												{{-- residuo Cotizado --}}
												@case('Programado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Cotizado</b>" data-content="<p style='width: 50%'>la solicitud de servicio ha sido revisada y actualmente se esta ubicando un espacio según la disponibilidad en nuestra agenda para la recoleccion de sus residuos...  <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b></p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-comments-dollar'></i></a></td>
													@break
												{{-- residuo Aprobado --}}
												@case('Notificado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Aprobado</b>" data-content="<p style='width: 50%'>La fecha programada para la recoleccion de sus residuos a sido aprobada porfavor revise el correo electronico de la persona de contacto para tener le información de las fechas... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-thumbs-up'></i></a></td>
													@break
												@case('Recibido')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Aprobado</b>" data-content="<p style='width: 50%'>La evaluacion de su residuo a sido aprobada y puede comenzar a ralacionar el residuo con los generadores para realizar solicitudes de servicio... recuerde revisar la información del tratamiento y los requerimientos aprobados <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-thumbs-up'></i></a></td>
													@break
												{{-- cotización vencida --}}
												@case('Completado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Vencido</b>" data-content="<p style='width: 50%'>los residuos correspondientes a esta solicitud de servicio han sido recibidos en nuestra planta de procesos por favor verifique las cantidades recibidas en cada uno de los residuos, para luego marcar la solicitud como Conciliada/No Conciliada según corresponda... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-calendar-times'></i></a></td>
													@break
												{{-- Información Incompleta --}}
												@case('Conciliado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Incompleto</b>" data-content="<p style='width: 50%'>su solicitud de servicio a sido conciliada correctamente y pronto se realizara el tratamiento de los residuos y la correspondiente carga de los Certificados/Manifiestos... <br>Por favor comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-tasks'></i></a></td>
													@break
												{{-- Información Revisado --}}
												@case('No Conciliado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Revisado</b>" data-content="<p style='width: 50%'>alguna de las cantidades recibidas no corresponde con los valores esperados y se realizaran las respectivas validaciones entre <b>Prosarc S.A. ESP.</b> y la persona de Contacto adicionalmente puede revisar el registro fotografico ingresando a los detalles de cada residuo... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-check-double'></i></a></td>
													@break
												{{-- Información Revisado --}}
												@case('Tratado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tarjeta de emergencia no valida</b>" data-content="<p style='width: 50%'>Todos los residuos de esta solicitud de servicio han sido Tratados Satisfactoriamente en breve se cargaran en el sistema <b>SisPRO</b> los archivos de Certificados/Manifiestos Según Corresponda... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-file-pdf'></i></a></td>
													@break
												{{-- TDE actualizada --}}
												@case('Certificada')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tarjeta de emergencia actualizada</b>" data-content="<p style='width: 50%'>Los archivos correspondientes a Certificados ya se encuentran disponibles para su visualizacion y descarga... se le enviara una notificacion por correo en el momento que los Manifiestos ya esten disponibles para su descarga desde el sistema <b>SisPRO</b>... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-file-pdf'></i></a></td>
													@break
												{{-- opción default --}}
												@default
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Indefinido</b>" data-content="<p style='width: 50%'>Status Indefinido... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-ban'></i></a></td>
											@endswitch
										@else
											@switch($Servicio->SolSerStatus)
												{{-- evaluación pendiente --}}
												@case('Pendiente')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Pendiente</b>" data-content="<p style='width: 50%'>Las solicitudes nuevas solo se puede gestionar previa autorización del Área <b>Tesorería</b>... </p>" class='btn fixed_widthbtn btn-default'><i class='fas fa-lg fa-hourglass-start'></i></a></td>
													@break
												{{-- residuo Rechazado --}}
												@case('Aceptado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Rechazado</b>" data-content="<p style='width: 50%'>la solicitud de servicio ha sido Admitida por Tesoreria y debe ser revisada por el Asistente de Logistica para validar las condiciones del servicio y las cantidades de los residuos... <br>Para mas detalles comuníquese con el <b>Asistente de Logistica</b> </p>" class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-ban'></i></a></td>
													@break
												{{-- residuo Evaluado --}}
												@case('Aprobado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Evaluado</b>" data-content="<p style='width: 50%'>la Solicitud ha sido revisada por el Asistente de Logistica satisfactoriamente y ahora se debe crear en el calendario las programaciones de servicios Necesarias para la recoleccion de los residuos correspondientes a esta solicitud... <br>Para mas detalles comuníquese con el <b>Jefe de Logistica</b></p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-list'></i></a></td>
													@break
												{{-- residuo Cotizado --}}
												@case('Programado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Cotizado</b>" data-content="<p style='width: 50%'>ya se han creado las programaciones de servicios necesarias para la recoleccion de los residuos correspondientes a esta solicitud... el area de tesoreria debera autorizar dichas recolecciones/programaciones para que los conductores puedan visualizar las y ejecutarlas en la fecha que corresponda <br>Para mas detalles comuníquese con el <b>Jefe de Logistica</b></p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-comments-dollar'></i></a></td>
													@break
												{{-- residuo Aprobado --}}
												@case('Notificado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Aprobado</b>" data-content="<p style='width: 50%'>El Area de tesoreria ha autorizado la ejecucion de las programaciones/recolecciones correspondientes a esta solicitud... adicionalmente se ha enviado automaticamente una notificacion por correo electronico a la persona de contacto del cleinte informando la fecha de la programacion de servicio <br>Para mas detalles comuníquese con el <b>Jefe de Logistica</b> </p>" class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-thumbs-up'></i></a></td>
													@break
												{{-- cotización vencida --}}
												@case('Recibido')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Vencido</b>" data-content="<p style='width: 50%'>las programaciones correspondientes a este servicio han sido recibidas en planta de procesos... el area de RecepcionPDA precedera a cargar la informacion de las cantidades recibidas y las fotos del pesaje/descarge de cada residuo  <br>Para mas detalles comuníquese con el <b>RecepcionPDA</b> </p>" class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-calendar-times'></i></a></td>
													@break
												{{-- información del residuo incompleta --}}
												@case('Completado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Incompleto</b>" data-content="<p style='width: 50%'>todos los residuos de esta solicitud de servicio han sido recibidos en planta y se han cargado las cantidades correspondientes... automaticamente se envio un correo electronico a la persona de contacto de esta solicitud para que revise las cantidades recibidas... se debera esperar a que el cliente acepte o rechalos pesos enviados a conciliación <br>Para mas detalles comuníquese con el <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-tasks'></i></a></td>
													@break
												{{-- Residuo Revisado --}}
												@case('Conciliado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Revisado</b>" data-content="<p style='width: 50%'>El cleinte ha aceptado las cantidades enviadas a conciliacion y el area de Operaciones puede comenzar con el tratamiento de los residuos... adicionalmente tambien se puede adelantar el proceso de certificacion de los residuos con tratamiento de Termodestruccion<br>Para mas detalles comuníquese con el <b>Área de Logística</b> </p>" class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-check-double'></i></a></td>
													@break
												{{-- falta la TDE --}}
												@case('No Conciliado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tarjeta de emergencia no valida</b>" data-content="<p style='width: 50%'>algunas de las cantidades de residuos enviadas a conciliacion ha sido rechazada pro el cliente... <br>Para mas detalles comuníquese con el <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-file-pdf'></i></a></td>
													@break
												{{-- TDE actualizada --}}
												@case('Tratado')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tarjeta de emergencia actualizada</b>" data-content="<p style='width: 50%'> todos los residuos de este servicio han sido tratados satisfactoriamente... sin embargo el area de tesoreria debera autorizar al cliente para la descarga de manifiestos/Certificados y los Certificados de otros Gestores seran cargados en el Sitema SisPRO segun se vayan recibiendo... <br>Para mas detalles comuníquese con el <b>Jefe de Operaciones</b> </p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-file-pdf'></i></a></td>
													@break
												@case('Certificada')
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tarjeta de emergencia actualizada</b>" data-content="<p style='width: 50%'>Los archivos correspondientes a Certificados ya se encuentran disponibles para su visualizacion y descarga por parte del cliente... el area de Operaciones enviara una notificacion por correo al Asesor Comercial que corresponda en el momento que los Manifiestos/Certificados de Otros Gestores esten disponibles para su descarga desde el sistema <b>SisPRO</b>... <br>Para mas detalles comuníquese con el <b>Asesor Comercial</b> o con el <b>Jefe de Operaciones</b> según corresponda</p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-file-pdf'></i></a></td>
													@break
												{{-- opción default --}}
												@default
													<td class="text-center"><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Indefinido</b>" data-content="<p style='width: 50%'>Status Indefinido... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-ban'></i></a></td>
											@endswitch
										@endif
										@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
												<td><a data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Persona de Contacto</b>" data-content="<p>Datos de la persona de Contacto para esta Solicitud de Servicio</p><ul><li>{{$Servicio->PersFirstName}} {{$Servicio->PersLastName}}</li><li>{{$Servicio->PersEmail}}</li><li>{{$Servicio->PersCellphone}}</li></ul><p>Haga click para ver detalles adicionales de este cliente..." href="/clientes/{{$Servicio->CliSlug}}" target="_blank"><i class="fas fa-user"></i></a>{{$Servicio->CliName}}</td>
										@endif
										@if(in_array(Auth::user()->UsRol, Permisos::SEDECOMERCIAL))
											<th>{{$Servicio->TipoFacturacion}}</th>
											<th>{{$Servicio->CliStatus}}</th>
										@endif
										@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
											<td><i data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-title="<b>Comercial Asignado</b>" data-content="<ul><li>{{$Servicio->ComercialPersFirstName}} {{$Servicio->ComercialPersLastName}}</li><li>{{$Servicio->ComercialPersEmail}}</li><li>{{$Servicio->ComercialPersCellphone}}</li></ul>" class="fas fa-user-tie" style="color:green;"></i> {{$Servicio->ComercialPersFirstName.' '.$Servicio->ComercialPersLastName}}</td>
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
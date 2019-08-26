@extends('layouts.app')
@section('htmlheader_title', trans('adminlte_lang::LangRespel.Respellist'))
@section('contentheader_title', trans('adminlte_lang::LangRespel.Respellist'))
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-12 col-md-offset-0">
			<!-- /.box -->
			<div class="box">
				@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::PROGRAMADOR))
					<div class="box-header">
						<a href="respels/create" class="btn btn-primary" style="float: right;">{{trans('adminlte_lang::LangRespel.CreaterespelButton')}}</a>
					</div>
				@endif
				<!-- /.box-header -->
				<div class="box box-info">
					<div class="box-body">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>{{trans('adminlte_lang::LangRespel.RespelName')}}</th>
									<th>{{trans('adminlte_lang::LangRespel.Respelclas')}}</th>
									<th>{{trans('adminlte_lang::LangRespel.Respeligro')}}</th>
									<th>{{trans('adminlte_lang::LangRespel.Respelestado')}}</th>
									<th>{{trans('adminlte_lang::LangRespel.Respelhoja')}}</th>
									<th>{{trans('adminlte_lang::LangRespel.Respeltarj')}}</th>
									@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
										<th>{{trans('adminlte_lang::LangRespel.Respelcliente')}}</th>
									@endif
									<th>{{trans('adminlte_lang::LangRespel.RespelStatus')}}</th>
									@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
										<th nowrap><span data-placement="left" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 100}' title="Status del Residuo" data-content="<ul><li><a class='fixed_widthbtn btn btn-default'><i class='fas fa-lg fa-hourglass-start'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Pendiente</b> </li><li><a class='fixed_widthbtn btn btn-warning'><i class='fas fa-lg fa-tasks'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Incompleta</b> </li><li><a class='fixed_widthbtn btn btn-danger'><i class='fas fa-lg fa-ban'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Rechazado</b> </li><li><a class='fixed_widthbtn btn btn-primary'><i class='fas fa-lg fa-thumbs-up'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Aprobado</b> </li><li><a class='fixed_widthbtn btn btn-success'><i class='fas fa-lg fa-check-double'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Revisado</b> </li><li><a class='fixed_widthbtn btn btn-danger'><i class='fas fa-lg fa-calendar-times'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Vencido</b> </li></ul>"><i style="color: Dodgerblue;" class="fas fa-info-circle fa-spin"></i></span>{{trans('adminlte_lang::LangRespel.Respelevaluar')}}</th>
									@else
										<th nowrap><span data-placement="left" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 100}' title="Status del Residuo" data-content="<ul><li><a class='fixed_widthbtn btn btn-default'><i class='fas fa-lg fa-hourglass-start'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Pendiente</b> </li><li><a class='fixed_widthbtn btn btn-warning'><i class='fas fa-lg fa-tasks'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Incompleta</b> </li><li><a class='fixed_widthbtn btn btn-danger'><i class='fas fa-lg fa-ban'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Rechazado</b> </li><li><a class='fixed_widthbtn btn btn-primary'><i class='fas fa-lg fa-thumbs-up'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Aprobado</b> </li><li><a class='fixed_widthbtn btn btn-success'><i class='fas fa-lg fa-check-double'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Revisado</b> </li><li><a class='fixed_widthbtn btn btn-danger'><i class='fas fa-lg fa-calendar-times'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Vencido</b> </li></ul>"><i style="color: Dodgerblue;" class="fas fa-info-circle fa-spin"></i></span>{{trans('adminlte_lang::LangRespel.Respelver')}}</th>
									@endif
								</tr>
							</thead>
							<tbody id="readyTable">
								@foreach($Respels as $respel)
									@if($respel->RespelDelete == 1)
										<tr style="color: red;">
									@else
										<tr>
									@endif
									<td class="text-center">{{$respel->RespelName}}</td>

									@if($respel->YRespelClasf4741 <> null)
										<td class="text-center">{{$respel->YRespelClasf4741}}</td>
									@elseif($respel->ARespelClasf4741 <> null)
										<td class="text-center">{{$respel->ARespelClasf4741}}</td>
									@else()
										<td class="text-center">N/A</td>
									@endif

									<td class="text-center">{{$respel->RespelIgrosidad}}</td>
									<td class="text-center">{{$respel->RespelEstado}}</td>

									@if($respel->RespelHojaSeguridad!=="RespelHojaDefault.pdf")
										<td class="text-center"><a method='get' href='/img/HojaSeguridad/{{$respel->RespelHojaSeguridad}}' class='btn btn-primary'><i class='fas fa-file-pdf fa-lg'></a></td>
									@else
										<td class="text-center"><a disabled method='get' href='/img/{{$respel->RespelHojaSeguridad}}' class='btn btn-default'><i class='fas fa-file-pdf fa-lg'></a></td>
									@endif

									@if($respel->RespelTarj!=="RespelTarjetaDefault.pdf")
										<td class="text-center"><a method='get' href='/img/TarjetaEmergencia/{{$respel->RespelTarj}}' class='btn btn-primary'><i class='fas fa-file-pdf fa-lg'></a></td>
									@else
										<td class="text-center"><a disabled method='get' href='/img/{{$respel->RespelTarj}}' class='btn btn-default'><i class='fas fa-file-pdf fa-lg'></a></td>
									@endif

									@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
										<td class="text-center">{{$respel->CliName}}</td>
									@endif
									<td class="text-center">{{$respel->RespelStatus}}</td>
									@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE))
										@switch($respel->RespelStatus)
											{{-- evaluación pendiente --}}
											@case('Pendiente')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Pendiente</b>" data-content="<p style='width: 50%'> la información de su residuo debe ser analizada para asignarle un tratamiento adecuado y las tarifas que les corresponden segun el tratamiento... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-default'><i class='fas fa-lg fa-hourglass-start'></i></a></td>
												@break
											{{-- residuo Rechazado --}}
											@case('Rechazado')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Rechazado</b>" data-content="<p style='width: 50%'> la viabilizacion de su residuo ha sido rechazada y/o no se disponen de tratamientos acordes a sus necesidades... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b></p>" class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-ban'></i></a></td>
												@break
											{{-- residuo Evaluado --}}
											@case('Evaluado')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Evaluado</b>" data-content="<p style='width: 50%'> el Residuo ya posee un tratamiento viable asignados, sin embargo, debe esperar a que se le asignen las tarifas de acuerdo al tratamiento... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b></p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-list'></i></a></td>
												@break
											{{-- residuo Cotizado --}}
											@case('Cotizado')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Cotizado</b>" data-content="<p style='width: 50%'> el Residuo ya posee un tarifas y tratamientos asignados, sin embargo, se debe esperar a que las tarifas sean aprobadas <br>Para mas detalles comuníquese con la <b>Asesor Comercial</b></p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-money'></i></a></td>
												@break
											{{-- residuo Aprobado --}}
											@case('Aprobado')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Aprobado</b>" data-content="<p style='width: 50%'> la evaluacion de su residuo a sido aprobada y puede comenzar a realizar solicitudes de servicio... recuerde revisar la informacion del tratamiento y las tarifas aprobadas <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-thumbs-up'></i></a></td>
												@break
											{{-- cotización vencida --}}
											@case('Vencido')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Vencido</b>" data-content="<p style='width: 50%'> Las tarifas asignadas a su residuo exceden de la fecha aprobada por lo cual podrian ser facturadas a un precio diferente... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-calendar-times'></i></a></td>
												@break
											{{-- Informacion Incompleta --}}
											@case('Incompleto')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Incompleto</b>" data-content="<p style='width: 50%'> la informacion suministrada en el registro de su residuo no es sufiiente para poder asignar un tratamiento viable... <br>Por favor comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-tasks'></i></a></td>
												@break
											{{-- Informacion Revisado --}}
											@case('Revisado')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Revisado</b>" data-content="<p style='width: 50%'> su residuo ha sido revisado por el area de logistica y cuenta con la documentacion necesaia para ser transportado por nuestros vehiculos... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-check-double'></i></a></td>
												@break
											{{-- Informacion Revisado --}}
											@case('Falta TDE')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tarjeta de emergencia no valida</b>" data-content="<p style='width: 50%'> la tarjeta de emergencia adjuntada no corresponde con la información de su residuo, debe adjuntar la tarjeta de emergencia correcta para que sus solicitudes de servicio puedan ser programadas con los vehiculos de <b>Prosarc.ESP.S.A.</b> ... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-file-pdf'></i></a></td>
												@break
											{{-- opción default --}}
											@default
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Pendiente</b>" data-content="<p style='width: 50%'> la información de su residuo debe ser analizada para asignarle un tratamiento adecuado y las tarifas que les corresponden segun el tratamiento... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-ban'></i></a></td>
										@endswitch
									@else
										@switch($respel->RespelStatus)
											{{-- evaluación pendiente --}}
											@case('Pendiente')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Pendiente</b>" data-content="<p style='width: 50%'> Residuo registrado por el cliente que debe ser evaluado por el area encargada para asignar tratamientos viables... <br>Para mas detalles comuníquese con el <b>Jefe de Operaciones</b> </p>" class='btn fixed_widthbtn btn-default'><i class='fas fa-lg fa-hourglass-start'></i></a></td>
												@break
											{{-- residuo Rechazado --}}
											@case('Rechazado')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Rechazado</b>" data-content="<p style='width: 50%'> la viabilizacion de su residuo ha sido rechazada y/o no se disponen de tratamientos acordes a sus necesidades... <br>Para mas detalles comuníquese con el <b>Jefe de Operaciones</b> </p>" class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-ban'></i></a></td>
												@break
											{{-- residuo Evaluado --}}
											@case('Evaluado')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Evaluado</b>" data-content="<p style='width: 50%'> el Residuo ya posee un tratamiento viable asignados, sin embargo, el <b>Asesor Comercial</b> debe asignar las tarifas de acuerdo al tratamiento y ofertar alguna de las opciones... <br>Para mas detalles comuníquese con el <b>Jefe de Operaciones</b></p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-list'></i></a></td>
												@break
											{{-- residuo Cotizado --}}
											@case('Cotizado')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Cotizado</b>" data-content="<p style='width: 50%'> el Residuo ya posee un tarifas y tratamientos asignados, sin embargo, se debe esperar a que sea aprobado por <b>Subgerencia</b> <br>Para mas detalles comuníquese con la <b>Subgerencia</b></p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-money'></i></a></td>
												@break
											{{-- residuo Aprobado --}}
											@case('Aprobado')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Aprobado</b>" data-content="<p style='width: 50%'> los tratamientos y tarifas del residuo han sido aprobadas por la <b>Subgerencia</b> y el cliente puede comenzar a realizar solicitudes de servicio... es importante revisar la informacion del tratamiento ofertado... <br>Para mas detalles comuníquese con el <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-thumbs-up'></i></a></td>
												@break
											{{-- cotización vencida --}}
											@case('Vencido')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Vencido</b>" data-content="<p style='width: 50%'> Las tarifas asignadas al residuo exceden de la fecha negociada por el <b>Asesor Comercial</b> por lo cual podrian ser facturadas a un precio diferente... <br>Para mas detalles comuníquese con el <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-calendar-times'></i></a></td>
												@break
											{{-- información del residuo incompleta --}}
											@case('Incompleto')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Incompleto</b>" data-content="<p style='width: 50%'> la informacion suministrada en el registro de su residuo no es sufiiente para poder asignar un tratamiento viable... <br>Para mas detalles comuníquese con el <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-tasks'></i></a></td>
												@break
											{{-- Residuo Revisado --}}
											@case('Revisado')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Revisado</b>" data-content="<p style='width: 50%'> el residuo ha sido revisado por el area de logistica y cuenta con la documentacion necesaria para ser transportado por nuestros vehiculos... <br>Para mas detalles comuníquese con el <b>Area de Logistica</b> </p>" class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-check-double'></i></a></td>
												@break
											{{-- Informacion Revisado --}}
											@case('Falta TDE')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tarjeta de emergencia no valida</b>" data-content="<p style='width: 50%'> la tarjeta de emergencia adjuntada no corresponde con la información del residuo, el cliente debe adjuntar la tarjeta de emergencia correcta para que las solicitudes de servicio puedan ser programadas con los vehiculos de <b>Prosarc.ESP.S.A.</b> ... <br>Para mas detalles comuníquese con el <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-file-pdf'></i></a></td>
												@break
											{{-- opción default --}}
											@default
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Pendiente</b>" data-content="<p style='width: 50%'> Residuo registrado por el cliente que debe ser evaluado por el area encargada para asignar tratamientos viables... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-search'></i></a></td>
										@endswitch
									@endif
								</tr>
								@endforeach
							</tbody>
							{{-- <tfoot>
							<tr>
								<th>Nombre</th>
								<th>Clasificación 4741 Y</th>
								<th>Clasificación 4741 A</th>
								<th>Peligrosidad</th>
								<th>Estado del residuo</th>
								<th>Hoja de Seguridad</th>
								<th>Tarj. de Emergencia</th>
								<th>Estado</th>
								<th>Generado por</th>
								<th>Ver Más...</th>
							</tr>
							</tfoot> --}}
						</table>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</div>
@endsection
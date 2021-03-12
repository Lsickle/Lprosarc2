@extends('layouts.app')
@section('htmlheader_title', trans('adminlte_lang::LangRespel.Respellist'))
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #d4fc79, #00C851); padding-right:30vw; position:relative; overflow:hidden;">
	Residuos Comunes
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- /.box -->
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::LangRespel.Respellist') }}</h3 class="pull-left">
					@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
						<a href="respelspublic/create" class="btn btn-primary" style="float: right;">Nuevo Residuo Común</a>
					@elseif(in_array(Auth::user()->UsRol, Permisos::CLIENTE)||in_array(Auth::user()->UsRol2, Permisos::CLIENTE))
						
					@else
						<a href="#" disabled class="btn btn-default pull-right" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Nuevo Residuo Común</b>" data-content="<p style='width: 50%'>Su cuenta no posee los permisos necesarios para agregar nuevos residuos comunes </p>">{{trans('adminlte_lang::LangRespel.CreaterespelButton')}}</a>
					@endif
				</div>
				<!-- /.box-header -->
				<div class="box box-info">
					<div class="box-body">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Actualizado</th>
									<th>Categoría</th>
									<th>SubCategoría</th>
									<th>{{trans('adminlte_lang::LangRespel.RespelName')}}</th>
									<th>{{trans('adminlte_lang::LangRespel.Respelclas')}}</th>
									<th>{{trans('adminlte_lang::LangRespel.Respelhoja')}}</th>
									<th>{{trans('adminlte_lang::LangRespel.Respeltarj')}}</th>
									@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE))
									<th nowrap><span data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 100}' title="Status del Residuo" data-content="
									<p class='row'>
										<div class='col-md-6 col-sd-12 col-xs-12'>
											<ul>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-default'><i class='fas fa-lg fa-hourglass-start'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Pendiente</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-primary'><i class='fas fa-lg fa-list'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Evaluado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-primary'><i class='fas fa-lg fa-comments-dollar'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Cotizado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-success'><i class='fas fa-lg fa-thumbs-up'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Aprobado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-success'><i class='fas fa-lg fa-check-double'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Revisado</b> </li>
											</ul>
										</div>
										<div class='col-md-6 col-sd-12 col-xs-12'>
											<ul>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-warning'><i class='fas fa-lg fa-tasks'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Incompleto</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-danger'><i class='fas fa-lg fa-ban'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Rechazado</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-warning'><i class='fas fa-lg fa-file-pdf'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Falta TDE</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-primary'><i class='fas fa-lg fa-file-pdf'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>TDE actualizada</b> </li>
												<li class='text-nowrap'><a class='fixed_widthbtn btn btn-danger'><i class='fas fa-lg fa-calendar-times'></i></a><i class='fas fa-lg fa-arrow-right'></i> <b>Vencido</b> </li>
											</ul>
										</div>
									</p>"><i style="color: Dodgerblue;" class="fas fa-info-circle fa-spin"></i></span>Copiar</th>
									@endif
									@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
									<th>Ver</th>
									@endif
									@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
									<th>evaluar</th>
									@endif
									<th>{{trans('adminlte_lang::LangRespel.Respeligro')}}</th>
									<th>{{trans('adminlte_lang::LangRespel.Respelestado')}}</th>
								</tr>
							</thead>
							<tbody id="readyTable">
								@foreach($PublicRespels as $respel)
									@if((in_array(Auth::user()->UsRol, Permisos::CLIENTE)&&($respel->RespelStatus == "Aprobado" || $respel->RespelStatus == "Revisado")||$respel->RespelStatus == "Evaluado"||$respel->RespelStatus == "Cotizado")||in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
									@if($respel->RespelDelete == 1)
										<tr style="color: red;">
									@else
										<tr>
									@endif
									<td>{{ \Carbon\Carbon::parse($respel->updated_at)->diffForHumans() }}</td>

									@if($respel->FK_SubCategoryRP != null)
									<td class="text-center">{{$respel->SubcategoryRespelpublic->CategoryRP->CategoryRpName}}</td>
									<td class="text-center">{{$respel->SubcategoryRespelpublic->SubCategoryRpName}}</td>
									@else
										<td class="text-center">Sin Categoria</td>
										<td class="text-center">N/A</td>
									@endif

									<td class="text-center">{{$respel->RespelName}}</td>

									@if($respel->YRespelClasf4741 <> null)
										<td class="text-center">{{$respel->YRespelClasf4741}}</td>
									@elseif($respel->ARespelClasf4741 <> null)
										<td class="text-center">{{$respel->ARespelClasf4741}}</td>
									@else
										<td class="text-center">N/A</td>
									@endif


									@if($respel->RespelHojaSeguridad!=="RespelHojaDefault.pdf")
										<td class="text-center"><a method='get' href='/img/HojaSeguridad/{{$respel->RespelHojaSeguridad}}' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></a></td>
									@else
										<td class="text-center"><a disabled method='get' href='/img/{{$respel->RespelHojaSeguridad}}' class='btn btn-default'><i class='fas fa-file-pdf fa-lg'></a></td>
									@endif

									@if($respel->RespelTarj!=="RespelTarjetaDefault.pdf")
										<td class="text-center"><a method='get' href='/img/TarjetaEmergencia/{{$respel->RespelTarj}}' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></a></td>
									@else
										<td class="text-center"><a disabled method='get' href='/img/{{$respel->RespelTarj}}' class='btn btn-default'><i class='fas fa-file-pdf fa-lg'></a></td>
									@endif
									
									@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE))
										@switch($respel->RespelStatus)
											{{-- evaluación pendiente --}}
											@case('Pendiente')
												<td class="text-center"><a method='get' href='/respelspublic/{{$respel->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Pendiente</b>" data-content="<p style='width: 50%'> la información de este residuo debe ser analizada para asignarle un tratamiento adecuado y las tarifas que les corresponden segun el tratamiento... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-default'><i class='fas fa-lg fa-hourglass-start'></i></a></td>
												@break
											{{-- residuo Rechazado --}}
											@case('Rechazado')
												<td class="text-center"><a method='get' href='/respelspublic/{{$respel->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Rechazado</b>" data-content="<p style='width: 50%'> la viabilizacion de este residuo ha sido rechazada y/o no se disponen de tratamientos acordes a sus necesidades... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b></p>" class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-ban'></i></a></td>
												@break
											{{-- residuo Evaluado --}}
											@case('Evaluado')
												<td class="text-center"><a method='get' href='/respelspublic/{{$respel->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Evaluado</b>" data-content="<p style='width: 50%'> el Residuo ya posee un tratamiento viable asignados, sin embargo, debe esperar a que se le asignen las tarifas de acuerdo al tratamiento... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b></p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-list'></i></a></td>
												@break
											{{-- residuo Cotizado --}}
											@case('Cotizado')
												<td class="text-center"><a method='get' href='/respelspublic/{{$respel->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Cotizado</b>" data-content="<p style='width: 50%'> el Residuo ya posee un tarifas y tratamientos asignados, sin embargo, se debe esperar a que las tarifas sean aprobadas <br>Para mas detalles comuníquese con la <b>Asesor Comercial</b></p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-comments-dollar'></i></a></td>
												@break
											{{-- residuo Aprobado --}}
											@case('Aprobado')
												<td class="text-center"><a method='get' href='/respelspublic/{{$respel->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Aprobado</b>" data-content="<p style='width: 50%'> la evaluacion de este residuo a sido aprobada y puede comenzar a realizar solicitudes de servicio... recuerde revisar la informacion del tratamiento y las tarifas aprobadas <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-thumbs-up'></i></a></td>
												@break
											{{-- cotización vencida --}}
											@case('Vencido')
												<td class="text-center"><a method='get' href='/respelspublic/{{$respel->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Vencido</b>" data-content="<p style='width: 50%'> Las tarifas asignadas a este residuo exceden de la fecha aprobada por lo cual podrian ser facturadas a un precio diferente... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-calendar-times'></i></a></td>
												@break
											{{-- Informacion Incompleta --}}
											@case('Incompleto')
												<td class="text-center"><a method='get' href='/respelspublic/{{$respel->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Incompleto</b>" data-content="<p style='width: 50%'> la informacion suministrada en el registro de este residuo no es sufiiente para poder asignar un tratamiento viable... <br>Por favor comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-tasks'></i></a></td>
												@break
											{{-- Informacion Revisado --}}
											@case('Revisado')
												<td class="text-center"><a method='get' href='/respelspublic/{{$respel->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Revisado</b>" data-content="<p style='width: 50%'> este residuo ha sido revisado por el area de logistica y cuenta con la documentacion necesaia para ser transportado por nuestros vehiculos... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-check-double'></i></a></td>
												@break
											{{-- Informacion Revisado --}}
											@case('Falta TDE')
												<td class="text-center"><a method='get' href='/respelspublic/{{$respel->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tarjeta de emergencia no valida</b>" data-content="<p style='width: 50%'> la tarjeta de emergencia adjuntada no corresponde con la información de este residuo, debe adjuntar la tarjeta de emergencia correcta para que sus solicitudes de servicio puedan ser programadas con los vehiculos de <b>Prosarc.ESP.S.A.</b> ... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-file-pdf'></i></a></td>
												@break
											{{-- opción default --}}
											@default
												<td class="text-center"><a method='get' href='/respelspublic/{{$respel->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Pendiente</b>" data-content="<p style='width: 50%'> la información de este residuo debe ser analizada para asignarle un tratamiento adecuado y las tarifas que les corresponden segun el tratamiento... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-ban'></i></a></td>
										@endswitch
									@elseif(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
											<td class="text-center"><a method='get' href='/respelspublic/{{$respel->RespelSlug}}' class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-eye'></i></a></td>
									@endif
									@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
									@switch($respel->RespelStatus)
											{{-- evaluación pendiente --}}
											@case('Pendiente')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Pendiente</b>" data-content="<p style='width: 50%'> Residuo registrado por el cliente que debe ser evaluado por el area encargada para asignar tratamientos viables... <br>Para mas detalles comuníquese con el <b>Jefe de Operaciones</b> </p>" class='btn fixed_widthbtn btn-default'><i class='fas fa-lg fa-hourglass-start'></i></a></td>
												@break
											{{-- residuo Rechazado --}}
											@case('Rechazado')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Rechazado</b>" data-content="<p style='width: 50%'> la viabilizacion de este residuo ha sido rechazada y/o no se disponen de tratamientos acordes a sus necesidades... <br>Para mas detalles sobre la evaluación comuníquese con el <b>Jefe de Operaciones</b> </p>" class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-ban'></i></a></td>
												@break
											{{-- residuo Evaluado --}}
											@case('Evaluado')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Evaluado</b>" data-content="<p style='width: 50%'> el Residuo ya posee un tratamiento viable asignados, sin embargo, el <b>Asesor Comercial</b> debe asignar las tarifas de acuerdo al tratamiento y ofertar alguna de las opciones... <br>Para mas detalles sobre la evaluación comuníquese con el <b>Jefe de Operaciones</b></p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-list'></i></a></td>
												@break
											{{-- residuo Cotizado --}}
											@case('Cotizado')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Cotizado</b>" data-content="<p style='width: 50%'> el Residuo ya posee un tarifas y tratamientos asignados, sin embargo, se debe esperar a que sea aprobado por <b>Subgerencia</b> <br>Para mas detalles comuníquese con la <b>Subgerencia</b></p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-comments-dollar'></i></a></td>
												@break
											{{-- residuo Aprobado --}}
											@case('Aprobado')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Aprobado</b>" data-content="<p style='width: 50%'> los tratamientos y tarifas de este residuo han sido aprobadas por la <b>Subgerencia</b> y el cliente puede comenzar a realizar solicitudes de servicio... es importante revisar la informacion del tratamiento ofertado... <br>Para mas detalles comuníquese con el <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-thumbs-up'></i></a></td>
												@break
											{{-- cotización vencida --}}
											@case('Vencido')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Vencido</b>" data-content="<p style='width: 50%'> Las tarifas asignadas a este residuo exceden de la fecha negociada por el <b>Asesor Comercial</b> por lo cual podrian ser facturadas a un precio diferente... <br>Para mas detalles comuníquese con el <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-calendar-times'></i></a></td>
												@break
											{{-- información del residuo incompleta --}}
											@case('Incompleto')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Incompleto</b>" data-content="<p style='width: 50%'> la informacion suministrada en el registro de este residuo no es sufiiente para poder asignar un tratamiento viable... <br>Para mas detalles sobre la evaluación comuníquese con el <b>Jefe de Operaciones</b> </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-tasks'></i></a></td>
												@break
											{{-- Residuo Revisado --}}
											@case('Revisado')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Revisado</b>" data-content="<p style='width: 50%'> el residuo ha sido revisado por el area de logistica y cuenta con la documentacion necesaria para ser transportado por nuestros vehiculos... <br>Para mas detalles comuníquese con el <b>Area de Logistica</b> </p>" class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-check-double'></i></a></td>
												@break
											{{-- falta la TDE --}}
											@case('Falta TDE')
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tarjeta de emergencia no valida</b>" data-content="<p style='width: 50%'> la tarjeta de emergencia adjuntada no corresponde con la información de este residuo, el cliente debe adjuntar la tarjeta de emergencia correcta para que las solicitudes de servicio puedan ser programadas con los vehiculos de <b>Prosarc.ESP.S.A.</b> ... <br>Para mas detalles comuníquese con el <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-file-pdf'></i></a></td>
												@break
											{{-- opción default --}}
											@default
												<td class="text-center"><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Status Pendiente</b>" data-content="<p style='width: 50%'> Residuo registrado por el cliente que debe ser evaluado por el area encargada para asignar tratamientos viables... <br>Para mas detalles comuníquese con su <b>Asesor Comercial</b> </p>" class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-search'></i></a></td>
										@endswitch
										@endif
									<td class="text-center">{{$respel->RespelIgrosidad}}</td>
									<td class="text-center">{{$respel->RespelEstado}}</td>
								</tr>
								@endif
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
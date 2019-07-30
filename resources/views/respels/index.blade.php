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
									@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
										<th>{{trans('adminlte_lang::LangRespel.Respelcliente')}}</th>
									@endif
									<th>{{trans('adminlte_lang::LangRespel.RespelStatus')}}</th>
									@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
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
									<td>{{$respel->RespelName}}</td>

									@if($respel->YRespelClasf4741 <> null)
										<td>{{$respel->YRespelClasf4741}}</td>
									@elseif($respel->ARespelClasf4741 <> null)
										<td>{{$respel->ARespelClasf4741}}</td>
									@else()
										<td>N/A</td>
									@endif

									<td>{{$respel->RespelIgrosidad}}</td>
									<td>{{$respel->RespelEstado}}</td>

									@if($respel->RespelHojaSeguridad!=="RespelHojaDefault.pdf")
										<td><a method='get' href='/img/HojaSeguridad/{{$respel->RespelHojaSeguridad}}' class='btn btn-primary'><i class='fas fa-file-pdf fa-lg'></a></td>
									@else
										<td><a disabled method='get' href='/img/{{$respel->RespelHojaSeguridad}}' class='btn btn-default'><i class='fas fa-file-pdf fa-lg'></a></td>
									@endif

									@if($respel->RespelTarj!=="RespelTarjetaDefault.pdf")
										<td><a method='get' href='/img/TarjetaEmergencia/{{$respel->RespelTarj}}' class='btn btn-primary'><i class='fas fa-file-pdf fa-lg'></a></td>
									@else
										<td><a disabled method='get' href='/img/{{$respel->RespelTarj}}' class='btn btn-default'><i class='fas fa-file-pdf fa-lg'></a></td>
									@endif

									@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
										<td>{{$respel->CliName}}</td>
									@endif
									<td>{{$respel->RespelStatus}}</td>
									@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
										@switch($respel->RespelStatus)
											{{-- evaluación pendiente --}}
											@case('Pendiente')
												<td><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' class='btn fixed_widthbtn btn-default'><i class='fas fa-lg fa-hourglass-start'></i></a></td>
												@break
											{{-- residuo Rechazado --}}
											@case('Rechazado')
												<td><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-ban'></i></a></td>
												@break
											{{-- residuo Aprobado --}}
											@case('Aprobado')
												<td><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-thumbs-up'></i></a></td>
												@break
											{{-- cotización vencida --}}
											@case('Vencido')
												<td><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-calendar-times'></i></a></td>
												@break
											{{-- Informacion Incompleta --}}
											@case('Incompleto')
												<td><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-tasks'></i></a></td>
												@break
											{{-- Informacion Revisado --}}
											@case('Revisado')
												<td><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-tasks'></i></a></td>
												@break
											{{-- opción default --}}
											@default
												<td><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-ban'></i></a></td>
										@endswitch
									@else
										@switch($respel->RespelStatus)
											{{-- evaluación pendiente --}}
											@case('Pendiente')
												<td><a method='get' href='/respels/{{$respel->RespelSlug}}' class='btn fixed_widthbtn btn-default'><i class='fas fa-lg fa-hourglass-start'></i></a></td>
												@break
											{{-- residuo Rechazado --}}
											@case('Rechazado')
												<td><a method='get' href='/respels/{{$respel->RespelSlug}}' class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-ban'></i></a></td>
												@break
											{{-- residuo Aprobado --}}
											@case('Aprobado')
												<td><a method='get' href='/respels/{{$respel->RespelSlug}}' class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-thumbs-up'></i></a></td>
												@break
											{{-- cotización vencida --}}
											@case('Vencido')
												<td><a method='get' href='/respels/{{$respel->RespelSlug}}' class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-calendar-times'></i></a></td>
												@break
											{{-- información del residuo incompleta --}}
											@case('Incompleto')
												<td><a method='get' href='/respels/{{$respel->RespelSlug}}' class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-tasks'></i></a></td>0
												@break
											{{-- Residuo Revisado --}}
											@case('Revisado')
												<td><a method='get' href='/respels/{{$respel->RespelSlug}}' class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-tasks'></i></a></td>0
												@break
											{{-- opción default --}}
											@default
												<td><a method='get' href='/respels/{{$respel->RespelSlug}}' class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-search'></i></a></td>
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
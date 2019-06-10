@extends('layouts.app')
@section('htmlheader_title', 'Lista de Residuos')
@section('contentheader_title', trans('adminlte_lang::LangRespel.Respellist'))
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-12 col-md-offset-0">
			<!-- /.box -->
			<div class="box">
				<div class="box-header">
					<a href="respels/create" class="btn btn-primary" style="float: right;">Crear</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Clasificación 4741</th>
								<th>Peligrosidad</th>
								<th>Estado del residuo</th>
								<th>Hoja de Seguridad</th>
								<th>Tarj. de Emergencia</th>
								@if(Auth::user()->UsRol !== "Cliente")
									<th>Cliente</th>
								@endif
								@if(Auth::user()->UsRol !== "Cliente")
									<th>Evaluar</th>
								@else
									<th nowrap><span data-placement="left" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 100}' title="Status del Residuo" data-content="<ul><li><a target='_blank' class='fixed_widthbtn btn btn-default'><i class='fas fa-question'></i></a><i class='fas fa-arrow-right'></i> <b>Pendiente</b> </li><li><a target='_blank' class='fixed_widthbtn btn btn-warning'><i class='fas fa-tasks'></i></a><i class='fas fa-arrow-right'></i> <b>Incompleta</b> </li><li><a target='_blank' class='fixed_widthbtn btn btn-danger'><i class='fas fa-ban'></i></a><i class='fas fa-arrow-right'></i> <b>Rechazado</b> </li><li><a target='_blank' class='fixed_widthbtn btn btn-success'><i class='fas fa-thumbs-up'></i></a><i class='fas fa-arrow-right'></i> <b>Aprobado</b> </li><li><a target='_blank' class='fixed_widthbtn btn btn-info'><i class='fas fa-calendar-times'></i></a><i class='fas fa-arrow-right'></i> <b>Vencido</b> </li></ul>"><i style="color: Dodgerblue;" class="fas fa-info-circle fa-spin"></i></span>Ver Más...</th>
								@endif
							</tr>
						</thead>
						<tbody hidden onload="renderTable()" id="readyTable">
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
									<td><a method='get' href='/img/HojaSeguridad/{{$respel->RespelHojaSeguridad}}' target='_blank' class='btn btn-primary'><i class='fas fa-file-pdf fa-lg'></a></td>
								@else
									<td><a disabled method='get' href='/img/{{$respel->RespelHojaSeguridad}}' target='_blank' class='btn btn-default'><i class='fas fa-file-pdf fa-lg'></a></td>
								@endif

								@if($respel->RespelTarj!=="RespelTarjetaDefault.pdf")
									<td><a method='get' href='/img/TarjetaEmergencia/{{$respel->RespelTarj}}' target='_blank' class='btn btn-primary'><i class='fas fa-file-pdf fa-lg'></a></td>
								@else
									<td><a disabled method='get' href='/img/{{$respel->RespelTarj}}' target='_blank' class='btn btn-default'><i class='fas fa-file-pdf fa-lg'></a></td>
								@endif

								@if(Auth::user()->UsRol !== "Cliente")
									<td>{{$respel->CliName}}</td>
								@endif

								@if(Auth::user()->UsRol == "Programador"||Auth::user()->UsRol == "JefeOperacion"||Auth::user()->UsRol == "admin")
									@switch($respel->RespelStatus)
									    {{-- evaluación pendiente --}}
									    @case('Pendiente')
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' target='_blank' class='btn btn-default'><i class='fas fa-question'></i></a></td>
									        @break
									    {{-- residuo Rechazado --}}
									    @case('Rechazado')
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' target='_blank' class='btn btn-danger'><i class='fas fa-ban'></i></a></td>
									        @break
									    {{-- residuo Aprobado --}}
									    @case('Aprobado')
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' target='_blank' class='btn btn-success'><i class='fas fa-thumbs-up'></i></a></td>
									        @break
									    {{-- cotización vencida --}}
									    @case('Vencido')
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' target='_blank' class='btn btn-info'><i class='fas fa-calendar-times'></i></a></td>
									        @break
									    {{-- cotización vencida --}}
									    @case('Incompleta')
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' target='_blank' class='btn btn-warning'><i class="fas fa-tasks"></i></a></td>
									        @break
									    {{-- opción default --}}
									    @default
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}' target='_blank' class='btn btn-primary'><i class='fas fa-search'></i></a></td>
									@endswitch
								@else
									@switch($respel->RespelStatus)
									    {{-- evaluación pendiente --}}
									    @case('Pendiente')
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}' target='_blank' class='btn btn-default'><i class='fas fa-question'></i></a></td>
									        @break
									    {{-- residuo Rechazado --}}
									    @case('Rechazado')
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}' target='_blank' class='btn btn-danger'><i class='fas fa-ban'></i></a></td>
									        @break
									    {{-- residuo Aprobado --}}
									    @case('Aprobado')
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}' target='_blank' class='btn btn-success'><i class='fas fa-thumbs-up'></i></a></td>
									        @break
									    {{-- cotización vencida --}}
									    @case('Vencido')
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}' target='_blank' class='btn btn-info'><i class='fas fa-calendar-times'></i></a></td>
									        @break
									    {{-- información del residuo incompleta --}}
									    @case('Incompleta')
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}' target='_blank' class='btn btn-warning'><i class="fas fa-tasks"></i></a></td>
									        @break
									    {{-- opción default --}}
									    @default
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}' target='_blank' class='btn btn-primary'><i class='fas fa-search'></i></a></td>
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
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</div>
@endsection
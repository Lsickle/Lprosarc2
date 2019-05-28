@extends('layouts.app')
@section('htmlheader_title', 'Respel')
@section('contentheader_title', trans('adminlte_lang::LangRespel.Respellist'))
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- /.box -->
			<div class="box">
				<div class="box-header">
					<a href="respels/create" class="btn btn-primary" style="float: right;">Crear</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="RespelTable" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Clasificacion 4741</th>
								<th>Peligrosidad</th>
								<th>Estado del residuo</th>
								<th>Hoja de Seguridad</th>
								<th>Tarj de Emergencia</th>
								<th>Estado de aprobación</th>
								@if(Auth::user()->UsRol == "Programador"||Auth::user()->UsRol == "JefeOperacion"||Auth::user()->UsRol == "admin")
								<th>Cliente</th>
								@else
								<th>Generado por</th>
								@endif
								@if(Auth::user()->UsRol == "Programador"||Auth::user()->UsRol == "JefeOperacion"||Auth::user()->UsRol == "admin")
								<th>Evaluar</th>
								@else
								<th>Ver Más...</th>
								@endif
							</tr>
						</thead>
						<tbody hidden onload="renderTable()" id="readyTable">
							{{-- <h1 id="loadingTable">LOADING...</h1> --}}
							@include('layouts.partials.spinner')
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
								<td>{{$respel->RespelStatus}}</td>
								<td>{{$respel->CliName}}</td>
								@if(Auth::user()->UsRol == "Programador"||Auth::user()->UsRol == "JefeOperacion"||Auth::user()->UsRol == "admin")
									@switch($respel->RespelStatus)
									    {{-- evaluación pendiente --}}
									    @case('pendiente')
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' target='_blank' class='btn btn-warning'><i class='fab fa-list'></i></a></td>
									        @break
									    {{-- residuo rechazado --}}
									    @case('rechazado')
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' target='_blank' class='btn btn-danger'><i class='fab fa-ban'></i></a></td>
									        @break
									    {{-- residuo aprobado --}}
									    @case('aprobado')
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' target='_blank' class='btn btn-success'><i class='fab fa-thumbs-up'></i></a></td>
									        @break
									    {{-- cotización vencida --}}
									    @case('vencido')
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' target='_blank' class='btn btn-danger'><i class='fab fa-calendar-times'></i></a></td>
									        @break
									    {{-- cotización vencida --}}
									    @case('incompleta')
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}/edit' target='_blank' class='btn btn-warning'><i class='fab fa-task'></i></a></td>
									        @break
									    {{-- cotización vencida --}}
									    @default
									        <td><a method='get' href='/respels/{{$respel->RespelSlug}}' target='_blank' class='btn btn-primary'><i class='fab fa-search'></i></a></td>
									@endswitch
								@else
									<td><a method='get' href='/respels/{{$respel->RespelSlug}}' target='_blank' class='btn btn-primary'><i class='fab fa-search'></i></a></td>
								@endif
							</tr>
							@endforeach
						</tbody>
						{{-- <tfoot>
						<tr>
							<th>Nombre</th>
							<th>Clasificacion 4741 Y</th>
							<th>Clasificacion 4741 A</th>
							<th>Peligrosidad</th>
							<th>Estado del residuo</th>
							<th>Hoja de Seguridad</th>
							<th>Tarj de Emergencia</th>
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
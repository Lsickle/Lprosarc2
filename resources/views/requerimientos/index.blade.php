@extends('layouts.app')

@section('htmlheader_title','Requerimientos')

@section('contentheader_title', 'Requerimientos')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Requerimientos de los residuos</h3>
						<a href="/requerimientos/create" class="btn btn-primary" style="float: right;">Crear</a>
					</div>
					<!-- /.box-header -->
					<div class="box box-info">
						<div class="box-body">
							<table class="table table-compact table-bordered table-striped">
								<thead>
									<tr>
									<th>Cliente</th>
									<th>Nombre del Residuo</th>
									{{-- <th>Tratamiento</th> --}}
									{{-- <th>Tarifa</th> --}}
									<th>Auditable</th>
									<th>Tipo de Auditoria</th>
									<th>Creado</th>
									<th>Actualizado</th>
									<th>Requerimiento</th>
									<th>Editar</th>
									</tr>
								</thead>
								<tbody>
									@foreach($Requerimientos as $Requerimiento)
									<tr>
										<td>{{$Requerimiento->CliName}}</td>
										<td>{{$Requerimiento->RespelName}}</td>
										{{-- <td>{{$Requerimiento->TratName}}</td> --}}
										{{-- <td>{{$Requerimiento->ID_Tarifa}}</td> --}}

										@if ($Requerimiento->ReqAuditoriaTipo == 'Virtual' || $Requerimiento->ReqAuditoriaTipo == 'Presencial')
											<td>Si</td>
										@else
											<td>No</td>                      
										@endif
										<td>{{$Requerimiento->ReqAuditoriaTipo}}</td>
										<td>{{$Requerimiento->created_at}}</td>
										<td>{{$Requerimiento->updated_at}}</td>
										<td><a method='get' href='/requerimientos/{{$Requerimiento->ReqSlug}}' class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.see') }}</a></td>
										<td><a method='get' href='/requerimientos/{{$Requerimiento->ReqSlug}}/edit' class='btn btn-warning btn-block'>{{ trans('adminlte_lang::message.edit') }}</a></td>
									</tr>
									@endforeach
								</tbody>
								{{-- <tfoot>
									<tr>
										<th>Requerimientos de</th>
										<th>Auditable</th>
										<th>Tipo de Auditoria</th>
										<th>Creado</th>
										<th>Actualizado</th>
										<th>Requerimientos</th>
									</tr>
								</tfoot> --}}
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

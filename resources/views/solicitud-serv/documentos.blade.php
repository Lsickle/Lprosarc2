@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #fbc2eb, #aa66cc); padding-right:30vw; position:relative; overflow:hidden;">
	Servicios->Documentos
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">
				<div class="box">
					<div class="box-header with-border">
						<a href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/documentos/create" class="btn btn-success"><i class="fas fa-file-contract"></i> Añadir Certificado</a>
						<a disabled href="" class="btn btn-success"><i class="fas fa-file-invoice"></i> Añadir Manifiesto</a>
					</div>
					<div class="box-body">
						<table class="table table-compact table-bordered table-striped">
							<thead>
								<th>Servicio</th>
								<th>#</th>
								<th>Documento</th>
								<th>Observación</th>
								<th>Aprobación Operaciones</th>
								<th>Aprobación Logistica</th>
								<th>Aprobación Director Planta</th>
							</thead>
							<tbody>
								<tr>
									<td>data1234</td>
									<td>data1234</td>
									<td>data1234</td>
									<td>data1234</td>
									<td>data1234</td>
									<td>data1234</td>
									<td>data1234</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="box-footer">
						<a href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}" class="btn btn-primary pull-right">Volver al Servicio</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('NewScript')
@endsection
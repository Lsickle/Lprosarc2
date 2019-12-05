@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #fbc2eb, #aa66cc); padding-right:30vw; position:relative; overflow:hidden;">
	Servicios-Documentos
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
								@foreach($certificados as $certificado)
								<tr>
									<td>{{$certificado->FK_CertSolser}}</td>
									<td>{{$certificado->ID_Cert}}</td>
									@if($certificado->CertSrc!=="CertificadoDefault.pdf")
										<td class="text-center"><a method='get' href='/img/Certificados/{{$certificado->CertSrc}}' target='_blank' class='btn btn-success'><i class='fas fa-file-contract fa-lg'></a></td>
									@else
										<td class="text-center"><a disabled method='get' href='/img/{{$certificado->CertSrc}}' class='btn btn-default'><i class='fas fa-file-contract fa-lg'></a></td>
									@endif
									<td>{{$certificado->CertObservacion}}</td>
									<td>{{$certificado->CertAuthJo}}</td>
									<td>{{$certificado->CertAuthJl}}</td>
									<td>{{$certificado->CertAuthDp}}</td>
								</tr>
								@endforeach
								@foreach($manifiestos as $manifiesto)
								<tr>
									<td>{{$manifiesto->FK_ManifSolser}}</td>
									<td>{{$manifiesto->ID_Manif}}</td>
									@if($manifiesto->ManifSrc!=="ManifiestoDefault.pdf")
										<td class="text-center"><a method='get' href='/img/Manifiestos/{{$manifiesto->ManifSrc}}' target='_blank' class='btn btn-success'><i class='fas fa-file-invoice'></a></td>
									@else
										<td class="text-center"><a disabled method='get' href='/img/{{$manifiesto->ManifSrc}}' class='btn btn-default'><i class='fas fa-file-invoice fa-lg'></a></td>
									@endif
									<td>{{$manifiesto->ManifObservacion}}</td>
									<td>{{$manifiesto->ManifAuthJo}}</td>
									<td>{{$manifiesto->ManifAuthJl}}</td>
									<td>{{$manifiesto->ManifAuthDp}}</td>
								</tr>
								@endforeach
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
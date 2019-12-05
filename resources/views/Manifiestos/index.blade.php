@extends('layouts.app')
@section('htmlheader_title')
Lista de Manifiestos
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #fbc2eb, #aa66cc); padding-right:30vw; position:relative; overflow:hidden;">
	Manifiestos
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">
				<div class="box">
					<div class="box-header with-border">
						{{-- <a href="/solicitud-servicio/{{$SolicitudServicio->SolSerSlug}}/documentos/create" class="btn btn-success"><i class="fas fa-file-contract"></i> Añadir Certificado</a> --}}
						{{-- <a disabled href="" class="btn btn-success"><i class="fas fa-file-invoice"></i> Añadir Manifiesto</a> --}}
					</div>
					<div class="box-body">
						<table class="table table-compact table-bordered table-striped">
							<thead>
								<th>Servicio</th>
								<th>#</th>
								<th>Documento</th>
								<th>Observación</th>
								<th>Aprobación HSEQ</th>
								<th>Aprobación Operaciones</th>
								<th>Aprobación Logística</th>
								<th>Aprobación Director Planta</th>
								
								@if(in_array(Auth::user()->UsRol, Permisos::EDITMANIFCERT))
									<th>Ver</th>
								@endif
								@if(in_array(Auth::user()->UsRol, Permisos::SIGNMANIFCERT))
									<th>Firmar</th>
								@endif
								<th>Actualizado el:</th>
							</thead>
							<tbody>
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
									<td class="text-center">
										@if($manifiesto->ManifAuthHseq === 1)
											<i class='fas fa-signature'></i>
										@else
											<p>Pendiente</p>
										@endif
									</td>
									<td class="text-center">
										@if($manifiesto->ManifAuthJo === 1)
											<i class='fas fa-signature'></i>
										@else
											<p>Pendiente </p>
										@endif
									</td>
									<td class="text-center">
										@if($manifiesto->ManifAuthJl === 1)
											<i class='fas fa-signature'></i>
										@else
											<p>Pendiente </p>
										@endif
									</td>
									<td class="text-center">
										@if($manifiesto->ManifAuthDp === 1)
											<i class='fas fa-signature'></i>
										@else
											<p>Pendiente </p>
										@endif
									</td>
									@if(in_array(Auth::user()->UsRol, Permisos::EDITMANIFCERT))
									<td class="text-center"><a method='get' href='/manifiesto/{{$manifiesto->ManifSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Actualizar Manifiesto</b>" data-content="<p style='width: 50%'>Puede actualizar el Certificado e ingresar información relevante para la generación del mismo </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-file-signature'></i></a></td>
									@endif
									@if(in_array(Auth::user()->UsRol, Permisos::SIGNMANIFCERT))
									<td class="text-center"><a method='get' href='/manifiesto/{{$manifiesto->ManifSlug}}/firmar/{{$SolicitudServicio->SolSerSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Firmar Manifiesto</b>" data-content="<p style='width: 50%'>Este boton le permite marcar el Manifiesto como firmado en la Base de datos  </p>" class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-file-signature'></i></a></td>
									@endif
									<td>{{$manifiesto->updated_at}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('NewScript')
@endsection
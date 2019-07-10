@extends('layouts.app')
@section('htmlheader_title')
Requerimientos
@endsection
@section('contentheader_title')
Requerimientos
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Crear Requerimiento</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<div class="box box-info"> 
						<form role="form" action="/requerimientos/" method="POST" enctype="multipart/form-data">
							@csrf
							<div class="box-body">
								{{-- <p>Actualice la información necesaria completando los campos requeridos según la información del residuo que registro</p> --}}
								<div class="col-md-6">
									<div class="col-md-12">
										<h4><b> Fotos</b></h4>
									</div>
									<div class="col-md-6">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Foto-Descargue</b>" data-content="<p style='width: 50%'> Se requiere registro fotografico del proceso de descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>">
											<input type="checkbox" class="fotoswitch" name="ReqFotoDescargue"/> Descargue/Pesaje
										</label>
									</div>
									<div class="col-md-6">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Foto-Tratamiento</b>" data-content="<p style='width: 50%'> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>">
											<input type="checkbox" class="fotoswitch" name="ReqFotoDestruccion"/> Tratamiento
										</label>
									</div>
								</div>
								<div class="col-md-6">
									<div class="col-md-12">
										<h4><b> Videos</b></h4>
									</div>
									<div class="col-md-6">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Video-Descargue</b>" data-content="<p style='width: 50%'> Se requiere video del proceso de Descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>">
											<input type="checkbox" class="videoswitch" name="ReqVideoDescargue"/> Descargue/Pesaje
										</label>
									</div>
									<div class="col-md-6">
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Video-Tratamiento</b>" data-content="<p style='width: 50%'> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>">
											<input type="checkbox" class="videoswitch" name="ReqVideoDestruccion"/> Tratamiento
										</label>
									</div>
								</div>
								<div class="col-md-12">
								<hr>
								</div>
								<div class="col-md-16">
								<div class="col-md-12">
									<center><h4><b>Adicionales</h4></b></center>
								</div>
								<div class="col-md-4">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Auditoria Presencial</b>" data-content="<p style='width: 50%'> Se requiere presencia de auditor al momento de realizar tratamiento de residuos en instalaciones de Prosarc S.A. ESP</p>">
										<input class="AllowUncheck" type="radio" name="ReqAuditoriaTipo"/> Auditoria Presencial
									</label>
								</div>
								<div class="col-md-4">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Auditoria Virtual</b>" data-content="<p style='width: 50%'> Se requiere acceso al sistema de camaras de Prosarc S.A. ESP para monitorear tratamiento de residuos</p>">
										<input class="AllowUncheck" type="radio" name="ReqAuditoriaTipo"/> Auditoria Virtual
									</label>
								</div>													
								<div class="col-md-4">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Ticket de Bascula Camionera</b>" data-content="<p style='width: 50%'> Se requiere pesaje en bascula camionera y la presentacion del ticket correspondiente</p>">
										<input type="checkbox" class="testswitch" name="ReqBascula"/> Ticket de Bascula
									</label>
								</div>
								<div class="col-md-4">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Personal con Capacitacion</b>" data-content="<p style='width: 50%'> Se requiere que el Conductor y/o Ayudante de Prosarc S.A. ESP haya realizado capacitación especifica, la cual es dictada por el Cliente</p>">
										<input type="checkbox" class="testswitch" name="ReqCapacitacion"/> Personal con Capacitacion
									</label>
								</div>
								<div class="col-md-4">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Personal Adicional</b>" data-content="<p style='width: 50%'> Se requiere el envio de una persona adicional, aparte del conductor y el ayudante, para el cargue de vehiculos de Prosarc S.A.</p>">
										<input type="checkbox" class="testswitch" name="ReqMasPerson"/> Personal Adicional
									</label>
								</div>
								<div class="col-md-4">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Vehiculo con Plataforma</b>" data-content="<p style='width: 50%'> Se requiere que Prosarc S.A. ESP envie vehiculo con plataforma para el cargue de los residuos en las instalaciones del Cliente/Generador</p>">
										<input type="checkbox" class="testswitch" name="ReqPlatform"/> Vehiculo con Plataforma
									</label>
								</div>
								<div class="col-md-4">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Devolución de elementos</b>" data-content="<p style='width: 50%'> Se requiere devolucion de elementos que son enviados a planta con los residuos a Tratar... por ejemplo: Canecas</p>">
										<input type="checkbox" class="testswitch" name="ReqDevolucion"/> Devolución de elementos
									</label>
								</div>
								<div class="col-md-4">
									<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Nombre de elementos</b>" data-content="<p style='width: 50%'> Se debe especificar el nombre de los elementos que Se requiere sean devueltos al Cliente/Generador... solo aplica si se selecciono el requerimiento: <b><i>Devolución de elentos</i></b></p>">
										<input type="text" maxlength="64" class="" name="ReqDevolucionTipo"> Nombre elementos
									</label>
								</div>
								</div>
							</div>
							<div class="box box-info">
								<div class="box-footer">
									<button type="submit" class="btn btn-success pull-right">{{trans('adminlte_lang::message.create')}}</button>
								</div>
							</div>
							<input hidden type="text" name="updated_by" value="{{Auth::user()->email}}">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

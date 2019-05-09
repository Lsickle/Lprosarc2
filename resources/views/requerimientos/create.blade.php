@extends('layouts.app')
@section('htmlheader_title')
requerimientos - Crear
@endsection
@section('contentheader_title')
requerimientos - Crear
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
								<h3 class="box-title">Formulario de registro</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
							@include('layouts.partials.spinner')
							<form role="form" action="/requerimientos/" method="POST" enctype="multipart/form-data">
								@csrf
								{{-- <h1 id="loadingTable">LOADING...</h1> --}}
								<div class="box-body" hidden onload="renderTable()" id="readyTable">
									<div class="tab-pane" id="addRowWizz">
										<p>Actualice la información necesaria completando los campos requeridos según la información del residuo que registro</p>
											<!-- general form elements -->
											<div class="row">
												<!-- left column -->
												<div class="col-md-12">
													<!-- general form elements -->
													<div class="box box-primary">
														<!-- /.box-header -->
														<!-- form start -->
														<div class="box-body">
															<div class="col-md-12">
																<label>Fotos</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="fotoswitch" name="ReqFotoCargue"/> Cargue
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="fotoswitch" name="ReqFotoDescargue"/> Descargue
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="fotoswitch" name="ReqFotoPesaje"/> Pesaje
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="fotoswitch" name="ReqFotoReempacado"/> Reempacado
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="fotoswitch" name="ReqFotoMezclado"/> Mezclado
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="fotoswitch" name="ReqFotoDestruccion"/> Destruccion
																</label>
															</div>
														</div>
														<div class="box-body">
															<div class="col-md-12">
																<label>Videos</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="videoswitch" name="ReqVideoCargue"/> Cargue
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="videoswitch" name="ReqVideoDescargue"/> Descargue
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="videoswitch" name="ReqVideoPesaje"/> Pesaje
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="videoswitch" name="ReqVideoReempacado"/> Reempacado
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="videoswitch" name="ReqVideoMezclado"/> Mezclado
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="videoswitch" name="ReqVideoDestruccion"/> Destruccion
																</label>
															</div>
														</div>
														<div class="box-body">
															<div class="col-md-12">
																<label>Adicionales</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input class="AllowUncheck" type="radio" name="ReqAuditoriaTipo"/> Auditoria Presencial
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input class="AllowUncheck" type="radio" name="ReqAuditoriaTipo"/> Auditoria Virtual
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="testswitch" name="ReqDatosPersonal"/> Datos del Personal
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="testswitch" name="ReqBascula"/> Ticket de Bascula
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="testswitch" name="ReqPlanillas"/> Planillas de SS
																</label>
															</div>
															
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="testswitch" name="ReqAlistamiento"/> Alistamiento de residuos
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="testswitch" name="ReqCapacitacion"/> personal con Capacitacion
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="testswitch" name="ReqMasPerson"/> Personal Adicional
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="testswitch" name="ReqPlatform"/> vehiculo con Plataforma
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="testswitch" name="ReqCertiEspecial"/> Certificacion Especial
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="checkbox" class="testswitch" name="ReqDevolucion"/> Devolucion de elementos
																</label>
															</div>
															<div class="col-md-4">
																<label>
																	<input type="text" maxlength="64" class="" name="ReqDevolucionTipo"> Nombre elementos
																</label>
															</div>
														</div>
														<!-- /.box-body -->
													</div>
													<!-- /.box -->
												</div>
												<!-- /.box-body -->
											</div>
										</div>
										<div class="col-md-12">
										<div class="box-footer">
											<button type="submit" class="btn btn-success pull-right" style="margin-right:3em">Crear</button>
										</div>
									</div>
									</div>
									<input hidden type="text" name="updated_by" value="{{Auth::user()->email}}">
									<!-- /.box-body -->
									
							</form>
							{{-- @endforeach --}}
						</div>
						<!-- /.box -->
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!--/.col (right) -->
		</div>
		<!-- /.box-body -->
	</div>
@endsection

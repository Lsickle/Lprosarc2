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
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Requerimiento del cliente</h3>
					{{-- <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
					</div> --}}
				</div>
				<div class="box box-info">
					<div class="box-body">
						<div class="col-md-12"> 
							<label>Fotos</label>
						</div>
						<div class="col-md-4"> 
							<label>
								@if ($Requerimientos->ReqFotoCargue === 1)
								<input type="checkbox" class="fotoswitch" name="ReqFotoCargue" checked disabled/> Cargue
								@else
								<input type="checkbox" class="fotoswitch" name="ReqFotoCargue" disabled/> Cargue 
								@endif
							</label>
						</div>
						<div class="col-md-4"> 
							<label>
								@if ($Requerimientos->ReqFotoDescargue === 1)   
								<input type="checkbox" class="fotoswitch" name="ReqFotoDescargue" checked disabled/> Descargue
								@else         
								<input type="checkbox" class="fotoswitch" name="ReqFotoDescargue" disabled/> Descargue
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqFotoPesaje === 1)   
								<input type="checkbox" class="fotoswitch" name="ReqFotoPesaje" checked disabled/> Pesaje
								@else  
								<input type="checkbox" class="fotoswitch" name="ReqFotoPesaje" disabled/> Pesaje
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqFotoReempacado === 1)   
								<input type="checkbox" class="fotoswitch" name="ReqFotoReempacado" checked disabled/> Reempacado
								@else                       
								<input type="checkbox" class="fotoswitch" name="ReqFotoReempacado" disabled/> Reempacado
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqFotoMezclado === 1)   
								<input type="checkbox" class="fotoswitch" name="ReqFotoMezclado" checked disabled/> Mezclado
								@else                       
								<input type="checkbox" class="fotoswitch" name="ReqFotoMezclado" disabled/> Mezclado
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqFotoDestruccion === 1)   
								<input type="checkbox" class="fotoswitch" name="ReqFotoDestruccion" checked disabled/> Destruccion
								@else                       
								<input type="checkbox" class="fotoswitch" name="ReqFotoDestruccion" disabled/> Destruccion
								@endif
							</label>
						</div>
					</div>
					<div class="box-body">
						<div class="col-md-12"> 
							<label>Videos</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqVideoCargue == 1)
									<input type="checkbox" class="videoswitch" name="ReqVideoCargue" checked disabled/> Cargue
								@else
									<input type="checkbox" class="videoswitch" name="ReqVideoCargue" disabled/> Cargue
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqVideoDescargue == 1)
									<input type="checkbox" class="videoswitch" name="ReqVideoDescargue" checked disabled/> Descargue
								@else
									<input type="checkbox" class="videoswitch" name="ReqVideoDescargue" disabled/> Descargue
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqVideoPesaje == 1)
									<input type="checkbox" class="videoswitch" name="ReqVideoPesaje" checked disabled/> Pesaje
								@else
									<input type="checkbox" class="videoswitch" name="ReqVideoPesaje" disabled/> Pesaje
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqVideoReempacado == 1)
									<input type="checkbox" class="videoswitch" name="ReqVideoReempacado" checked disabled/> Reempacado
								@else
									<input type="checkbox" class="videoswitch" name="ReqVideoReempacado" disabled/> Reempacado
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqVideoMezclado == 1)
									<input type="checkbox" class="videoswitch" name="ReqVideoMezclado" checked disabled/> Mezclado
								@else
									<input type="checkbox" class="videoswitch" name="ReqVideoMezclado" disabled/> Mezclado
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqVideoDestruccion == 1)
									<input type="checkbox" class="videoswitch" name="ReqVideoDestruccion" checked disabled/> Destruccion
								@else
									<input type="checkbox" class="videoswitch" name="ReqVideoDestruccion" disabled/> Destruccion
								@endif
							</label>
						</div>
					</div>
					<div class="box-body">
						<div class="col-md-12">
							<label>Adicionales</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqAuditoriaTipo == 'Presencial')
									<input class="AllowUncheck" type="radio" name="ReqAuditoriaTipo" checked disabled/> Auditoria Presencial
								@else
									<input class="AllowUncheck" type="radio" name="ReqAuditoriaTipo" disabled/> Auditoria Presencial
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqAuditoriaTipo == 'Virtual')
									<input class="AllowUncheck" type="radio" name="ReqAuditoriaTipo" checked disabled/> Auditoria Virtual
								@else
									<input class="AllowUncheck" type="radio" name="ReqAuditoriaTipo" disabled/> Auditoria Virtual
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqDatosPersonal == 1)
									<input type="checkbox" class="testswitch" name="ReqDatosPersonal" checked disabled/> Datos del Personal 
								@else
									<input type="checkbox" class="testswitch" name="ReqDatosPersonal" disabled/> Datos del Personal 
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqBascula == 1)
									<input type="checkbox" class="testswitch" name="ReqBascula" checked disabled/> Bascula
								@else
									<input type="checkbox" class="testswitch" name="ReqBascula" disabled/> Bascula
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqPlanillas == 1)
									<input type="checkbox" class="testswitch" name="ReqPlanillas" checked disabled/> Planillas
								@else
									<input type="checkbox" class="testswitch" name="ReqPlanillas" disabled/> Planillas
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqDevolucion == 1)
									<input type="checkbox" class="testswitch" name="ReqDevolucion" checked disabled/> Devolucion de elementos
								@else
									<input type="checkbox" class="testswitch" name="ReqDevolucion" disabled/> Devolucion de elementos
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqAlistamiento == 1)
									<input type="checkbox" class="testswitch" name="ReqAlistamiento" checked disabled/> Alistamiento de residuos
								@else
									<input type="checkbox" class="testswitch" name="ReqAlistamiento" disabled/> Alistamiento de residuos
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqCapacitacion == 1)
									<input type="checkbox" class="testswitch" name="ReqCapacitacion" checked disabled/> personal con Capacitacion
								@else
									<input type="checkbox" class="testswitch" name="ReqCapacitacion" disabled/> personal con Capacitacion
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqMasPerson == 1)
									<input type="checkbox" class="testswitch" name="ReqMasPerson" checked disabled/> Mas Personal de cargue/descargue
								@else
									<input type="checkbox" class="testswitch" name="ReqMasPerson" disabled/> Mas Personal de cargue/descargue
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqPlatform == 1)
									<input type="checkbox" class="testswitch" name="ReqPlatform" checked disabled/> vehiculo con Plataforma
								@else
									<input type="checkbox" class="testswitch" name="ReqPlatform" disabled/> vehiculo con Plataforma
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								@if ($Requerimientos->ReqCertiEspecial == 1)
									<input type="checkbox" class="testswitch" name="ReqCertiEspecial" checked disabled/> Certificacion Especial
								@else
									<input type="checkbox" class="testswitch" name="ReqCertiEspecial" disabled/> Certificacion Especial
								@endif
							</label>
						</div>
						<div class="col-md-4">
							<label>
								<input type="text" maxlength="64" class="" name="ReqDevolucionTipo" value="{{$Requerimientos->ReqDevolucionTipo}}" disabled> Tipo de elementos
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
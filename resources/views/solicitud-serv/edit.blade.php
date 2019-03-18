@extends('layouts.app')
@section('htmlheader_title')
Solicitude de servicio
@endsection
@section('contentheader_title')
Editar Solicitud de servicio
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Datos</h3>
					
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
							<i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
								<i class="fa fa-times"></i></button>
							</div>
						</div>
						<div class="row">
							<!-- left column -->
							<div class="col-md-12">
								<!-- general form elements -->
								<div class="box box-primary">
                                        @component('layouts.partials.modal')
                                            {{$Servicios->ID_SolSer}}
                                        @endcomponent
									<div class="box-header with-border">
                                        <h3 class="box-title">Editar registro</h3>
                                        @if($Servicios->SolSerDelete == 0)
                                            <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Servicios->ID_SolSer}}'  class='btn btn-danger' style="float: right;">Eliminar</a>
                                            <form action='/solicitud-servicio/{{$Servicios->SolSerSlug}}' method='POST'>
                                                @method('DELETE')
                                                @csrf
                                                <input  type="submit" id="Eliminar{{$Servicios->ID_SolSer}}" style="display: none;">
                                            </form>
                                        @else
                                            <form action='/personal/{{$Servicios->SolSerSlug}}' method='POST' style="float: right;">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" class='btn btn-success btn-block' value="Añadir">
                                            </form>
                                        @endif
									</div>
							<!-- /.box-header -->
                        <!-- form start -->
									<form role="form" action="/solicitud-servicio/{{$Servicios->ID_SolSer}}" method="POST" enctype="multipart/form-data">
										@method('PUT')
										@csrf
										<div class="col-md-6">
                                                <label for="Sede">Sede</label>
                                                <select class="form-control" id="Sede" name="Fk_SolSerTransportador" required>
                                                    <option value="{{$Servicios->Fk_SolSerTransportador}}">Seleccione...</option>
                                                    @foreach ($Sedes as $Sede)
                                                        <option value="{{$Sede->ID_Sede}}">{{$Sede->SedeName}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="GSede">Sede Generador</label>
                                                <select class="form-control" id="GSede" name="FK_SolSerGenerSede" required>
                                                    <option value="{{$Servicios->FK_SolSerGenerSede}}">Seleccione...</option>
                                                    @foreach ($GSedes as $GSede)
                                                        <option value="{{$GSede->ID_GSede}}">{{$GSede->GSedeName}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="Respel">Respel</label>
                                                <select class="form-control" id="Respel" name="FK_Respel" required>
                                                <option value="{{$SGenerRes->FK_Respel}}">Seleccione...</option>
                                                    @foreach ($Respels as $Respel)
                                                        <option value="{{$Respel->ID_Respel}}">{{$Respel->RespelName}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="estado">Estado</label>
                                                <select class="form-control" id="estado" name="SolSerStatus" required>
                                                    <option value="{{$Servicios->SolSerStatus}}">Seleccione...</option>
                                                    <option>Aprobada</option>
                                                    <option>Negada</option>
                                                    <option>Pendiente</option>
                                                    <option>Incompleta</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="Tipo">Tipo</label>
                                                <select class="form-control" id="Tipo" name="SolSerTipo" required>
                                                    <option value="{{$Servicios->SolSerTipo}}">Seleccione...</option>
                                                    <option>Interno</option>
                                                    <option>Alquilado</option>
                                                    <option>Externo</option>
                                                </select>
                                            </div>
                                            
                                            
                                            <div class="col-md-6">
                                                <label for="soliservicioinputext3">Frecuencia de recolecta</label>
                                                <input type="text" class="form-control" id="soliservicioinputext3" value="{{$Servicios->SolSerFrecuencia}}" placeholder="15 días" name="SolSerFrecuencia">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="soliservicioinputext4">Nombre del conductor externo</label>
                                                <input type="text" class="form-control" id="soliservicioinputext4" value="{{$Servicios->SolSerConducExter}}" placeholder="Juan" name="SolSerConducExter">
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <label for="soliservicioinputext5">Placa del vehiculo externo</label>
                                                <input type="text" class="form-control" id="soliservicioinputext5" value="{{$Servicios->SolSerVehicExter}}" placeholder="FDR-756" name="SolSerVehicExter">
                                            </div>
                                            <div class="form-group" style="float:left; margin-top:3%; margin-left: 1%;">
                                                    <div class="icheck form-group">
                                                        <label for="inputcheck">
                                                            Auditable
                                                        </label>
                                                        @if ($Servicios->SolSerAuditable == '1')
                                                        <input id="inputcheck" type="checkbox" name="SolSerAuditable" value="1" checked>
                                                        
                                                        @else
                                                        <input id="inputcheck" type="checkbox" name="SolSerAuditable" value="1">
                                                            
                                                        @endif
                                                </div>
                                            </div>

										<input hidden type="text" name="updated_by" value="{{Auth::user()->email}}">
										<!-- /.box-body -->
										<div class="col-md-12">	
											<div class="box-footer">
												<button type="submit" class="btn btn-primary pull-right" style="margin-right:5em">Registrar</button>
											</div>
										</div>
									</form>
						        <!-- /.box -->
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!--/.col (right) -->
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</div>
@endsection
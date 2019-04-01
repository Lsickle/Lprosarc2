@extends('layouts.app')
@section('htmlheader_title')
Articulos
@endsection
@section('contentheader_title')
Articulos por Proveedor
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
                            <!-- /.box-header -->
                            
							{{-- <div class="box-header">
									@component('layouts.partials.modal')
										{{$Movimientos->ID_Movimientos}}
									@endcomponent
								@if($Movimientos->MovActDelete == 0)
								  <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Movimientos->ID_Movimientos}}'  class='btn btn-danger' style="float: right;">Eliminar</a>
								  <form action='/articulos-proveedor/{{$Movimientos->ID_Movimientos}}' method='POST'>
									  @method('DELETE')
									  @csrf
									  <input  type="submit" id="Eliminar{{$Movimientos->ID_Movimientos}}" style="display: none;">
								  </form>
								@else

								  <form action='/articulos-proveedor/{{$Movimientos->ID_Movimientos}}' method='POST' style="float: right;">
									@method('DELETE')
									@csrf
									<input type="submit" class='btn btn-success btn-block' value="Añadir">
								  </form>
								@endif
                              </div> --}}
                              
							<!-- form start -->
							<form role="form" action="/movimiento-activos/{{$Movimientos->ID_MovAct}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="col-md-12">
                                        <label for="moviminetoActivo">Tipo de Movimiento</label>
                                        <select class="form-control" id="moviminetoActivo" name="MovTipo" required>
                                            <option value="{{$Movimientos->MovTipo}}">Seleccione...</option>
                                            <option>Entrada</option>
                                            <option>Salida</option>
                                            <option>Asignar</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="moviminetoActivo1">Nombre del Activo</label>
                                        <select class="form-control" id="moviminetoActivo1" name="FK_MovInv" required>
                                            <option value="{{$Movimientos->FK_MovInv}}">Seleccione...</option>
                                            @foreach ($Activos as $Activos)
                                                 <option value="{{$Activos->ID_Act}}">{{$Activos->ActName}}</option>																
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="moviminetoActivo2">Asignado A</label>
                                        <select class="form-control" id="moviminetoActivo2" name="FK_ActPerson">
                                            <option value="">Seleccione...</option>
                                            @foreach ($Personales as $Personal)
                                                 <option value="{{$Personal->ID_Pers}}">{{$Personal->PersFirstName}} ({{$Personal->CargName}})</option>																
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">		
										<div class="box-footer" style="float:right; margin-right:5%">
											<button type="submit" class="btn btn-primary">Registrar</button>
										</div>	
									</div>
								</div>
							</form>
						</div>
					</div>
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
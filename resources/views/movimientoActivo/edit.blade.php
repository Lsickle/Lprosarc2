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
                        @component('layouts.partials.modal')
                            {{$Movimientos->ID_MovAct}}
                        @endcomponent
                        @if($Movimientos->MovActDelete == 0)
                          <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Movimientos->ID_MovAct}}'  class='btn btn-danger' style="float: right;">Eliminar</a>
                          <form action='/movimiento-activos/{{$Movimientos->ID_MovAct}}' method='POST'>
                              @method('DELETE')
                              @csrf
                              <input  type="submit" id="Eliminar{{$Movimientos->ID_MovAct}}" style="display: none;">
                          </form>
                        @else
                          <form action='/movimiento-activos/{{$Movimientos->ID_MovAct}}' method='POST' style="float: right;">
                            @method('DELETE')
                            @csrf
                            <input type="submit" class='btn btn-success btn-block' value="Añadir">
                          </form>
                        @endif
                      </div>
					{{-- <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
					</div> --}}
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<!-- form start -->
							<form role="form" action="/movimiento-activos/{{$Movimientos->ID_MovAct}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="col-md-12">
                                        <label for="moviminetoActivo">Tipo de Movimiento</label>
                                        <select class="form-control" id="moviminetoActivo" name="MovTipo" required>
                                            
                                            {{-- Falta Validar --}}
                                            {{-- <option value="{{$Movimientos->MovTipo}}">{{$Movimientos->MovTipo}}</option> --}}
                                            @if ($Movimientos->MovTipo == "Entrada")
                                                <option>Entrada</option>
                                                <option>Salida</option>
                                                <option>Asignar</option>
                                            @else
                                                @if ($Movimientos->MovTipo == "Salida")
                                                    <option>Salida</option>
                                                    <option>Entrada</option>
                                                    <option>Asignar</option>
                                                @else
                                                    <option>Asignar</option>
                                                    <option>Entrada</option>   
                                                    <option>Salida</option>
                                                @endif
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="moviminetoActivo1">Nombre del Activo</label>
                                        <select class="form-control" id="moviminetoActivo1" name="FK_MovInv" required>
                                            <option value="{{$Movimientos->FK_MovInv}}">{{$Activo->ActName}}</option>
                                            @foreach ($Activos as $Activos)
                                                 <option value="{{$Activos->ID_Act}}">{{$Activos->ActName}}</option>																
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="moviminetoActivo2">Asignado A</label>
                                        <select class="form-control" id="moviminetoActivo2" name="FK_ActPerson">
                                            @if ($Movimientos->FK_ActPerson == NULL)
                                                    <option value="">Seleccione...</option>
                                            @else
                                                <option value="{{$Movimientos->FK_ActPerson}}">{{$Personal->PersFirstName}} ({{$Cargos->CargName}})</option>
                                                {{-- <option value="">Nadie Asignado </option>																 --}}
                                            @endif
                                            @foreach ($Personales as $Personal)
                                                <option value="{{$Personal->ID_Pers}}">{{$Personal->PersFirstName}} ({{$Personal->CargName}})</option>																
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">		
										<div class="box-footer" style="float:right; margin-right:5%">
											<button type="submit" class="btn btn-primary">Actualizar</button>
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
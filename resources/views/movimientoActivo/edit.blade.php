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
							<div class="box-header">
									@component('layouts.partials.modal')
										{{$ArtProvs->ID_ArtiProve}}
									@endcomponent
								@if($ArtProvs->ArtDelete == 0)
								  <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$ArtProvs->ID_ArtiProve}}'  class='btn btn-danger' style="float: right;">Eliminar</a>
								  <form action='/articulos-proveedor/{{$ArtProvs->ID_ArtiProve}}' method='POST'>
									  @method('DELETE')
									  @csrf
									  <input  type="submit" id="Eliminar{{$ArtProvs->ID_ArtiProve}}" style="display: none;">
								  </form>
								@else

								  <form action='/articulos-proveedor/{{$ArtProvs->ID_ArtiProve}}' method='POST' style="float: right;">
									@method('DELETE')
									@csrf
									<input type="submit" class='btn btn-success btn-block' value="Añadir">
								  </form>
								@endif
							  </div>
							<!-- form start -->
							<form role="form" action="/articulos-proveedor/{{$ArtProvs->ID_ArtiProve}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="col-md-6">
                                        <label for="activo">Tipo de Movimiento</label>
                                        <select class="form-control" id="activo" name="MovTipo" required>
                                            <option value="">Seleccione...</option>
                                            <option>Entrada</option>
                                            <option>Salida</option>
                                            <option>Asignacion</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="activo">Nombre del Activo</label>
                                        <select class="form-control" id="activo" name="FK_MovInv" required>
                                            <option>Seleccione...</option>
                                            @foreach ($Movimientos as $Movimiento)
                                                 <option value="{{$Movimiento->ID_Act}}">{{$Movimiento->ActName}}</option>																
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="activo">Asignado A</label>
                                        <select class="form-control" id="activo" name="FK_ActPerson" required>
                                            <option>Seleccione...</option>
                                            @foreach ($Movimientos as $Movimiento)
                                                 <option value="{{$Movimiento->ID_Pers}}">{{$Movimiento->PersFirstName}}      ({{$Movimiento->CargName}})</option>																
                                            @endforeach
                                        </select>
                                    </div>
								<div class="container-fluid spark-screen">
									<div class="row">			
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
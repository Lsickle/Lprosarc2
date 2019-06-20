@extends('layouts.app')
@section('htmlheader_title')
Activos
@endsection
@section('contentheader_title')
Datos de Activos
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Editar Datos</h3>
					@if($Activos->ActDelete == 0)
						<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Activos->ID_Act}}'  class='btn btn-danger' style="float: right;">Eliminar</a>
						<form action='/activos/{{$Activos->ID_Act}}' method='POST'>
							@method('DELETE')
							@csrf
							<input  type="submit" id="Eliminar{{$Activos->ID_Act}}" style="display: none;">
						</form>
					@else
						<form action='/activos/{{$Activos->ID_Act}}' method='POST' style="float: right;">
						@method('DELETE')
						@csrf
						<button type="submit" class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.add') }}</button>
						</form>
					@endif
					{{-- <div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
					</div> --}}
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
                            <!-- form start -->
							<form role="form" action="/activos/{{$Activos->ID_Act}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
								<div class="col-md-6">
									<label for="activo">Categoría</label>
									<select class="form-control" id="activo" name="categoria" required>
										<option>{{$Categoria->CatName}}</option>
										@foreach ($Categorias as $Categoria)
											<option value="{{$Categoria->ID_CatAct}}">{{$Categoria->CatName}}</option>																
										@endforeach
									</select>
								</div>
							{{-- </div> --}}
								<div class="col-md-6">
									<label for="activo">Subcategoria</label>
									<select class="form-control" id="activo" name="FK_ActSub" required>
										<option value="{{$Activos->FK_ActSub}}">{{$SubActivo->SubCatName}}</option>
										@foreach ($SubActivos as $SubActivo)
											 <option value="{{$SubActivo->ID_SubCat}}">{{$SubActivo->SubCatName}}</option>																
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<label for="activo3">Sede</label>
									<select class="form-control" id="activo3" name="FK_ActSede" required>
										<option value="{{$Activos->FK_ActSede}}">{{$Sede->SedeName}}</option>	
										@foreach ($Sedes as $Sede)
											<option value="{{$Sede->ID_Sede}}">{{$Sede->SedeName}}</option>	
										@endforeach
									</select>
								</div>
								<div class="col-md-6">
									<label for="activoinputext1">Nombre del activo</label>
									<input type="text" class="form-control" id="activoinputext1" value="{{$Activos->ActName}}" name="ActName" required>
								</div>
								<div class="col-md-6">
									<label for="activo">Forma del activo</label>
									<select class="form-control" id="activo" name="ActUnid" required>
										<option value="{{$Activos->ActUnid}}">{{$Activos->ActUnid}}</option>
										@if ($Activos->ActUnid == "Peso")
											<option>Unidad</option>	
										@else
											<option>Peso</option>
										@endif
									</select>
								</div>
								<div class="col-md-6">
									<label for="activoinputext2">Cantidad</label>
									<input type="number" class="form-control" id="activoinputext2" value="{{$Activos->ActCant}}" name="ActCant" max="999999" required>
								</div>
								<div class="col-md-6">
									<label for="activoinputext3">Serial de Prosarc</label>
									<input type="text" class="form-control" id="activoinputext3" value="{{$Activos->ActSerialProsarc}} " name="ActSerialProsarc" required>
								</div>
								<div class="col-md-6">
									<label for="activoinputext4">Modelo</label>
									<input type="text" class="form-control" id="activoinputext4" value="{{$Activos->ActModel}}" name="ActModel" required>
								</div>
								<div class="col-md-6">
									<label for="activoinputext5">Talla</label>
									<input type="text" class="form-control" id="activoinputext5" value="{{$Activos->ActTalla}}" name="ActTalla" required>
								</div>
								
								<div class="col-md-6">
									<label for="activoinputext7">Serial Proveedor</label>
									<input type="text" class="form-control" id="activoinputext7" value="{{$Activos->ActSerialProveed}}" name="ActSerialProveed" required>
								</div>
								<div class="col-md-12">
									<label for="activoinputext6">Observaciones</label>
									<input type="text" class="form-control" id="activoinputext6" value="{{$Activos->ActObserv}}" name="ActObserv" required>
								</div>
								<div class="container-fluid spark-screen">
									<div class="row">			
										<div class="box-footer" style="float:right; margin-right:5%">
											<button type="submit" class="btn btn-primary">Actualizar</button>
										</div>	
									</div>
								</div>
							</form>
						</div>						
					</div>
				</div>
			</div>
			<!--/.col (right) -->
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</div>
@endsection
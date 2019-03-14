@extends('layouts.app')
@section('htmlheader_title','Capacitaciones')
@section('contentheader_title','Edicion de Capacitacion')
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header">
	                @component('layouts.partials.modal')
	                    {{$training->ID_Capa}}
	                @endcomponent
					<h3 class="box-title">Datos del mantenimiento</h3>
					@if($training->CapaDelete == 0)
						<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$training->ID_Capa}}' class='btn btn-danger' style="float: right;">Eliminar</a>
						<form action='/capacitacion/{{$training->ID_Capa}}' method='POST'>
							@method('DELETE')
							@csrf
							<input  type="submit" id="Eliminar{{$training->ID_Capa}}" style="display: none;">
						</form>
					@else
						<form action='/capacitacion/{{$training->ID_Capa}}' method='POST' style="float: right;">
							@method('DELETE')
							@csrf
							<input type="submit" class='btn btn-success' value="Añadir">
						</form>
					@endif
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<form role="form" action="/capacitacion/{{$training->ID_Capa}}" method="POST" enctype="multipart/form-data">
								@method('PATCH')
								@csrf
								<div class="box-body">
									<div class="col-xs-6">
										<label for="CapaName">Nombre de la Capacitacion</label>
										<input required="true" name="CapaName" autofocus="true" type="text" class="form-control" id="CapaName" value="{{$training->CapaName}}">
									</div>
									<div class="col-xs-6" style="padding-left: 0; ">
										<label for="CapaTipo">Tipo de Capacitacion</label>
										<select name="CapaTipo" id="CapaTipo" class="form-control">
											<option value="{{$training->CapaTipo}}">Seleccione...</option>
											<option value="1">Interna</option>
											<option value="0">Externa</option>
										</select>
									</div>
								</div>	
								<div class="box-footer" style="float:right; margin-right:5%">
									<button type="submit" class="btn btn-primary">Registrar</button>
								</div>
							</form>
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
	<!-- /.box -->
</div>
@endsection

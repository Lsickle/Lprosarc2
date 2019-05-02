@extends('layouts.app')
@section('htmlheader_title','Areas')
@section('contentheader_title','Registro de Areas')
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<form role="form" action="/areas" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="box-body">
									<div class="col-xs-12 col-md-12">
										<label for="NombreArea">Nombre del área</label>
										<input required="true" name="NomArea" autofocus="true" type="text" class="form-control" id="NombreArea" >
									</div>
									<div class="col-xs-12 col-md-12">
										<label for="SedeSelect">Sede</label>
										<select name="AreaSede" id="SedeSelect" class="form-control">
											@foreach($Sedes as $Sede)
												<option value="{{$Sede->ID_Sede}}">{{$Sede->SedeName}}</option>
											@endforeach
										</select>
									</div>
								</div>	
								<div class="box-footer">
									<button type="submit" class="btn btn-primary pull-right">Registrar</button>
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

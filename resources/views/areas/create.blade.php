@extends('layouts.app')
@section('htmlheader_title','Registro de areas')
@section('contentheader_title','Registro de areas')
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
							{{-- <div class="box-header with-border">
								<h3 class="box-title">Quick Example</h3>
							</div> --}}
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/areas" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="box-body">
									<div class="col-xs-6">
										<label for="NombreArea">Nombre Area</label>
										<input required="true" name="NomArea" autofocus="true" type="text" class="form-control" id="NombreArea" >
									</div>
									<div class="col-xs-6" style="padding-left: 0; ">
										<label for="SedeSelect">Sede</label>
										<select name="AreaSede" id="SedeSelect" class="form-control">
											@foreach($Sedes as $Sede)
												<option value="{{$Sede->ID_Sede}}">{{$Sede->SedeName}}</option>
											@endforeach
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

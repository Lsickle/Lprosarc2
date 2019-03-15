@extends('layouts.app')
@section('htmlheader_title','Capacitaciones')
@section('contentheader_title','Registro de Capacitaciones')
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
							<form role="form" action="/capacitacion-personal" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="col-xs-6">
										<label for="CapaPersDate">Aprovacion de la Capacitacion</label>
										<input required="true" name="CapaPersDate" autofocus="true" type="date" class="form-control" id="CapaPersDate" >
									</div>
								<div class="col-xs-6">
									<label for="CapaPersExpire">Expiracion de la Capacitacion</label>
									<input required="true" name="CapaPersExpire" autofocus="true" type="date" class="form-control" id="CapaPersExpire" >
								</div>
									<div class="col-xs-6">
										<label for="FK_Pers">Persona</label>
										<select name="FK_Pers" id="FK_Pers" class="form-control">
											<option value="1">Seleccione...</option>
											@foreach($Personals as $Personal)
												<option value="{{$Personal->ID_Pers}}">{{$Personal->PersFirstName. ' ' .$Personal->PersLastName}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-xs-6">
										<label for="FK_Capa">Capacitacion</label>
										<select name="FK_Capa" id="FK_Capa" class="form-control">
											<option value="1">Seleccione...</option>
											@foreach($Trainings as $Training)
												<option value="{{$Training->ID_Capa}}">{{$Training->CapaName}}</option>
											@endforeach
										</select>
									</div>
								<div class="box-body">
									<div class="col-xs-6" style="padding-left: 0; ">
										<label for="FK_Sede">Sede de la Capacitacion</label>
										<select name="FK_Sede" id="FK_Sede" class="form-control">
											<option value="1">Seleccione...</option>
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
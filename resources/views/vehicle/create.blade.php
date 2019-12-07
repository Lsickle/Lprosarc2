@extends('layouts.app')
@section('htmlheader_title')
{{trans('adminlte_lang::message.vehicletitle')}}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, rgb(69, 202, 252), rgb(48, 63, 159)); padding-right:30vw; position:relative; overflow:hidden;">
	{{ trans('adminlte_lang::message.vehicletitle') }}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{trans('adminlte_lang::message.vehiclecreate')}}</h3>
				</div>
				<div class="box box-info">
					<form role="form" action="/vehicle" method="POST" enctype="multipart/form-data" data-toggle="validator">
						@csrf
						<div class="box-body">
							<div class="form-group col-md-12">
								<label for="FK_VehiSede">{{trans('adminlte_lang::message.vehicsedes')}}</label>
								<small class="help-block with-errors">*</small>
								<select class="form-control" id="FK_VehiSede" name="FK_VehiSede" required="true">
									<option value="">{{ trans('adminlte_lang::message.select') }}</option>
									@foreach($Sedes as $Sede)
										<option value="{{$Sede->ID_Sede}}">{{$Sede->SedeName}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="VehicPlaca">{{trans('adminlte_lang::message.vehicplaca')}}</label>
								<small class="help-block with-errors">*</small>
								<input type="text" class="form-control placa" id="VehicPlaca" name="VehicPlaca" data-minlength="7" required="true">
							</div>
							
							<div class="form-group col-md-6">
								<label for="VehicCapacidad">{{trans('adminlte_lang::message.vehiccapacidad')}}</label>
								<small class="help-block with-errors">*</small>
								<input type="number" class="form-control" id="VehicCapacidad" name="VehicCapacidad" required="true" max="999999">
							</div>
							<div class="form-group col-md-6">
								<label for="VehicKmActual">{{trans('adminlte_lang::message.vehickm')}}</label>
								<small class="help-block with-errors">*</small>
								<input type="number" class="form-control" id="VehicKmActual" name="VehicKmActual" required="true" max="999999">
							</div>
							<div class="form-group col-md-6">
								<label for="VehicTipo">{{trans('adminlte_lang::message.vehictipo')}}</label>
								<small class="help-block with-errors">*</small>
								<select class="form-control" id="VehicTipo" name="VehicTipo" required="true" maxlength="64">
									<option value="Camión sencillo (2 Ejes)">Camión sencillo (2 Ejes)</option>
									<option value="Dobletroque (3 Ejes)">Dobletroque (3 Ejes)</option>
									<option value="Camión de 4 ejes">Camión de 4 ejes</option>
									<option value="Tractocamión (2S1)">Tractocamión (2S1)</option>
									<option value="Tractocamión (2S3)">Tractocamión (2S3)</option>
									<option value="Tractocamión (3S1)">Tractocamión (3S1)</option>
									<option value="Tractocamión (3S2)">Tractocamión (3S2)</option>
									<option value="Tractocamión (3S3)">Tractocamión (3S3)</option>
								</select>
							</div>
						</div>
						<div class="box box-info">
							<div class="box-footer">
								<button type="submit" class="btn btn-success pull-right">{{trans('adminlte_lang::message.register')}}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
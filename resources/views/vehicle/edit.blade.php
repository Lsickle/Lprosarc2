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
				<div class="box-header">
					@component('layouts.partials.modal')
						@slot('slug')
							{{$Vehicle->VehicPlaca}}
						@endslot
						@slot('textModal')
							el vehiculo con placa <b>{{$Vehicle->VehicPlaca}}</b>
						@endslot
					@endcomponent
					<h3 class="box-title">{{trans('adminlte_lang::message.vehicleedit')}}</h3>
					@if($Vehicle->VehicDelete === 0)
					<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Vehicle->VehicPlaca}}'  class='btn btn-danger pull-right'><i class="fas fa-trash-alt"></i><b> {{ trans('adminlte_lang::message.delete') }}</b></a>
					<form action='/vehicle/{{$Vehicle->VehicPlaca}}' method='POST'>
						@method('DELETE')
						@csrf
						<input  type="submit" id="Eliminar{{$Vehicle->VehicPlaca}}" style="display: none;">
					</form>
					@else
					<form action='/vehicle/{{$Vehicle->VehicPlaca}}' method='POST' style="float: right;">
						@method('DELETE')
						@csrf
						<button type="submit" class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.add') }}</button>
					</form>
					@endif
				</div>
				<div class="box box-info">
					<form role="form" action="/vehicle/{{$Vehicle->VehicPlaca}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
						@method('PUT')
						@csrf
						<div class="box-body">
							<div class="form-group col-md-12">
								<label for="FK_VehiSede">{{trans('adminlte_lang::message.vehicsedes')}}</label>
								<small class="help-block with-errors">*</small>
								<select class="form-control" id="FK_VehiSede" name="FK_VehiSede" required="true">
									<option value="">{{ trans('adminlte_lang::message.select') }}</option>
									@foreach($Sedes as $Sede)
										<option value="{{$Sede->ID_Sede}}" {{$Vehicle->FK_VehiSede == $Sede->ID_Sede ? 'selected' : ''}}>{{$Sede->SedeName}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="VehicPlaca">{{trans('adminlte_lang::message.vehicplaca')}}</label>
								<small class="help-block with-errors">*</small>
								<input type="text" class="form-control placa" id="VehicPlaca" name="VehicPlaca" required="true" data-minlength="7" value="{{$Vehicle->VehicPlaca}}">
							</div>
							<div class="form-group col-md-6">
								<label for="VehicTipo">{{trans('adminlte_lang::message.vehictipo')}}</label>
								<small class="help-block with-errors">*</small>
								<input type="text" class="form-control" id="VehicTipo" name="VehicTipo" maxlength="16" value="{{$Vehicle->VehicTipo}}">
							</div>
							<div class="form-group col-md-6">
								<label for="VehicCapacidad">{{trans('adminlte_lang::message.vehiccapacidad')}}</label>
								<small class="help-block with-errors">*</small>
								<input type="number" class="form-control" id="VehicCapacidad" name="VehicCapacidad" max="999999" value="{{$Vehicle->VehicCapacidad}}">
							</div>
							<div class="form-group col-md-6">
								<label for="VehicKmActual">{{trans('adminlte_lang::message.vehickm')}}</label>
								<small class="help-block with-errors">*</small>
								<input type="number" class="form-control" id="VehicKmActual" name="VehicKmActual" required="true" max="999999" value="{{$Vehicle->VehicKmActual}}">
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box box-info">
							<div class="box-footer">
								<button type="submit" class="btn btn-success pull-right">{{trans('adminlte_lang::message.update')}}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
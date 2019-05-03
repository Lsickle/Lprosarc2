@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.cargotitle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.cargotitle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{trans('adminlte_lang::message.createcargo')}}</h3>
				</div>
				<div class="box box-info">
					<form role="form" action="/cargosInterno" method="POST" enctype="multipart/form-data" data-toggle="validator">
						@csrf
						@if ($errors->any())
							<div class="alert alert-danger" role="alert">
								<ul>
									@foreach ($errors->all() as $error)
										<p>{{$error}}</p>
									@endforeach
								</ul>
							</div>
						@endif
						<div class="box-body">
							<div class="form-group col-xs-6 col-md-6">
								<label for="NombreCargo">{{trans('adminlte_lang::message.cargoname')}}</label><small class="help-block with-errors">*</small>
								<input data-minlength="8" data-error="{{ trans('adminlte_lang::message.data-error-minlength4') }}" required name="CargName" autofocus="true" type="text" class="form-control inputText" id="NombreCargo" value="{{old('CargName')}}">
							</div>
							<div class="form-group col-xs-6 col-md-6">
								<label for="CargoGrade">{{trans('adminlte_lang::message.cargograde')}}</label>
								<select name="CargGrade" id="CargoGrade" class="form-control select">
									<option value="">{{trans('adminlte_lang::message.select')}}</option>
									<option {{old('CargGrade') == trans('adminlte_lang::message.cargogradelist1') ? 'selected' : ''}}>{{trans('adminlte_lang::message.cargogradelist1')}}</option>
									<option {{old('CargGrade') == trans('adminlte_lang::message.cargogradelist2') ? 'selected' : ''}}>{{trans('adminlte_lang::message.cargogradelist2')}}</option>
									<option {{old('CargGrade') == trans('adminlte_lang::message.cargogradelist3') ? 'selected' : ''}}>{{trans('adminlte_lang::message.cargogradelist3')}}</option>
									<option {{old('CargGrade') == trans('adminlte_lang::message.cargogradelist4') ? 'selected' : ''}}>{{trans('adminlte_lang::message.cargogradelist4')}}</option>
								</select>
							</div>
							<div class="form-group col-xs-6 col-md-6">
								<label for="CargoSalary">{{trans('adminlte_lang::message.cargosalary')}}</label>
								<input maxlength="12" name="CargSalary" autofocus="true" type="text" class="form-control money" id="CargoSalary" value="{{old('CargSalary')}}">
							</div>
							<div class="form-group col-xs-6 col-md-6">
								<label for="AreaSelect">{{trans('adminlte_lang::message.areaname')}}</label><small class="help-block with-errors">*</small>
								<select name="CargArea" required id="AreaSelect" class="form-control select">
									<option value="">{{trans('adminlte_lang::message.select')}}</option>
									@foreach($Areas as $Area)
										<option value="{{$Area->ID_Area}}" {{old('CargArea') == $Area->ID_Area ? 'selected' : ''}}>{{$Area->AreaName}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="box box-info">
							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">{{trans('adminlte_lang::message.register')}}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

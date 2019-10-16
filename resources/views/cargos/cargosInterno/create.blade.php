@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.cargotitle') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #FFFFFF, #A3A2AE); padding-right:30vw; position:relative; overflow:hidden;">
	{{ trans('adminlte_lang::message.cargotitle') }}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header with-border">
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
							<div class="form-group col-md-6">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.cargoareatittle') }}" data-content="{{ trans('adminlte_lang::message.cargoareainfo') }}" for="AreaSelect"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.inputarea')}}</label><small class="help-block with-errors">*</small>
								<select name="CargArea" required id="AreaSelect" class="form-control select">
									<option value="">{{trans('adminlte_lang::message.select')}}</option>
									@foreach($Areas as $Area)
										<option value="{{$Area->AreaSlug}}">{{$Area->AreaName}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-6">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.cargogradetittle') }}" data-content="{{ trans('adminlte_lang::message.cargogradeinfo') }}" for="CargoGrade"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.cargograde')}}</label>
								<select name="CargGrade" id="CargoGrade" class="form-control">
									<option value="">{{trans('adminlte_lang::message.select')}}</option>
									<option>{{trans('adminlte_lang::message.cargogradelist1')}}</option>
									<option>{{trans('adminlte_lang::message.cargogradelist2')}}</option>
									<option>{{trans('adminlte_lang::message.cargogradelist3')}}</option>
									<option>{{trans('adminlte_lang::message.cargogradelist4')}}</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.cargonametittle') }}" data-content="{{ trans('adminlte_lang::message.cargonameinfo') }}" for="NombreCargo"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.cargoname')}}</label><small class="help-block with-errors">*</small>
								<input data-minlength="5" required name="CargName" autofocus="true" type="text" class="form-control inputText" id="NombreCargo" value="{{old('CargName')}}">
							</div>
							
							<div class="form-group col-md-6">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.cargosalarytittle') }}" data-content="{{ trans('adminlte_lang::message.cargosalaryinfo') }}" for="CargoSalary"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.cargosalary')}}</label>
								<input maxlength="12" name="CargSalary" autofocus="true" type="text" class="form-control money" id="CargoSalary" value="{{old('CargSalary')}}">
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

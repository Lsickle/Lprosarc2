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
			<div class="box box-info">
				<div class="box-header">
					<h3 class="box-title">{{trans('adminlte_lang::message.createcargo')}}</h3>
				</div>
				<div class="box">
					<form role="form" action="/cargos" method="POST" enctype="multipart/form-data" data-toggle="validator">
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
							<div class="form-group col-xs-12 col-md-12">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.cargoareatittle') }}" data-content="{{ trans('adminlte_lang::message.cargoareainfo') }}" for="AreaSelect"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.inputarea')}}</label><small class="help-block with-errors">*</small>
								<select name="CargArea" required id="AreaSelect" class="form-control select">
									<option value="">{{trans('adminlte_lang::message.select')}}</option>
									@foreach($Areas as $Area)
										<option value="{{$Area->ID_Area}}" {{old('CargArea') == $Area->ID_Area ? 'selected' : ''}}>{{$Area->AreaName}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-xs-12 col-md-12">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.cargonametittle') }}" data-content="{{ trans('adminlte_lang::message.cargonameinfo') }}" for="NombreCargo"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.cargoname')}}</label><small class="help-block with-errors">*</small>
								<input data-minlength="8" data-error="{{ trans('adminlte_lang::message.data-error-minlength4') }}" required name="CargName" autofocus="true" type="text" class="form-control inputText" id="NombreCargo" value="{{old('NomCarg')}}">
							</div>
							
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-success pull-right">{{trans('adminlte_lang::message.register')}}</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

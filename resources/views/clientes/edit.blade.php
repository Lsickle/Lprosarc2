@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientcliente') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.clientcliente') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.edit') }}</h3>
				</div>
				<div class="box box-info">
					<!-- form start -->
					@if(Route::currentRouteName() === 'clientes.edit')
						<form role="form" action="/clientes/{{$cliente->CliSlug}}" method="POST" enctype="multipart/form-data"  data-toggle="validator" class="form">
					@else
						<form role="form" action="/cliente/{{$cliente->CliSlug}}/update" method="POST" enctype="multipart/form-data"  data-toggle="validator" class="form">
					@endif
						{{csrf_field()}}
						@csrf
						@method('PUT')
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
							<div class="col-md-6 form-group">
								<label for="ClienteInputNit">{{ trans('adminlte_lang::message.clientNIT') }}</label><small class="help-block with-errors">*</small>
								<input type="text" name="CliNit" class="form-control nit" id="ClienteInputNit" data-minlength="13" maxlength="13" placeholder="{{ trans('adminlte_lang::message.clientNITplacehoder') }}" required value="{{$cliente->CliNit}}">
							</div>
							<div class="col-md-6 form-group">
								<label for="ClienteInputRazon">{{ trans('adminlte_lang::message.clirazonsoc') }}</label><small class="help-block with-errors">*</small>
								<input type="text" name="CliName" class="form-control" id="ClienteInputRazon"  data-minlength="5"  maxlength="100" required value="{{$cliente->CliName}}">
							</div>
							<div class="col-md-6 form-group">
								<label for="ClienteInputNombre" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b>" data-content="{{ trans('adminlte_lang::message.contacclientnombrecortomessage') }}">
									<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
									{{ trans('adminlte_lang::message.clientnombrecorto') }}
								</label>
								<small class="help-block with-errors">*</small>
								<input type="text" name="CliShortname" class="form-control" id="ClienteInputNombre" data-minlength="2"  maxlength="100" required value="{{$cliente->CliShortname}}">
							</div>
							<div class="col-md-6 form-group">
								<label for="CliRut" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.clientrut') }}</b>" data-content="{{ trans('adminlte_lang::message.clientrut-info') }}">
									<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
									{{ trans('adminlte_lang::message.clientrut') }}
								</label>
								<small class="help-block with-errors"></small>
								<div class="input-group">
									<input type="file" name="CliRut" class="form-control" id="CliRut" accept=".pdf" data-accept="pdf" data-filesize="5120">
									<div class="input-group-btn ">
										<a class="{{$cliente->CliRut === null ? 'btn btn-default' : 'btn btn-success'}}">
											<i class='{{$cliente->CliRut === null ? 'fas fa-ban' : 'fas fa-file-pdf'}}'></i>
										</a>
									</div>
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label for="CliCamaraComercio" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.clientcamaracomercio') }}</b>" data-content="{{ trans('adminlte_lang::message.clientcamaracomercio-info') }}">
									<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
									{{ trans('adminlte_lang::message.clientcamaracomercio') }}
								</label>
								<small class="help-block with-errors"></small>
								<div class="input-group">
									<input type="file" name="CliCamaraComercio" class="form-control" id="CliCamaraComercio" accept=".pdf" data-accept="pdf" data-filesize="5120">
									<div class="input-group-btn ">
										<a class="{{$cliente->CliCamaraComercio === null ? 'btn btn-default' : 'btn btn-success'}}">
											<i class='{{$cliente->CliCamaraComercio === null ? 'fas fa-ban' : 'fas fa-file-pdf'}}'></i>
										</a>
									</div>
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label for="CliRepresentanteLegal" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.clientlegalrepresentative') }}</b>" data-content="{{ trans('adminlte_lang::message.clientlegalrepresentative-info') }}">
									<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
									{{ trans('adminlte_lang::message.clientlegalrepresentative') }}
								</label>
								<small class="help-block with-errors"></small>
								<div class="input-group">
									<input type="file" name="CliRepresentanteLegal" class="form-control" id="CliRepresentanteLegal" accept=".pdf" data-accept="pdf" data-filesize="5120">
									<div class="input-group-btn ">
										<a class="{{$cliente->CliRepresentanteLegal === null ? 'btn btn-default' : 'btn btn-success'}}">
											<i class='{{$cliente->CliRepresentanteLegal === null ? 'fas fa-ban' : 'fas fa-file-pdf'}}'></i>
										</a>
									</div>
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label for="CliCertificaionBancaria" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.clientbankcertification') }}</b>" data-content="{{ trans('adminlte_lang::message.clientbankcertification-info') }}">
									<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
									{{ trans('adminlte_lang::message.clientbankcertification') }}
								</label>
								<small class="help-block with-errors"></small>
								<div class="input-group">
									<input type="file" name="CliCertificaionBancaria" class="form-control" id="CliCertificaionBancaria" accept=".pdf" data-accept="pdf" data-filesize="5120">
									<div class="input-group-btn ">
										<a class="{{$cliente->CliCertificaionBancaria === null ? 'btn btn-default' : 'btn btn-success'}}">
											<i class='{{$cliente->CliCertificaionBancaria === null ? 'fas fa-ban' : 'fas fa-file-pdf'}}'></i>
										</a>
									</div>
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label for="CliCertificaionComercial" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.clientcommercialcertification') }}</b>" data-content="{{ trans('adminlte_lang::message.clientcommercialcertification-info') }}">
									<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
									{{ trans('adminlte_lang::message.clientcommercialcertification') }}
								</label>
								<small class="help-block with-errors"></small>
								<div class="input-group">
									<input type="file" name="CliCertificaionComercial" class="form-control" id="CliCertificaionComercial" accept=".pdf" data-accept="pdf" data-filesize="5120">
									<div class="input-group-btn ">
										<a class="{{$cliente->CliCertificaionComercial === null ? 'btn btn-default' : 'btn btn-success'}}">
											<i class='{{$cliente->CliCertificaionComercial === null ? 'fas fa-ban' : 'fas fa-file-pdf'}}'></i>
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="box box-info">
							<div class="box-footer">
								<button type="submit" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.update') }}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

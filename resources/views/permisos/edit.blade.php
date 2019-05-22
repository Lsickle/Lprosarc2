@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.user') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.user') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.useredit') }}</h3>
				</div>
				<div class="box box-info">
					<!-- form start -->
					<form role="form" action="/permisos/{{$User->UsSlug}}" method="POST" enctype="multipart/form-data"  data-toggle="validator" class="form">
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
							<div class="form-group col-md-12">
								<label for="ClienteInputNit">{{ trans('adminlte_lang::message.clientNIT') }}</label><small class="help-block with-errors">*</small>
								<input type="text" name="CliNit" class="form-control" id="ClienteInputNit" data-maxlength="255" required value="{{$User->name}}">
							</div>
							<div class="col-md-12 form-group">
								<label for="ClienteInputRazon">{{ trans('adminlte_lang::message.clirazonsoc') }}</label><small class="help-block with-errors">*</small>
								<input type="text" name="CliName" class="form-control" id="ClienteInputRazon"  maxlength="100" required value="{{$User->email}}">
							</div>
							<div class="col-md-12 form-group">
								<label for="ClienteInputNombre">{{ trans('adminlte_lang::message.clientnombrecorto') }}</label><small class="help-block with-errors">*</small>
								<input type="" name="CliShortname" class="form-control" id="ClienteInputNombre" minlength="2"  maxlength="100" required value="{{$User->password}}">
							</div>
						</div>
						<div class="box box-info">
							<div class="box-footer">
								<button type="submit" class="btn btn-warning pull-right">{{ trans('adminlte_lang::message.update') }}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

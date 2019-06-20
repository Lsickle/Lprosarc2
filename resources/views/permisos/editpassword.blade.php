@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.user') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.changepassword') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 col-xs-12">
			<div class="box box-info">
				<div class="box-body box-profile form-group">
					<form role="form" action="/permiso/{{$User->UsSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
						@method('PUT')
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
						@if (session('Menssage'))
							<div class="alert alert-danger" role="alert">
								{{session('Menssage')}}
							</div>
						@endif
						<div class="form-group col-md-12 col-xs-12">
							<label for="oldpassword">{{ trans('adminlte_lang::message.oldpassword') }}</label><small class="help-block with-errors">*</small>
							<input required name="oldpassword" class="form-control" type="password" id="oldpassword" data-minlength="6" data-error="{{ trans('adminlte_lang::message.data-error-minlength6') }}"maxlength="255">
						</div>
						<div class="form-group col-md-12 col-xs-12">
							<label for="newpassword">{{ trans('adminlte_lang::message.newpassword') }}</label><small class="help-block with-errors">*</small>
							<input required name="newpassword" class="form-control" type="password" id="newpassword" data-minlength="6" data-error="{{ trans('adminlte_lang::message.data-error-minlength6') }}" maxlength="255">
						</div>
						<div class="form-group col-md-12 col-xs-12">
							<label for="newpassword_confirmation">{{ trans('adminlte_lang::message.confirmpassword') }}</label><small class="help-block with-errors">*</small>
							<input required name="newpassword_confirmation" data-minlength="6" maxlength="255" data-match="#newpassword" data-error="{{ trans('adminlte_lang::message.confirmpasswordfalse') }}" class="form-control" type="password" id="newpassword_confirmation">
						</div>
						<div class="col-md-12 col-xs-12">
							<button type="submit" class="btn btn-info pull-right">{{ trans('adminlte_lang::message.change') }}</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
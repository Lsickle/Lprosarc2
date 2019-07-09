@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.profile') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.changepassword') }}
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		{{-- seccion de prueba --}}
			<div class="row">
				<div class="col-md-8 col-md-offset-2 col-xs-12">
					<!-- Profile Image -->
					<div class="box box-primary">
						<div class="box-body box-profile form-group">
							<form role="form" action="/profile/{{$user->UsSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
								@method('PATCH')
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
									@if (!session('Error'))
								    	<div class="alert alert-success" role="alert">
								    @else
								    	<div class="alert alert-danger" role="alert">
								    @endif
								        {{session('Menssage')}}
								    </div>
								@endif
								<div class="form-group col-md-12 col-xs-12">
									<input type="hidden" name="email" value="{{$user->email}}">
									<label for="oldpassword">{{ trans('adminlte_lang::message.oldpassword') }}</label><small class="help-block with-errors">*</small>
									<input required name="oldpassword" class="form-control" type="password" id="oldpassword">
								</div>
								<div class="form-group col-md-12 col-xs-12">
									<label for="newpassword">{{ trans('adminlte_lang::message.newpassword') }}</label><small class="help-block with-errors">*</small>
									<input required name="newpassword" class="form-control" type="password" id="newpassword">
								</div>
								<div class="form-group col-md-12 col-xs-12">
									<label for="newpassword_confirmation">{{ trans('adminlte_lang::message.confirmpassword') }}</label><small class="help-block with-errors">*</small>
									<input required name="newpassword_confirmation" data-match="#newpassword" class="form-control" type="password" id="newpassword_confirmation">
								</div>
								<div class="col-md-12 col-xs-12">
									<button type="submit" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.change') }}</button>
								</div>
							</form>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
			</div>
		<!-- /.row -->
	</div>
@endsection
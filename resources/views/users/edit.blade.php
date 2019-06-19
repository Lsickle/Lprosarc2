@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.profile') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.profileedit') }}
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		{{-- seccion de prueba --}}
			<div class="row">
				<div class="col-md-8 col-md-offset-2 col-xs-12">
					<!-- Profile Image -->
					<div class="box box-primary">
						<div class="box-body box-profile form-group">
								@if ($errors->any())
									<div class="alert alert-danger" role="alert">
										<ul>
											@foreach ($errors->all() as $error)
												<p>{{$error}}</p>
											@endforeach
										</ul>
									</div>
								@endif
							<div class="col-md-12 col-xs-12">
								<div id="foto" class="img-responsive img-circle" title="Cambiar Foto" style="cursor: pointer; margin: 0 auto; width: 100px;">
									@if(file_exists(public_path().'/img/ImagesProfile/'.Auth::user()->UsAvatar) && Auth::user()->UsAvatar <> null)
										<img class="profile-user-img img-responsive img-circle" src="../../../img/ImagesProfile/{{Auth::user()->UsAvatar}}" alt="User profile picture">
									@else
										<img class="profile-user-img img-responsive img-circle" src="../../../img/defaultuser.png" alt="User profile picture">
									@endif
								</div>
							</div>
							<form role="form" action="/profile/{{$user->UsSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
								@method('PUT')
								@csrf
								<div class="col-md-6 col-md-offset-2 col-xs-6 col-xs-offset-2 form-group">
									<small class="help-block with-errors"></small>
									<input id="UsAvatar" name="UsAvatar" style="display: none;" type="file" class="form-control" accept=".jpg,.png" data-filesize="2048">
								</div>
								<div class="form-group col-md-12 col-xs-12">
									<label for="name">{{ trans('adminlte_lang::message.username') }}</label><small class="help-block with-errors">*</small>
									<input required name="name" class="form-control" type="text" id="name" value="{{$user->name}}">
								</div>
								<div class="form-group col-md-12 col-xs-12">
									<label for="email">{{ trans('adminlte_lang::message.emailaddress') }}</label><small class="help-block with-errors">*</small>
									<input required name="email" class="form-control" type="email" id="email" value="{{$user->email}}">
								</div>
								<div class="col-md-12 col-xs-12">
									<input type="submit" class="btn btn-primary pull-right" value="{{ trans('adminlte_lang::message.update') }}">
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
@section('NewScript')
	<script>
		$('#foto').on('click', function(){
			$('#UsAvatar').click();
		});
	</script>
@endsection
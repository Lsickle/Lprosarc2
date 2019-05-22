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
					<h3 class="box-title">{{ trans('adminlte_lang::message.userregister') }}</h3>
				</div>
				<div class="box box-info">
					<form role="form" action="/permisos" method="POST" enctype="multipart/form-data" data-toggle="validator">
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
                                <label for="FK_UserPers">{{ trans('adminlte_lang::message.userpersonadd') }}</label></label><small class="help-block with-errors"></small>
								<select class="form-control select" id="FK_UserPers" name="FK_UserPers">
                                    <option value="">{{ trans('adminlte_lang::message.select') }}</option>
									@foreach ($Personals as $Personal)		
                                        <option value="{{$Personal->PersSlug}}" {{ old('FK_UserPers') == $Personal->PersSlug ? 'selected' : '' }}>{{$Personal->PersFirstName}} {{$Personal->PersLastName}}</option>
									@endforeach
								</select>
							</div>
                            <div class="form-group col-md-6">
                                <label for="name">{{ trans('adminlte_lang::message.username') }}</label></label><small class="help-block with-errors">*</small>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">{{ trans('adminlte_lang::message.emailaddress') }}</label></label><small class="help-block with-errors">*</small>
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{ trans('adminlte_lang::message.emailplaceholder') }}" value="{{ old('email') }}" required>
                            </div>
							<div class="form-group col-md-6">
								<label for="UsAvatar">{{ trans('adminlte_lang::message.useravatar') }}</label></label><small class="help-block with-errors"></small>
								<input type="file" class="form-control" id="UsAvatar" name="UsAvatar" value="{{ old('UsAvatar') }}">
                            </div>

							<div class="form-group col-md-6">
								<label for="UsType">{{ trans('adminlte_lang::message.usertype') }}</label></label><small class="help-block with-errors"></small>
                                <input type="text" class="form-control" id="UsType" name="UsType" maxlength="64"  value="{{ old('UsType') }}">
							</div>
							<div class="form-group col-md-6">
								<label for="UsStatus">{{ trans('adminlte_lang::message.userstatus') }}</label></label><small class="help-block with-errors"></small>
                                <input type="text" class="form-control" id="UsStatus" name="UsStatus" maxlength="32"  value="{{ old('UsStatus') }}">
							</div>
							<div class="form-group col-md-6">
								<label for="password">{{ trans('adminlte_lang::message.password') }}</label></label><small class="help-block with-errors"></small>
                                <input type="password" class="form-control" id="password" name="password" maxlength="32"  value="{{ old('password') }}">
							</div>
                            <div class="form-group col-md-6">
                                <label for="UsRol">{{ trans('adminlte_lang::message.userrol') }}</label></label><small class="help-block with-errors">*</small>
                                <input type="text" class="form-control" id="UsRol" name="UsRol" maxlength=""  value="{{ old('UsRol') }}" required>
                            </div>
							<div class="form-group col-md-6">
								<label for="UsRolDesc">{{ trans('adminlte_lang::message.userdescriptionrol') }}</label></label><small class="help-block with-errors">*</small>
                                <input type="text" class="form-control" id="UsRolDesc" name="UsRolDesc" maxlength=""  value="{{ old('UsRolDesc') }}" required>
							</div>
							<div class="form-group col-md-6">
								<label for="UsRol2">{{ trans('adminlte_lang::message.userrol2') }}</label></label><small class="help-block with-errors">*</small>
                                <input type="text" class="form-control" id="UsRol2" name="UsRol2" maxlength=""  value="{{ old('UsRol2') }}" required>
							</div>
							<div class="form-group col-md-6">
								<label for="UsRolDesc2">{{ trans('adminlte_lang::message.userdescriptionrol2') }}</label></label><small class="help-block with-errors">*</small>
                                <input type="text" class="form-control" id="UsRolDesc2" name="UsRolDesc2" maxlength=""  value="{{ old('UsRolDesc2') }}" required>
							</div>
							
						</div>
						<div class="box box-info">
							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.register') }}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

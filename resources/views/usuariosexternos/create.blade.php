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
					<form role="form" action="/UsuariosCliente" method="POST" enctype="multipart/form-data" data-toggle="validator">
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
								<select required class="form-control select" id="FK_UserPers" name="FK_UserPers">
                                    <option value="">{{ trans('adminlte_lang::message.select') }}</option>
									@foreach ($Personals as $Personal)		
                                        <option value="{{$Personal->PersSlug}}" {{ old('FK_UserPers') == $Personal->PersSlug ? 'selected' : '' }}>{{$Personal->PersFirstName}} {{$Personal->PersLastName}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-6">
                                <label for="name">{{ trans('adminlte_lang::message.username') }}</label></label><small class="help-block with-errors">*</small>
                                <input type="text" class="form-control inputText" id="name" name="name" value="{{ old('name') }}" maxlength="64" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">{{ trans('adminlte_lang::message.emailaddress') }}</label></label><small class="help-block with-errors">*</small>
                                <input type="email" class="form-control" id="email" name="email" maxlength="255" placeholder="{{ trans('adminlte_lang::message.emailplaceholder') }}" value="{{ old('email') }}" required>
							</div>
							<div class="form-group col-md-6">
								<label for="UsAvatar">{{ trans('adminlte_lang::message.useravatar') }}</label></label><small class="help-block with-errors"></small>
								<input type="file" class="form-control" id="UsAvatar" name="UsAvatar" accept=".jpg, .png, .svg,.gif" data-accept="jpg, jpeg, png, svg, gif" data-filesize="5120" value="{{ old('UsAvatar') }}">
                            </div>
							<div class="form-group col-md-6">
								<label for="password">{{ trans('adminlte_lang::message.password') }}</label></label><small class="help-block with-errors">*</small>
                                <input type="password" class="form-control" id="password" name="password" data-minlength="8" maxlength="255"  value="{{ old('password') }}" required>
							</div>
							
							<div class="form-group col-md-6 col-xs-12">
								<label for="newpassword_confirmation">{{ trans('adminlte_lang::message.confirmpassword') }}</label><small class="help-block with-errors">*</small>
								<input required name="password_confirmation" data-minlength="8" maxlength="255" data-match="#password" class="form-control" type="password" id="newpassword_confirmation">
							</div>
						</div>
						<div class="box box-info">
							<div class="box-footer">
								<button type="submit" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.register') }}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

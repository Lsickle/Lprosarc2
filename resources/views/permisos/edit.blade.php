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
		<div class="col-md-10 col-md-offset-1">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.useredit') }}</h3>
				</div>
				<div class="box box-info">
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
							<label for="img" style="display:flex; justify-content:center;">
								<img style="cursor:pointer;" class="profile-user-img img-responsive img-circle" src="{{file_exists(public_path()."/img/ImagesProfile/$User->UsAvatar") && $User->UsAvatar <> null ? "../../../img/ImagesProfile/$User->UsAvatar" : '../../../img/defaultuser.png'}}" alt="User profile picture">
							</label>
							<input type="file" id="img" style="display:none;" name="UsAvatar" accept="image/*">
							<div class="form-group col-md-6">
								<label for="FK_UserPers">{{ trans('adminlte_lang::message.userpersonadd') }}</label></label><small class="help-block with-errors"></small>
								<select class="form-control select" id="FK_UserPers" name="FK_UserPers">
									<option value="">{{ trans('adminlte_lang::message.select') }}</option>
									{{-- Perosona Asignada en estos momentos --}}
									@if (isset($Personal))
										<option value="{{$Personal->PersSlug}}" {{ $User->FK_UserPers === $Personal->ID_Pers ? 'selected' : '' }}>{{$Personal->PersFirstName}} {{$Personal->PersLastName}}</option>
									@endif
									{{-- Personal por asignar --}}
									@foreach ($Personals as $Personal)		
										<option value="{{$Personal->PersSlug}}" {{ $User->FK_UserPers === $Personal->ID_Pers ? 'selected' : '' }}>{{$Personal->PersFirstName}} {{$Personal->PersLastName}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="name">{{ trans('adminlte_lang::message.username') }}</label><small class="help-block with-errors">*</small>
								<input type="text" name="name" class="form-control inputText" id="name" maxlength="255" required value="{{$User->name}}">
							</div>
							<div class="form-group col-md-6">
                                <label for="UsRol">{{ trans('adminlte_lang::message.userrol') }}</label></label><small class="help-block with-errors">*</small>
								<select class="form-control select" id="UsRol" name="UsRolDesc" required>
                                    <option value="">{{ trans('adminlte_lang::message.select') }}</option>
									@foreach ($Roles as $Rol)		
                                        <option value="{{$Rol->UsRolDesc}}" {{ $User->UsRolDesc == $Rol->UsRolDesc ? 'selected' : '' }}>{{$Rol->UsRolDesc}}</option>
									@endforeach
								</select>
							</div>
                            <div class="form-group col-md-6">
                                <label for="UsRol2">{{ trans('adminlte_lang::message.userrol2') }}</label></label><small class="help-block with-errors"></small>
								<select class="form-control select" id="UsRol2" name="UsRolDesc2">
                                    <option value="">{{ trans('adminlte_lang::message.select') }}</option>
									@foreach ($Roles as $Rol)		
                                        <option value="{{$Rol->UsRolDesc}}" {{ $User->UsRolDesc2 == $Rol->UsRolDesc ? 'selected' : '' }}>{{$Rol->UsRolDesc}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-md-6 form-group">
								<label for="email">{{ trans('adminlte_lang::message.emailaddress') }}</label><small class="help-block with-errors">*</small>
								<input type="text" name="email" class="form-control" id="email"  maxlength="255" required value="{{$User->email}}">
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

{{-- dudas: 	
		*un usuario puede cambiar de usuario o primero se debe desvincular un usuario
		*el programador va a poder ver todos los usuarios?
		* --}}
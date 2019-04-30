@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.profile') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.profile') }}
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		{{-- seccion de prueba --}}
			<div class="row justify-content-center">
				<div class="col-md-8 col-md-offset-2 col-xs-12">
						<!-- Profile Image -->
						<div class="box box-primary">
							<div class="box-body box-profile">
								<div class="col-xs-12-col-md-12">
									<img class="profile-user-img img-responsive img-circle" src="../../../img/{{$user->UsAvatar }}" alt="User profile picture">
									<h3 class="profile-username text-center">{{$user->name}}</h3>
									<p class="text-muted text-center">{{$user->email}}</p>
								</div>
								<div class="col-xs-12 col-md-12">
									<a href="/profile/{{$user->UsSlug}}/edit" class="btn btn-success pull-right"><b>{{ trans('adminlte_lang::message.edit') }}</b></a>
									<a href="/profile/{{$user->UsSlug}}/passwordreset" class="btn btn-primary"><b>{{ trans('adminlte_lang::message.changepassword') }}</b></a>
								</div>
							</div>
							<!-- /.box-body -->
						</div>
				</div>
			</div>
		<!-- /.row -->
	</div>
@endsection
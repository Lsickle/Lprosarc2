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
		<div class="col-md-8 col-md-offset-2">
			<div class="box box-info">
				<div class="box-body box-profile">
					<div class="col-md-12 col-xs-12">
						@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE))
							<a href="/UsuariosCliente/{{$User->UsSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{ trans('adminlte_lang::message.edit') }}</b></a>
						@endif
						@component('layouts.partials.modal')
							@slot('slug')
								{{$User->id}}
							@endslot
							@slot('textModal')
								al usuario <b>{{$User->name}}</b>
							@endslot
						@endcomponent
						@if ($User->FK_UserPers === null)
							@if($User->DeleteUser === 0)
								<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$User->id}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i><b> {{ trans('adminlte_lang::message.delete') }}</b></a>
								@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE))
									<form action='/UsuariosCliente/{{$User->UsSlug}}' method='POST'  class="col-12 pull-left">
										@method('DELETE')
										@csrf
										<input type="submit" id="Eliminar{{$User->id}}" style="display: none;">
									</form>
								@endif
							@else
								@if (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE))
									<form action='/UsuariosCliente/{{$User->UsSlug}}' method='POST' class="pull-left">
										@method('DELETE')
										@csrf
										<button type="submit" class='btn btn-success btn-block'>
											<i class="fas fa-plus-square"></i><b> {{ trans('adminlte_lang::message.add') }}</b>
										</button>
									</form>
								@endif
							@endif
						@endif

					</div>
					<p>
						<img class="profile-user-img img-responsive img-circle" src="{{file_exists(public_path()."/img/ImagesProfile/$User->UsAvatar") && $User->UsAvatar <> null ? "../../../img/ImagesProfile/$User->UsAvatar" : '../../../img/robot400x400.gif'}}" alt="User profile picture">
					</p>
					<h3 class="profile-username text-center">{{$User->name}}</h3>

					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.userpersonassigned') }}</b> 
							@if(isset($Personal))
								<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.emailaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Personal ->PersFirstName}} {{$Personal ->PersLastName}}</p>">{{$Personal ->PersFirstName}} {{$Personal ->PersLastName}}</a>
							@else
								<a href="#" class="pull-right">{{ trans('adminlte_lang::message.userpersonassignedwithout') }}</a>
							@endif
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.emailaddress') }}</b> 
							<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.emailaddress') }}')"><i class="far fa-copy"></i></a>
							<a href="#" id="{{ trans('adminlte_lang::message.emailaddress') }}" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.emailaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$User->email}}</p>">{{$User->email}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.userstatus') }}</b> <a class="pull-right">{{$User->UsStatus}}</a>
						</li>
					</ul>
					<div class="text-center">
						<a href="/UsuariosCliente/{{$User->UsSlug}}/editpassword" class="btn btn-info"><i class="fas fa-key"></i><b> {{ trans('adminlte_lang::message.userchangepassword') }}</b></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
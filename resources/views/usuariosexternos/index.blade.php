@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.users') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.users') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
                    <h3 class="box-title">{{ trans('adminlte_lang::message.userlist') }}</h3>
                    @if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE))
                    <a href="/UsuariosCliente/create" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.create') }}</a>
                    @endif
				</div>
                <div class="box box-info">
				    <div class="box-body">
                        <table id="permisosTable" class="table table-compact table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{ trans('adminlte_lang::message.username') }}</th>
                                <th>{{ trans('adminlte_lang::message.userperson') }}</th>
                                <th>{{ trans('adminlte_lang::message.emailaddress') }}</th>
                                <th>{{ trans('adminlte_lang::message.seemore') }}</th>
                            </tr>
                            </thead>
                            <tbody id="readyTable">
                            @foreach($Users as $User)
                                <tr style="{{$User->DeleteUser == 1 ? "color:red;"  : ''}}">
                                    <td>{{$User->name}}</td>
                                    <td>{{$User->PersFirstName}} {{$User->PersLastName}}</td>
                                    <td>{{$User->email}}</td>
                                    <td>
                                        <a method='get' href='/UsuariosCliente/{{$User->UsSlug}}' class='btn btn-info btn-block'><i class="fas fa-search"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
			    </div>
			</div>
		</div>
	</div>
</div>
@endsection
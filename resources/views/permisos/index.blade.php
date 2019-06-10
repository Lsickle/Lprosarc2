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
                    <a href="/permisos/create" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.create') }}</a>
				</div>
                <div class="box box-info">
				    <div class="box-body">
                        <table id="permisosTable" class="table table-compact table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{ trans('adminlte_lang::message.username') }}</th>
                                <th>{{ trans('adminlte_lang::message.userperson') }}</th>
                                <th>{{ trans('adminlte_lang::message.emailaddress') }}</th>
                                <th>{{ trans('adminlte_lang::message.userrol') }}</th>
                                <th>{{ trans('adminlte_lang::message.userrol2') }}</th>
                                <th>{{ trans('adminlte_lang::message.seemore') }}</th>
                            </tr>
                            </thead>
                            <tbody onload="renderTable()" id="readyTable">
                            @foreach($Users as $User)
                            <tr 	@if($User->DeleteUser === 1)
                                        style="color: red;" 
                                    @endif
                            >
                            <td>{{$User->name}}</td>
                                <td>{{$User->PersFirstName}} {{$User->PersLastName}}</td>
                                <td>{{$User->email}}</td>
                                <td>{{$User->UsRolDesc}}</td>
                                <td>{{$User->UsRolDesc2}}</td>
                                <td>
                                    <a method='get' href='/permisos/{{$User->UsSlug}}' class='btn btn-primary btn-block'>{{ trans('adminlte_lang::message.see') }}</a>
                                </td>
                            </tr>
                            @endforeach
                            @foreach($UsersSinPersonal as $UserSinPersonal)
                            <tr 	@if($UserSinPersonal->DeleteUser === 1)
                                        style="color: red;" 
                                    @endif
                            >
                                <td>{{$UserSinPersonal->name}}</td>
                                <td></td>
                                <td>{{$UserSinPersonal->email}}</td>
                                <td>{{$UserSinPersonal->UsRolDesc}}</td>
                                <td>{{$UserSinPersonal->UsRolDesc2}}</td>
                                <td>
                                    <a method='get' href='/permisos/{{$UserSinPersonal->UsSlug}}' class='btn btn-primary btn-block'>{{ trans('adminlte_lang::message.see') }}</a>
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
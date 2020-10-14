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
				</div>
                <div class="box box-info">
				    <div class="box-body">
                        
                        <table id="permisosTable" class="table table-compact table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>{{ trans('adminlte_lang::message.username') }}</th>
                                <th>{{ trans('adminlte_lang::message.userperson') }}</th>
                                <th>{{ trans('adminlte_lang::message.emailaddress') }}</th>
                                <th>Rol1</th>
                                <th>Rol2</th>
                                <th>cargo</th>
                                <th>area</th>
                                <th>sede</th>
                                <th>cliente</th>
                                <th>{{ trans('adminlte_lang::message.seemore') }}</th>
                            </tr>
                            </thead>
                            <tbody id="readyTable">
                            @foreach($UsersSinPersonal as $UserSinPersonal)
                                <tr style="{{$UserSinPersonal->DeleteUser == 1 ? "color:red;"  : ''}}">
                                    <td>{{$UserSinPersonal->name}}</td>
                                    <td>{{$UserSinPersonal->PersFirstName}} {{$UserSinPersonal->PersLastName}}</td>
                                    <td>{{$UserSinPersonal->email}}</td>
                                    <td>{{$UserSinPersonal->UsRol}}</td>
                                    <td>{{$UserSinPersonal->UsRol2}}</td>
                                    <td>{{$UserSinPersonal->CargName}}</td>
                                    <td>{{$UserSinPersonal->AreaName}}</td>
                                    <td>{{$UserSinPersonal->SedeName}}</td>
                                    <td>{{$UserSinPersonal->CliName}}</td>
                                    <td>
                                        <form action='/UsuariosCliente/{{$UserSinPersonal->UsSlug}}' method='POST'>
                                            @method('DELETE')
                                            @csrf
                                            <input value="toggle" type="submit" id="Eliminar{{$UserSinPersonal->id}}" class='btn btn-primary pull-left'>
                                        </form>
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
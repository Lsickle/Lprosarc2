@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::LangTratamiento.pretratMenu') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #FF856D, #CC0000); padding-right:30vw; position:relative; overflow:hidden;">
    {{ trans('adminlte_lang::LangTratamiento.pretratMenu') }}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::LangTratamiento.pretratlist') }}</h3>
					@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones) || in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
					<a href="/pretratamiento/create" class="btn btn-primary" style="float: right;">{{ trans('adminlte_lang::message.create') }}</a>
					@else
					<a href="#" disabled class="btn btn-default pull-right" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Crear Tratamiento</b>" data-content="<p style='width: 50%'> Unicamente el jefe de operaciones cuenta con la autorizacion para crear tratamientos">{{ trans('adminlte_lang::message.create') }}</a>
					@endif
				</div>
				<!-- /.box-header -->
				<div class="box box-info">
					<div class="box-body">
						<table id="pretratamientosTable" class="table table-bordered table-striped" width="100%">
							<thead>
								<tr>
									<th>{{ trans('adminlte_lang::LangTratamiento.pretratname') }}</th>
									<th>{{ trans('adminlte_lang::LangTratamiento.pretratdescript') }}</th>
									<th>{{ trans('adminlte_lang::message.seemore') }}</th>
								</tr>
							</thead>
							<tbody id="readyTable">
								@foreach($pretratamientos as $pretratamiento)
								<tr @if($pretratamiento->PreTratDelete === 1)
									style="color: red;"
									@endif
									>
									<td>{{$pretratamiento->PreTratName}}</td>
									<td>{{$pretratamiento->PreTratDescription}}</td>
									<td><a method='get' href='/pretratamiento/{{$pretratamiento->ID_PreTrat}}/edit' class='btn btn-info btn-block' title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i></a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
		</div>
	</div>
</div>
@endsection

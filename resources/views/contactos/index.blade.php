@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientcontacto') }}
@endsection
@section('contentheader_title')
<span style="background-color:#ffbb33; padding-right:30vw; position:relative; overflow:hidden;">
	{{ trans('adminlte_lang::message.clientcontacto') }}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.MenuContactos') }}</h3>
					@if (in_array(Auth::user()->UsRol, Permisos::Jefes) || in_array(Auth::user()->UsRol2, Permisos::Jefes))
						<a href="/contactos/create" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.create') }}</a>
					@endif
				</div>
				<div class="box box-info">
					<div class="box-body">
						<table id="contactosTable" class="table table-compact table-bordered table-striped">
							<thead>
							<tr>
								<th>{{ trans('adminlte_lang::message.clientcategoría') }}</th>
								<th>{{ trans('adminlte_lang::message.clirazonsoc') }}</th>
								<th>{{ trans('adminlte_lang::message.clientnombrecorto') }}</th>
								<th>{{ trans('adminlte_lang::message.clientNIT') }}</th>
								<th>{{ trans('adminlte_lang::message.seemore') }}</th>
							</tr>
							</thead>
							<tbody id="readyTable">
							@foreach($Clientes as $Cliente)
							<tr @if($Cliente->CliDelete === 1)
									style="color: red;" 
								@endif
							>
								<td>{{$Cliente->CliCategoria}}</td>
								<td>{{$Cliente->CliName}}</td>
								<td>{{$Cliente->CliShortname}}</td>
								<td>{{$Cliente->CliNit}}</td>
								<td>
									<a method='get' href='/contactos/{{$Cliente->CliSlug}}' class='btn btn-info btn-block' title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i></a>
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
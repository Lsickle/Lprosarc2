@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.areatitle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.areatitle') }}
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">{{ trans('adminlte_lang::message.listarea') }}</h3>
						@if(in_array(Auth::user()->UsRol, Permisos::PersInter1) || in_array(Auth::user()->UsRol2, Permisos::PersInter1))
						<a href="/areasInterno/create" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.create') }}</a>
						@endif
					</div>
					<div class="box box-info">
						<div class="box-body">
							<table id="AreaTable" class="table table-compact table-bordered table-striped">
								<thead>
									<tr>
										<th>{{ trans('adminlte_lang::message.areaname') }}</th>
										<th>{{ trans('adminlte_lang::message.sclientsede') }}</th>
										@if(in_array(Auth::user()->UsRol, Permisos::PersInter1) || in_array(Auth::user()->UsRol2, Permisos::PersInter1))
										<th>{{ trans('adminlte_lang::message.edit') }}</th>
										@endif
									</tr>
								</thead>
								<tbody id="readyTable">
									@foreach($Areas as $Area)
									<tr style="{{$Area->AreaDelete === 1 ? 'color: red' : ''}}">
										<td>{{$Area->AreaName}}</td>
										<td>{{$Area->SedeName}}</td>
										@if(in_array(Auth::user()->UsRol, Permisos::PersInter1) || in_array(Auth::user()->UsRol2, Permisos::PersInter1))
										<td><a href='/areasInterno/{{$Area->AreaSlug}}/edit' class='btn btn-warning btn-block'><i class="fas fa-edit"></i> <b>{{trans('adminlte_lang::message.edit')}}</b></a></td>
										@endif
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
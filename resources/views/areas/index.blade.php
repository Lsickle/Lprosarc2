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
						<a href="/areas/create" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.create') }}</a>
					</div>
					<div class="box box-info">
						<div class="box-body">
							<table id="AreaTable" class="table table-compact table-bordered table-striped">
								<thead>
									<tr>
										<th>{{ trans('adminlte_lang::message.areaname') }}</th>
										<th>{{ trans('adminlte_lang::message.sclientsede') }}</th>
										<th>{{ trans('adminlte_lang::message.edit') }}</th>
									</tr>
								</thead>
								<tbody id="readyTable">
									@foreach($Areas as $Area)
									<tr style="{{$Area->AreaDelete === 1 ? 'color: red' : ''}}">
										<td>{{$Area->AreaName}}</td>
										<td>{{$Area->SedeName}}</td>
										<td><a href='/areas/{{$Area->AreaSlug}}/edit' class='btn btn-warning btn-block'>{{trans('adminlte_lang::message.edit')}}</a></td>
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
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
						@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
							<a href="/areas/create" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.create') }}</a>
						@endif
					</div>
					<div class="box box-info">
						<div class="box-body">
							<table id="AreaTable" class="table table-compact table-bordered table-striped">
								<thead>
									<tr>
										<th>{{ trans('adminlte_lang::message.areaname') }}</th>
										<th>{{ trans('adminlte_lang::message.sclientsede') }}</th>
										@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
										<th>{{trans('adminlte_lang::message.clientcliente')}}</th>
										@endif
										@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
											<th>{{ trans('adminlte_lang::message.edit') }}</th>
										@endif
									</tr>
								</thead>
								<tbody id="readyTable">
									{{-- <h1 id="loadingTable">LOADING...</h1> --}}
									@foreach($Areas as $Area)
									<tr @if($Area->AreaDelete === 1)
										style="color: red;"
										@endif
										>
										<td>{{$Area->AreaName}}</td>
										<td>{{$Area->SedeName}}</td>
										@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
										<td>{{$Area->CliShortname}}</td>
										@endif
										@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
											<td><a href='/areas/{{$Area->AreaSlug}}/edit' class='btn btn-warning btn-block'>{{trans('adminlte_lang::message.edit')}}</a></td>
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
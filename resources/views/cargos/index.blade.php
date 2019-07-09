@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.cargotitle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.cargotitle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{trans('adminlte_lang::message.listcargo')}}</h3>
					<a href="/cargos/create" class="btn btn-primary pull-right">{{trans('adminlte_lang::message.create')}}</a>
				</div>
				<div class="box box-info">
					<div class="box-body">
						<table id="CargosTable" class="table table-compact table-bordered table-striped">
							<thead>
								<tr>
									<th>{{trans('adminlte_lang::message.cargoname')}}</th>
									<th>{{trans('adminlte_lang::message.areaname')}}</th>
									<th>{{trans('adminlte_lang::message.edit')}}</th>
								</tr>
							</thead>
							<tbody id="readyTable">
								@foreach($Cargos as $Cargo)
								<tr style="{{$Cargo->CargDelete === 1 ? 'color: red' : ''}}">
									<td>{{$Cargo->CargName}}</td>
									<td>{{$Cargo->AreaName}}</td>
									<td><a href='/cargos/{{$Cargo->CargSlug}}/edit' class='btn btn-warning btn-block'>{{trans('adminlte_lang::message.edit')}}</a></td>
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

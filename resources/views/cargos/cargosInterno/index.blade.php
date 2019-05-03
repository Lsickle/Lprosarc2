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
					<a href="/cargosInterno/create" class="btn btn-primary pull-right">{{trans('adminlte_lang::message.create')}}</a>
				</div>
				<div class="box box-info">
					<div class="box-body">
						<table id="CargosTable" class="table table-compact table-bordered table-striped">
							<thead>
								<tr>
									<th>{{trans('adminlte_lang::message.cargoname')}}</th>
									<th>{{trans('adminlte_lang::message.areaname')}}</th>
									<th>{{trans('adminlte_lang::message.cargograde')}}</th>
									<th>{{trans('adminlte_lang::message.cargosalary')}}</th>
									<th>{{trans('adminlte_lang::message.edit')}}</th>
								</tr>
							</thead>
							<tbody  hidden onload="renderTable()" id="readyTable">
								{{-- <h1 id="loadingTable">LOADING...</h1> --}}
								@include('layouts.partials.spinner')
								@foreach($Cargos as $Cargo)
								<tr @if($Cargo->CargDelete === 1)
									style="color: red;"
									@endif
									>
										<td>{{$Cargo->CargName}}</td>
										<td>{{$Cargo->AreaName}}</td>
										<td>{{$Cargo->CargGrade}}</td>
										<td>{{$Cargo->CargSalary}}</td>
										<td><a href='/cargosInterno/{{$Cargo->CargSlug}}/edit' class='btn btn-warning btn-block'>{{trans('adminlte_lang::message.edit')}}</a></td>
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

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
					@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
						<a href="/cargos/create" class="btn btn-primary pull-right">{{trans('adminlte_lang::message.create')}}</a>
					@endif
				</div>
				<div class="box box-info">
					<div class="box-body">
						<table id="CargosTable" class="table table-compact table-bordered table-striped">
							<thead>
								<tr>
									<th>{{trans('adminlte_lang::message.cargoname')}}</th>
									<th>{{trans('adminlte_lang::message.areaname')}}</th>
									@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
										<th>{{trans('adminlte_lang::message.edit')}}</th>
									@endif
								</tr>
							</thead>
							<tbody id="readyTable">
								@foreach($Cargos as $Cargo)
								<tr @if($Cargo->CargDelete === 1)
									style="color: red;"
									@endif
									>
										<td>{{$Cargo->CargName}}</td>
										<td>{{$Cargo->AreaName}}</td>
									@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
										<td><a href='/cargos/{{$Cargo->CargSlug}}/edit' class='btn btn-warning btn-block'>{{trans('adminlte_lang::message.edit')}}</a></td>
									@endif
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

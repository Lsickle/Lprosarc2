@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientmenu') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.clientmenu') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.clientindexboxtitle') }}</h3>
				</div>
				<div class="box-body">
					<table id="clientesTable" class="table table-compact table-bordered table-striped">
						<thead>
						<tr>
							<th>{{ trans('adminlte_lang::message.clirazonsoc') }}</th>
							<th>{{ trans('adminlte_lang::message.clientnombrecorto') }}</th>
							<th>{{ trans('adminlte_lang::message.clientNIT') }}</th>
							<th>{{ trans('adminlte_lang::message.seemore') }}</th>
						</tr>
						</thead>
						<tbody onload="renderTable()" id="readyTable">
						@foreach($clientes as $cliente)
						<tr 	@if($cliente->CliDelete === 1)
									style="color: red;" 
								@endif
						>
						<td>{{$cliente->CliShortname}}</td>
							<td>{{$cliente->CliName}}</td>
							<td>{{$cliente->CliNit}}</td>
							<td>
								<a method='get' href='/clientes/{{$cliente->CliSlug}}' class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.see') }}</a>
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
@endsection
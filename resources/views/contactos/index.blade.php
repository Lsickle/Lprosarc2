@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientmenu') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.clientcontact') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
		<!-- /.box -->
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.clientindexboxtitle') }}</h3>
					<a href="/contactos/create" class="btn btn-primary" style="float: right;">{{ trans('adminlte_lang::message.create') }}</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="contactosTable" class="table table-compact table-bordered table-striped">
						<thead>
						<tr>
							<th>{{ trans('adminlte_lang::message.clientcategoría') }}</th>
							<th>{{ trans('adminlte_lang::message.clientnombrecorto') }}</th>
							<th>{{ trans('adminlte_lang::message.clientNIT') }}</th>
							<th>{{ trans('adminlte_lang::message.createdthe') }}</th>
							<th>{{ trans('adminlte_lang::message.seemore') }}</th>
						</tr>
						</thead>
						<tbody onload="renderTable()" id="readyTable">
						@include('layouts.partials.spinner')
						@foreach($Clientes as $Cliente)
						<tr 	@if($Cliente->CliDelete === 1)
									style="color: red;" 
								@endif
						>
							<td>{{$Cliente->CliCategoria}}</td>
							<td>{{$Cliente->CliName}}</td>
							<td>{{$Cliente->CliNit}}</td>
							<td>{{$Cliente->created_at}}</td>
							<td>
								<a method='get' href='/contactos/{{$Cliente->CliSlug}}' class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.see') }}</a>
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
		<!-- /.box -->
		</div>
	</div>
</div>
@endsection
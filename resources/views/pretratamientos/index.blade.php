@extends('layouts.app')
@section('contentheader_title')
{{ trans('adminlte_lang::LangTratamiento.pretratMenu') }}
@endsection
@section('htmlheader_title')
{{ trans('adminlte_lang::LangTratamiento.pretratlist') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::LangTratamiento.pretratlist') }}</h3>
					<a href="/pretratamiento/create" class="btn btn-primary" style="float: right;">{{ trans('adminlte_lang::message.create') }}</a>
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

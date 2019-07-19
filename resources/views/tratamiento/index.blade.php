@extends('layouts.app')
@section('contentheader_title')
{{ trans('adminlte_lang::LangTratamiento.tratMenu') }}
@endsection
@section('htmlheader_title')
{{ trans('adminlte_lang::LangTratamiento.tratlist') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::LangTratamiento.tratlist') }}</h3>
					<a href="/tratamiento/create" class="btn btn-primary" style="float: right;">{{ trans('adminlte_lang::message.create') }}</a>
				</div>
				<!-- /.box-header -->
				<div class="box box-info">
					<div class="box-body">
						<table id="tratamientosTable" class="table table-bordered table-striped" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>{{ trans('adminlte_lang::LangTratamiento.type') }}</th>
									<th>{{ trans('adminlte_lang::LangTratamiento.tratprovee') }}</th>
									<th>{{ trans('adminlte_lang::LangTratamiento.sede') }}</th>
									<th>{{ trans('adminlte_lang::message.address') }}</th>
									<th>{{ trans('adminlte_lang::LangTratamiento.tratMenu') }}</th>
									<th>{{ trans('adminlte_lang::LangTratamiento.pretrat') }}s</th>
									<th>{{ trans('adminlte_lang::message.seemore') }}</th>
								</tr>
							</thead>
							<tbody id="readyTable">
								@foreach($tratamientos as $tratamiento)
								<tr @if($tratamiento->TratDelete === 1)
									style="color: red;"
									@endif
									>
									<td>{{$tratamiento->ID_Trat}}</td>
									@if($tratamiento->TratTipo=='1')
									<td>Interno</td>
									@else
									<td>Externo</td>
									@endif
									<td>{{$tratamiento->CliShortname}}</td>
									<td>{{$tratamiento->SedeName}}</td>
									<td>{{$tratamiento->SedeAddress}}</td>
									<td>{{$tratamiento->TratName}}</td>
									<td>
										<ul>
											@foreach($tratamiento->pretratamientos as $pretratamiento)
												@if($pretratamiento->PreTratDelete == 0)
													<li>{{$pretratamiento->PreTratName}}</li>
												@endif
											@endforeach
										</ul>
									</td>
									<td><a method='get' href='/tratamiento/{{$tratamiento->ID_Trat}}/' class='btn btn-info btn-block' title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i></a></td>
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

@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.sclientsedes') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.sclientsedes') }}
@endsection

@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- /.box -->
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.sclientlistsede') }}</h3>
					<a href="/sclientes/create" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.create') }}</a>
				</div>
				<div class="box box-info">
				<!-- /.box-header -->
					<div class="box-body">
						<table id="sclientes" class="table table-bordered table-striped display" width="100%">
							<thead>
								<tr>
									<th>{{ trans('adminlte_lang::message.sclientnamesede') }}</th>
									<th>{{ trans('adminlte_lang::message.address') }}</th>
									<th>{{ trans('adminlte_lang::message.mobile') }}</th>
									<th>{{ trans('adminlte_lang::message.emailaddress') }}</th>
									<th>{{ trans('adminlte_lang::message.seemore')}}</th>
								</tr>
							</thead>
							<tbody id="readyTable">
								@foreach($Sedes as $Sede)
									<tr @if($Sede->SedeDelete === 1)
											style="color: red;" 
										@endif
									>
										<td>{{$Sede->SedeName}}</td>
										<td>{{$Sede->SedeAddress}} ({{$Sede->MunName.' - '.$Sede->DepartName}})</td>
										<td>{{$Sede->SedeCelular}}</td>
										<td>{{$Sede->SedeEmail}}</td>
										<td>
											<a method='get' href='/sclientes/{{$Sede->SedeSlug}}' class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.see') }}</a>
										</td>
									</tr>
									@endforeach
							</tbody>
							{{-- <tfoot>
								<tr>
									<th>{{ trans('adminlte_lang::message.sclientnamesede') }}</th>
									<th>{{ trans('adminlte_lang::message.address') }}</th>
									<th>{{ trans('adminlte_lang::message.mobile') }}</th>
									<th>{{ trans('adminlte_lang::message.emailaddress') }}</th>
									<th>{{ trans('adminlte_lang::message.seemore')}}</th>
								</tr>
							</tfoot> --}}
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
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
					<a href="/sclientes/create" class="btn btn-primary" style="float: right;">{{ trans('adminlte_lang::message.create') }}</a>
				</div>
				<div class="box box-info">
				<!-- /.box-header -->
					<div class="box-body">
						<table id="sedes" class="table table-bordered table-striped" width="100%">
							<thead>
								<tr>
									<th>{{ trans('adminlte_lang::message.clientcliente') }}</th>
									<th>{{ trans('adminlte_lang::message.sclientnamesede') }}</th>
									{{-- <th>{{ trans('adminlte_lang::message.municipio') }}</th> --}}
									{{-- <th>{{ trans('adminlte_lang::message.mobile') }}</th> --}}
									<th>{{ trans('adminlte_lang::message.emailaddress') }}</th>
									{{-- <th>{{ trans('adminlte_lang::message.phone')}}</th> --}}
									{{-- <th>{{ trans('adminlte_lang::message.phone')}} 2</th> --}}
									<th>{{ trans('adminlte_lang::message.address') }}</th>
									<th>{{ trans('adminlte_lang::message.seemore')}}</th>
									<th>{{ trans('adminlte_lang::message.edit')}}</th>
								</tr>
							</thead>
							<tbody hidden onload="renderTable()" id="readyTable">
								@include('layouts.partials.spinner')
								@foreach($sedes as $Sede)
											<tr @if($Sede->SedeDelete === 1)
									style="color: red;" 
									@endif
								>
								<td>{{$Sede->CliShortname}}</td>
								<td>{{$Sede->SedeName}}</td>
								{{-- <td>{{$Sede->MunName.' - '.$Sede->DepartName}}</td> --}}
								{{-- <td>{{$Sede->SedeCelular}}</td> --}}
								<td>{{$Sede->SedeEmail}}</td>
									{{-- <td>{{$Sede->SedePhone1.' - '.$Sede->SedeExt1}}</td> --}}
								{{-- <td>{{$Sede->SedePhone2.' - '.$Sede->SedeExt2}}</td> --}}
								<td>{{$Sede->SedeAddress}}</td>
								<td>{{$Sede->SedeSlug}}</td>
								<td>{{$Sede->SedeSlug}}</td>
									</tr>
									@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th>{{ trans('adminlte_lang::message.clientcliente') }}</th>
									<th>{{ trans('adminlte_lang::message.sclientnamesede') }}</th>
									{{-- <th>{{ trans('adminlte_lang::message.municipio') }}</th> --}}
									{{-- <th>{{ trans('adminlte_lang::message.mobile') }}</th> --}}
									<th>{{ trans('adminlte_lang::message.emailaddress') }}</th>
									<th>{{ trans('adminlte_lang::message.address') }}</th>
									{{-- <th>{{ trans('adminlte_lang::message.phone')}}</th> --}}
									{{-- <th>{{ trans('adminlte_lang::message.phone')}} 2</th> --}}
									<th>{{ trans('adminlte_lang::message.seemore')}}</th>
									<th>{{ trans('adminlte_lang::message.edit')}}</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
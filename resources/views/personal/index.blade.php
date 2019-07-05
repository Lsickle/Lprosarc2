@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.personalhtmlheader_title') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.personalhtmlheader_title') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.personaltitlelist') }}</h3>
					@if(Auth::user()->UsRol == trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol2 == trans('adminlte_lang::message.Cliente'))
						<a href="personal/create" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.create') }}</a>
					@endif
				</div>
				<div class="box box-info">
					<div class="box-body">
						<table id="PersonalsTable" class="table table-compact table-bordered table-striped">
							<thead>
								<tr>
									<th>{{ trans('adminlte_lang::message.persdocument') }}</th>
									<th>{{ trans('adminlte_lang::message.persname') }}</th>
									<th>{{ trans('adminlte_lang::message.emailaddress') }}</th>
									<th>{{ trans('adminlte_lang::message.mobile') }}</th>
									<th>{{ trans('adminlte_lang::message.cargoname') }}</th>
									<th>{{ trans('adminlte_lang::message.areaname') }}</th>
									@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
										<th>{{ trans('adminlte_lang::message.clientmenu') }}</th>
									@endif
									<th>{{ trans('adminlte_lang::message.see') }}</th>
								</tr>
							</thead>
							<tbody id="readyTable">
								@foreach($Personals as $Personal)
								<tr style="{{$Personal->PersDelete === 1 ? 'color: red' : ''}}">
									<td>{{$Personal->PersDocType." ".$Personal->PersDocNumber}}</td>
									<td>{{$Personal->PersFirstName." ".$Personal->PersSecondName." ".$Personal->PersLastName}}</td>
									<td>{{$Personal->PersEmail}}</td>
									<td>{{$Personal->PersCellphone}}</td>
									<td>{{$Personal->CargName}}</td>
									<td>{{$Personal->AreaName}}</td>
									@if(Auth::user()->UsRol <> trans('adminlte_lang::message.Cliente'))
										<td>{{$Personal->CliShortname}}</td>
									@endif
									<td><a method='get' href='/personal/{{$Personal->PersSlug}}' class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.see') }}</a></td>
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
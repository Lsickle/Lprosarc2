@extends('layouts.app')
@section('htmlheader_title')
	{{ trans('adminlte_lang::message.sedesgener') }}
@endsection
@section('contentheader_title')
  {{ trans('adminlte_lang::message.sedesgener') }}
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">{{ trans('adminlte_lang::message.sgenerlist') }}</h3>
						@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
							<a href="/sgeneradores/create" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.create') }}</a>
						@endif
					</div>
					<div class="box box-info">
						<div class="box-body">
							<table id="sgeneradores" class="table table-bordered table-striped">
								<thead>
									<tr>
										@if(Auth::user()->UsRol !== trans('adminlte_lang::message.Cliente'))
											<th>{{ trans('adminlte_lang::message.clientcliente') }}</th>
										@endif
										<th>{{ trans('adminlte_lang::message.gener') }}</th>
										<th>{{ trans('adminlte_lang::message.SGenertitle') }}</th>
										<th>{{ trans('adminlte_lang::message.address') }}</th>
										<th>{{ trans('adminlte_lang::message.emailaddress') }}</th>
										<th>{{ trans('adminlte_lang::message.mobile') }}</th>
										<th>{{ trans('adminlte_lang::message.seemore') }}</th>
									</tr>
								</thead>
								<tbody hidden onload="renderTable()" id="readyTable">
									@include('layouts.partials.spinner')
									@foreach($Gsedes as $GSede)
										<tr @if($GSede->GSedeDelete === 1)
												style="color: red;" 
											@endif>
											@if(Auth::user()->UsRol !== trans('adminlte_lang::message.Cliente'))
												<td>{{$GSede->CliShortname}}</td>
											@endif
											<td>{{$GSede->GenerShortname}}</td>
											<td>{{$GSede->GSedeName}}</td>
											<td>{{$GSede->GSedeAddress}} ({{$GSede->MunName}} - {{$GSede->DepartName}})</td>
											<td>{{$GSede->GSedeEmail}}</td>
											<td>{{$GSede->GSedeCelular}}</td>
											<td>
												<a method='get' href='/sgeneradores/{{$GSede->GSedeSlug}}' class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.see') }}</a>
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
	</div>
@endsection
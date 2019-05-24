@extends('layouts.app')
@section('htmlheader_title')
  {{ trans('adminlte_lang::message.genermenu') }}
@endsection
@section('contentheader_title')
  {{ trans('adminlte_lang::message.genermenu') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.generindex') }}</h3>
					@if (!isset($Gener))
						<div class="col-xs-12">
							@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
									<a href="/generadores/create" class="btn btn-success pull-right" >{{ trans('adminlte_lang::message.create') }}</a>
							@endif
							@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
								<a href="/Soy-Gener/{{Auth::user()->UsSlug}}" class="btn btn-info" >{{ trans('adminlte_lang::message.soygener') }}</a>
							@endif
						</div>
					@else
						@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
							<a href="/generadores/create" class="btn btn-success pull-right" >{{ trans('adminlte_lang::message.create') }}</a>
						@endif
					@endif
				</div>
				<div class="box box-info">
					<div class="box-body">
						<table id="generadores" class="table table-bordered table-striped">
							<thead>
								<tr>
									@if(Auth::user()->UsRol !== trans('adminlte_lang::message.Cliente'))
										<th>{{ trans('adminlte_lang::message.clientcliente') }} - {{ trans('adminlte_lang::message.sclientsede') }}</th>
									@endif
									@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
										<th>{{ trans('adminlte_lang::message.sclientsede') }}</th>
									@endif
									<th>{{ trans('adminlte_lang::message.gener') }}</th>
									<th>{{ trans('adminlte_lang::message.clientNIT') }}</th>
									<th>{{ trans('adminlte_lang::message.seemore') }}</th>
								</tr>
							</thead>
							<tbody  hidden onload="renderTable()" id="readyTable">
							@include('layouts.partials.spinner')
							@foreach($Generadors as $Gener)
								<tr @if($Gener->GenerDelete === 1)
									style="color: red;" 
								@endif
								>
									@if(Auth::user()->UsRol !== trans('adminlte_lang::message.Cliente'))
										<td>{{$Gener->CliShortname}} - {{$Gener->SedeName}}</td>
									@endif
									@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
									<td>{{$Gener->SedeName}}</td>
									@endif
									<td>{{$Gener->GenerShortname}}</td>
									<td>{{$Gener->GenerNit}}</td>
									<td>
										<a method='get' href='/generadores/{{$Gener->GenerSlug}}' class='btn btn-primary btn-block'>{{ trans('adminlte_lang::message.see') }}</a>
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
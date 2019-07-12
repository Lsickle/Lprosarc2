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
					<center>
						<h3 class="box-title pull-left">{{ trans('adminlte_lang::message.generindex') }}</h3>
						@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE))
							@if (!isset($Gener))
								<a href="/Soy-Gener/{{Auth::user()->UsSlug}}" class="btn btn-info" >{{ trans('adminlte_lang::message.soygener') }}</a>
							@endif
							<a href="/generadores/create" class="btn btn-primary pull-right" >{{ trans('adminlte_lang::message.create') }}</a>
						@endif
					</center>
				</div>
				<div class="box box-info">
					<div class="box-body">
						<table id="generadores" class="table table-bordered table-striped">
							<thead>
								<tr>
									@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
										<th>{{ trans('adminlte_lang::message.clientcliente') }} - {{ trans('adminlte_lang::message.sclientsede') }}</th>
									@endif
									@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE))
										<th>{{ trans('adminlte_lang::message.sclientsede') }}</th>
									@endif
									<th>{{ trans('adminlte_lang::message.gener') }}</th>
									<th>{{ trans('adminlte_lang::message.clientNIT') }}</th>
									<th>{{ trans('adminlte_lang::message.seemore') }}</th>
								</tr>
							</thead>
							<tbody id="readyTable">
							@foreach($Generadors as $Gener)
								<tr @if($Gener->GenerDelete === 1)
									style="color: red;" 
								@endif
								>
									@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
										<td>{{$Gener->CliShortname}} - {{$Gener->SedeName}}</td>
									@endif
									@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE))
									<td>{{$Gener->SedeName}}</td>
									@endif
									<td>{{$Gener->GenerShortname}}</td>
									<td>{{$Gener->GenerNit}}</td>
									<td>
										<a method='get' href='/generadores/{{$Gener->GenerSlug}}' class='btn btn-info btn-block' title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i></a>
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
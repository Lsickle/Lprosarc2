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
					<div class="col-sm-16 text-center">
						<h3 class="box-title pull-left">{{ trans('adminlte_lang::message.generindex') }}</h3>
						@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
							@if (!isset($Gener))
								<div class="col-xs-6 col-md-8">
									<form action='/Soy-Gener/{{Auth::user()->UsSlug}}' method='POST'>
										@csrf
										<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.soygener') }}</b>" data-content="{{ trans('adminlte_lang::message.soygener-info') }}">
											<input type="submit" class="btn btn-info" value="{{ trans('adminlte_lang::message.soygener') }}">
										</label>
									</form>
								</div>
							@endif
							<a href="/generadores/create" class="btn btn-primary pull-right" >{{ trans('adminlte_lang::message.create') }}</a>
						@endif
					</div>
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
								<tr style="{{$Gener->GenerDelete == 1 ? "color:red;"  : ''}}">
									@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
										<td>{{$Gener->CliName}} - {{$Gener->SedeName}}</td>
									@endif
									@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE))
									<td>{{$Gener->SedeName}}</td>
									@endif
									<td>{{$Gener->GenerName}}</td>
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
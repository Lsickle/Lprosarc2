@extends('layouts.app')
@section('htmlheader_title')
	{{ trans('adminlte_lang::message.sedesgener') }}
@endsection
@section('contentheader_title')
  <span style="background-image: linear-gradient(40deg, rgb(69, 202, 252), rgb(48, 63, 159)); padding-right:30vw; position:relative; overflow:hidden;">
  	{{ trans('adminlte_lang::message.sedesgener') }}
    <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
  </span>
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">{{ trans('adminlte_lang::message.sgenerlist') }}</h3>
						@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE))
							<a href="/sgeneradores/create" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.create') }}</a>
						@endif
					</div>
					<div class="box box-info">
						<div class="box-body">
							<table id="sgeneradores" class="table table-bordered table-striped">
								<thead>
									<tr>
										@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
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
								<tbody id="readyTable">
									@foreach($Gsedes as $GSede)
										<tr @if($GSede->GSedeDelete === 1)
												style="color: red;" 
											@endif>
											@if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARC))
												<td>{{$GSede->CliShortname}}</td>
											@endif
											<td>{{$GSede->GenerShortname}}</td>
											<td>{{$GSede->GSedeName}}</td>
											<td>{{$GSede->GSedeAddress}} ({{$GSede->MunName}} - {{$GSede->DepartName}})</td>
											<td>{{$GSede->GSedeEmail}}</td>
											<td>{{$GSede->GSedeCelular}}</td>
											<td>
												<a method='get' href='/sgeneradores/{{$GSede->GSedeSlug}}' class='btn btn-info btn-block' title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i></a>
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
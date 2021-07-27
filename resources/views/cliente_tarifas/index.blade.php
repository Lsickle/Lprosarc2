@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::LangTratamiento.tratMenu') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #FF856D, #CC0000); padding-right:30vw; position:relative; overflow:hidden;">
    {{ trans('adminlte_lang::LangTratamiento.tratMenu') }}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::LangTratamiento.tratlist') }}</h3>
					@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones) || in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
					<a href="/tratamiento/create" class="btn btn-primary" style="float: right;">{{ trans('adminlte_lang::message.create') }}</a>
					@else
					<a href="#" disabled class="btn btn-default pull-right" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Crear Tratamiento</b>" data-content="<p style='width: 50%'> Unicamente el jefe de operaciones cuenta con la autorizacion para crear tratamientos">{{ trans('adminlte_lang::message.create') }}</a>
					@endif
				</div>
				<!-- /.box-header -->
				<div class="box box-info">
					<div class="box-body">
						<table id="tratamientosTable" class="table table-bordered table-striped" width="100%">
							<thead>
								<tr>
									<th>N°</th>
									<th>{{ trans('adminlte_lang::LangTratamiento.type') }}</th>
									<th>{{ trans('adminlte_lang::LangTratamiento.tratprovee') }}</th>
									<th>{{ trans('adminlte_lang::LangTratamiento.sede') }}</th>
									<th>{{ trans('adminlte_lang::message.address') }}</th>
									<th>{{ trans('adminlte_lang::LangTratamiento.tratMenu') }}</th>
									<th>{{ trans('adminlte_lang::LangTratamiento.pretrat') }}s</th>
									<th>clasificaciones Permitidas</th>
									<th>{{ trans('adminlte_lang::message.seemore') }}</th>
								</tr>
							</thead>
							<tbody id="readyTable">
								@foreach($tratamientos as $tratamiento)
								<tr @if($tratamiento->TratDelete === 1)
									style="color: red;"
									@endif
									>
									<td>#{{$tratamiento->ID_Trat}}</td>
									@if($tratamiento->TratTipo == 0)
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
									<td>
										<table>
											<tbody>
												<tr  style="background-color: transparent;">
													@php
														$i = 1;
													@endphp
													@foreach($tratamiento->clasificaciones as $clasificacion)
														<td><li>{{$clasificacion->ClasfCode}}</li></td>
														@if($i>0 && $i%4==0)
																</tr><tr style="background-color: transparent;">
														@endif
														@php
															$i++;
														@endphp
													@endforeach
												</tr>
											</tbody>
										</table>
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

@extends('layouts.app')
@section('htmlheader_title')
{{-- {{ trans('adminlte_lang::message.cargotitle') }} --}}
Contratos
@endsection
@section('contentheader_title')
{{-- {{ trans('adminlte_lang::message.cargotitle') }} --}}
Contratos
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{-- {{trans('adminlte_lang::message.listcargo')}} --}} Lista de contratos</h3>
					@if(in_array(Auth::user()->UsRol, Permisos::PersInter1) || in_array(Auth::user()->UsRol2, Permisos::PersInter1))
					<a href="/contratos/create" class="btn btn-primary pull-right">{{trans('adminlte_lang::message.create')}}</a>
					@endif
				</div>
				<div class="box box-info">
					<div class="box-body">
						<table id="ContratosTable" class="table table-compact table-bordered table-striped">
							<thead>
								<tr>
									<th>{{-- {{trans('adminlte_lang::message.cargoname')}} --}}Cliente</th>
									<th>{{-- {{trans('adminlte_lang::message.areaname')}} --}}Contrato</th>
									<th>{{-- {{trans('adminlte_lang::message.cargograde')}} --}}Vigencia</th>
									@if(in_array(Auth::user()->UsRol, Permisos::PersInter1) || in_array(Auth::user()->UsRol2, Permisos::PersInter1))
									<th>{{trans('adminlte_lang::message.edit')}}</th>
									@endif
								</tr>
							</thead>
							<tbody id="readyTable">
								@foreach($Contratos as $Contrato)
								<tr style="{{$Contrato->ContraDelete === 1 ? 'color: red' : ''}}">
									<td>{{$Contrato->CliShortname}}</td>
									<td><a href="/{{$Contrato->ContraPdf}}"></a></td>
									<td>{{$Contrato->ContraVigencia}}</td>
									@if(in_array(Auth::user()->UsRol, Permisos::PersInter1) || in_array(Auth::user()->UsRol2, Permisos::PersInter1))
									<td><a href='/contratos/{{$Contrato->ContraSlug}}/edit' class='btn btn-warning btn-block'><i class="fas fa-edit"></i> <b>{{trans('adminlte_lang::message.edit')}}</b></a></td>
									@endif
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

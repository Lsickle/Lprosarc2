@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.contracttitle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.contracttitle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{trans('adminlte_lang::message.contractindex')}} </h3>
					@if(in_array(Auth::user()->UsRol, Permisos::CONTRATOSCRUD) || in_array(Auth::user()->UsRol2, Permisos::CONTRATOSCRUD))
					<a href="/contratos/create" class="btn btn-primary pull-right">{{trans('adminlte_lang::message.create')}}</a>
					@endif
				</div>
				<div class="box box-info">
					<div class="box-body">
						<table id="ContratosTable" class="table table-compact table-bordered table-striped">
							<thead>
								<tr>
									<th>{{trans('adminlte_lang::message.contractclien')}}</th>
									<th>{{trans('adminlte_lang::message.contractpdf')}}</th>
									<th>{{trans('adminlte_lang::message.contractvigencia')}}</th>
									<th>{{trans('adminlte_lang::message.contractvigencia2')}}</th>
									@if(in_array(Auth::user()->UsRol, Permisos::CONTRATOSCRUD) || in_array(Auth::user()->UsRol2, Permisos::CONTRATOSCRUD))
									<th>{{trans('adminlte_lang::message.edit')}}</th>
									@endif
								</tr>
							</thead>
							<tbody id="readyTable">
								@foreach($Contratos as $Contrato)
								<tr style="{{$Contrato->ContraDelete === 1 ? 'color: red' : ''}}">
									<td>{{$Contrato->CliShortname}}</td>
									<td style="text-align: center;"><a href="/img/Contratos/{{$Contrato->ContraPdf}}" class="btn btn-info"> <i class="fas fa-file-pdf fa-lg"></i> </a></td>
									<td style="text-align: center;">{{$Contrato->ContraVigencia}}</td>
									<td>{{$Contrato->ContraVigencia < now() ? 'Vencida' : ($Contrato->ContraNotifiVigencia <= now() ? 'Pronto a Vencer' : 'Vigente')}}</td>
									@if(in_array(Auth::user()->UsRol, Permisos::CONTRATOSCRUD) || in_array(Auth::user()->UsRol2, Permisos::CONTRATOSCRUD))
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

@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.cargotitle') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #FFFFFF, #A3A2AE); padding-right:30vw; position:relative; overflow:hidden;">
	{{ trans('adminlte_lang::message.cargotitle') }}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{trans('adminlte_lang::message.listcargo')}}</h3>
					<a href="/cargos/create" class="btn btn-primary pull-right">{{trans('adminlte_lang::message.create')}}</a>
				</div>
				<div class="box box-info">
					<div class="box-body">
						<table id="CargosTable" class="table table-compact table-bordered table-striped">
							<thead>
								<tr>
									<th>{{trans('adminlte_lang::message.cargoname')}}</th>
									<th>{{trans('adminlte_lang::message.areaname')}}</th>
									<th>{{trans('adminlte_lang::message.edit')}}</th>
								</tr>
							</thead>
							<tbody id="readyTable">
								@foreach($Cargos as $Cargo)
								<tr style="{{$Cargo->CargDelete === 1 ? 'color: red' : ''}}">
									<td>{{$Cargo->CargName}}</td>
									<td>{{$Cargo->AreaName}}</td>
									<td><a href='/cargos/{{$Cargo->CargSlug}}/edit' class='btn btn-warning btn-block'><i class="fas fa-edit"></i> <b>{{trans('adminlte_lang::message.edit')}}</b></a></td>
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

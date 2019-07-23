@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientmenu') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.clientmenu') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.clientindexboxtitle') }}</h3>
				</div>
				<div class="box box-info">
					<div class="box-body">
						<table id="clientesTable" class="table table-compact table-bordered table-striped">
							<thead>
							<tr>
								<th>{{ trans('adminlte_lang::message.clirazonsoc') }}</th>
								<th>{{ trans('adminlte_lang::message.clientnombrecorto') }}</th>
								<th>{{ trans('adminlte_lang::message.clientNIT') }}</th>
								@if(in_array(Auth::user()->UsRol, Permisos::AsigComercial) || in_array(Auth::user()->UsRol2, Permisos::AsigComercial))
								<th>Comercial Asignado</th>
								@endif
								<th>{{ trans('adminlte_lang::message.seemore') }}</th>
							</tr>
							</thead>
							<tbody onload="renderTable()" id="readyTable">
							@foreach($clientes as $cliente)
							<tr style="{{$cliente->CliDelete === 1 ? 'color: red;' : ''}}">
							<td>{{$cliente->CliShortname}}</td>
								<td>{{$cliente->CliName}}</td>
								<td>{{$cliente->CliNit}}</td>
								@if(in_array(Auth::user()->UsRol, Permisos::AsigComercial) || in_array(Auth::user()->UsRol2, Permisos::AsigComercial))
								<td>
									<a href="#" class="kg" onclick="changeComercial(`{{$cliente->CliSlug}}`)">
									{{$cliente->PersFirstName <> null ? $cliente->PersFirstName.' '.$cliente->PersLastName : 'Sin Asignar'}}
								</td>
								@endif
								<td>
									<a method='get' href='/clientes/{{$cliente->CliSlug}}' class='btn btn-info btn-block' title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i></a>
								</td>
							</tr>
							@endforeach
							</tbody>
						</table>
						<div id="divchangeComercial"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('NewScript')
	<script>
		function changeComercial(slug){
			$('#divchangeComercial').empty();
			$('#divchangeComercial').append(`
				<form role="form" action="/solicitud-residuo/`+slug+`/changeComercial" method="POST" enctype="multipart/form-data" data-toggle="validator" id="FormKg">
					@method('PUT')
					@csrf
					<div class="modal modal-default fade in" id="changeComercial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<div style="font-size: 5em; color: green; text-align: center; margin: auto;">
										<i class="fas fa-plus-circle"></i>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary pull-right">{{trans('adminlte_lang::message.save')}}</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			`);
			$('#changeComercial').modal();
		}
	</script>
@endsection
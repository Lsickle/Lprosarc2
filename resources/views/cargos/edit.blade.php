@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.cargotitle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.cargotitle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box box-info">
				<div class="box-header with-border">
					@component('layouts.partials.modal')
						@slot('slug')
							{{$Cargos->CargSlug}}
						@endslot
						@slot('textModal')
							el cargo de <b>{{$Cargos->CargName}}</b>
						@endslot
					@endcomponent
					<h3 class="box-title">{{trans('adminlte_lang::message.editcargo')}}</h3>
					@if($Cargos->ID_Carg <> $CargoOne[0]->ID_Carg)
						@if($Cargos->CargDelete == 0)
							<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Cargos->CargSlug}}' class='btn btn-danger pull-right'><i class="fas fa-trash-alt"></i><b> {{ trans('adminlte_lang::message.delete') }}</b></a>
							<form action='/cargos/{{$Cargos->CargSlug}}' method='POST'>
								@method('DELETE')
								@csrf
								<input  type="submit" id="Eliminar{{$Cargos->CargSlug}}" style="display: none;">
							</form>
						@else
							<form action='/cargos/{{$Cargos->CargSlug}}' method='POST' class="pull-right">
								@method('DELETE')
								@csrf
								<button type="submit" class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.add') }}</button>
							</form>
						@endif
					@endif
				</div>
				<div class="box">
					<form role="form" action="/cargos/{{$Cargos->CargSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
						@method('PATCH')
						@csrf
						@if ($errors->any())
							<div class="alert alert-danger" role="alert">
								<ul>
									@foreach ($errors->all() as $error)
										<p>{{$error}}</p>
									@endforeach
								</ul>
							</div>
						@endif
						<div class="box-body">
							<div class="form-group col-xs-12 col-md-12">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover"  data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.cargoareatittle') }}" data-content="{{ trans('adminlte_lang::message.cargoareainfo') }}" for="AreaSelect"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.inputarea')}}</label><small class="help-block with-errors">*</small>
								<select name="CargArea" required id="AreaSelect" class="form-control select">
									<option value="">{{trans('adminlte_lang::message.select')}}</option>
									@foreach($Areas as $Area)
										<option value="{{$Area->ID_Area}}" {{$Cargos->CargArea == $Area->ID_Area ? 'selected' : ''}}>{{$Area->AreaName}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-xs-12 col-md-12">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover"  data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.cargonametittle') }}" data-content="{{ trans('adminlte_lang::message.cargonameinfo') }}" for="NombreCargo"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.cargoname')}}</label><small class="help-block with-errors">*</small>
								<input required name="CargName" autofocus="true" type="text" class="form-control inputText" id="NombreCargo" value="{{$Cargos->CargName}}">
							</div>
							
						</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">{{trans('adminlte_lang::message.register')}}</button>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

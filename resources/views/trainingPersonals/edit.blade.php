@extends('layouts.app')
@section('htmlheader_title','Capacitaciones')
@section('contentheader_title','Edicion de Capacitaciones')
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header">
					@component('layouts.partials.modal')
						@slot('slug')
							{{$CapaPer->ID_CapPers}}
						@endslot
						@slot('textModal')
							la capacitacion <b>{{$CapaPer->ID_CapPers}}</b> a la persona <b>{{$CapaPer->FK_Pers}}</b>
						@endslot
					@endcomponent
					<h3 class="box-title">Datos de la capacitación de una persona</h3>
					@if($CapaPer->CapaPersDelete === 0)
						<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$CapaPer->ID_CapPers}}' class='btn btn-danger pull-right'><i class="fas fa-trash-alt"></i><b> {{ trans('adminlte_lang::message.delete') }}</b></a>
						<form action='/capacitacion-personal/{{$CapaPer->ID_CapPers}}' method='POST'>
							@method('DELETE')
							@csrf
							<input  type="submit" id="Eliminar{{$CapaPer->ID_CapPers}}" style="display: none;">
						</form>
					@else
						<form action='/capacitacion-personal/{{$CapaPer->ID_CapPers}}' method='POST' style="float: right;">
							@method('DELETE')
							@csrf
							<button type="submit" class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.add') }}</button>
						</form>
					@endif
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<form role="form" action="/capacitacion-personal/{{$CapaPer->ID_CapPers}}" method="POST" enctype="multipart/form-data">
								@method('PATCH')
								@csrf
								<div class="col-xs-6">
										<label for="CapaPersDate">Aprobación de la Capacitación</label>
										<input required="true" name="CapaPersDate" autofocus="true" type="text" class="form-control" id="CapaPersDate" value="{{$CapaPer->CapaPersDate}}">
									</div>
								<div class="col-xs-6">
									<label for="CapaPersExpire">Expiración de la Capacitación</label>
									<input required="true" name="CapaPersExpire" autofocus="true" type="text" class="form-control" id="CapaPersExpire" value="{{$CapaPer->CapaPersExpire}}">
								</div>
									<div class="col-xs-6">
										<label for="FK_Pers">Persona</label>
										<select name="FK_Pers" id="FK_Pers" class="form-control">
											<option value="{{$CapaPer->FK_Pers}}">Seleccione...</option>
											@foreach($Personals as $Personal)
												<option value="{{$Personal->ID_Pers}}">{{$Personal->PersFirstName. ' ' .$Personal->PersLastName}}</option>
											@endforeach
										</select>
									</div>
									<div class="col-xs-6">
										<label for="FK_Capa">Capacitación</label>
										<select name="FK_Capa" id="FK_Capa" class="form-control">
											<option value="{{$CapaPer->FK_Capa}}">Seleccione...</option>
											@foreach($Trainings as $Training)
												<option value="{{$Training->ID_Capa}}">{{$Training->CapaName}}</option>
											@endforeach
										</select>
									</div>
								<div class="box-body">
									<div class="col-xs-6" style="padding-left: 0; ">
										<label for="FK_Sede">Sede de la Capacitación</label>
										<select name="FK_Sede" id="FK_Sede" class="form-control">
											<option value="{{$CapaPer->FK_Sede}}">Seleccione...</option>
											@foreach($Sedes as $Sede)
												<option value="{{$Sede->ID_Sede}}">{{$Sede->SedeName}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="box-footer" style="float:right; margin-right:5%">
									<button type="submit" class="btn btn-primary">Actualizar</button>
								</div>
							</form>
						</div>
						<!-- /.box -->
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!--/.col (right) -->
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</div>
@endsection
@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.gener') }}
@endsection
@section('contentheader_title')
@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE))
<span style="background-image: linear-gradient(40deg, rgb(69, 202, 252), rgb(48, 63, 159)); padding-right:30vw; position:relative; overflow:hidden;">
	{{ trans('adminlte_lang::message.gener') }}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@else
<span style="background-image: linear-gradient(40deg, rgb(255, 216, 111), rgb(252, 98, 98)); padding-right:30vw; position:relative; overflow:hidden;">
	{{ trans('adminlte_lang::message.gener') }}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endif
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.generupdate') }}</h3>
				</div>
				<div class="box box-info">
					<form role="form" action="/generadores/{{$Generador->GenerSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
						@csrf
						@method('PUT')
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
							<div class="col-xs-12 form-group">
								<label for="FK_GenerCli" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.MenuSedes') }}</b>" data-content="{{ trans('adminlte_lang::message.misSedes-gener') }}">
									<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
									{{ trans('adminlte_lang::message.MenuSedes') }}
								</label>
								<small class="help-block with-errors">*</small>
								<select name="FK_GenerCli" class="form-control select" id="GenerInputTipo" required>
									@foreach($Sedes as $Sede)
										<option value="{{$Sede->SedeSlug}}" {{$Generador->FK_GenerCli == $Sede->ID_Sede ? 'selected' : '' }}>{{$Sede->SedeName}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-xs-12 form-group">
								<label for="GenerInputNit">{{ trans('adminlte_lang::message.clientNIT') }}</label><small class="help-block with-errors">*</small>
								<input type="text" name="GenerNit" class="form-control nit" id="GenerInputNit" data-minlength="13" maxlength="13" placeholder="{{ trans('adminlte_lang::message.clientNITplacehoder') }}" value="{{$Generador->GenerNit}}" required>
							</div>
							<div class="col-xs-12 form-group">
								<label for="GenerInputRazon">{{ trans('adminlte_lang::message.clirazonsoc') }}</label><small class="help-block with-errors">*</small>
								<input type="text" name="GenerName" class="form-control" id="GenerInputRazon" value="{{$Generador->GenerName}}" maxlength="255" required>
							</div>
							{{-- <div class="col-xs-12 form-group">
								<label for="GenerShortname" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b>" data-content="{{ trans('adminlte_lang::message.contacclientnombrecortomessage') }}">
									<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
									{{ trans('adminlte_lang::message.clientnombrecorto') }}
								</label>
								<small class="help-block with-errors">*</small>
								<input type="text" name="GenerShortname" class="form-control" id="GenerInputNombre" value="{{$Generador->GenerShortname}}" maxlength="64">
							</div> --}}
							<div class="col-md-12 form-group">
								<label for="GenerCode" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.genercode') }}</b>" data-content="{{ trans('adminlte_lang::message.code-gener') }}">
									<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
									{{ trans('adminlte_lang::message.genercode') }}
								</label>
								<small class="help-block with-errors"></small>
								<input name="GenerCode" type="text" class="form-control" id="GenerCode" value="{{$Generador->GenerCode}}" maxlength="32">
							</div>
						</div>
						<div class="box box-info">
							<div class="box-footer">
								<button type="submit" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.update') }}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

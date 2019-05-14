@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.gener') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.gener') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.generupdate') }}</h3>
				</div>
						<!-- general form elements -->
						<div class="box box-info">
							<!-- form start -->
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
										<label for="GenerInputTipo">{{ trans('adminlte_lang::message.MenuSedes') }}</label>
										<a href="#" class="textpopover" title="{{ trans('adminlte_lang::message.MenuSedes') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{ trans('adminlte_lang::message.misSedes-gener') }}</p>"><i class="far fa-question-circle" ></i></a>
										<small class="help-block with-errors">*</small>
										<select name="FK_GenerCli" class="form-control select" id="GenerInputTipo" required>
											@foreach($Sedes as $Sede)
												<option value="{{$Sede->ID_Sede}}" {{$Generador->FK_GenerCli== $Sede->ID_Sede ? 'selected' : '' }}>{{$Sede->SedeName}}</option>
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
									<div class="col-xs-12 form-group">
										<label for="GenerInputNombre">{{ trans('adminlte_lang::message.name') }}</label>
										<a href="#" class="textpopover" title="{{ trans('adminlte_lang::message.clientnombrecorto') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{ trans('adminlte_lang::message.nameCorto-gener') }}</p>"><i class="far fa-question-circle" ></i></a>
										<small class="help-block with-errors">*</small>
										<input type="text" name="GenerShortname" class="form-control" id="GenerInputNombre" value="{{$Generador->GenerShortname}}" maxlength="64">
									</div>
									<div class="col-md-12 form-group">
										<label for="GenerCode">{{ trans('adminlte_lang::message.genercode') }}</label>
										<a href="#" class="textpopover" title="{{ trans('adminlte_lang::message.genercode') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{ trans('adminlte_lang::message.code-gener') }}</p>"><i class="far fa-question-circle" ></i></a>
										<small class="help-block with-errors"></small>
										<input name="GenerCode" type="text" class="form-control" id="GenerCode" value="{{$Generador->GenerCode}}" maxlength="32">
									</div>
								</div>
								<!-- /.box-body -->
								<div class="box box-info">
									<div class="box-footer">
										<button type="submit" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.update') }}</button>
									</div>
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

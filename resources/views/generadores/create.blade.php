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
				<div class="box-header with-border">
					<h3 class="box-title">{{ trans('adminlte_lang::message.Generregistertittle') }}</h3>
				</div>
						<!-- general form elements -->
						<div class="box box-info">
							<!-- form start -->
							<form role="form" action="/generadores" method="POST" enctype="multipart/form-data" data-toggle="validator">
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
									<div class="col-xs-12 form-group">
										<label for="GenerInputTipo">{{ trans('adminlte_lang::message.sclientsede') }}</label><small class="help-block with-errors">*</small>
										<select name="FK_GenerCli" class="form-control select" id="GenerInputTipo" required>
											<option value="">{{ trans('adminlte_lang::message.select') }}</option>
											@foreach($Sedes as $Sede)
												<option value="{{$Sede->ID_Sede}}" {{ old('FK_GenerCli') == $Sede->ID_Sede ? 'selected' : '' }}>{{$Sede->SedeName}}</option>
											@endforeach()
										</select>
									</div>
									<div class="col-xs-12 form-group">
										<label for="GenerInputNit">{{ trans('adminlte_lang::message.clientNIT') }}</label><small class="help-block with-errors">*</small>
										<input class="form-control nit" data-minlength="13" maxlength="13"  name="GenerNit" autofocus="true" type="text" id="GenerInputNit" data-error="{{ trans('adminlte_lang::message.data-error-minlength10') }}" placeholder="{{ trans('adminlte_lang::message.clientNITplacehoder') }}" value="{{ old('GenerNit') }}" required>
									</div>
									<div class="col-xs-12 form-group">
										<label for="GenerInputRazon">{{ trans('adminlte_lang::message.clirazonsoc') }}</label><small class="help-block with-errors">*</small>
										<input name="GenerName" type="text" class="form-control" id="GenerInputRazon" value="{{ old('GenerName') }}" required>
									</div>
									<div class="col-xs-12 form-group">
										<label for="">{{ trans('adminlte_lang::message.clientnombrecorto') }}</label><small class="help-block with-errors">*</small>
										<input name="GenerShortname" type="text" class="form-control" value="{{ old('GenerShortname') }}" id="GenerInputNombre" required>
									</div>
								</div>
								<!-- /.box-body -->
								<div class="box box-info">
									<div class="box-footer">
										<button type="submit" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.register') }}</button>
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

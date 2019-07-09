@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::LangRespel.Respelcreate') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::LangRespel.Respelcreate') }}
@endsection	
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{ trans('adminlte_lang::LangRespel.Respelcreate') }}</h3>
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-info">
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/respels" method="POST" id="myform" enctype="multipart/form-data" data-toggle="validator" >
								@csrf
								@if ($errors->any())
								    <div class="alert alert-danger" role="alert">
								        <ul>
								            @foreach ($errors->all() as $error)
								                <li>{{$error}}</li>
								            @endforeach
								        </ul>
								    </div>
								@endif
								@if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || in_array(Auth::user()->UsRol2, Permisos::PROGRAMADOR))
									<div class="col-md-12 form-group">
										<label for="Sede">{{ trans('adminlte_lang::LangRespel.createcliente') }}</label>
										<small class="help-block with-errors">*</small>
										<select name="Sede" id="Sede" class="form-control" required>
											<option value="">{{ trans('adminlte_lang::LangRespel.selecthem') }}</option>
											@foreach($Sedes as $Cliente)
												<option value="{{$Cliente->ID_Sede}}">{{$Cliente->CliName}}</option>
											@endforeach
										</select>
									</div>
								@elseif(in_array(Auth::user()->UsRol, Permisos::CLIENTE))
									<input type="text" name="Sede" style="display: none;" value="{{$Sede}}">
								@endif
								@include('layouts.RespelPartials.respelform1')
								<!-- /.box-body -->
								<div class="col-md-12">	
									<div class="box-footer">
										<a onclick="AgregarRes()" class="btn btn-primary"><i class="fa fa-plus"></i>{{ trans('adminlte_lang::LangRespel.addrespelButton') }}</a>	
										<button type="submit" class="btn btn-success pull-right">{{ trans('adminlte_lang::LangRespel.registerrespelButton') }}</button>
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
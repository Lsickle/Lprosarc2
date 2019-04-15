@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::LangRespel.respelmenu') }}
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
						<div class="box box-primary">
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/respels" method="POST" enctype="multipart/form-data">
								@csrf
								@if(Auth::user()->UsRol=='Programador'||Auth::user()->UsRol=='admin'||Auth::user()->UsRol=='JefeOperacion')
									<div class="col-md-12">
										<label for="Sede">Cliente</label>
										<select name="Sede" id="Sede" class="form-control">
											<option value="2">Seleccione</option>
											@foreach($Sedes as $Cliente)
												<option value="{{$Cliente->ID_Sede}}">{{$Cliente->CliName}}</option>
											@endforeach
										</select>
									</div>
								@elseif(Auth::user()->UsRol=='Cliente')
									<input type="text" name="Sede" style="display: none;" value="{{$Sede}}">
								@endif
								@include('layouts.RespelPartials.Respelform1')
								<!-- /.box-body -->
								<div class="col-md-12">	
									<div class="box-footer">
										<a onclick="AgregarRes()" class="btn btn-success">Agregar Residuo</a>
										<button type="submit" class="btn btn-primary pull-right" style="margin-right:5em">Registrar</button>
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
@extends('layouts.app')
@if(Auth::user()->UsRol == "Cliente")
@section('htmlheader_title')
Respel-Editar
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::LangRespel.Respelcreate') }}
@endsection
@section('main-content')
@component('layouts.partials.modal')
	{{$Respels->ID_Respel}}
@endcomponent
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Edición de Residuos</h3>
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<div class="box box-primary">
						<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/respels/{{$Respels->ID_Respel}}" method="POST" enctype="multipart/form-data">
								@method('PUT')
								@csrf

								@include('layouts.RespelPartials.Respelform1Edit')


								<input hidden type="text" name="updated_by" value="{{Auth::user()->email}}">
								<!-- /.box-body -->
								<div class="col-md-12">	
									<div class="box-footer">
										<button type="submit" class="btn btn-primary pull-right" style="margin-right:5em">Actualizar</button>
									</div>
								</div>
							</form>
							<!-- /.box -->
						</div>
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
@endif

@if(Auth::user()->UsRol == "Programador"||Auth::user()->UsRol == "JefeOperacion"||Auth::user()->UsRol == "admin")
@section('htmlheader_title')
Respel-Tratamiento
@endsection
@section('contentheader_title')
	{{ trans('adminlte_lang::LangRespel.Respelasig') }}
@endsection
@section('main-content')
@component('layouts.partials.modal')
	{{$Respels->ID_Respel}}
@endcomponent
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Edición de Residuos</h3>
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<div class="box box-primary">
						<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/respels/{{$Respels->ID_Respel}}" method="POST" enctype="multipart/form-data">
								@method('PUT')
								@csrf

								@include('layouts.RespelPartials.trata-requerimiento')


								<input hidden type="text" name="updated_by" value="{{Auth::user()->email}}">
								<!-- /.box-body -->
								<div class="col-md-12">	
									<div class="box-footer">
										<button type="submit" class="btn btn-primary pull-right" style="margin-right:5em">Actualizar</button>
									</div>
								</div>
							</form>
							<!-- /.box -->
						</div>
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
@endif
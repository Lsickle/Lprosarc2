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
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Formulario de registro</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/permisos/{{$user->id}}" method="POST" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<div class="box-body">
									<div class="tab-pane" id="addRowWizz">
							            <p>Ingrese la informacion necesara completando todos los campos requeridos segun la informacion del residuo que desea registrar en cada paso</p>
							            <div id="smartwizard">
							              <ul>
							                <li><a href="#step-1"><b>Paso 1</b><br /><small>Datos de la cuenta</small></a></li>
							                <li><a href="#step-2"><b>Paso 2</b><br /><small>rol y tipo</small></a></li>
							                <li><a href="#step-3"><b>paso 3</b><br /><small>status</small></a></li>
							              </ul>
							                <div>
							                  <div id="step-1" class="">
							                    @include('layouts.UserPartials.form1')
							                  </div>
							                  <div id="step-2" class="">
							                    @include('layouts.UserPartials.form2')
							                  </div>
							                  <div id="step-3" class="">
							                    @include('layouts.UserPartials.form3')
							                  </div>
							                </div>
							            </div>
							        </div>
								</div>
								<input hidden type="text" name="updated_by" value="{{Auth::user()->email}}">
								<!-- /.box-body -->
								<div class="box-footer">
									<button type="submit" class="btn btn-primary pull-right" style="margin-right:5em">Actualizar</button>
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

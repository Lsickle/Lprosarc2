@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientregistertittle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.clientregistertittle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Modificar Datos de empresa</h3>
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
								<h3 class="box-title">Quick Example</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
							<form role="form" action="/permisos/{{$user->UsSlug}}" method="POST" enctype="multipart/form-data">
								@csrf
								@method('PUT')
								<div class="box-body">
									<div class="tab-pane" id="addRowWizz">
							            <p>This is a basic form wizard example that inherits the colors from the selected scheme.</p>
							            <div id="smartwizard">
							              <ul>
							                <li><a href="#step-1">Paso 1 <br /><small>Datos de la cuenta</small></a></li>
							                <li><a href="#step-2">Paso 2<br /><small>rol y tipo</small></a></li>
							                <li><a href="#step-3">paso 3<br /><small>status</small></a></li>
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
								<!-- /.box-body -->
								<div class="box-footer">
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

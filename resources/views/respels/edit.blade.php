@extends('layouts.app')
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
									<div class="box-header with-border">
									<a href="/requerimientos/{{$Requerimientos->ReqSlug}}/edit" class="btn btn-primary" style="float: right; margin-left: 1%;">Editar Requerimientos</a>
								   
									@if($Respels->RespelDelete == 0)
									   <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Respels->ID_Respel}}' class='btn btn-danger' style="float: right;">Borrar</a>
									   <form action='/respels/{{$Respels->RespelSlug}}' method='POST'>
										   @method('DELETE')
										   @csrf
										   <input  type="submit" id="Eliminar{{$Respels->ID_Respel}}" style="display: none;">
									   </form>
									   @else
									   <form action='/respels/{{$Respels->RespelSlug}}' method='POST' style="float: right;">
										   @method('DELETE')
										   @csrf
										   <input type="submit" class='btn btn-success btn-block' value="Añadir">
									   </form>
								   @endif

									</div>
								</div>
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
												<button type="submit" class="btn btn-primary pull-right" style="margin-right:5em">Registrar</button>
											</div>
										</div>
									</form>
						<!-- /.box -->
								</div>
							</div>
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
@extends('layouts.app')
{{-- vista de edición para el cliente --}}
@section('htmlheader_title')
Certificado edición
@endsection

@section('contentheader_title')
  <span style="background-image: linear-gradient(40deg, #F1B378, #D66841); padding-right:30vw; position:relative; overflow:hidden;">
  	Edición del Certificado
    <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
  </span>
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12 col-md-offset-0">
				<!-- Default box -->
				<div class="box">
					<form role="form" action="/certificados/{{$certificado->CertSlug}}" method="POST" id="myform" enctype="multipart/form-data" data-toggle="validator">
						@method('PUT')
						@csrf
						<div class="box-header">
							<h3 class="box-title">Datos del Certificado</h3>
						</div>
							<!-- left column -->
							<!-- general form elements -->
						<div class="box box-info">
							<div class="box-body">
								<!-- /.box-header -->
								@if ($errors->any())
									<div class="alert alert-danger" role="alert">
										<ul>
											@foreach ($errors->all() as $error)
												<li>{{$error}}</li>
											@endforeach
										</ul>
									</div>
								@endif
								@include('layouts.CertificadoPartials.CertificadoformEdit')
							</div>
							<div class="box box-info">
								<div class="box-footer">
									<button type="submit" class="btn btn-success pull-right"><i class="fa fa-check"></i>{{ trans('adminlte_lang::LangRespel.updaterespelButton') }}</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('name')
<script type="text/javascript">
	$(document).ready(function(){
		$("#departamento").change(function(e){
			id=$("#departamento").val();
			e.preventDefault();
			$.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			  }
			});
			$.ajax({
				url: "{{url('/muni-depart')}}/"+id,
				method: 'GET',
				data:{},
				beforeSend: function(){
					$(".load").append('<i class="fas fa-sync-alt fa-spin"></i>');
					$("#municipio").prop('disabled', true);
				},
				success: function(res){
					$("#municipio").empty();
					var municipio = new Array();
					for(var i = res.length -1; i >= 0; i--){
						if ($.inArray(res[i].ID_Mun, municipio) < 0) {
							$("#municipio").append(`<option value="${res[i].ID_Mun}">${res[i].MunName}</option>`);
							municipio.push(res[i].ID_Mun);
						}
					}
				},
				complete: function(){
					$(".load").empty();
					$("#municipio").prop('disabled', false);
				}
			})
		});
	});
</script>
@endsection
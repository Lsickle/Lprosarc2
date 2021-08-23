@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::LangRespel.Respelcreate') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #FF856D, #CC0000); padding-right:30vw; position:relative; overflow:hidden;">
	{{ trans('adminlte_lang::LangRespel.Respelcreate') }}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
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
					<div class="box box-info">
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
							<div class="box-body">
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
								@if(in_array(Auth::user()->UsRol, Permisos::RESPELPUBLIC)||in_array(Auth::user()->UsRol2, Permisos::RESPELPUBLIC))
								{{-- Categoria --}}
								<div class="col-md-6 form-group has-feedback">
									<label>Categoría</label><small class="help-block with-errors">*</small>
									<select id="selectCategory" class="form-control" data-dependent="FK_SubCategoryRP">
										<option disabled>seleccione una categoria...</option>
										@foreach($categories as $category)
										<option value="{{$category->ID_CategoryRP}}">{{$category->CategoryRpName}}</option>
										@endforeach
									</select>
								</div>

								{{-- SubCategoria --}}
								<div class="col-md-6 form-group has-feedback">
									<label>SubCategoría</label><a class="load"></a><small class="help-block with-errors">*</small>
									<select id="subcategorycontainer" name="FK_SubCategoryRP" class="form-control" required>
									</select>
								</div>
								@endif
								@include('layouts.RespelPartials.respelform1')
							</div>
							<!-- /.box-body -->
							<div class="box box-info">
								<div class="box-footer">
									{{-- <a onclick="AgregarRes()" class="btn btn-primary"><i class="fa fa-plus"></i>{{ trans('adminlte_lang::LangRespel.addrespelButton') }}</a>	 --}}
									<button type="submit" class="btn btn-success pull-right">{{ trans('adminlte_lang::LangRespel.registerrespelButton') }}</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

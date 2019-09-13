@extends('layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::LangRespel.Respeledittag') }}
@endsection

@section('contentheader_title')
{{ trans('adminlte_lang::LangRespel.Respeleditmenu') }}
@endsection

@section('main-content')
	@component('layouts.partials.modal')
		@slot('slug')
			{{$Respels->ID_PRespel}}
		@endslot
		@slot('textModal')
			el residuo <b>N° {{$Respels->PRespelName}}</b>
		@endslot
	@endcomponent
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12 col-md-offset-0">
				<!-- Default box -->
				<div class="box">
					<form role="form" action="/respelspublic/{{$Respels->ID_PRespel}}" method="POST" id="myform" enctype="multipart/form-data" data-toggle="validator">
						@method('PUT')
						@csrf
						<div class="box-header">
							<h3 class="box-title">{{ trans('adminlte_lang::LangRespel.Respeleditmenu') }}</h3>
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
								{{-- Categoria --}}
								<div class="col-md-6 form-group has-feedback">
									<label>Categoría</label><small class="help-block with-errors">*</small>
									<select id="selectCategory" class="form-control" data-dependent="FK_SubCategoryRP">
										<option disabled>seleccione una categoria...</option>
										@foreach($categories as $category)
											<option {{$Subcategory->FK_CategoryRP == $category->ID_CategoryRP ? 'selected' : ''}} value="{{$category->ID_CategoryRP}}">{{$category->CategoryRpName}}</option>
										@endforeach
									</select>
								</div>

								{{-- SubCategoria --}}
								<div class="col-md-6 form-group has-feedback">
									<label>SubCategoría</label><a class="load"></a><small class="help-block with-errors">*</small>
									<select id="subcategorycontainer" name="FK_SubCategoryRP" class="form-control" required>
										<option value="{{$Subcategory->ID_SubCategoryRP}}">{{$Subcategory->SubCategoryRpName}}</option>	
									</select>
								</div>
								@include('layouts.RespelPublicPartials.PRespelform1Edit')
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
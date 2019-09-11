@extends('layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.areatitle') }}
@endsection

@section('contentheader_title')
{{ trans('adminlte_lang::message.areatitle') }}
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">
				<div class="box">
					<div class="box-header">
						@component('layouts.partials.modal')
							@slot('slug')
								{{$categoria->ID_CategoryRP}}
							@endslot
							@slot('textModal')
								la Categoria <b>{{$categoria->CategoryRpName}}</b>
							@endslot
						@endcomponent
						<h3 class="box-title">{{ trans('adminlte_lang::message.editarea') }}</h3>
						<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$categoria->ID_CategoryRP}}' class='btn btn-danger pull-right'><i class="fas fa-trash-alt"></i><b> {{ trans('adminlte_lang::message.delete') }}</b></a>
						<a style="margin-right: 1em;" onclick="addSubcategory()" id="addsubcategorybutton" class="btn btn-primary pull-right"><i class='fas fa-plus fa-lg'></i> Añadir Subcategoria</a>
						<form action='/categorypublic/{{$categoria->ID_CategoryRP}}' method='POST'>
							@method('DELETE')
							@csrf
							<input  type="submit" id="Eliminar{{$categoria->ID_CategoryRP}}" style="display: none;">
						</form>
					</div>
					<div class="box box-info">
						<form role="form" action="/categorypublic/{{$categoria->ID_CategoryRP}}" method="POST" enctype="multipart/form-data" data-toggle="validator" id="categoryRPForm">
							@method('PATCH')
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
								<div class="form-group col-xs-12 col-md-12 has-feedback">
									<label for="CategoryRpName" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.CategoryName') }}</b>" data-content="{{ trans('adminlte_lang::message.CategoryNameInfo') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.CategoryName') }}</label>
									<small class="help-block with-errors">*</small>
										<input data-minlength="5" required="true" name="CategoryRpName" autofocus="true" type="text" class="form-control inputText" id="CategoryRpName" value="{{$categoria->CategoryRpName}}">
									{{-- <div class="input-group">
										<input data-minlength="5" required="true" name="CategoryRpName" autofocus="true" type="text" class="form-control inputText" id="CategoryRpName" value="{{$categoria->CategoryRpName}}">
										<div class="input-group-btn">
											<a onclick="AddSubcategory()" class='btn btn-primary'><i class='fas fa-plus fa-lg'></i></a>
										</div>
									</div>	 --}}
								</div>
								<div id="subcategorias">
									@foreach($categoria->SubCategoryRP as $SubCategory)
									<div class="form-group col-xs-12 col-md-6">
										<label for="SubCategoryRpName" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Nombre de la Subcategoria</b>" data-content="{{ trans('adminlte_lang::message.SubCategoryNameInfo') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Nombre de la Subcategoria</label>
										<small class="help-block with-errors">*</small>
										<input data-minlength="5" required="true" name="SubCategoryRp[]name" autofocus="true" type="text" class="form-control inputText" id="SubCategoryRpName" value="{{$SubCategory->SubCategoryRpName}}">
										<input hidden name="ID_SubCategoryRP[]" value="{{$SubCategory->ID_SubCategoryRP}}">
									</div>
									@endforeach
								</div>
							</div>
							<div class="box box-info">
								<div class="box-footer">
									<button type="submit" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.update') }}</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('NewScript')
<script type="text/javascript">
	var contador = {{isset($contadorphp)?$contadorphp:1}};

	function validarprevent(){
			$("#addsubcategorybutton").click(function(event) {
			  event.preventDefault();
			});
	}
	function addSubcategory(){
		validarprevent();
		$('#subcategorias').append('<div id ="minusSubCategoryButton'+contador+'Container" class="form-group col-xs-12 col-md-6"><label for="SubCategoryRpName" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.SubCategoryName') }}</b>" data-content="{{ trans('adminlte_lang::message.SubCategoryNameInfo') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.SubCategoryName') }}</label><a onclick="EliminarSubcategory('+contador+')" id="minusSubCategoryButton'+contador+'"><i style="color:red; margin: 0; padding: 0; margin-top: 0.25em; cursor: pointer;" class="fa fa-trash-alt pull-right"></i></a><small class="help-block with-errors pull-right">*</small><input data-minlength="5" required="true" name="SubCategoryRpName[]" autofocus="true" type="text" class="form-control inputText" id="SubCategoryRpName'+contador+'"></div>');
		$("#categoryRPForm").validator('update');
		contador = parseInt(contador) + 1;
		popover();
	}
	function EliminarSubcategory(contador){
		validarprevent();
		$("#minusSubCategoryButton"+contador+"Container").remove();
		$("#categoryRPForm").validator('update');

	}
</script>
@endsection

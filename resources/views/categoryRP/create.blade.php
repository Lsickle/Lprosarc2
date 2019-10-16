@extends('layouts.app')

@section('htmlheader_title')
Crear Categoria
@endsection

@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #d4fc79, #00C851); padding-right:30vw; position:relative; overflow:hidden;">
	Categorias
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Crear Categoria</h3>
					</div>
					<div class="box box-info">
						<form role="form" action="/categorypublic" method="POST" enctype="multipart/form-data" data-toggle="validator">
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
								
								<div class="form-group col-xs-12 col-md-12">
									<label for="CategoryRpName" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.CategoryName') }}</b>" data-content="{{ trans('adminlte_lang::message.CategoryNameInfo') }}"><i style="font-size: 1.7rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.CategoryName') }}</label>
									<small class="help-block with-errors">*</small>
									<input data-minlength="5" required name="CategoryRpName" autofocus="true" type="text" class="form-control inputText" id="CategoryRpName" value="{{old('CategoryRpName')}}">
								</div>
							</div>	
							<div class="box box-info">
								<div class="box-footer">
									<button type="submit" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.register') }}</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

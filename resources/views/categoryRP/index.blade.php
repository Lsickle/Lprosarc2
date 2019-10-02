@extends('layouts.app')
@section('htmlheader_title')
Lista de Categorias
@endsection
@section('contentheader_title')
Categorias para Residuos Comunes
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Lista de Categorias</h3>
						<a href="/categorypublic/create" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.create') }}</a>
					</div>
					<div class="box box-info">
						<div class="box-body">
							<table id="AreaTable" class="table table-compact table-bordered table-striped">
								<thead>
									<tr>
										<th>Categoria</th>
										<th>SubCategoria</th>
										<th>Editar</th>
									</tr>
								</thead>
								<tbody id="readyTable">
									@foreach($CategoriesRP as $CateroryRP)
									<tr>
										<td>{{$CateroryRP->CategoryRpName}}</td>
										<td>{{$CateroryRP->SedeName}}
											<ul>
											@foreach($CateroryRP->SubCategoryRP as $SubCateroryRP)
												<li>{{$SubCateroryRP->SubCategoryRpName}}</li>
											@endforeach
											</ul>
										</td>
										<td><a href='/categorypublic/{{$CateroryRP->ID_CategoryRP}}/edit' class='btn btn-warning'><i class="fas fa-edit"></i> <b>{{trans('adminlte_lang::message.edit')}}</b></a></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
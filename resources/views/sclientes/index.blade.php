@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.sclientmenu') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">

				<!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de sedes por cliente</h3>
              <a href="/sclientes/create" class="btn btn-primary" style="float: right;">Crear</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="sedes" class="table table-bordered table-striped" width="100%">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Direccion</th>
                  <th>Municipio</th>
                  <th>Cliente</th>
                  <th>Celular</th>
                  <th>Sede Email</th>
                  <th>Telefono 1</th>
                  <th>Telefono 2</th>
                  <th>Editar</th>
                </tr>
                </thead>
                <tbody hidden onload="renderTable()" id="readyTable">

              {{-- <h1 id="loadingTable">LOADING...</h1> --}}
                   @include('layouts.partials.spinner')
                	@foreach($sedes as $Sede)
						        <tr @if($Sede->SedeDelete === 1)
                          style="color: red;" 
                        @endif
                    >
		                  <td>{{$Sede->SedeName}}</td>
		                  <td>{{$Sede->SedeAddress}}</td>
                      <td>{{$Sede->MunName.' - '.$Sede->DepartName}}</td>
                      <td>{{$Sede->CliShortname}}</td>
                      <td>{{$Sede->SedeCelular}}</td>
                      <td>{{$Sede->SedeEmail}}</td>
		                  <td>{{$Sede->SedePhone1.' - '.$Sede->SedeExt1}}</td>
                      <td>{{$Sede->SedePhone2.' - '.$Sede->SedeExt2}}</td>
                      <td>{{$Sede->SedeSlug}}</td>
		                </tr>
			          	@endforeach
            	</tbody>
                <tfoot>
                <tr>
                  <th>Nombre</th>
                  <th>Direccion</th>
                  <th>Municipio</th>
                  <th>Cliente</th>
                  <th>Celular</th>
                  <th>Sede Email</th>
                  <th>Telefono 1</th>
                  <th>Telefono 2</th>
                  <th>Editar</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

			</div>
		</div>
	</div>
@endsection
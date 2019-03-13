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
              <table id="scliente" class="table table-compact table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Direccion</th>
                  <th>Telefono 1</th>
                  <th>Ext1</th>
                  <th>Telefono 2</th>
                  <th>Ext2</th>
                  <th>Sede Email</th>
                  <th>Sede Celular</th>
                  <th>Cliente</th>
                  <th>Auditable</th>
                  <th>Editar</th>
                  <th>Borrar</th>
                </tr>
                </thead>
                <tbody  hidden onload="renderTable()" id="readyTable">

              {{-- <h1 id="loadingTable">LOADING...</h1> --}}
                   <div class="fingerprint-spinner" id="loadingTable">
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">L</b></div>
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">o</b></div>
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">a</b></div>
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">d</b></div>
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">i</b></div>
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">n</b></div>
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">g</b></div>
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">.</b></div>
                     <div class="spinner-ring"><b style="font-size: 1.8rem;">.</b></div>
                   </div>
                	@foreach($sedes as $Sede)
						        <tr>
		                  <td>{{$Sede->SedeName}}</td>
		                  <td>{{$Sede->SedeAddress}}</td>
		                  <td>{{$Sede->SedePhone1}}</td>
		                  <td>{{$Sede->SedeExt1}}</td>
                      <td>{{$Sede->SedePhone2}}</td>
                      <td>{{$Sede->SedeExt2}}</td>
                      <td>{{$Sede->SedeEmail}}</td>
                      <td>{{$Sede->SedeCelular}}</td>
                      <td>{{$Sede->CliShortname}}</td>
	                  	@if($Sede->CliAuditable==1)
        								<td>Si</td>
        							@else
        								<td>NO</td>
        							@endif
                      <td>{{$Sede->SedeSlug}}</td>
                      <td>Naa</td>
		                </tr>
			          	@endforeach
            	</tbody>
                <tfoot>
                <tr>
                  <th>Nombre</th>
                  <th>Direccion</th>
                  <th>Telefono 1</th>
                  <th>Ext1</th>
                  <th>Telefono 2</th>
                  <th>Ext2</th>
                  <th>Sede Email</th>
                  <th>Sede Celular</th>
                  <th>Cliente</th>
                  <th>Auditable</th>
                  <th>edicion</th>
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
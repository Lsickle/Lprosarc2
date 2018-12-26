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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
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
                  <th>edicion</th>
                </tr>
                </thead>
                <tbody>
                	{{-- <div class="row">
							<div class="card text-center" style="width: 18rem; margin-top:3rem;">
								<img class="card-img-top rounded-circle mx-auto d-block" src="images/{{$trainer->avatar}}" onerror="this.src='images/default.jpg';" alt="" style="margin:2rem; background-color:#EFEFEF; width:8rem;height:8rem;">
								<div class="card-body">
									<h5 class="card-title">{{$cliente->CliShortname}}</h5>	
									<p class="card-text" style="overflow-y: scroll; max-height:3rem; min-height:3rem;">{{$cliente->CliNit}}</p>
									<a href="/clientes/{{$cliente->CliShortname}}" class="btn btn-primary">Ver mas...</a>
								</div>
							</div>
						</div> --}}
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
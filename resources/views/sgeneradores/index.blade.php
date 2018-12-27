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
              <h3 class="box-title">Lista de sedes por Generador</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example4" class="table table-bordered table-striped">
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
                  <th>Generador</th>
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
                	@foreach($Gsedes as $GSede)
						        <tr>
		                  <td>{{$GSede->GSedeName}}</td>
		                  <td>{{$GSede->GSedeAddress}}</td>
		                  <td>{{$GSede->GSedePhone1}}</td>
		                  <td>{{$GSede->GSedeExt1}}</td>
                      <td>{{$GSede->GSedePhone2}}</td>
                      <td>{{$GSede->GSedeExt2}}</td>
                      <td>{{$GSede->GSedeEmail}}</td>
                      <td>{{$GSede->GSedeCelular}}</td>
                      <td>{{$GSede->GenerShortname}}</td>
	                  	@if($GSede->GenerAuditable==1)
        								<td>Si</td>
        							@else
        								<td>NO</td>
        							@endif
                      <td>{{$GSede->GSedeSlug}}</td>
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
                  <th>Generador</th>
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
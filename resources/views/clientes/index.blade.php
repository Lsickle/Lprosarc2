  @extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.clientmenu') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">

				<!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">lista de clientes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Categoria</th>
                  <th>Nombre</th>
                  <th>NIT</th>
                  <th>Creado el</th>
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
                	@foreach($clientes as $cliente)
						        <tr>
		                  <td>{{$cliente->CliCategoria}}</td>
		                  <td>{{$cliente->CliShortname}}</td>
		                  <td>{{$cliente->CliNit}}</td>
		                  <td>{{$cliente->created_at}}</td>
		                  	@if($cliente->CliAuditable==1)
          								<td>Si</td>
          							@else
          								<td>NO</td>
          							@endif
                          <td>{{$cliente->CliSlug}}</td>
		                </tr>
					@endforeach
            	</tbody>
                <tfoot>
                <tr>
                  <th>Categoria</th>
                  <th>Nombre</th>
                  <th>NIT</th>
                  <th>Creado el</th>
                  <th>Auditable</th>
                  <th>edicion</th
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
  @extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::LangUsers.usermenu') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">

				<!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ trans('adminlte_lang::LangUsers.userlist') }}</h3>
              <div style="margin-right:2em; float: right;">
              <a class="btn btn-primary" href="#addRowWizz" data-toggle="tab"> persona Usuario</a>
            </div>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="UsersTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Rol</th>
                  <th>DescripcionRol</th>
                  <th>Mas...</th>
                </tr>
                </thead>
                <tbody>
                	{{-- <div class="row">
							<div class="card text-center" style="width: 18rem; margin-top:3rem;">
								<img class="card-img-top rounded-circle mx-auto d-block" src="images/{{$trainer->avatar}}" onerror="this.src='images/default.jpg';" alt="" style="margin:2rem; background-color:#EFEFEF; width:8rem;height:8rem;">
								<div class="card-body">
									<h5 class="card-title">{{$user->CliShortname}}</h5>	
									<p class="card-text" style="overflow-y: scroll; max-height:3rem; min-height:3rem;">{{$user->CliNit}}</p>
									<a href="/clientes/{{$user->CliShortname}}" class="btn btn-primary">Ver mas...</a>
								</div>
							</div>
						</div> --}}
                	@foreach($users as $user)
						        <tr>
		                  <td>{{$user->name}}</td>
		                  <td>{{$user->email}}</td>
                      <td>{{$user->UsStatus}}</td>
                      <td>{{$user->rolname}}</td>
                      <td>{{$user->descripcion}}</td>
                      <th>{{$user->UsSlug}}</th>
		                </tr>
					@endforeach
            	</tbody>
                <tfoot>
                <tr>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Rol</th>
                  <th>DescripcionRol</th>
                  <th>Mas...</th>
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
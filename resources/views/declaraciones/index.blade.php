  @extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::LangDeclar.declarmenu') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">

				<!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ trans('adminlte_lang::LangDeclar.declarlist') }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="DeclarTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Aplicacion</th>
                  <th>Tipo</th>
                  <th>Nombre</th>
                  <th>Status</th>
                  <th>Frecuencia</th>
                  <th>Cliente</th>
                  <th>Generador</th>
                  <th>Auditable</th>
                  <th>Creado por</th>
                  <th>Creado el</th>
                  <th>Actualizado el</th>
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
                	@foreach($Declarations as $declaracion)
						        <tr>
		                  <td>{{$declaracion->DeclarApply}}</td>
		                  <td>{{$declaracion->DeclarTipo}}</td>
		                  <td>{{$declaracion->DeclarName}}</td>
		                  <td>{{$declaracion->DeclarStatus}}</td>
                      <td>{{$declaracion->DeclarFrecuencia}}</td>
                      <td>{{$declaracion->SedeName}}</td>
                      <td>{{$declaracion->GSedeName}}</td>
                      @if($declaracion->DeclarAuditable==1)
                          <td>Si</td>
                        @else
                          <td>NO</td>
                        @endif
                        <td>{{$declaracion->name}}</td>
                        <td>{{$declaracion->created_at}}</td>
                        <td>{{$declaracion->updated_at}}</td>
                      <td>{{$declaracion->DeclarSlug}}</td>
		                </tr>
					@endforeach
            	</tbody>
                <tfoot>
                <tr>
                  <th>Aplicacion</th>
                  <th>Tipo</th>
                  <th>Nombre</th>
                  <th>Status</th>
                  <th>Frecuencia</th>
                  <th>Cliente</th>
                  <th>Generador</th>
                  <th>Auditable</th>
                  <th>Creado por</th>
                  <th>Creado el</th>
                  <th>Actualizado el</th>
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
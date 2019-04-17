@extends('layouts.app')

@section('htmlheader_title','Generadores')


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">

				<!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de sedes por Generador</h3>
              <a href="/sgeneradores/create" class="btn btn-primary" style="float: right;">Crear</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="sgeneradores" class="table table-bordered table-striped">
                <thead hidden id="readyHead">
                <tr>
                  <th>Nombre</th>
                  <th>Direccion</th>
                  <th>Telefono 1</th>
                  <th>Telefono 2</th>
                  <th>Sede Email</th>
                  <th>Sede Celular</th>
                  <th>Generador</th>
                  <th>Municipio</th>
                  <th>Editar</th>
                </tr>
                </thead>
                <tbody  hidden onload="renderTable()" id="readyTable">

              {{-- <h1 id="loadingTable">LOADING...</h1> --}}
                   @include('layouts.partials.spinner')
                	@foreach($Gsedes as $GSede)
						        <tr @if($GSede->GSedeDelete === 1)
                          style="color: red;" 
                        @endif
                    >
		                  <td>{{$GSede->GSedeName}}</td>
		                  <td>{{$GSede->GSedeAddress}}</td>
		                  <td>{{$GSede->GSedePhone1}}</td>
                      <td>{{$GSede->GSedePhone2}}</td>
                      <td>{{$GSede->GSedeEmail}}</td>
                      <td>{{$GSede->GSedeCelular}}</td>
                      <td>{{$GSede->GenerShortname}}</td>
                      <td>{{$GSede->MunName." - ".$GSede->DepartName}}</td>
                      <td>{{$GSede->GSedeSlug}}</td>
		                </tr>
			          	@endforeach
            	</tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

			</div>
		</div>
	</div>
@endsection
  @extends('layouts.app')

@section('htmlheader_title','Generadores')
@section('contentheader_title','Lista de Generadores')

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">

				<!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Lista de Generadores</h3>
              <a href="/generadores/create" class="btn btn-primary" style="float: right;">Crear</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="generadores" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Categoria</th>
                  <th>Nombre</th>
                  <th>NIT</th>
                  <th>Creado el</th>
                  <th>Sede</th>
                  <th>Cliente</th>
                  <th>Ver Más</th>
                  <th>Editar</th>
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
                	@foreach($Generadors as $Gener)
						        <tr @if($Gener->GenerDelete === 1)
                          style="color: red;" 
                        @endif
                    >
		                  <td>{{$Gener->GenerType}}</td>
		                  <td>{{$Gener->GenerName}}</td>
		                  <td>{{$Gener->GenerNit}}</td>
		                  <td>{{$Gener->created_at}}</td>
                      <td>{{$Gener->SedeName}}</td>
                      <td>{{$Gener->CliShortname}}</td>
                      <td>{{$Gener->GenerSlug}}</td>
                      <td>{{$Gener->GenerSlug}}</td>
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
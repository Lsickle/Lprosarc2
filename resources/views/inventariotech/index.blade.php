@extends('layouts.app')

@section('htmlheader_title','InventarioTech')

@section('contentheader_title', 'InventarioTechnoligy')

@section('main-content')
	<div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-16 col-md-offset-0">
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Inventario de tecnologia</h3>
            <a href="cargos/create" class="btn btn-primary" style="float: right;">Crear</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="CargosTable" class="table table-compact table-bordered table-striped">
              <thead>
                <tr>
	              <th>Nombre</th>
	              <th>Modelo</th>
	              <th>Sistema Operativo</th>
	              <th>Observaciones</th>
	              <th>Ver más..</th>
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
                @foreach($Inventarios as $Inventario)
                <tr>
                  <td>{{$Inventario->PersFirstName." ".$Inventario->PersLastName}}</td>
                  <td>{{$Inventario->TecnBrand}}</td>
                  <td>{{$Inventario->TecnOs}}</td>
                  <td>{{$Inventario->Tecnobserv}}</td>
                  <td>{{$Inventario->ID_Tecn}}</td>
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

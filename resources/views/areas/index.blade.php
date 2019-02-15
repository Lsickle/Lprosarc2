@extends('layouts.app')

@section('htmlheader_title','Areas')

@section('contentheader_title', 'Areas Finales')

@section('main-content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-16 col-md-offset-0">
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Lista de Areas</h3>
            <a href="areas/create" class="btn btn-primary" style="float: right;">Crear</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-compact table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Sede</th>
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
                {{-- <div class="row">
                  <div class="card text-center" style="width: 18rem; margin-top:3rem;">
                    <div class="card-body">
                      <h5 class="card-title">hola</h5>
                      <p class="card-text" style="overflow-y: scroll; max-height:3rem; min-height:3rem;">hola</p>
                      <a href="/clientes/hola" class="btn btn-primary">Ver mas...</a>
                    </div>
                  </div>
                </div> --}}
                @foreach($Areas as $Area)
                <tr>
                  <td>{{$Area->AreaName}}</td>
                  <td>{{$Area->SedeName}}</td>
                </tr>
                @endforeach
              </tbody>
              {{-- <tfoot>
              <tr>
                <th>Nombre</th>
                <th>Sede</th>
                <th>Mas...</th>
              </tr>
              </tfoot> --}}
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>
@endsection

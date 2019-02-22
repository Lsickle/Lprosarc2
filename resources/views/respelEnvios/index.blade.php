@extends('layouts.app')

@section('htmlheader_title','Recibos')

@section('contentheader_title', 'Recibos')

@section('main-content')
	<div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-16 col-md-offset-0">
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Lista de ResEnvios</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="RMaterialsTable" class="table table-compact table-bordered table-striped">
                <tr>
                  <th>Recibo</th>
                  <td>1</td>
                </tr>
                <tr>
                  <th>Kg Enviado</th>
                  <td>2</td>
                </tr>
                <tr>
                  <th>Kg Llegado</th>
                  <td>3</td>
                </tr>
                <tr>
                  <th>Kg Conciliado</th>
                  <td>4</td>
                </tr>
                <tr>
                  <th>Kg Tratado</th>
                  <td>5</td>
                </tr>
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
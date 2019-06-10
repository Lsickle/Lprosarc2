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
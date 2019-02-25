@extends('layouts.app')
@section('htmlheader_title')
Solicitud de Servicios
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Datos de la solicitud de servicios</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="SolicitudservicioTable" class="table table-compact table-bordered table-striped">
            <thead>
                <tr>
                  <th>Fecha creado</th>
                  <th>Fecha mejorado</th>
                  <th>Estado</th>
                  <th>Tipo</th>
                  <th>Auditable</th>
                  <th>Frecuencia</th>
                  <th>Conductor Externo</th>
                  <th>Placa del vehiculo externo</th>
                </tr>
            </thead>
            <tbody  hidden onload="renderTable()" id="readyTable">
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
            {{-- <tfoot>
                <tr>
                  <th>Estado</th>
                  <th>Tipo</th>
                  <th>Auditable</th>
                  <th>Frecuencia</th>
                  <th>Conductor Externo</th>
                  <th>Placa del vehiculo externo</th>
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
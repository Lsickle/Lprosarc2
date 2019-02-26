@extends('layouts.app')
@section('htmlheader_title')
Solicitud de residuos
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Datos de la solicitud de residuos</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          {{-- <table id="SolicitudresiduoTable" class="table table-compact table-bordered table-striped"> --}}
          <table id="solicitudresiduoTable" class="table table-compact table-bordered table-striped">
            <thead>
                <tr>
                  <th>Kilogramos enviado</th>
                  <th>Kilogramos recibido</th>
                  <th>Kilogramos Conciliado</th>
                  <th>Tratado</th>
                  <th>Fecha de creacion</th>
                  <th>Fecha de actualizacion</th>
                </tr>
              </thead>
                @foreach ($Residuos as $Residuo)
                <tr>
            <th>{{$Residuo->SolResKgEnviado}}</th>
            <th>{{$Residuo->SolResKgRecibido}}</th>
            <th>{{$Residuo->SolResKgConciliado}}</th>
            <th>{{$Residuo->SolResKgTratado}}</th>
            <th>{{$Residuo->created_at}}</th>
            <th>{{$Residuo->updated_at}}</th>
                </tr>
                @endforeach
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
                  <th>Kilogramos enviado</th>
                  <th>Kilogramos recibido</th>
                  <th>Kilogramos Conciliado</th>
                  <th>Tratado</th>
                  <th>Fecha de creacion</th>
                  <th>Fecha de actualizacion</th>
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
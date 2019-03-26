@extends('layouts.app')
@section('htmlheader_title')
Residuos
@endsection
@section('contentheader_title')
Solicitud de Residuos
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Datos</h3>
          <a href="/solicitud-residuo/create" class="btn btn-primary" style="float: right;">Crear</a>  
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="SolicitudresiduoTable" class="table table-compact table-bordered table-striped">
            <thead>
                <tr>
                  <th>Solicitud de Servicio</th>
                  <th>Cliente</th>
                  <th>Residuo</th>
                  <th>Kilogramos enviado</th>
                  <th>Kilogramos recibido</th>
                  <th>Kilogramos Conciliado</th>
                  <th>Tratado</th>
                  <th>Solicitud de servicio</th>
                  <th>Editar</th>
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
              @foreach ($Residuos as $Residuo)
                <tr>
                  <td>{{$Residuo->ID_SolSer}}</td>
                  <td>{{$Residuo->CliShortname}}</td>
                  <td>{{$Residuo->RespelName}}</td>
                  <td>{{$Residuo->SolResKgEnviado}}</td>
                  <td>{{$Residuo->SolResKgRecibido}}</td>
                  <td>{{$Residuo->SolResKgConciliado}}</td>
                  <td>{{$Residuo->SolResKgTratado}} Kilogramo</td>
                  <td>{{$Residuo->FK_SolResSolSer}}</td>
                  <td>{{$Residuo->SolResSlug}}</td>
                </tr>
                @endforeach
            {{-- <tfoot>
                <tr>
                  <th>Cliente</th>
                  <th>Residuo</th>
                  <th>Kilogramos enviado</th>
                  <th>Kilogramos recibido</th>
                  <th>Kilogramos Conciliado</th>
                  <th>Tratado</th>
                  <th>Solicitud de servicio</th>
                  <th>Editar</th>
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
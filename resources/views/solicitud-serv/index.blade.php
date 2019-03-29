@extends('layouts.app')
@section('htmlheader_title')
Solicitud de Servicios
@endsection
@section('contentheader_title')
Servicios
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Datos de las solicitudes de los servicios</h3>
          <a href="solicitud-servicio/create" class="btn btn-primary" style="float: right;">Crear</a>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="SolicitudservicioTable" class="table table-compact table-bordered table-striped">
            <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Generador</th>
                  <th>Residuo</th>
                  <th>Estado</th>
                  <th>Auditable</th>
                  <th>Frecuencia</th>
                  <th>Tipo del vehiculo</th>
                  <th>Conductor Externo</th>
                  <th>Placa del vehiculo externo</th>
                  {{-- <th>Fecha creado</th> --}}
                  {{-- <th>Fecha modificado</th> --}}
                  <th>Ver Más</th>
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
              @foreach ($Servicios as $Servicio)
                    <tr>
                      <td>{{$Servicio->CliShortname}}</td>
                      <td>{{$Servicio->GenerName}}</td>
                      <td>{{$Servicio->RespelName}}</td>
                      <td>{{$Servicio->SolSerStatus}}</td>
                      @if ($Servicio->SolSerAuditable == 1)
                      <td>Si</td>                      
                      @else
                      <td>No</td>
                      @endif
                      <td>{{$Servicio->SolSerFrecuencia}} Días</td>
                      <td>{{$Servicio->SolSerTipo}}</td>
                      <td>{{$Servicio->SolSerConducExter}}</td>
                      <td>{{$Servicio->SolSerVehicExter}}</td>
                      {{-- <td>{{$Servicio->created_at}}</td> --}}
                      {{-- <td>{{$Servicio->updated_at}}</td> --}}
                      <td>{{$Servicio->SolSerSlug}}</td>
                    </tr>
                @endforeach
                  </tbody>
            {{-- <tfoot>
                <tr>
                  <th>Cliente</th>
                  <th>Generador</th>
                  <th>Residuo</th>
                  <th>Estado</th>
                  <th>Auditable</th>
                  <th>Frecuencia</th>
                  <th>Tipo del vehiculo</th>
                  <th>Conductor Externo</th>
                  <th>Placa del vehiculo externo</th>
                  <th>Fecha creado</th>
                  <th>Fecha modificado</th>
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
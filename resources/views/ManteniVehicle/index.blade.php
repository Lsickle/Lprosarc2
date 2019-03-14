@extends('layouts.app')
@section('htmlheader_title', 'Vehiculos')
@section('contentheader_title', 'Lista de Vehiculos')
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Datos de los vehiculos</h3>
          <a href="/vehicle-mantenimiento/create" class="btn btn-primary" style="float: right;">Crear</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="MantVehicleTable" class="table table-compact table-bordered table-striped">
            <thead>
                <tr>
                  <th>Vehiculo</th>
                  <th>Kilometraje</th>
                  <th>Estado</th>
                  <th>Tipo</th>
                  <th>Hora Inicio</th>
                  <th>Hora Final</th>
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
              
              @foreach ($MantVehicles as $MantVehicle)
                <tr>
                  <td>{{$MantVehicle->VehicPlaca}}</td>
                  <td>{{$MantVehicle->MvKm}}</td> 
                  @if($MantVehicle->HoraMavFin >= now())
                    <td>Activo</td>
                  @else
                    <td>Finalizado</td>
                  @endif
                  <td>{{$MantVehicle->MvType}}</td>
                  <td>{{$MantVehicle->HoraMavInicio}}</td>
                  <td>{{$MantVehicle->HoraMavFin}}</td>
                  <td>{{$MantVehicle->ID_Mv}}</td>
                </tr> 
              @endforeach
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</div>
@endsection
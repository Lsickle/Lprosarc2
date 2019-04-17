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
                  <th>Estado</th>
                  <th>Persona encargada</th>
                  <th>Email</th>
                  <th>Cantidad (Total)</th>
                  <th>Tipo del vehiculo</th>
                  <th>Ver Más</th>
                </tr>
                
            </thead>
            <tbody  hidden onload="renderTable()" id="readyTable">
                @include('layouts.partials.spinner')
                @foreach ($Servicios as $Servicio)
                    @if($Servicio->SolSerDelete == 1)
                      <tr style="color: red;">
                    @else
                      <tr>
                    @endif
                      <td>{{$Servicio->CliShortname}}</td>
                      <td>{{$Servicio->SolSerStatus}}</td>
                      <td>{{$Servicio->PersFirstName.' '.$Servicio->PersLastName}}</td>
                      <td>{{$Servicio->PersAddress}}(email)</td>
                      <td>230 kg</td>
                      <td>{{$Servicio->SolSerTipo}}</td>
                      <td>{{$Servicio->SolSerSlug}}</td>
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
@extends('layouts.app')
@section('htmlheader_title', 'Vehiculos')
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Datos de los vehiculos</h3>
          <a href="/vehicle/create" class="btn btn-primary" style="float: right;">Crear</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="VehicleTable" class="table table-compact table-bordered table-striped">
            <thead>
                <tr>
                  <th>Placa</th>
                  <th>Tipo</th>
                  <th>Capacidad</th>
                  <th>Km Actual</th>
                  <th>Prosedencia</th>
                  <th>Sede</th>
                  <th>Fecha Registrado</th>
                  <th>Editar</th>
                  <th>Borrar</th>
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
              
              @foreach ($Vehicles as $Vehicle)
              @component('layouts.partials.modal')
                    {{$Vehicle->VehicPlaca}}
              @endcomponent
                <tr>
                  <td>{{$Vehicle->VehicPlaca}}</td>   
                  <td>{{$Vehicle->VehicTipo}}</td>   
                  <td>{{$Vehicle->VehicCapacidad}} Kilos</td>   
                  <td>{{$Vehicle->VehicKmActual}}</td> 
                  @if ($Vehicle->VehicInternExtern == 1)
                      <td>Interno</td>
                  @else
                      <td>Externo</td>
                  @endif  
                  <td>{{$Vehicle->SedeName}}</td>
                  <td>{{$Vehicle->created_at}}</td>
                  <td>{{$Vehicle->VehicPlaca}}</td>
                  <td>@if($Vehicle->VehicDelete === 0)
                        <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Vehicle->VehicPlaca}}' class='btn btn-danger btn-block'>Borrar</a>
                        <form action='/vehicle/{{$Vehicle->VehicPlaca}}' method='POST'>
                          @method('DELETE')
                          @csrf
                          <input  type="submit" id="Eliminar{{$Vehicle->VehicPlaca}}" style="display: none;">
                        </form>
                      @else
                        <form action='/vehicle/{{$Vehicle->VehicPlaca}}' method='POST'>
                          @method('DELETE')
                          @csrf
                          <input type="submit" class='btn btn-success btn-block' value="Añadir">
                        </form>
                      @endif
                  </td>
                </tr> 
              @endforeach
            {{-- <tfoot>
                <tr>
                    <th>Placa</th>
                    <th>Tipo</th>
                    <th>Capacidad</th>
                    <th>Km Actual</th>
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
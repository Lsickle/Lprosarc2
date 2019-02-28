@extends('layouts.app')
@section('htmlheader_title')
Activos
@endsection
@section('contentheader_title')
Activos
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Datos de los activos</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="MovimientoActivoTable" class="table table-compact table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre del activo</th>
                    <th>Tipo</th>
                    <th>Fecha Creacion</th>
                    <th>Actualizado el</th>
                    <th>Editar</th>
                </tr>
              
            {{-- </thead> --}}
          {{-- </tbody> --}}
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
              @foreach ($Movimientos as $Movimiento)
                  <tr>
                    <td>{{$Movimiento->ActName}}</td>
                    <td>{{$Movimiento->MovTipo}}</td>
                    <td>{{$Movimiento->created_at}}</td>
                    <td>{{$Movimiento->updated_at}}</td>
                    <td></td>

                  </tr>
                
              @endforeach
              {{-- @foreach ($Activos as $Activo)
                  
              @endforeach --}}
            {{-- <tfoot>
                <tr>
                    <th>Nombre del activo</th>
                    <th>Tipo</th>
                    <th>Fecha Creacion</th>
                    <th>Actualizado el</th>
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
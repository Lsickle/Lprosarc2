@extends('layouts.app')
@section('htmlheader_title')
Movimiento
@endsection
@section('contentheader_title')
Movimiento de Activos
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Datos</h3>
          <a href="movimiento-activos/create" class="btn btn-primary" style="float: right;">Crear</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="MovimientoActivoTable" class="table table-compact table-bordered table-striped">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Activo</th>
                    <th>Tipo</th>
                    <th>Asignado</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Editar</th>
                </tr>
            </thead>
          {{-- </tbody> --}}
            <tbody  hidden onload="renderTable()" id="readyTable">
              @foreach ($Movimientos as $Movimiento)
                  <tr>
                    <td>{{$Movimiento->CliShortname}}</td>
                    <td>{{$Movimiento->ActName}}</td>
                    <td>{{$Movimiento->MovTipo}}</td>
                    <td>{{$Movimiento->PersFirstName}}</td>
                    <td>{{$Movimiento->created_at}}</td>
                    <td>{{$Movimiento->updated_at}}</td>
                    <td>{{$Movimiento->ID_MovAct}}</td>
                  </tr>
              @endforeach
            {{-- <tfoot>
                <tr>
                    <th>Activo</th>
                    <th>Asignado</th>
                    <th>Tipo</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
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
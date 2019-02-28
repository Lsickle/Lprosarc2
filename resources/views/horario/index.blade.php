@extends('layouts.app')
@section('htmlheader_title')
Horario
@endsection
@section('contentheader_title')
Horarios del personal
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Datos</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="HorarioTable" class="table table-compact table-bordered table-striped">
            <thead>
                <tr>
                    <th>Trabajador</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Otro tipo</th>
                    <th>Feriado</th>
                    <th>Entrada</th>
                    <th>Salida</th>
                    <th>Permiso (Inicio)</th>
                    <th>Permiso (Final</th>
                    <th>Editar</th>
                </tr>
            </thead>
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
              @foreach ($Horarios as $Horario)
                <tr>
                    <td>{{$Horario->PersFirstName}}</td>
                    <td>{{$Horario->HorarioFecha}}</td>
                    <td>{{$Horario->Horariotipo}}</td>
                    <td>{{$Horario->HorariotipoOther}}</td>
                    @if ($Horario->HorarioFeriado <> 1)
                        <td>Domingo</td>
                    @else
                        <td>Festivo</td>
                    @endif
                    <td>{{$Horario->HorarioEntrada}}</td>
                    <td>{{$Horario->HorarioSalida}}</td>
                    <td>{{$Horario->HoraPermisoInicio}}</td>
                    <td>{{$Horario->HoraPermisoFin}}</td>
                    <td></td>
                </tr>
              @endforeach
            {{-- <tfoot>
                <tr>
                    <th>Trabajador</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Otro tipo</th>
                    <th>Feriado</th>
                    <th>Entrada</th>
                    <th>Salida</th>
                    <th>Permiso (Inicio)</th>
                    <th>Permiso (Final</th>
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
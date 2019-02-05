@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.auditmenu') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de Cambios y Actualizaciones</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="auditstable" class="table table-compact table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Creado</th>
                <th>Tabla</th>
                <th>Registro</th>
                <th>Usuario</th>
                <th>LOG</th>
              </tr>
            </thead>
            <tbody  hidden onload="renderTable()" id="readyTable">
              {{-- <h1 id="loadingTable">LOADING...</h1> --}}
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
              @foreach($auditorias as $auditoria)
              <tr>
                <td>{{$auditoria->id}}</td>
                <td>{{$auditoria->created_at}}</td>
                <td>{{$auditoria->AuditTabla}}</td>
                <td>{{$auditoria->AuditRegistro}}</td>
                <td>{{$auditoria->AuditUser}}</td>
                <td>
                
                @foreach ($auditoria->Auditlog as $key=>$val)
                          <b>{{ $key }}</b>:{{ $val }}<br>
                @endforeach
                </td>
              </tr>
              @endforeach
            </tbody>
            {{-- <tfoot>
            <tr>
                <th>ID</th>
                <th>Creado</th>
                <th>Tabla</th>
                <th>Registro</th>
                <th>Usuario</th>
                <th>ver</th>
                <th>LOG</th>
            </tr>
            </tfoot> --}}
          </table>
        </div>
      </div>
      <!-- /.box -->
    </div>
  </div>
</div>
@endsection
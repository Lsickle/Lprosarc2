@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::LangAudit.auditmenu') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">{{ trans('adminlte_lang::LangAudit.auditTittle') }}</h3>
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
            <tbody id="readyTable">
              @foreach($auditorias as $auditoria)
              <tr>
                <td>{{$auditoria->id}}</td>
                <td>{{$auditoria->created_at}}</td>
                <td>{{$auditoria->AuditTabla}}</td>
                <td>{{$auditoria->AuditRegistro}}</td>
                <td>{{$auditoria->AuditUser}}</td>
                <td>
                {{-- @if (is_Array($auditoria->Auditlog))
                @foreach ($auditoria->Auditlog as $key=>$val)
                          <b>{{ $key }}</b>:{{ $val }}<br>
                @endforeach
                @else    
                {{$auditoria->Auditlog}}
                @endif --}}
                {{json_decode($auditoria->Auditlog)}}
                
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
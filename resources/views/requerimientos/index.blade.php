@extends('layouts.app')

@section('htmlheader_title','Requerimientos')

@section('contentheader_title', 'Lista Requerimientos')

@section('main-content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-16 col-md-offset-0">
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Requerimientos de los residuos</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="RequerimientosTable" class="table table-compact table-bordered table-striped">
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Nombre del Residuo</th>
                  <th>Auditable</th>
                  <th>Tipo de Auditoria</th>
                  <th>Creado</th>
                  <th>Actualizado</th>
                  <th>Requerimiento</th>
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
                @foreach($Requerimientos as $Requerimiento)
                <tr>
                  <td>{{$Requerimiento->CliName}}</td>
                  <td>{{$Requerimiento->RespelName}}</td>

                  @if ($Requerimiento->ReqAuditoriaTipo == 'Virtual' || $Requerimiento->ReqAuditoriaTipo == 'Presencial')
                      <td>Si</td>
                  @else
                      <td>No</td>                      
                  @endif
                  <td>{{$Requerimiento->ReqAuditoriaTipo}}</td>
                  <td>{{$Requerimiento->created_at}}</td>
                  <td>{{$Requerimiento->updated_at}}</td>
                  <td>{{$Requerimiento->ReqSlug}}</td>
                </tr>
                @endforeach
              </tbody>
              {{-- <tfoot>
                  <tr>
                    <th>Requerimientos de</th>
                    <th>Auditable</th>
                    <th>Tipo de Auditoria</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                    <th>Requerimientos</th>
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

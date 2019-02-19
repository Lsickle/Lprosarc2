@extends('layouts.app')

@section('htmlheader_title','Capacitaciones')

@section('contentheader_title', 'Capacitaciones')

@section('main-content')
	<div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-16 col-md-offset-0">
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Lista de capacitaciones del personal</h3>
            <a href="cargos/create" class="btn btn-primary" style="float: right;">Crear</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="CargosTable" class="table table-compact table-bordered table-striped">
              <thead>
                <tr>
                  <th>Persona</th>
                  <th>Capacitacion</th>
                  <th>Sede</th>
                  <th>Aprovacion</th>
                  <th>Vencimiento</th>
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
                @foreach($CapaPers as $CapaPer)
                <tr>
                  <td>{{$CapaPer->PersFirstName." ".$CapaPer->PersLastName}}</td>
                  <td>{{$CapaPer->CapaName}}</td>
                  <td>{{$CapaPer->SedeName}}</td>
                  <td>{{$CapaPer->CapaPersDate}}</td>
                  <td>{{$CapaPer->CapaPersExpire}}</td>
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
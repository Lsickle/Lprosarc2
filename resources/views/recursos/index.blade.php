@extends('layouts.app')

@section('htmlheader_title','Recursos')

@section('contentheader_title', 'Lista de Recursos')

@section('main-content')
	 <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-16 col-md-offset-0">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Recursos de los residuos</h3>
            <a href="recurso/create" class="btn btn-primary" style="float: right;">Crear</a>
          </div>
          <div class="box-body">
            <table id="RecursosTable" class="table table-compact table-bordered table-striped">
              <thead>
                <tr>
                  <th>Solicitud de Servicio</th>
                  <th>Residuo</th>
                  <th>Ver Recursos</th>
                  <th>Editar</th>
                </tr>
              </thead>
              <tbody  hidden onload="renderTable()" id="readyTable">
                @include('layouts.partials.spinner')
                @foreach($Recursos as $Recurso)
                <tr>
                  <td>{{$Recurso->FK_SolResSolSer}}</td>
                  <td>{{$Recurso->RespelName}}</td>
                  <td>{{$Recurso->SolResSlug}}</td>
                  <td>{{$Recurso->SolResSlug}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
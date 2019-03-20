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
                  <th>Nombre</th>
                  <th>Categoria</th>
                  <th>Tipo</th>
                  {{-- <th>Ruta</th> --}}
                  <th>Formato</th>
                  <th>Residuo</th>
                  <th>Ver Recursos</th>
                  <th>Editar</th>
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
                @foreach($Recursos as $Recurso)
                <tr>
                  <td>{{$Recurso->ID_SolSer}}</td>
                  <td>{{$Recurso->RecName}}</td>
                  <td>{{$Recurso->RecCarte}}</td>
                  <td>{{$Recurso->RecTipo}}</td>
                  <td>{{$Recurso->RecFormat}}</td>
                  <td>{{$Recurso->FK_RecSol}}</td>
                  {{-- <td>{{$Recurso->ID_Rec}}</td> --}}
                  <td>{{$Recurso->RecSrc}}</td>
                  <td>{{$Recurso->ID_Rec}}</td>
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
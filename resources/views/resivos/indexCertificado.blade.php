@extends('layouts.app')
@section('htmlheader_title')
Certificados
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de Certificados</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="CertificadoTable" class="table table-compact table-bordered table-striped">
            <thead>
              <tr>
                <th>Numero de Certificado</th>
                <th>Nombre del Atributo</th>
                <th>Valor del Atributo</th>
                <th>Observaciones</th>
                <th>Direccion PDF</th>
                {{-- <th>Aprobado del jefe Op</th>
                <th>Aprobado del jefe Lg</th>
                <th>Aprobado del jefe Dr</th> --}}
                <th>Anexos</th>
                <th>Fecha de Creacion</th>
                {{-- <th>Fecha de Modificacion</th> --}}
                <th>Ver Más..</th>

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
              @foreach ($Certificados as $Certificado)
              <tr>
                <td>{{$Certificado->CertNumero}}</td>
                <td>{{$Certificado->CertiEspName}}</td>
                <td>{{$Certificado->CertiEspValue}}</td>
                <td>{{$Certificado->CertObservacion}}</td>
                <td>{{$Certificado->CertSrc}}</td>
                {{-- <tr>{{$Certificado->CertAuthJo}}</tr> --}}
                {{-- <tr>{{$Certificado->CertAuthJl}}</tr> --}}
                {{-- <tr>{{$Certificado->CertAuthDp}}</tr> --}}
                <td>{{$Certificado->CertAnexo}}</td>
                <td>{{$Certificado->created_at}}</td>
                {{-- <tr>{{$Certificado->updated_at}}</tr> --}}
                <td></td>
              </tr>
              @endforeach
              
            </tbody>
            {{-- <tfoot>
            <tr>
              <th>Numero de Certificado</th>
              <th>Nombre del Atributo</th>
              <th>Valor del Atributo</th>
              <th>Observaciones</th>
              <th>Aprobado del jefe Op</th>
              <th>Aprobado del jefe Lg</th>
              <th>Aprobado del jefe Dr</th>
              <th>Direccion PDF</th>
              <th>Fecha de Creacion</th>
              <th>Fecha de Modificacion</th> 
              <th>Más</th>
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
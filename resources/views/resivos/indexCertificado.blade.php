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
          <a href="/certificado/create" class="btn btn-primary" style="float: right;">Crear</a>
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
              @include('layouts.partials.spinner')
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
                <td><a method='get' href='#" + data + "' class='btn btn-success'/>Ver</a></td>
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
@extends('layouts.app')
@section('htmlheader_title')
Manifiesto
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de Manifiesto</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="ManifiestoTable" class="table table-compact table-bordered table-striped">
            <thead>
              <tr>
                <th>Numero de Manifiesto</th>
                <th>Nombre del Atributo</th>
                <th>Valor del Atributo</th>
                {{-- <th>Observaciones</th> --}}
                <th>Direccion PDF</th>
                <th>Direccion del Manifiesto</th>
                {{-- <th>Aprobado del jefe Op</th>
                <th>Aprobado del jefe Lg</th>
                <th>Aprobado del jefe Dr</th> --}}
                <th>Fecha de creacion</th>
                {{-- <th>Fecha de Modificacion</th> --}}
                <th>Ver Más...</th>
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
              @foreach($Manifiestos as $Manifiesto)
              <tr>
                <td>{{$Manifiesto->ManifNumero}}</td>
                <td>{{$Manifiesto->ManifiEspName}}</td>
                <td>{{$Manifiesto->ManifiEspValue}}</td>
                {{-- <td>{{$Manifiesto->ManifObservacion}}</td> --}}
                <td>{{$Manifiesto->ManifSrc}}</td>
                {{-- @if($Manifiesto->ManiAuthJo == 1)
                <td>Si</td>
                @else
                <td>NO</td>
                @endif
                @if($Manifiesto->ManiAuthJl == 1)
                <td>Si</td>
                @else
                <td>NO</td>
                @endif
                @if($Manifiesto->ManiAuthDp == 1)
                <td>Si</td>
                @else
                <td>NO</td>
                @endif --}}
                <td>{{$Manifiesto->CertAnexo}}</td>
                <td>{{$Manifiesto->created_at}}</td>
                <td></td>
              </tr>
              @endforeach
            </tbody>
            {{--<tfoot>
                <tr>
                <th>Numero de Manifiesto</th>
                <th>Nombre del Atributo</th>
                <th>Valor del Atributo</th>
                <th>Observaciones</th> 
                <th>Direccion PDF</th>
                <th>Direccion del Manifiesto</th>
                <th>Aprobado del jefe Op</th>
                <th>Aprobado del jefe Lg</th>
                <th>Aprobado del jefe Dr</th>
                <th>Fecha de creacion</th>
                <th>Fecha de Modificacion</th> 
                <th>Ver Más...</th>
              </tr>
            </tfoot>--}}
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</div>
@endsection
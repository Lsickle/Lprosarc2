@extends('layouts.app')
@section('htmlheader_title')
Activos
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Datos de los activos</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="ActivoTable" class="table table-compact table-bordered table-striped">
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>SubCategoria</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Forma</th>
                    <th>Modelo</th>
                    <th>Serial Prosarc</th>
                    <th>Serial Proveedor</th>
                    <th>Más</th>
                </tr>
              {{-- <tbody  hidden onload="renderTable()" id="readyTable"> --}}
              @foreach ($SubActivos as $SubActivo)
                  <th>{{$SubActivo->CatName}}</th>
                  <th>{{$SubActivo->SubCatName}}</th>
                  <th>{{$SubActivo->ActName}}</th>
                  <th>{{$SubActivo->ActCant}}</th>
                  
                  @if($SubActivo->ActUnid == 1)
                    <th>Unidades</th>
                  @else
                    <th>Peso</th>
                  @endif

                  <th>{{$SubActivo->ActModel}}</th>
                  <th>{{$SubActivo->ActSerialProsarc}}</th>
                  <th>{{$SubActivo->ActSerialProveed}}</th>
                  {{-- <th>{{$SubActivo->ActUnid}}</th> --}}
                  {{-- <th>{{$SubActivo->ActTalla}}</th> --}}
                  {{-- <th>{{$SubActivo->ActObserv}}</th> --}}
                </tr>
              @endforeach  
            {{-- </thead> --}}
          </tbody>
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
            {{-- <tfoot>
                <tr>
                    <th>Categoria</th>
                    <th>SubCategoria</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Unidades</th>
                    <th>Modelo</th>
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
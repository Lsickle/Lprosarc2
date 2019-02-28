@extends('layouts.app')
@section('htmlheader_title')
Activos
@endsection
@section('contentheader_title')
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
          <table id="ArticuloXProveedor" class="table table-compact table-bordered table-striped">
            <thead>
                <tr>
                    <th>Forma </th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Costo por Unid.</th>
                    <th>Cant. min. compra</th>
                    <th>Fecha creado</th>
                    <th>Fecha Actualizado</th>
                    <th>Editar</th>
                </tr>
              
            {{-- </thead> --}}
          {{-- </tbody> --}}
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
              
              @foreach ($Proveedores as $Proveedor)
              <tr>
                @if ($Proveedor->ArtiUnidad <> 1)
                    <td>Unidades</td>
                @else
                    <td>Peso</td>
                @endif
                <td>{{$Proveedor->ArtiCant}}</td>
                <td>{{$Proveedor->ArtiPrecio}}</td>
                <td>{{$Proveedor->ArtiCostoUnid}}</td>
                <td>{{$Proveedor->ArtiMinimo}}</td>
                <td>{{$Proveedor->created_at}}</td>
                <td>{{$Proveedor->updated_at}}</td>
                <td></td>
              </tr>
              @endforeach
            {{-- <tfoot>
               <tr>
                    <th>Forma </th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Costo por Unid.</th>
                    <th>Cant. min. compra</th>
                    <th>Fecha creado</th>
                    <th>Fecha Actualizado</th>
                    <th>Editar</th>
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
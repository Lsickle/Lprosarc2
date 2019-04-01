@extends('layouts.app')
@section('htmlheader_title')
Articulos
@endsection
@section('contentheader_title')
Articulos por Proveedor
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Datos</h3>
          <a href="articulos-proveedor/create" class="btn btn-primary" style="float: right;">Crear</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="ArticuloXProveedor" class="table table-compact table-bordered table-striped">
            <thead>
                <tr>
                    {{-- <th>Cliente</th> --}}
                    {{-- <th>Forma </th> --}}
                    <th>Activo</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Costo por Unid.</th>
                    <th>Cantidad  minima <br> de compra</th>
                    <th>Editar</th>
                </tr>
            </thead>
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
              
              @foreach ($ArtProvs as $ArtProv)
              <tr>
                <td>{{$ArtProv->ActName}}</td>
                <td>
                  {{$ArtProv->ArtiCant}}
                  @if ($ArtProv->ArtiUnidad <> 1)
                      Unidades
                  @else
                      En Peso
                  @endif
                </td>
                <td>{{$ArtProv->ArtiPrecio}}</td>
                <td>{{$ArtProv->ArtiCostoUnid}}</td>
                <td>{{$ArtProv->ArtiMinimo}}</td>
                <td>{{$ArtProv->ID_ArtiProve}}</td>
              </tr>
              @endforeach
            {{-- <tfoot>
               <tr>
                    <th>Activo</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Costo por Unid.</th>
                    <th>Cantidad  minima <br> de compra</th>
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
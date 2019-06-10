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
          <a href="activos/create" class="btn btn-primary" style="float: right;">Crear</a>

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="ActivoTable" class="table table-compact table-bordered table-striped">
            <thead>
                <tr>
                    <th>Categoría</th>
                    <th>Subcategoría</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Forma</th>
                    <th>Modelo</th>
                    <th>Serial Prosarc</th>
                    <th>Serial Proveedor</th>
                    <th>Más</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody  hidden onload="renderTable()" id="readyTable">
              @foreach ($Activos as $Activo)
                  <tr>
                    <td>{{$Activo->CatName}}</td>
                    <td>{{$Activo->SubCatName}}</td>
                    <td>{{$Activo->ActName}}</td>
                    <td>{{$Activo->ActCant}}</td>
                    <td>{{$Activo->ActUnid}}</td>
                    <td>{{$Activo->ActModel}}</td>
                    <td>{{$Activo->ActSerialProsarc}}</td>
                    <td>{{$Activo->ActSerialProveed}}</td>
                    <td></td>
                    <td>{{$Activo->ID_Act}}</td>
                  </tr>
                
              @endforeach
            {{-- <tfoot>
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
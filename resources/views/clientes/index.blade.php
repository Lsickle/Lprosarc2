@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientmenu') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de Contactos</h3>
          <a href="/clientes/create" class="btn btn-primary" style="float: right;">Crear</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="clientesTable" class="table table-compact table-bordered table-striped">
            <thead>
              <tr>
                <th>Categoría</th>
                <th>Nombre</th>
                <th>NIT</th>
                <th>Creado el</th>
                <th>Ver Más</th>
                <th>Editar</th>
              </tr>
            </thead>
            <tbody onload="renderTable()" id="readyTable">
              @include('layouts.partials.spinner')
              @foreach($clientes as $cliente)
              <tr @if($cliente->CliDelete === 1)
                style="color: red;" 
              @endif
              >
                <td>{{$cliente->CliCategoria}}</td>
                <td>{{$cliente->CliName}}</td>
                <td>{{$cliente->CliNit}}</td>
                <td>{{$cliente->created_at}}</td>
                <td>{{$cliente->CliSlug}}</td>
                <td>{{$cliente->CliSlug}}</td>
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
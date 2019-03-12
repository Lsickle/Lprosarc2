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
          <table id="example1" class="table table-compact table-bordered table-striped">
            <thead>
              <tr>
                <th>Categoria</th>
                <th>Nombre</th>
                <th>NIT</th>
                <th>Creado el</th>
                <th>Auditable</th>
                <th>Ver Más</th>
                <th>Editar</th>
                <th>Borrar</th>
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
              @foreach($clientes as $cliente)
              @component('layouts.partials.modal')
                    {{$cliente->ID_Cli}}
              @endcomponent
              <tr>
                <td>{{$cliente->CliCategoria}}</td>
                <td>{{$cliente->CliShortname}}</td>
                <td>{{$cliente->CliNit}}</td>
                <td>{{$cliente->created_at}}</td>
                @if($cliente->CliAuditable==1)
                  <td>Si</td>
                @else
                  <td>NO</td>
                @endif
                <td>{{$cliente->CliSlug}}</td>
                <td>{{$cliente->CliSlug}}</td>
                <td>@if($cliente->CliDelete == 0)
                      <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$cliente->ID_Cli}}' class='btn btn-danger btn-block'>Borrar</a>
                      <form action='/clientes/{{$cliente->CliSlug}}' method='POST'>
                          @method('DELETE')
                          @csrf
                          <input  type="submit" id="Eliminar{{$cliente->ID_Cli}}" style="display: none;">
                      </form>
                    @else
                      <form action='/clientes/{{$cliente->CliSlug}}' method='POST'>
                          @method('DELETE')
                          @csrf
                          <input type="submit" class='btn btn-success btn-block' value="Añadir">
                      </form>
                    @endif
                </td>
              </tr>
              @endforeach
            </tbody>
            {{-- <tfoot>
            <tr>
              <th>Categoria</th>
              <th>Nombre</th>
              <th>NIT</th>
              <th>Creado el</th>
              <th>Auditable</th>
              <th>Mas...</th>
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
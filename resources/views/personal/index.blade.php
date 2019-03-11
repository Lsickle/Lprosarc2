@extends('layouts.app')

@section('htmlheader_title','Personal')

@section('contentheader_title', 'Personal')

@section('main-content')
	<div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-16 col-md-offset-0">
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Lista de personal</h3>
            <a href="personal/create" class="btn btn-primary" style="float: right;">Crear</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="PersonalsTable" class="table table-compact table-bordered table-striped">
              <thead>
                <tr>
                  <th>Doctype</th>
                  <th>Documento</th>
                  <th>Nombre</th>
                  <th>Telefono</th>
                  <th>Cargo</th>
                  <th>Ver más</th>
                  <th>Editar</th>
                  <th>Eliminar</th>
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
                @foreach($Personals as $Personal)
                @include('layouts.partials.modal')
                <tr>
                  <td>{{$Personal->PersDocType}}</td>
                  <td>{{$Personal->PersDocNumber}}</td>
                  <td>{{$Personal->PersFirstName." ".$Personal->PersSecondName." ".$Personal->PersLastName}}</td>
                  <td>{{$Personal->PersCellphone}}</td>
                  <td>{{$Personal->CargName." de ".$Personal->AreaName}}</td>
                  <td>{{$Personal->PersSlug}}</td>
                  <td>{{$Personal->PersSlug}}</td>
                  <td>@if($Personal->PersDelete == 0)
                        <a method='get' href='#' data-toggle='modal' data-target='#myModal' class='btn btn-danger btn-block'>Borrar</a>
                        <form action='/personal/{{$Personal->PersSlug}}' method='POST'>
                            @method('DELETE')
                            @csrf
                            <input  type="submit" id="Eliminar" style="display: none;">
                        </form>
                      @else
                        <form action='/personal/{{$Personal->PersSlug}}' method='POST'>
                          @method('DELETE')
                          @csrf
                          <input type="submit" class='btn btn-success' value="Añadir">
                        </form>
                      @endif
                  </td>
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
@extends('layouts.app')

@section('htmlheader_title','Capacitaciones')

@section('contentheader_title', 'Capacitaciones')

@section('main-content')
	<div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-16 col-md-offset-0">
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Lista de capacitaciones</h3>
            <a href="/capacitacion/create" class="btn btn-primary" style="float: right;">Crear</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="TrainingsTable" class="table table-compact table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Tipo</th>
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
                @foreach($Trainings as $Training)
                @component('layouts.partials.modal')
                    {{$Training->ID_Capa}}
                @endcomponent
                <tr>
                  <td>{{$Training->CapaName}}</td>
                  @if($Training->CapaTipo == 1)
                    <td>Interno</td>
                  @else
                    <td>Externo</td>
                  @endif
                  <td>{{$Training->ID_Capa}}</td>
                  <td>@if($Training->CapaDelete == 0)
                        <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Training->ID_Capa}}' class='btn btn-danger btn-block'>Borrar</a>
                        <form action='/capacitacion/{{$Training->ID_Capa}}' method='POST'>
                            @method('DELETE')
                            @csrf
                            <input  type="submit" id="Eliminar{{$Training->ID_Capa}}" style="display: none;">
                        </form>
                      @else
                        <form action='/capacitacion/{{$Training->ID_Capa}}' method='POST'>
                          @method('DELETE')
                          @csrf
                          <input type="submit" class='btn btn-success btn-block' value="Añadir">
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
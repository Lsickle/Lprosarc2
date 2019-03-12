@extends('layouts.app')

@section('htmlheader_title','Cargos')

@section('contentheader_title', 'Cargos Finales')

@section('main-content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-16 col-md-offset-0">
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Lista de Cargos</h3>
            <a href="cargos/create" class="btn btn-primary" style="float: right;">Crear</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="CargosTable" class="table table-compact table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Grado</th>
                  <th>Carg</th>
                  <th>Salario</th>
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
                @foreach($Cargos as $Cargo)
                @component('layouts.partials.modal')
                    {{$Cargo->ID_Carg}}
                @endcomponent
                <tr>
                  <td>{{$Cargo->CargName}}</td>
                  <td>{{$Cargo->CargGrade}}</td>
                  <td>{{$Cargo->CargName}}</td>
                  <td>{{$Cargo->CargSalary}}</td>
                  <td>{{$Cargo->ID_Carg}}</td>
                  <td>@if($Cargo->CargDelete == 0)
                        <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Cargo->ID_Carg}}' class='btn btn-danger btn-block'>Borrar</a>
                        <form action='/cargos/{{$Cargo->ID_Carg}}' method='POST'>
                            @method('DELETE')
                            @csrf
                            <input  type="submit" id="Eliminar{{$Cargo->ID_Carg}}" style="display: none;">
                        </form>
                      @else
                        <form action='/cargos/{{$Cargo->ID_Carg}}' method='POST'>
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

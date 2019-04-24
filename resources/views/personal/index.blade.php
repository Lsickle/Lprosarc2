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
                  <th>Documento</th>
                  <th>Nombre</th>
                  <th>Correo Electronico</th>
                  <th>Celular</th>
                  <th>Cargo</th>
                  <th>Area</th>
                  <th>Ver más</th>
                </tr>
              </thead>
              <tbody  hidden onload="renderTable()" id="readyTable">
                {{-- <h1 id="loadingTable">LOADING...</h1> --}}
                @include('layouts.partials.spinner')
                @foreach($Personals as $Personal)
                <tr @if($Personal->PersDelete === 1)
                      style="color: red;" 
                    @endif
                >
                  <td>{{$Personal->PersDocType." ".$Personal->PersDocNumber}}</td>
                  <td>{{$Personal->PersFirstName." ".$Personal->PersSecondName." ".$Personal->PersLastName}}</td>
                  <td>{{$Personal->PersEmail}}</td>
                  <td>{{$Personal->PersCellphone}}</td>
                  <td>{{$Personal->CargName}}</td>
                  <td>{{$Personal->AreaName}}</td>
                  <td>{{$Personal->PersSlug}}</td>
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
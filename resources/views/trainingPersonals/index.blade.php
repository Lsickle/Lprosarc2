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
            <h3 class="box-title">Lista de capacitaciones del personal</h3>
            <a href="/capacitacion-personal/create" class="btn btn-primary" style="float: right;">Crear</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="TrainingPersonalsTable" class="table table-compact table-bordered table-striped">
              <thead>
                <tr>
                  <th>Persona</th>
                  <th>Capacitacion</th>
                  <th>Sede</th>
                  <th>Aprovacion</th>
                  <th>Vencimiento</th>
                  <th>Editar</th>
                </tr>
              </thead>
              <tbody  hidden onload="renderTable()" id="readyTable">
                {{-- <h1 id="loadingTable">LOADING...</h1> --}}
                   @include('layouts.partials.spinner')
                @foreach($CapaPers as $CapaPer)
                <tr @if($CapaPer->CapaPersDelete === 1)
                      style="color: red;" 
                    @endif
                >
                  <td>{{$CapaPer->PersFirstName." ".$CapaPer->PersLastName}}</td>
                  <td>{{$CapaPer->CapaName}}</td>
                  <td>{{$CapaPer->SedeName}}</td>
                  <td>{{$CapaPer->CapaPersDate}}</td>
                  <td>{{$CapaPer->CapaPersExpire}}</td>
                  <td>{{$CapaPer->ID_CapPers}}</td>
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
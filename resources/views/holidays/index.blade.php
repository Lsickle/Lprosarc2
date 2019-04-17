@extends('layouts.app')

@section('htmlheader_title','Holiday')

@section('contentheader_title', 'Lista de festivos')

@section('main-content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-16 col-md-offset-0">
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Días Festivos</h3>
            <a href="areas/create" class="btn btn-primary" style="float: right;">Crear</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="AreaTable" class="table table-compact table-bordered table-striped">
              <thead>
                <tr>
                  <th>Fecha</th>
                </tr>
              </thead>
              <tbody  hidden onload="renderTable()" id="readyTable">
                {{-- <h1 id="loadingTable">LOADING...</h1> --}}
                @include('layouts.partials.spinner')
                @foreach($Holidays as $Holiday)
                <tr>
                  <td>{{$Holiday->SedeName}}</td>
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

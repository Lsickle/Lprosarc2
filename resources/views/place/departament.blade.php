@extends('layouts.app')
@section('htmlheader_title')
Departamentos
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de Departamentos</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="departamentTable" class="table table-compact table-bordered table-striped">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Region</th>
                <th>Capital</th>
              </tr>
            </thead>
            <tbody  hidden onload="renderTable()" id="readyTable">
              {{-- <h1 id="loadingTable">LOADING...</h1> --}}
              @include('layouts.partials.spinner')
              @foreach($departament as $departament)
              <tr>
                <td>{{$departament->DepartName}}</td>
                <td>{{$departament->DepartRegionName}}</td>
                <td>{{$departament->DepartCapitalName}}</td>
              </tr>
              @endforeach
            </tbody>
            {{-- <tfoot>
            <tr>
              <th>Nombre</th>
              <th>Region</th>
              <th>Capital</th>
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
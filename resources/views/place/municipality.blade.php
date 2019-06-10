@extends('layouts.app')
@section('htmlheader_title')
Municipios
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lista de municipios</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="municipalityTable" class="table table-compact table-bordered table-striped">
            <thead>
              <tr>
                <th>Nombre</th>
              </tr>
            </thead>
            <tbody  hidden onload="renderTable()" id="readyTable">
              @foreach($municipios as $municipio)
              <tr>
                <td>{{$municipio->MunName}}</td>
              </tr>
              @endforeach
            </tbody>
            {{-- <tfoot>
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
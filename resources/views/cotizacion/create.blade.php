@extends('layouts.app')
@section('htmlheader_title')
    Nueva Cotización
@endsection
@section('contentheader_title')
    Nueva Cotización
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-16 col-md-offset-0">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" action="/cotizacion" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="box-body">

                                    <div class="col-md-6">
                                        <label for="selectsede">Sede del Cliente</label>
                                        <select class="form-control" id="selectsede" name="FK_CotiSede" required="true">
                                            @foreach($sedes as $sede)
                                                <option value="{{$sede->ID_Sede}}">{{$sede->SedeName}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="CotizacionStatus">Status de cotización</label>
                                        <select class="form-control" id="CotizacionStatus" name="CotiStatus" disabled >
                                            <option>Pendiente</option>
                                            <option>Aprobada</option>
                                            <option>Aprobada Parcial</option>
                                            <option>Rechazada</option>
                                        </select>
                                    </div>

                                    {{-- residuos adjuntables a la cotizacion --}}
                                    {{-- <div>
                                        <table id="RespelTable" class="table table-bordered table-striped">
                                          <thead>
                                            <tr>
                                              <th>Nombre</th>
                                              <th>Clasificacion 4741 Y</th>
                                              <th>Clasificacion 4741 A</th>
                                              <th>Peligrosidad</th>
                                              <th>Estado del residuo</th>
                                              <th>Hoja de Seguridad</th>
                                              <th>Tarj de Emergencia</th>
                                              <th>Estado</th>
                                              <th>Generado por</th>
                                              <th>Seleccionar</th>
                                              <th>Editar</th>
                                            </tr>
                                          </thead>
                                          <tbody hidden onload="renderTable()" id="readyTable">
                                            @include('layouts.partials.spinner')
                                            @foreach($residuos as $residuo)
                                                <tr>
                                                  <td>{{$residuo->RespelName}}</td>
                                                  <td>{{$residuo->YRespelClasf4741}}</td>
                                                  <td>{{$residuo->ARespelClasf4741}}</td>
                                                  <td>{{$residuo->RespelIgrosidad}}</td>
                                                  <td>{{$residuo->RespelEstado}}</td>
                                                  <td>{{$residuo->RespelHojaSeguridad}}</td>
                                                  <td>{{$residuo->RespelTarj}}</td>
                                                  <td>{{$residuo->RespelStatus}}</td>
                                                  <td>{{$residuo->CliName}}</td>
                                                  <td>{{$residuo->RespelSlug}}</td>
                                                  <td>{{$residuo->RespelSlug}}</td>
                                                </tr>
                                            @endforeach
                                          </tbody>
                                        </table>
                                    </div> --}}
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success">Registrar</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
@endsection

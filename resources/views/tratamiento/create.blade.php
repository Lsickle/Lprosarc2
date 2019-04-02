@extends('layouts.app')
@section('htmlheader_title')
    Nueva Tratamiento
@endsection
@section('contentheader_title')
    Nueva Tratamiento
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-16 col-md-offset-0">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Tratamiento</h3>
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
                            <form role="form" action="/tratamiento" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="box-body">


                                    <div class="col-md-6">
                                        <label for="select1">Tipo</label>
                                        <select class="form-control" id="select1" name="TratTipo">
                                            <option value="0">Interno</option>
                                            <option value="1">Externo</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="select2">Sede del Cliente</label>
                                        <select class="form-control" id="select2" name="FK_TratProv" required="true">
                                            @foreach($sedes as $sede)
                                                <option value="{{$sede->ID_Sede}}">{{$sede->SedeName}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="input1">Nombre</label>
                                        <input id="input1" class="form-control" type="text" name="TratName">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="input2">Pretratamiento</label>
                                        <input id="input2" class="form-control" type="text" name="TratPretratamiento">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="select3">Residuo que aplica</label>
                                        <select class="form-control" id="select3" name="FK_TratRespel">
                                             @foreach($residuos as $residuo)
                                                <option value="{{$residuo->ID_Respel}}">{{$residuo->SedeName}} - {{$residuo->RespelName}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <button class="btn-primary" id="addcheck">agregar check box</button>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="select3">Auditable</label>
                                        <select class="form-control" id="select3" name="aditoria">
                                             @foreach($residuos as $residuo)
                                                <option value="{{$residuo->ID_Respel}}">{{$residuo->SedeName}} - {{$residuo->RespelName}}</option>
                                            @endforeach
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
                                    <button type="submit" class="btn btn-primary">Registrar</button>
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

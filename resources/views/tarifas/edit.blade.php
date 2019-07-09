@extends('layouts.app')
@section('htmlheader_title')
Actualizar Tarifa
@endsection
@section('contentheader_title')
Actualizción de Tarifa
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-16 col-md-offset-0">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Actualizar Tarifa {{$tarifa->ID_Tarifa}}</h3>
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
                            <form role="form" action="/tarifas/{{$tarifa->ID_Tarifa}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="box-body">
                                    <div class="col-md-3">
                                        <label for="unidad1">Unidad 1</label>
                                        <select class="form-control" id="unidad1" name="TarifaTipounidad1">
                                            <option {{ $tarifa->TarifaTipounidad1 == 'Kg' ? 'selected' : '' }}>Kg</option>
                                            <option {{ $tarifa->TarifaTipounidad1 == 'Litros' ? 'selected' : '' }}>Litros</option>
                                            <option {{ $tarifa->TarifaTipounidad1 == 'Cm³' ? 'selected' : '' }}>Cm³</option>
                                            <option {{ $tarifa->TarifaTipounidad1 == 'Unidad' ? 'selected' : '' }}>Unidad</option>
                                            <option {{ $tarifa->TarifaTipounidad1 == 'Galon' ? 'selected' : '' }}>Galon</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inicio1">rango 1 inicial</label>
                                        <input value="{{$tarifa->TarifaPesoinicial1}}" class="form-control" id="inicio1" type="number" min="1" pattern="^[0-9]+" name="TarifaPesoinicial1">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="final1">rango 1 final</label>
                                        <input value="{{$tarifa->TarifaPesofinal1}}" class="form-control" id="final1" type="number" min="1" pattern="^[0-9]+" name="TarifaPesofinal1">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="precio1">rango 1 Precio</label>
                                        <input value="{{$tarifa->TarifaPrecio1}}" class="form-control" id="precio1" type="number" min="1" pattern="^[0-9]+" name="TarifaPrecio1">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="unidad2">Unidad 2</label>
                                        <select class="form-control" id="unidad2" name="TarifaTipounidad2">
                                            <option {{ $tarifa->TarifaTipounidad2 == 'Kg' ? 'selected' : '' }}>Kg</option>
                                            <option {{ $tarifa->TarifaTipounidad2 == 'Litros' ? 'selected' : '' }}>Litros</option>
                                            <option {{ $tarifa->TarifaTipounidad2 == 'Cm³' ? 'selected' : '' }}>Cm³</option>
                                            <option {{ $tarifa->TarifaTipounidad2 == 'Unidad' ? 'selected' : '' }}>Unidad</option>
                                            <option {{ $tarifa->TarifaTipounidad2 == 'Galon' ? 'selected' : '' }}>Galon</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inicio2">rango 2 inicial</label>
                                        <input value="{{$tarifa->TarifaPesoinicial2}}" class="form-control" id="inicio2" type="number" min="2" pattern="^[0-9]+" name="TarifaPesoinicial2">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="final2">rango 2 final</label>
                                        <input value="{{$tarifa->TarifaPesofinal2}}" class="form-control" id="final2" type="number" min="2" pattern="^[0-9]+" name="TarifaPesofinal2">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="precio2">rango 2 Precio</label>
                                        <input value="{{$tarifa->TarifaPrecio2}}" class="form-control" id="precio2" type="number" min="2" pattern="^[0-9]+" name="TarifaPrecio2">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="unidad3">Unidad 3</label>
                                        <select class="form-control" id="unidad3" name="TarifaTipounidad3">
                                            <option {{ $tarifa->TarifaTipounidad3 == 'Kg' ? 'selected' : '' }}>Kg</option>
                                            <option {{ $tarifa->TarifaTipounidad3 == 'Litros' ? 'selected' : '' }}>Litros</option>
                                            <option {{ $tarifa->TarifaTipounidad3 == 'Cm³' ? 'selected' : '' }}>Cm³</option>
                                            <option {{ $tarifa->TarifaTipounidad3 == 'Unidad' ? 'selected' : '' }}>Unidad</option>
                                            <option {{ $tarifa->TarifaTipounidad3 == 'Galon' ? 'selected' : '' }}>Galon</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="inicio3">rango 3 inicial</label>
                                        <input value="{{$tarifa->TarifaPesoinicial3}}" class="form-control" id="inicio3" type="number" min="3" pattern="^[0-9]+" name="TarifaPesoinicial3">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="final3">rango 3 final</label>
                                        <input value="{{$tarifa->TarifaPesofinal3}}" class="form-control" id="final3" type="number" min="3" pattern="^[0-9]+" name="TarifaPesofinal3">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="precio3">rango 3 Precio</label>
                                        <input value="{{$tarifa->TarifaPrecio3}}" class="form-control" id="precio3" type="number" min="3" pattern="^[0-9]+" name="TarifaPrecio3">
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
                                    <button type="submit" class="btn btn-success">Actualizar</button>
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

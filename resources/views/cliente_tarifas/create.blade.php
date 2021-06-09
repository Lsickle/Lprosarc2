@extends('layouts.app')
@section('htmlheader_title')
crear Tarifa del cliente
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #FF856D, #CC0000); padding-right:30vw; position:relative; overflow:hidden;">
    Nuevo rango
    <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-16 col-md-offset-0">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $cliente->CliShortname }}</h3>
                    <div class="box-tools pull-right">
                        {{-- <button onclick="AgregarPreTrat()" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i> {{ trans('adminlte_lang::LangTratamiento.pretratadd') }}</button> --}}
                    </div>
                </div>
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <!-- /.box-header -->
                            <!-- form start -->

                            <form role="form" action="{{route('clientetarifas.store', ['cliente' => $cliente->CliSlug])}}" method="POST" id="createtratamientoForm">
                                @csrf
                                <div class="box-body" id="boxbodypretrat">
                                    <div class="col-md-3">
                                        <label for="select2trat">Tratamiento</label>
                                        <select class="form-control select" id="select2trat" name="FK_Tratamiento">
                                            @foreach ($tratamientos as $tratamiento)
                                            <option value="Id_Trat">{{$tratamiento->TratName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="input1">Rango</label>
                                        <input id="input1" class="form-control" type="number" name="CTarifaDesde" value="desde 1 Kg" step="1" min="1">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="select2tipo">Unidad</label>
                                        <select class="form-control select" id="select2tipo" name="Tarifatipo">
                                            <option value="Kg">Kg</option>
                                            <option value="Unid">Unidades</option>
                                            <option value="Lt">Litros</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="input2">Precio</label>
                                        <input id="input2" class="form-control" type="number" name="CTarifaPrecio">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="select2frecuencia">Frecuencia</label>
                                        <select class="form-control select" id="select2frecuencia" name="TarifaFrecuencia">
                                            <option value="Mensual">Mensual</option>
                                            <option value="Servicio">Servicio</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="input3">Vencimiento</label>
                                        <input min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" id="input3" class="form-control" type="date" name="TarifaVencimiento">
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success" style="margin-left: 1.5rem;"><i class="fas fa-check"></i> {{ trans('adminlte_lang::LangTratamiento.tratcreate') }}</button>
                                    <a class="btn btn-default btn-close pull-right" style="margin-right: 1.7rem;" href="{{ route('clientes.index')}}"><b><i class="fas fa-backspace" color="red"></i> Lista de clientes</b></a>
                                </div>
                            </form>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box">
                            <table id="TarifasClienteTable" class="table table-compact table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Tratamiento</th>
                                        <th>Rango</th>
                                        <th>Frecuencia</th>
                                        <th>Precio</th>
                                        <th>Cliente</th>
                                        <th>Vence</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cliente->clientetarifa as $tarifa)
                                    @foreach ($tarifa->rangos as $rango)
                                    <tr>
                                        <td>{{$tarifa->tratamiento->TratName}}</td>
                                        <td>desde {{$rango->CTarifaDesde}} {{$tarifa->Tarifatipo}}</td>
                                        <td>{{$tarifa->TarifaFrecuencia}}</td>
                                        <td>{{$rango->CTarifaPrecio}}</td>
                                        <td>{{$tarifa->cliente->CliShortname}}</td>
                                        <td>{{$tarifa->TarifaVencimiento}}</td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
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
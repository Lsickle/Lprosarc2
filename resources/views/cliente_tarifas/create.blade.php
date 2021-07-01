@extends('layouts.app')
@section('htmlheader_title')
Tarifas del cliente
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #FF856D, #CC0000); padding-right:30vw; position:relative; overflow:hidden;">
    Tarifas del Cliente
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
                    <h3 class="box-title"><b>{{ $cliente->CliShortname }}</b></h3>
                    <div class="box-tools pull-right">
                        {{-- <button onclick="AgregarPreTrat()" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i> {{ trans('adminlte_lang::LangTratamiento.pretratadd') }}</button> --}}
                        <a class="btn btn-default btn-close pull-right" style="margin-right: 1.7rem;" href="{{ route('clientes.index')}}"><b><i class="fas fa-backspace" color="red"></i> Volver a Lista de clientes</b></a>
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
                                @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class="box-body" id="boxbodypretrat">
                                    <div class="col-md-3">
                                        <label for="select2trat">Tratamiento</label>
                                        <select class="form-control select" id="select2trat" name="FK_Tratamiento" required>
                                            @foreach ($tratamientos as $tratamiento)
                                            <option value="{{$tratamiento->ID_Trat}}">{{$tratamiento->TratName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="input1">Rango</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">Desde </span>
                                            <input type="number" class="form-control" aria-label="Cantidad mas cercana la unidad" name="CTarifaDesde" required min="0" step="1">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="select2tipo">Unidad</label>
                                        <select class="form-control select" id="select2tipo" name="Tarifatipo" required>
                                            <option selected value="Kg">Kg</option>
                                            <option value="Unid">Unidades</option>
                                            <option value="Lt">Litros</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="input2">Precio</label>
                                        <input id="input2" class="form-control" type="number" min="0" step="1" name="CTarifaPrecio" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="select2frecuencia">Frecuencia</label>
                                        <select class="form-control select" id="select2frecuencia" name="CTarifaFrecuencia" required>
                                            <option value="Servicio">Servicio</option>
                                            <option value="Mensual">Mensual</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="input3">Vencimiento</label>
                                        <input min="{{date('Y-m-d')}}" id="input3" class="form-control" type="date" name="TarifaVencimiento" required>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success pull-right" style="margin-right: 1.7rem;"><i class="fas fa-check"></i> Agregar Tarifa</button>
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
                                        <th>ID</th>
                                        <th>Tratamiento</th>
                                        <th>Rango</th>
                                        <th>Frecuencia</th>
                                        <th>Precio</th>
                                        {{-- <th>Cliente</th> --}}
                                        <th>Vence</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cliente->clientetarifa as $tarifa)
                                    @foreach ($tarifa->rangos as $rango)
                                    <tr>
                                        <td>{{$tarifa->ID_CTarifa}}</td>
                                        <td>{{$tarifa->tratamiento->TratName}}</td>
                                        <td>desde {{$rango->CTarifaDesde}} <b style="color: {{($tarifa->Tarifatipo == 'Kg' ? 'Black' : 'Green')}}">{{$tarifa->Tarifatipo}}</b></td>
                                        <td>{{$tarifa->TarifaFrecuencia}}</td>
                                        <td>{{$rango->CTarifaPrecio}}</td>
                                        {{-- <td>{{$tarifa->cliente->CliShortname}}</td> --}}
                                        <td>{{$tarifa->TarifaVencimiento}}</td>
                                        <td>
                                            <form method="POST" id="Eliminar{{$rango->ID_CRango}}" action="{{route('clientetarifas.destroy', ['slug' => $cliente->CliSlug, 'clientetarifa' => $rango->ID_CRango])}}">
                                                @csrf
                                                @method('DELETE')
                                                <input form="Eliminar{{$rango->ID_CRango}}" type="submit" class="btn btn-danger" value="Borrar">
                                            </form>
                                        </td>
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

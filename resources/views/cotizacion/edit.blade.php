@extends('layouts.app')
@section('htmlheader_title')
Edición de cotización
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="/cotizacion/{{$cotizacion->ID_Coti}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">

                        {{-- numero de cotizacion --}}
                        <div class="col-md-6">
                            <label for="numerocotizacion">Numero de Cotización</label>
                            <input class="form-control" type="text" name="CotiNumero" id="numerocotizacion" value="{{$cotizacion->CotiNumero}}" disabled>
                        </div>
                        {{-- numero de cotizacion para enviar --}}
                        <div class="col-md-6" hidden>
                            <label for="numerocotizacion">Número de Cotización</label>
                            <input class="form-control" type="text" name="CotiNumero" id="numerocotizacion" value="{{$cotizacion->CotiNumero}}">
                        </div>

                        {{-- sede del cliente --}}
                        <div class="col-md-6">
                            <label for="selectsede">Sede del cliente</label>
                            <select class="form-control" id="selectsede" name="FK_CotiSede" required="true">
                                @foreach($sedes as $sede)
                                <option value="{{$sede->ID_Sede}}">{{$sede->SedeName}}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- fecha de solicitud o creacion de la cotizacion --}}
                        <div class="col-md-6">
                            <label for="solicitudDate">Fecha de solicitud</label>
                            <input class="form-control" type="text" name="CotiFechaSolicitud" id="solicitudDate" disabled value="{{$cotizacion->CotiFechaSolicitud}}">
                        </div>
                        
                        {{-- fecha de vencimiento --}}
                        <div class="col-md-6">
                            <label for="VencimientoDate">Vencimiento:</label>
                            {{-- <div class="input-group">
                                <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                                    <span>
                                        <i class="far fa-calendar-alt"></i> Rango De Vencimiento
                                    </span>
                                    <i class="fas fa-caret-down"></i>
                                </button>
                            </div> --}}
                            <input class="form-control" type="date" name="CotiFechaVencimiento" id="VencimientoDate">
                        </div>

                        {{-- total --}}
                        <div class="col-md-6">
                            <label for="Subtotal">Precio Subtotal</label>
                            <input class="form-control" type="text" name="CotiPrecioSubtotal" id="Subtotal" value="{{$cotizacion->CotiPrecioSubtotal}}">
                        </div>

                        {{-- sub total --}}
                        <div class="col-md-6">
                            <label for="Total">Precio Total</label>
                            <input class="form-control" type="text" name="CotiPrecioTotal" id="Total" value="{{$cotizacion->CotiPrecioTotal}}">
                        </div>

                        {{-- Status de la cotizacion --}}
                        <div class="col-md-6">
                            <label for="CotizacionStatus">Status de cotización</label>
                            <select class="form-control" id="CotizacionStatus" name="CotiStatus">
                                <option>Pendiente</option>
                                <option>Aprobada</option>
                                <option>Aprobada Parcial</option>
                                <option>Rechazada</option>
                            </select>
                        </div>
                        {{-- separador de residuos --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-primary collapsed-box box-solid" style="margin-top: 1%;">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Residuos</h3>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- /.box-tools -->
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        Lista de residuos seleccionables para la cotización
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                            <!-- /.col -->
                        </div>
                        {{-- residuos adjuntables a la cotizacion --}}
                        <div>
                            <table id="RespelTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Clasificación Y</th>
                                        <th>Clasificación A</th>
                                        <th>Peligrosidad</th>
                                        <th>Edo. Físico</th>
                                        <th>Hoja de Seguridad</th>
                                        <th>Tarj de Emergencia</th>
                                        <th>Aprobación</th>
                                        <th>Generado por</th>
                                        <th>Seleccionar</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody id="readyTable">
                                    @foreach($residuos as $residuo)
                                    <tr>
                                        <td>{{$residuo->ID_Respel}}</td>
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
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-warning">Actualizar</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>
@endsection

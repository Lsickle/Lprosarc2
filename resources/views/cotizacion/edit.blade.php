@extends('adminlte::page')

@section('htmlheader_title')
	Change Title here!
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="/cotizacion" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                <label for="CotizacionStatus">Status de cotizacion</label>
                                <select class="form-control" id="CotizacionStatus" name="CotiStatus">
                                    <option>Pendiente</option>
                                    <option>Aprobada</option>
                                    <option>Aprobada Parcial</option>
                                    <option>Rechazada</option>
                                </select>
                            </div>

                            {{-- vencimiento a partir de la aprobacion --}}
                            <div class="form-group">
                              <label>Vencimiento:</label>

                              <div class="input-group">
                                <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                                  <span>
                                    <i class="far fa-calendar-alt"></i> Rango De Vencimiento
                                  </span>
                                  <i class="fas fa-caret-down"></i>
                                </button>
                              </div>
                            </div>

                            <div class="col-md-6">
                                <label for="CotizacionStatus">Status de cotizacion</label>
                                <select class="form-control" id="CotizacionStatus" name="CotiStatus">
                                    <option>Pendiente</option>
                                    <option>Aprobada</option>
                                    <option>Aprobada Parcial</option>
                                    <option>Rechazada</option>
                                </select>
                            </div>


                            {{-- residuos adjuntables a la cotizacion --}}
                          {{--   <div>
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
		</div>
	</div>
@endsection

@extends('layouts.app')
@section('htmlheader_title')
Solicitud de servicio
@endsection
@section('contentheader_title')
Editar Solicitud de servicio
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-16 col-md-offset-0">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos</h3>
                </div>
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <!-- form start -->
                            <form role="form" id="form1" action="/solicitud-servicio/{{$id}}" method="POST">
                                @method('PATCH')
                                @csrf
                                <div class="col-md-6">
                                    <label for="FK_SolSerCliente">Cliente</label>
                                    <select id="FK_SolSerCliente" name="FK_SolSerCliente" class="form-control" required>
                                        <option value="{{$Cliente->ID_Cli}}">{{$Cliente->CliName}}</option>
                                        @foreach ($Clientes as $Cliente)
                                            <option value="{{$Cliente->ID_Cli}}">{{$Cliente->CliName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="FK_SolSerPersona">Persona</label>
                                    <select id="FK_SolSerPersona" name="FK_SolSerPersona" class="form-control" required>
                                        <option value="{{$Persona->ID_Pers}}">{{$Persona->PersFirstName.' '.$Persona->PersLastName}}</option>
                                        @foreach ($Personal as $Persona)
                                            <option value="{{$Persona->ID_Pers}}">{{$Persona->PersFirstName.' '.$Persona->PersLastName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="SolSerTipo">Tipo</label>
                                    <select class="form-control" name="SolSerTipo" id ="SolSerTipo" required="true">
                                        <option {{ $Solicitud->SolSerTipo == 'Interno' ? 'selected' : '' }}>Interno</option>
                                        <option {{ $Solicitud->SolSerTipo == 'Alquilado' ? 'selected' : '' }}>Alquilado</option>
                                        <option {{ $Solicitud->SolSerTipo == 'Externo' ? 'selected' : '' }}>Externo</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="Fk_SolSerTransportador">Sede</label>
                                    <select class="form-control" id="Fk_SolSerTransportador" name="Fk_SolSerTransportador" required>
                                        <option value="{{$Sede->ID_Sede}}">{{$Sede->SedeName}}</option>
                                        @foreach ($Sedes as $Sede)
                                            <option value="{{$Sede->ID_Sede}}">{{$Sede->SedeName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="SolSerConducExter">Nombre del conductor externo</label>
                                    <input type="text" class="form-control" id="SolSerConducExter" value="{{$Solicitud->SolSerConducExter}}" name="SolSerConducExter">
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="SolSerVehicExter">Placa del vehiculo externo</label>
                                    <input type="text" class="form-control" id="SolSerVehicExter" value="{{$Solicitud->SolSerVehicExter}}" name="SolSerVehicExter">
                                </div>
                                <div class="col-md-6" style="padding-top: 2%; text-align: center;">
                                    <label for="SolSerAuditable">Auditable</label>
                                    @if($Solicitud->SolSerAuditable == 1)
                                        <input class="AllowUncheck" type="radio" checked="" name="SolSerAuditable"/>
                                    @else
                                        <input class="AllowUncheck" type="radio" name="SolSerAuditable"/>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="SolResAuditoriaTipo">Tipo de auditoria</label>
                                    <select class="form-control" id="SolResAuditoriaTipo" name="SolResAuditoriaTipo" required>
                                        <option value="Presencial">Presencial</option>
                                        <option value="Virtual">Virtual</option>
                                    </select>
                                </div>
                                <div class="col-md-6" style="padding-top: 2%; text-align: center;">
                                    <label for="inputcheck">¿Usara de nuevo la solicitud?</label>
                                    @if($Solicitud->SolSerFrecuencia <> null)
                                        <input class="CalendarSwitch" type="radio" checked="" name="ReqAuditoriaTipo"/>
                                    @else
                                        <input class="CalendarSwitch" type="radio" name="ReqAuditoriaTipo"/>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="SolSerFrecuencia">Frecuencia de recolecta</label>
                                    <input type="text" class="form-control" id="SolSerFrecuencia" placeholder="15 días" value="{{$Solicitud->SolSerFrecuencia}}" name="SolSerFrecuencia"><br><br>
                                </div>
                                <div class="col-md-12" style="text-align: center;">
                                    <b>RESIDUOS A ENTREGAR</b>
                                </div>
                                @foreach($GenerResiduos as $GenerResiduo)
                                    <div id="divGenerRes">
                                        <div id="GenerRes">
                                            <div class="col-md-12">
                                                <label for="">Seleccione el generador</label>
                                                <select name="SGenerador[]" id="SGenerador" class="form-control">
                                                    <option value="{{$GenerResiduo->ID_GSede}}">{{$GenerResiduo->GSedeName}}</option>
                                                    @foreach($SGeneradors->where('ID_GSede', '<>', $GenerResiduo->ID_GSede)->get() as $SGenerador)
                                                        <option value="{{$SGenerador->ID_GSede}}">{{$SGenerador->GSedeName}}</option>
                                                    @endforeach
                                                </select><br>
                                            </div>
                                            <div class="divRes">
                                                <div id="divResiduos">
                                                    <div class="col-md-3">
                                                        <br><br><br>
                                                        <label>Residuos</label><hr>
                                                        <div id="divRespel">
                                                            @foreach($Residuos as $Residuo)
                                                                @if($Residuo->FK_SGener == $GenerResiduo->FK_SGener)
                                                                    <select name="Respel[][]" id="Respel"class="form-control">
                                                                        <option value="{{$Residuo->ID_Respel}}">{{$Residuo->RespelName}}</option>
                                                                        @foreach($Respels->get() as $Respel)
                                                                            @if($Respel->ID_Respel <> $Residuo->ID_Respel)
                                                                                <option value="{{$Respel->ID_Respel}}">{{$Respel->RespelName}}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select><hr>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 smartwizard">
                                                    <ul>
                                                        <li>
                                                            <a href="#step-1"><b>Descripción</b><br/><small>Datos del residuo</small></a>
                                                        </li>
                                                        <li>
                                                            <a href="#step-2"><b>Requerimientos</b><br/><small>Requerimientos del residuo</small></a>
                                                        </li>
                                                    </ul>
                                                    <div>
                                                        <div id="step-1">
                                                            <div class="col-md-3">
                                                                <br><label>N°. Unidades</label><hr>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <br><label>Tipo de Unidad</label><hr>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <br><label>Cantidad</label><hr>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <br><label>Tratamiento</label><hr>
                                                            </div>
                                                            @foreach($Residuos as $Residuo)
                                                                @if($Residuo->FK_SGener == $GenerResiduo->FK_SGener)
                                                                    <input type="text" style="display: none;" name="SolResSlug[][]" value="{{$Residuo->SolResSlug}}">
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" id="Unidades" value="{{$Residuo->SolResUnidades}}" name="Unidades[][]"><hr>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <select class="form-control" id="TipoCate" name="TipoCate[][]">
                                                                            <option {{ $Residuo->SolResTipoCate == 'Kilogramos' ? 'selected' : '' }}>Kilogramos</option>
                                                                            <option {{ $Residuo->SolResTipoCate == 'Litros' ? 'selected' : '' }}>Litros</option>
                                                                        </select><hr>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="text" class="form-control" id="CateEnviado" value="{{$Residuo->SolResCateEnviado}}" name="CateEnviado[][]"><hr>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <select class="form-control" id="Tratamiento" name="Tratamiento[][]">
                                                                            <option value="{{$Residuo->ID_Trat}}">{{$Residuo->TratName}}</option>
                                                                            @foreach($Tratamientos->get() as $Tratamiento)
                                                                                @if($Tratamiento->ID_Trat <> $Residuo->ID_Trat)
                                                                                    <option value="{{$Tratamiento->ID_Trat}}">{{$Tratamiento->TratName}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select><hr>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        <div id="step-2">
                                                            <div class="divReq">
                                                                <label title="Foto Cargue">F.Ca</label>
                                                                <label title="Foto Descargue">F.De</label>
                                                                <label title="Foto Pesaje">F.Pe</label>
                                                                <label title="Foto Reempacado">F.Re</label>
                                                                <label title="Foto Mezclaje">F.Me</label>
                                                                <label title="Foto Destrucción">F.Des</label>
                                                                <label title="Video Cargue">V.Ca</label>
                                                                <label title="Video Descargue">V.De</label>
                                                                <label title="Video Pesaje">V.Pe</label>
                                                                <label title="Video Reempacado">V.Re</label>
                                                                <label title="Video Mezclaje">V.Me</label>
                                                                <label title="Video Destrucción">V.Des</label>
                                                                <label title="Devolucion">Dev</label>
                                                                <label title="Planillas">Pla</label>
                                                                <label title="Alistamiento">Ali</label>
                                                                <label title="Capacitación">Cap</label>
                                                                <label title="Bascula">Bas</label>
                                                                <label title="Vehiculo con Plataforma">Ve.P</label>
                                                                <label title="Certificación Especial">Cer</label>
                                                            </div>
                                                            <div class="divReq">
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/>
                                                                <input class="inputcheck" type="checkbox"/><hr>
                                                            </div>
                                                            @foreach($Residuos as $Residuo)
                                                                @if($Residuo->FK_SGener == $GenerResiduo->FK_SGener)
                                                                    <div class="divReq">
                                                                        <input name="FotoCargue[][]" id="FotoCargue" {{$Residuo->SolResFotoCargue == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="FotoDescargue[][]" id="FotoDescargue" {{$Residuo->SolResFotoDescargue == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="FotoPesaje[][]" id="FotoPesaje" {{$Residuo->SolResFotoPesaje == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="FotoReempacado[][]" id="FotoReempacado" {{$Residuo->SolResFotoReempacado == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="FotoMezclado[][]" id="FotoMezclado" {{$Residuo->SolResFotoMezclado == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="FotoDestruccion[][]" id="FotoDestruccion" {{$Residuo->SolResFotoDestruccion == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="VideoCargue[][]" id="VideoCargue" {{$Residuo->SolResVideoCargue == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="VideoDescargue[][]" id="VideoDescargue" {{$Residuo->SolResVideoDescargue == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="VideoPesaje[][]" id="VideoPesaje" {{$Residuo->SolResVideoPesaje == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="VideoReempacado[][]" id="VideoReempacado" {{$Residuo->SolResVideoReempacado == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="VideoMezclado[][]" id="VideoMezclado" {{$Residuo->SolResVideoMezclado == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="VideoDestruccion[][]" id="VideoDestruccion" {{$Residuo->SolResVideoDestruccion == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="Devolucion[][]" id="Devolucion" {{$Residuo->SolResDevolucion == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="Planillas[][]" id="Planillas" {{$Residuo->SolResPlanillas == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="Alistamiento[][]" id="Alistamiento" {{$Residuo->SolResAlistamiento == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="Capacitacion[][]" id="Capacitacion" {{$Residuo->SolResCapacitacion == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="Bascula[][]" id="Bascula" {{$Residuo->SolResBascula == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="Platform[][]" id="Platform" {{$Residuo->SolResPlatform == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/> 
                                                                        <input name="CertiEspecial[][]" id="CertiEspecial" {{$Residuo->SolResCertiEspecial == "1" ? 'checked' : ''}} class="inputcheck" type="checkbox"/><hr>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-md-12">
                                    <div class="box-footer">
                                        <input type="submit" class="btn btn-primary" form="form1" value="Siguiente">
                                    </div>
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
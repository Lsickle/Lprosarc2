@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('contentheader_title')
<span
    style="background-image: linear-gradient(40deg, #d4fc79, #00C851); padding-right:30vw; position:relative; overflow:hidden;">
    Express-Solicitudes
    <div
        style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;">
    </div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-16 col-md-offset-0">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('adminlte_lang::message.solsertitleindex') }}</h3>
                </div>
                <div class="box box-info">
                    <div class="box-body">
                        <div id="ModalStatus"></div>
                        <table id="SolicitudservicioTable" class="table table-compact table-bordered table-striped d-none">
                            <thead>
                                <tr>
                                    <th>Último Recordatorio</th>
                                    <th>{{trans('adminlte_lang::message.solsershowdateRPDA')}}</th>
                                    <th>N°</th>
                                    <th nowrap>Status</th>
                                    <th>{{trans('adminlte_lang::message.clientcliente')}}</th>
                                    <th>Contacto</th>
                                    <th>Comercial Asignado</th>
                                    <th>{{trans('adminlte_lang::message.seemore')}}</th>
                                    @if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2))
                                        <th>Enviar</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Servicios as $Servicio)
                                <tr style="{{$Servicio->SolSerDelete == 1 ? 'color: red' : ''}}">
                                    <td id="{{'lastRecordatorio'.$Servicio->SolSerSlug}}">{{$Servicio->ultimoRecordatorio != null ? \Carbon\Carbon::parse($Servicio->ultimoRecordatorio->ObsDate)->diffForhumans() : ($Servicio->fechaCompletado != null ? \Carbon\Carbon::parse($Servicio->fechaCompletado->ObsDate)->diffForhumans() : "")  }}</td>
                                    <td style="text-align: center;">
                                        @if($Servicio->recepcion == null)
                                        {{null}}
                                        @else
                                        {{date('Y/m/d', strtotime($Servicio->recepcion))}}
                                        @endif
                                    </td>
                                    <td style="text-align: center;">#{{$Servicio->ID_SolSer}}</td>
                                    <td class="text-center"><a class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-truck-loading'></i></a><br>{{$Servicio->SolSerStatus}}</td>
                                    <td>{{$Servicio->CliName}}</td>
                                    <td>
                                        <ul>
                                            <li>{{$Servicio->PersFirstName}} {{$Servicio->PersLastName}}</li>
                                            <li>{{$Servicio->PersEmail}}</li>
                                            <li>{{$Servicio->PersCellphone}}</li>
                                        </ul>
                                    </td>
                                    <td>{{$Servicio->ComercialPersFirstName.' '.$Servicio->ComercialPersLastName}}</td>
                                    <td style="text-align: center;"><a
                                            href='/solicitud-servicio/{{$Servicio->SolSerSlug}}' class="btn btn-info"
                                            title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i
                                                class="fas fa-search"></i></a>
                                    </td>
                                    @if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2))
                                    @php
                                    $Status = ['Completado'];
                                    @endphp
                                    <td>
                                        <button id="{{'buttonCertStatus'.$Servicio->SolSerSlug}}"
                                            onclick="ModalSendRecordatorio('{{$Servicio->SolSerSlug}}', '{{$Servicio->ID_SolSer}}')"
                                            style="text-align: center;"
                                            class="{{'classSendRecordatorio'.$Servicio->SolSerSlug}} btn btn-{{$Servicio->SolSerStatus == 'Completado' ? 'success' : 'default'}}">
                                            <i class="fas fa-envelope"></i>
                                        Recordatorio {{$Servicio->ultimoRecordatorio != null ? $Servicio->ultimoRecordatorio->ObsRepeat + 1 : ($Servicio->fechaCompletado != null ? $Servicio->fechaCompletado->ObsRepeat : "")  }}</button>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div id="ModalStatus"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('NewScript')
    @if(in_array(Auth::user()->UsRol, Permisos::ProgVehic2) || in_array(Auth::user()->UsRol2, Permisos::ProgVehic2))
        <script>    
            function ModalSendRecordatorio(slug, id){
                $('#ModalStatus').empty();
                $('#ModalStatus').append(`
                    <div class="modal modal-default fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <span style="font-size: 0.3em; color: black;"><p>Enviar recordatorio de conciliación para el servicio <b>N° `+id+`</b>?</p></span>
                                    </div> 
                                    <div class="form-group col-md-12">
                                        <label color: black; text-align: left;" data-placement="auto" data-trigger="hover" data-html="true"
                                            data-toggle="popover" title="Observaciones"
                                            data-content="En este campo puede redactar sus observaciones con relación al recordatorio de conciliación para esta solicitud de servicio"><i
                                                style="font-size: 1.8rem; color: Dodgerblue;"
                                                class="fas fa-info-circle fa-2x fa-spin"></i>Observaciones</label>
                                        <small id="caracteresrestantesrepetirSR" class="help-block with-errors"></small>
                                        <textarea onchange="updatecaracteresrepetirSR()" id="textDescriptionrepetirSR" rows="5" style="resize: vertical;"
                                            maxlength="4000" class="form-control col-xs-12" required name="solserdescript"></textarea>
                                    </div>
                                    <input id="solserslug" type='hidden' name='solserslug' value="`+slug+`">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                                    <button type="button" id="buttonCertStatusOK`+slug+`" data-dismiss="modal" class='btn btn-success'>Enviar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                envsubmit();
                $('#myModal').modal();
                $('#buttonCertStatusOK'+slug).on( "click", function() {
                    var area = document.getElementById("textDescriptionrepetirSR");
                    var observacion = area.value;
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });
                    $.ajax({
                    url: "{{url('/recordatorioAjax')}}",
                    method: 'POST',
                    data:{
                        'solserslug': slug,
                        'solserdescript': observacion
                    },
                    beforeSend: function(){
                        let buttonsubmit = $('.classSendRecordatorio'+slug);
                        buttonsubmit.each(function() {
                                    $(this).on('click', function(event) {
                                        event.preventDefault();
                                    });
                                    $(this).disabled = true;
                                    $(this).prop('disabled', true);
                                });
                        buttonsubmit.empty();
                        buttonsubmit.append(`<i class="fas fa-sync fa-spin"></i> Actualizando...`);
                    },
                    success: function(res, status, xhr){
                        $('meta[name="csrf-token"]').attr('content', res.newtoken);
                        let buttonsubmit = $('.classSendRecordatorio'+slug);
                        let lastrecord = $('#lastRecordatorio'+slug);
                        switch (xhr.status) {
                            case 200:
                                buttonsubmit.each(function() {
                                    $(this).on('click', function(event) {
                                        event.preventDefault();
                                    });
                                    $(this).disabled = true;
                                    $(this).prop('disabled', true);
                                });
                                buttonsubmit.prop('class', 'btn btn-default');
                                buttonsubmit.empty();
                                buttonsubmit.append(`<i class="fas fa-envelope"></i> Recordatorio`);

                                lastrecord.empty();
                                lastrecord.append(res['ultimorecordatorio']);

                                toastr.success(res['message']);
                                break;
                        
                            default:
                                buttonsubmit.each(function() {
                                    $(this).on('click', function(event) {
                                        event.preventDefault();
                                    });
                                    $(this).disabled = false;
                                    $(this).prop('disabled', false);
                                });
                                buttonsubmit.prop('class', 'btn btn-success classSendRecordatorio'+slug);
                                buttonsubmit.empty();
                                buttonsubmit.append(`<i class="fas fa-envelope"></i> Recordatorio`);

                                toastr.error(res['error']);
                                break;
                        }
                    },
                    error: function(error){
                        $('meta[name="csrf-token"]').attr('content', error.newtoken);
                        let buttonsubmit = $('.classSendRecordatorio'+slug);
                        switch (error['responseJSON']['code']) {
                            case 400:
                                buttonsubmit.each(function() {
                                    $(this).on('click', function(event) {
                                        event.preventDefault();
                                    });
                                    $(this).disabled = true;
                                    $(this).prop('disabled', true);
                                });
                                buttonsubmit.prop('class', 'btn btn-danger');
                                buttonsubmit.empty();
                                buttonsubmit.append(`<i class="fas fa-certificate"></i> Press F5 Key`);
                                
                                break;
                        
                            default:
                                buttonsubmit.each(function() {
                                    $(this).on('click', function(event) {
                                        event.preventDefault();
                                    });
                                    $(this).disabled = true;
                                    $(this).prop('disabled', true);
                                });
                                buttonsubmit.prop('class', 'btn btn-warning classSendRecordatorio'+slug);
                                buttonsubmit.empty();
                                buttonsubmit.append(`<i class="fas fa-certificate"></i> Press F5 Key`);

                                break;
                        }
                        toastr.error(error['responseJSON']['message']);
                    },
                    complete: function(){
                        //
                    }
                    })
                });
                $(document).ready(function(){
                    var area = document.getElementById("textDescriptionrepetirSR");
                    var message = document.getElementById("caracteresrestantesrepetirSR");
                    var maxLength = 4000;
                    $('#textDescriptionrepetirSR').keyup(function updatecaracteresrepetirSR() {
                        message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
                    });
                });
            }
        </script>
        <script>
            function updatecaracteresrepetirSR() {
                var area = document.getElementById("textDescriptionrepetirSR");
                var message = document.getElementById("caracteresrestantesrepetirSR");
                var maxLength = 4000;
                message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
                observacion = area.value;
            }
        </script>
    @endif
@endsection
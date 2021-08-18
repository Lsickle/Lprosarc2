@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #fbc2eb, #aa66cc); padding-right:30vw; position:relative; overflow:hidden;">
    Servicios-Solicitudes
    <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;">
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
                        <div id="ModalFacturar"></div>
                        <table id="SolicitudservicioTable" class="table table-compact table-bordered table-striped d-none">
                            <thead>
                                <tr>
                                    <th>{{trans('adminlte_lang::message.solsershowdate')}}</th>
                                    <th>{{trans('adminlte_lang::message.solsershowdateRPDA')}}</th>
                                    <th>N°</th>
                                    <th nowrap>Status</th>
                                    <th>{{trans('adminlte_lang::message.clientcliente')}}</th>
                                    <th>Contacto</th>
                                    <th>Comercial Asignado</th>
                                    <th>{{trans('adminlte_lang::message.solserindextrans')}}</th>
                                    <th>{{trans('adminlte_lang::message.solseraddrescollect')}}</th>
                                    <th>{{trans('adminlte_lang::message.seemore')}}</th>
                                    @if(in_array(Auth::user()->UsRol, Permisos::SolSerCertifi) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi))
                                    <th>{{trans('adminlte_lang::message.solserstatuscertifi')}}</th>
                                    @endif
                                    @if(in_array(Auth::user()->UsRol, Permisos::COMERCIALES) || in_array(Auth::user()->UsRol2, Permisos::COMERCIALES))
                                    <th>{{'Facturar'}}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Servicios as $Servicio)
                                <tr style="{{$Servicio->SolSerDelete == 1 ? 'color: red' : ''}}">
                                    <td style="text-align: center;">{{date('Y/m/d', strtotime($Servicio->created_at))}}
                                    </td>
                                    <td style="text-align: center;">
                                        @if($Servicio->recepcion == null)
                                        {{null}}
                                        @else
                                        {{date('Y/m/d', strtotime($Servicio->recepcion))}}
                                        @endif
                                    </td>
                                    <td style="text-align: center;">#{{$Servicio->ID_SolSer}}</td>
                                    @switch($Servicio->SolSerStatus)
                                    @case('Pendiente')
                                    <td class="text-center"><a class='btn fixed_widthbtn btn-default'><i class='fas fa-lg fa-hourglass-start'></i></a><br>{{$Servicio->SolSerStatus}}
                                    </td>
                                    @break
                                    @case('Aceptado')
                                    <td class="text-center"><a class='btn fixed_widthbtn btn-info'><i class='fas fa-lg fa-thumbs-up'></i></a><br>{{$Servicio->SolSerStatus}}
                                    </td>
                                    @break
                                    @case('Aprobado')
                                    <td class="text-center"><a class='btn fixed_widthbtn btn-info'><i class='fas fa-lg fa-tasks'></i></a><br>{{$Servicio->SolSerStatus}}</td>
                                    @break
                                    @case('Programado')
                                    <td class="text-center"><a class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-calendar-alt'></i></a><br>{{$Servicio->SolSerStatus}}
                                    </td>
                                    @break
                                    @case('Notificado')
                                    <td class="text-center"><a class='btn fixed_widthbtn btn-primary'><i class='far fa-lg fa-envelope'></i></a><br>{{$Servicio->SolSerStatus}}
                                    </td>
                                    @break
                                    @case('Cancelado')
                                    @case('Recibido')
                                    <td class="text-center"><a class='btn fixed_widthbtn btn-danger'><i class='fas fa-lg fa-calendar-times'></i></a><br>{{$Servicio->SolSerStatus}}
                                    </td>
                                    @break
                                    @case('Completado')
                                    <td class="text-center"><a class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-truck-loading'></i></a><br>{{$Servicio->SolSerStatus}}
                                    </td>
                                    @break
                                    @case('Conciliado')
                                    <td class="text-center"><a class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-balance-scale'></i></a><br>{{$Servicio->SolSerStatus}}
                                    </td>
                                    @break
                                    @case('No Conciliado')
                                    <td class="text-center"><a class='btn fixed_widthbtn btn-warning'><i class='fas fa-lg fa-balance-scale-right'></i></a><br>{{$Servicio->SolSerStatus}}
                                    </td>
                                    @break
                                    @case('Corregido')
                                    <td class="text-center"><a class='btn fixed_widthbtn btn-success'><i class='fas fa-lg fa-weight'></i></a><br>{{$Servicio->SolSerStatus}}</td>
                                    @break
                                    @case('Tratado')
                                    <td class="text-center"><a class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-dumpster-fire'></i></a><br>{{$Servicio->SolSerStatus}}
                                    </td>
                                    @break
                                    @case('Facturado')
                                    <td class="text-center"><a class='btn fixed_widthbtn btn-default'><i class='fas fas fa-lg fa-receipt'></i></a><br>{{$Servicio->SolSerStatus}}
                                    </td>
                                    @break
                                    @case('Certificacion')
                                    <td class="text-center"><a class='btn fixed_widthbtn btn-success'><i class='fas fas fa-lg fa-certificate'></i></a><br>{{$Servicio->SolSerStatus}}
                                    </td>
                                    @break
                                    <b></b>
                                    @default
                                    <td class="text-center"><a class='btn fixed_widthbtn btn-primary'><i class='fas fa-lg fa-ban'></i></a><br>{{$Servicio->SolSerStatus}}</td>
                                    @endswitch
                                    <td>{{$Servicio->CliName}}</td>
                                    <td>
                                        <ul>
                                            <li>{{$Servicio->PersFirstName}} {{$Servicio->PersLastName}}</li>
                                            <li>{{$Servicio->PersEmail}}</li>
                                            <li>{{$Servicio->PersCellphone}}</li>
                                        </ul>
                                    </td>
                                    <td>{{$Servicio->ComercialPersFirstName.' '.$Servicio->ComercialPersLastName}}</td>
                                    <td>{{$Servicio->SolSerNameTrans}}</td>
                                    <td>{{$Servicio->SolSerCollectAddress == null ? 'N/A' : $Servicio->SolSerCollectAddress}}
                                    </td>
                                    <td style="text-align: center;"><a href='/solicitud-servicio/{{$Servicio->SolSerSlug}}' class="btn btn-info" title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i></a>
                                    </td>
                                    @if(in_array(Auth::user()->UsRol, Permisos::COMERCIALES) || in_array(Auth::user()->UsRol2, Permisos::COMERCIALES))
                                    @php
                                    $Status = ['Conciliado', 'Tratado'];
                                    @endphp
                                    <td>
                                        <button id="{{'buttonCertStatus'.$Servicio->SolSerSlug}}" onclick="ModalFacturacion('{{$Servicio->SolSerSlug}}', '{{$Servicio->ID_SolSer}}', '{{in_array($Servicio->SolSerStatus, $Status)}}', 'Facturada', 'facturar')" {{in_array($Servicio->SolSerStatus, $Status) ? '' :  'disabled'}} style="text-align: center;" class="{{'classFacturarStatus'.$Servicio->SolSerSlug}} btn btn-{{$Servicio->SolSerStatus == 'Facturado' ? 'default' : 'info'}}"><i class="fas fa-certificate"></i>
                                            {{'Facturar'}}</button>
                                    </td>
                                    @endif
                                    @if(in_array(Auth::user()->UsRol, Permisos::SolSerCertifi) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi))
                                    @php
                                    $Status = ['Conciliado', 'Tratado', 'Facturado'];
                                    @endphp
                                    <td>
                                        <button id="{{'buttonCertStatus'.$Servicio->SolSerSlug}}" onclick="ModalCertificacion('{{$Servicio->SolSerSlug}}', '{{$Servicio->ID_SolSer}}', '{{in_array($Servicio->SolSerStatus, $Status)}}', 'Certificada', 'certificar')" {{in_array($Servicio->SolSerStatus, $Status) ? '' :  'disabled'}} style="text-align: center;" class="{{'classCertStatus'.$Servicio->SolSerSlug}} btn btn-{{$Servicio->SolSerStatus == 'Certificacion' ? 'default' : 'success'}}"><i class="fas fa-certificate"></i>
                                            {{trans('adminlte_lang::message.solserstatuscertifi')}}</button>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('NewScript')
<script>
    function renewtoken(token) {
        $('meta[name="csrf-token"]').attr('content', token);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });
    }
    function renewTokenAfterError() {
        $.ajax({
            url: "{{url('/renewtokenaftererror')}}",
            method: 'GET',
            data:{},
            success: function(response){
                console.log('renewtokenaftererror OK');
                renewtoken(response);
                console.log(response);
            },
            error: function(xhr, status, error){
                renewtoken('invalid Token');
                console.log('renewtokenaftererror FAIL');
            },
        });
    }
    function updatecaracteresObs() {
        var area = document.getElementById("textDescriptionObs");
        var message = document.getElementById("caracteresrestantesObs");
        var maxLength = 4000;
        message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
        observacion = area.value;
    }

    $(document).ready(function(){
        var area = document.getElementById("textDescriptionObs");
        var message = document.getElementById("caracteresrestantesObs");
        var maxLength = 4000;
        $('#textDescriptionObs').keyup(function updatecaracteresrepetirObs() {
            message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
        });
    })

    function updatecaracteresSR() {
        var area = document.getElementById("textDescriptionSR");
        var message = document.getElementById("caracteresrestantesSR");
        var maxLength = 4000;
        message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
        observacion = area.value;

    }

    $(document).ready(function(){
        var area = document.getElementById("textDescriptionrepetirSR");
        var message = document.getElementById("caracteresrestantesrepetirSR");
        var maxLength = 4000;
        $('#textDescriptionrepetirSR').keyup(function updatecaracteresrepetirObs() {
            message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
        });
    })
</script>

@if(in_array(Auth::user()->UsRol, Permisos::SolSerCertifi) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi))
<script>
    function ModalCertificacion(slug, id, boolean, value, text){
                if(boolean == 1){
                    $('#ModalStatus').empty();
                    $('#ModalStatus').append(`
                        <div class="modal modal-default fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            <span style="font-size: 0.3em; color: black;"><p>¿Seguro(a) quiere `+text+` la solicitud <b>N° `+id+`</b>?</p></span>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">No, salir</button>
                                        <button type="button" id="buttonCertStatusOK`+slug+`" data-dismiss="modal" class='btn btn-success'>Si, acepto</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                    envsubmit();
                    $('#myModal').modal();
                    $('#buttonCertStatusOK'+slug).on( "click", function() {
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                        });
                        $.ajax({
                        url: "{{url('/certificarservicio')}}/"+slug,
                        method: 'GET',
                        data:{},
                        beforeSend: function(){
                            let buttonsubmit = $('.classCertStatus'+slug);
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
                        success: function(res){
                            let buttonsubmit = $('.classCertStatus'+slug);
                            switch (res['code']) {
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
                                    buttonsubmit.append(`<i class="fas fa-certificate"></i> Certificado`);

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
                                    buttonsubmit.prop('class', 'btn btn-success classCertStatus'+slug);
                                    buttonsubmit.empty();
                                    buttonsubmit.append(`<i class="fas fa-certificate"></i> Certificar`);

                                    toastr.error(res['error']);
                                    break;
                            }
                        },
                        error: function(error){
                            let buttonsubmit = $('.classCertStatus'+slug);
                            switch (error['responseJSON']['code']) {
                                case 400:
                                    buttonsubmit.each(function() {
                                        $(this).on('click', function(event) {
                                            event.preventDefault();
                                        });
                                        $(this).disabled = true;
                                        $(this).prop('disabled', true);
                                    });
                                    buttonsubmit.prop('class', 'btn btn-default');
                                    buttonsubmit.empty();
                                    buttonsubmit.append(`<i class="fas fa-certificate"></i> Certificado`);

                                    break;

                                default:
                                    buttonsubmit.each(function() {
                                        $(this).on('click', function(event) {
                                            event.preventDefault();
                                        });
                                        $(this).disabled = false;
                                        $(this).prop('disabled', false);
                                    });
                                    buttonsubmit.prop('class', 'btn btn-success classCertStatus'+slug);
                                    buttonsubmit.empty();
                                    buttonsubmit.append(`<i class="fas fa-certificate"></i> Certificar`);

                                    break;
                            }
                            toastr.error(error['responseJSON']['message']);
                        },
                        complete: function(){
                            //
                        }
                        })
                    });;
                }
            }
</script>
@endif
@if(in_array(Auth::user()->UsRol, Permisos::COMERCIALES) || in_array(Auth::user()->UsRol2, Permisos::COMERCIALES))
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
    var inicio = "{{date('Y/m/d')}}";
        var fin = "{{date('Y/m/d')}}";
        function checkFacturacionTipo() {
            var tipo = document.getElementById("selectTipoFact");
            if (tipo.value == 'Mensual') {
                $('#rangoContainer').append(`
                    <div class="form-group col-md-6">
                        <label class="control-label" for="RangoFechas">Fecha Inicial</label>
                        <input type="text" name="RangoFechas" id="RangoFechas" class="form-control" required minlength="23">
                    </div>
                `);
                $('#tipoFactContainer').addClass('col-md-6');
                $('#tipoFactContainer').removeClass('col-md-12');
                $('input[name="RangoFechas"]').daterangepicker({
                    "autoApply": true,
                    ranges: {
                        'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
                        'Este Mes': [moment().startOf('month'), moment().endOf('month')],
                        'Ultimo mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                        'Penultimo mes': [moment().subtract(2, 'month').startOf('month'), moment().subtract(2, 'month').endOf('month')],
                    },
                    "locale": {
                        "format": "YYYY/MM/DD",
                        "separator": " - ",
                        "applyLabel": "Aplicar",
                        "cancelLabel": "Cancelar",
                        "fromLabel": "Desde",
                        "toLabel": "Hasta",
                        "customRangeLabel": "Rango Especifico",
                        "weekLabel": "Sem",
                        "daysOfWeek": [
                        "Do",
                        "Lu",
                        "Ma",
                        "Mi",
                        "Ju",
                        "Vi",
                        "Sa"
                    ],
                    "monthNames": [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ],
                    "firstDay": 1
                    },
                    "minDate": "{{date('Y/m/d', strtotime('1 year ago'))}}",
                    "startDate": "{{date('Y/m/d', strtotime('-1 day'))}}",
                    "endDate": "{{date('Y/m/d', strtotime('today'))}}",
                    "drops": "auto"
                },
                    function(start, end, label) {
                        console.log('New date range selected: ' + start.format('YYYY/MM/DD') + ' to ' + end.format('YYYY/MM/DD') + ' (predefined range: ' + label + ')');
                        inicio = start.format('YYYY/MM/DD');
                        fin = end.format('YYYY/MM/DD');
                });
            }else{
                $('#rangoContainer').empty();
                $('#tipoFactContainer').addClass('col-md-12');
                $('#tipoFactContainer').removeClass('col-md-6');
                console.log('rango de fechas eliminado');
                inicio = "{{date('Y/m/d')}}";
                fin = "{{date('Y/m/d')}}";
            }
        }
</script>
<script>
    function ModalFacturacion(slug, id, boolean, value, text){
            if(boolean == 1){
                $('#ModalFacturar').empty();
                $('#ModalFacturar').append(`
                    <div class="modal modal-default fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <span style="font-size: 0.3em; color: black;"><p>¿Seguro(a) quiere `+text+` la solicitud <b>N° `+id+`</b>?</p></span>
                                    </div>

                                    <form action="/facturarservicio/`+slug+`" class="row" id="facturarservicio`+slug+`">
                                        <div class="form-group col-md-12" id="tipoFactContainer">
                                            <label class="control-label" for="FacturacionTipo">Tipo de Facturacion</label><small class="help-block with-errors">*</small>
                                            <select onchange="checkFacturacionTipo()" id="selectTipoFact" name="FacturacionTipo" class="form-control" required>
                                                <option selected value="Servicio">Servicio</option>
                                                <option value="Mensual">Rango de fechas</option>
                                            </select>
                                        </div>
                                        <div id="rangoContainer"></div>
                                        <div class="form-group col-md-6">
                                            <label for="Costo_transporte">Costo Transporte</label>
                                            <input required type="number" name="Costo_transporte" id="Costo_transporte" class="form-control" min="0" step="0.01">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="orden_compra">Orden de Compra</label>
                                            <input type="text" name="orden_compra" id="orden_compra" class="form-control" maxlength="20">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label color: black; text-align: left;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="Observaciones" data-content="En este campo puede redactar sus observaciones con relación a esta solicitud de servicio"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Observaciones</label>
                                            <small id="caracteresrestantesObs" class="help-block with-errors"></small>
                                            <textarea onchange="updatecaracteresObs()" id="textDescriptionObs" rows="5" style="resize: vertical;" maxlength="4000" class="form-control col-xs-12" name="solserdescript"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">No, salir</button>
                                    <button type="submit" form="facturarservicio`+slug+`" id="buttonFacturarStatusOK`+slug+`" data-dismiss="modal" class='btn btn-success'>Si, acepto</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                var area = document.getElementById("textDescriptionObs");
                var message = document.getElementById("caracteresrestantesObs");
                var maxLength = 4000;
                $('#textDescriptionObs').keyup(function updatecaracteresrepetirObs() {
                message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
                });
                envsubmit();
                $('#myModal').modal();
                $('#buttonFacturarStatusOK'+slug).on( "click", function() {
                    $("#facturarservicio"+slug).validate({
                        rules: {
                            FacturacionTipo: "required",
                            RangoFechas: {
                                required: {
                                    depends: function(element) {
                                        if ($("#selectTipoFact").val() == "Mensual") {
                                            return true;
                                        }else{
                                            return false;
                                        }
                                    }
                                },
                                minlength: 23
                            }
                        },
                        messages: {
                            FacturacionTipo: {
                                required: "Debe seleccionar el tipo de facturación",
                            },
                            RangoFechas: {
                                required: "Favor ingrese un rango de fechas",
                                minlength: "el rango de fechas no debe exceder de 23 caracteres",
                            }
                        },
                        errorElement: "em",
                        errorPlacement: function ( error, element ) {
                            // Add the `help-block` class to the error element
                            error.addClass( "help-block" );

                            if ( element.prop( "type" ) === "checkbox" ) {
                                error.insertAfter( element.parent( "label" ) );
                            } else {
                                error.insertAfter( element );
                            }
                        },
                        highlight: function ( element, errorClass, validClass ) {
                            $( element ).parents( ".col-md-6" ).addClass( "has-error" ).removeClass( "has-success" );
                        },
                        unhighlight: function (element, errorClass, validClass) {
                            $( element ).parents( ".col-md-6" ).addClass( "has-success" ).removeClass( "has-error" );
                        },
                        submitHandler: function(form) {
                        // do other things for a valid form
                            console.log('form send');
                        }
                    });
                    if (!$("#facturarservicio"+slug).valid()) {
                        toastr.error('verifique que todos los campos estan correctamente diligenciados');
                    }
                    if (!$("#facturarservicio"+slug).valid()) return false;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{url('/facturarservicio')}}/"+slug,
                        method: 'POST',
                        data:{
                            FacturacionTipo:$('#selectTipoFact').val(),
                            ordenCompra:$('#orden_compra').val(),
                            costoTransporte:$('#Costo_transporte').val(),
                            FechaInicial:inicio,
                            FechaFinal:fin,
                            DateTest:$('#datetest').val()
                        },
                        beforeSend: function(){
                            let buttonsubmit = $('.classFacturarStatus'+slug);
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
                        success: function(res){
                            console.log(res);
                            let buttonsubmit = $('.classFacturarStatus'+slug);
                            switch (res['code']) {
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
                                    buttonsubmit.append(`<i class="fas fa-receipt"></i> Facturaado`);

                                    toastr.success(res['message']);
                                    break;
                                case 400:
                                    buttonsubmit.each(function() {
                                        $(this).on('click', function(event) {
                                            event.preventDefault();
                                        });
                                        $(this).disabled = false;
                                        $(this).prop('disabled', false);
                                    });
                                    buttonsubmit.prop('class', 'btn btn-info classFacturarStatus'+slug);
                                    buttonsubmit.empty();
                                    buttonsubmit.append(`<i class="fas fa-receipt"></i> Facturar`);
                                    console.log('error 400');
                                    if (res['message']) {
                                        toastr.error(res['message']);
                                    }else{
                                        toastr.error('Error 400:Petición o Solicitud Incorrecta');
                                    }
                                    break;

                                default:
                                    buttonsubmit.each(function() {
                                        $(this).on('click', function(event) {
                                            event.preventDefault();
                                        });
                                        $(this).disabled = false;
                                        $(this).prop('disabled', false);
                                    });
                                    buttonsubmit.prop('class', 'btn btn-info classFacturarStatus'+slug);
                                    buttonsubmit.empty();
                                    buttonsubmit.append(`<i class="fas fa-receipt"></i> Facturar`);

                                    toastr.error(res['error']);
                                    break;
                            }
                            renewtoken(res['new_token']);
                        },
                        error: function(xhr, status, error){
                            let buttonsubmit = $('.classFacturarStatus'+slug);
                            switch (xhr.status) {
                                case 400:
                                    console.log('error 400');
                                    toastr.error('Error 400:Petición o Solicitud Incorrecta');
                                    break;

                                case 401:
                                    console.log('error 401');
                                    toastr.error('Error 401: usuario no autorizado, inicie sesion e intente de nuevo');
                                    break;

                                case 419:
                                    console.log('error 419');
                                    toastr.error('token CSRF no coincide... Recargue la pagina e intente de nuevo');

                                    break;

                                case 422:
                                    console.log('error 422');
                                    toastr.error('datos invalidos, verifique que esta ingresando la información correctamente');
                                    break;

                                default:
                                    console.log('error default');
                                    toastr.error('error no definido');
                                    break;
                            }
                            switch (error['responseJSON']['code']) {
                                case 400:
                                    buttonsubmit.each(function() {
                                        $(this).on('click', function(event) {
                                            event.preventDefault();
                                        });
                                        $(this).disabled = true;
                                        $(this).prop('disabled', true);
                                    });
                                    buttonsubmit.prop('class', 'btn btn-default');
                                    buttonsubmit.empty();
                                    buttonsubmit.append(`<i class="fas fa-receipt"></i> Facturado`);

                                    break;

                                default:
                                    buttonsubmit.each(function() {
                                            $(this).on('click', function(event) {
                                                event.preventDefault();
                                            });
                                            $(this).disabled = false;
                                            $(this).prop('disabled', false);
                                        });
                                        buttonsubmit.prop('class', 'btn btn-info classFacturarStatus'+slug);
                                        buttonsubmit.empty();
                                        buttonsubmit.append(`<i class="fas fa-receipt"></i> Facturar`);
                                        $.each(xhr.responseJSON.errors, function(key,value) {
                                            toastr.error(value);
                                        });
                            }
                            renewTokenAfterError();
                        },
                        complete: function(){
                            //
                        }
                    });
                });
            }
        }
</script>
@endif
@endsection
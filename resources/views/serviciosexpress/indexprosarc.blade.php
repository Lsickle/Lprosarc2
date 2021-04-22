@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('contentheader_title')
<span
    style="background-image: linear-gradient(40deg, #d4fc79, #00C851); padding-right:30vw; position:relative; overflow:hidden;">
    Servicios-Express
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
                    @if(in_array(Auth::user()->UsRol, Permisos::EXPRESS) || in_array(Auth::user()->UsRol, Permisos::EXPRESS))
                        <a href="serviciosexpress/create" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.create') }}</a>
                    @endif
                </div>
                <div class="box box-info">
                    <div class="box-body">
                        <div id="ModalStatus"></div>
                        <div id="ModalFacturar"></div>
                        <table id="SolicitudservicioTable" class="table table-compact table-bordered table-striped d-none">
                            <thead>
                                <tr>
                                    <th>{{trans('adminlte_lang::message.solsershowdateRPDA')}}</th>
                                    <th>N°</th>
                                    <th nowrap>Status</th>
                                    <th>{{trans('adminlte_lang::message.clientcliente')}}</th>
                                    <th>Contacto</th>
                                    <th>Dirección</th>
                                    <th>Cantidad</th>
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
                                        <td class="text-center">
                                        <a class='btn fixed_widthbtn btn-default' href="https://www.google.com/maps/dir/?api=1&destination={{$Servicio->SedeMapLat}},{{$Servicio->SedeMapLong}}&travelmode=car" target="_blank"><i class='fas fa-lg fa-hourglass-start'></i></a><br>{{$Servicio->SolSerStatus}}

                                        </td>
                                        @break
                                        @case('Aceptado')
                                        <td class="text-center">
                                        <a class='btn fixed_widthbtn btn-info' href="https://www.google.com/maps/dir/?api=1&destination={{$Servicio->SedeMapLat}},{{$Servicio->SedeMapLong}}&travelmode=car" target="_blank"><i class='fas fa-lg fa-thumbs-up'></i></a><br>{{$Servicio->SolSerStatus}}

                                        </td>
                                        @break
                                        @case('Aprobado')
                                        <td class="text-center">
                                        <a class='btn fixed_widthbtn btn-info' href="https://www.google.com/maps/dir/?api=1&destination={{$Servicio->SedeMapLat}},{{$Servicio->SedeMapLong}}&travelmode=car" target="_blank"><i class='fas fa-lg fa-tasks'></i></a><br>{{$Servicio->SolSerStatus}}

                                        </td>

                                        @break
                                        @case('Programado')
                                        <td class="text-center">
                                        <a class='btn fixed_widthbtn btn-success' href="https://www.google.com/maps/dir/?api=1&destination={{$Servicio->SedeMapLat}},{{$Servicio->SedeMapLong}}&travelmode=car" target="_blank"><i class='fas fa-lg fa-calendar-alt'></i></a><br>{{$Servicio->SolSerStatus}}

                                        </td>
                                        @break
                                        @case('Notificado')
                                        <td class="text-center">
                                        <a class='btn fixed_widthbtn btn-primary' href="https://www.google.com/maps/dir/?api=1&destination={{$Servicio->SedeMapLat}},{{$Servicio->SedeMapLong}}&travelmode=car" target="_blank"><i class='far fa-lg fa-envelope'></i></a><br>{{$Servicio->SolSerStatus}}

                                        </td>
                                        @break
                                        @case('Cancelado')
                                        @case('Recibido')
                                        <td class="text-center">
                                        <a class='btn fixed_widthbtn btn-danger' href="https://www.google.com/maps/dir/?api=1&destination={{$Servicio->SedeMapLat}},{{$Servicio->SedeMapLong}}&travelmode=car" target="_blank"><i class='fas fa-lg fa-calendar-times'></i></a><br>{{$Servicio->SolSerStatus}}

                                        </td>
                                        @break
                                        @case('Completado')
                                        <td class="text-center">
                                        <a class='btn fixed_widthbtn btn-success' href="https://www.google.com/maps/dir/?api=1&destination={{$Servicio->SedeMapLat}},{{$Servicio->SedeMapLong}}&travelmode=car" target="_blank"><i class='fas fa-lg fa-truck-loading'></i></a><br>{{$Servicio->SolSerStatus}}

                                        </td>
                                        @break
                                        @case('Conciliado')
                                        <td class="text-center">
                                        <a class='btn fixed_widthbtn btn-success' href="https://www.google.com/maps/dir/?api=1&destination={{$Servicio->SedeMapLat}},{{$Servicio->SedeMapLong}}&travelmode=car" target="_blank"><i class='fas fa-lg fa-balance-scale'></i></a><br>{{$Servicio->SolSerStatus}}

                                        </td>
                                        @break
                                        @case('No Conciliado')
                                        <td class="text-center">
                                        <a class='btn fixed_widthbtn btn-warning' href="https://www.google.com/maps/dir/?api=1&destination={{$Servicio->SedeMapLat}},{{$Servicio->SedeMapLong}}&travelmode=car" target="_blank"><i class='fas fa-lg fa-balance-scale-right'></i></a><br>{{$Servicio->SolSerStatus}}

                                        </td>
                                        @break
                                        @case('Corregido')
                                        <td class="text-center">
                                        <a class='btn fixed_widthbtn btn-success' href="https://www.google.com/maps/dir/?api=1&destination={{$Servicio->SedeMapLat}},{{$Servicio->SedeMapLong}}&travelmode=car" target="_blank"><i class='fas fa-lg fa-weight'></i></a><br>{{$Servicio->SolSerStatus}}

                                        </td>

                                        @break
                                        @case('Tratado')
                                        <td class="text-center">
                                        <a class='btn fixed_widthbtn btn-primary' href="https://www.google.com/maps/dir/?api=1&destination={{$Servicio->SedeMapLat}},{{$Servicio->SedeMapLong}}&travelmode=car" target="_blank"><i class='fas fa-lg fa-dumpster-fire'></i></a><br>{{$Servicio->SolSerStatus}}

                                        </td>
                                        @break
                                        @case('Facturado')
                                        <td class="text-center">
                                        <a class='btn fixed_widthbtn btn-default' href="https://www.google.com/maps/dir/?api=1&destination={{$Servicio->SedeMapLat}},{{$Servicio->SedeMapLong}}&travelmode=car" target="_blank"><i class='fas fas fa-lg fa-receipt'></i></a><br>{{$Servicio->SolSerStatus}}

                                        </td>
                                        @break
                                        @case('Certificacion')
                                        <td class="text-center">
                                        <a class='btn fixed_widthbtn btn-success' href="https://www.google.com/maps/dir/?api=1&destination={{$Servicio->SedeMapLat}},{{$Servicio->SedeMapLong}}&travelmode=car" target="_blank"><i class='fas fas fa-lg fa-certificate'></i></a><br>{{$Servicio->SolSerStatus}}

                                        </td>
                                        @break
                                        <b></b>
                                        @default
                                        <td class="text-center">
                                        <a class='btn fixed_widthbtn btn-primary' href="https://www.google.com/maps/dir/?api=1&destination={{$Servicio->SedeMapLat}},{{$Servicio->SedeMapLong}}&travelmode=car" target="_blank"><i class='fas fa-lg fa-ban'></i></a><br>{{$Servicio->SolSerStatus}}

                                        </td>

                                    @endswitch
                                    <td>{{$Servicio->CliName}}</td>
                                    <td>
                                        <ul>
                                            <li>{{$Servicio->PersFirstName}} {{$Servicio->PersLastName}}</li>
                                            <li>{{$Servicio->PersEmail}}</li>
                                            <li>{{$Servicio->PersCellphone}}</li>
                                        </ul>
                                    </td>
                                    <td>
                                        {{$Servicio->SolSerCollectAddress == null ? 'N/A' : $Servicio->SolSerCollectAddress}}
                                        @if ($Servicio->FK_SedeMun == 169)
                                        <br>
                                        Localidad: <b>{{$Servicio->SedeMapLocalidad}}</b>
                                        @endif
                                    </td>
                                    <td>{{$Servicio->totalrerspel}} Kg</td>
                                    <td style="text-align: center;"><a
                                            href='/serviciosexpress/{{$Servicio->SolSerSlug}}' class="btn btn-info"
                                            title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i
                                                class="fas fa-search"></i></a>
                                    </td>
                                    @if(in_array(Auth::user()->UsRol, Permisos::COMERCIALES) || in_array(Auth::user()->UsRol2, Permisos::COMERCIALES))
                                    @php
                                    $Status = ['Conciliado', 'Tratado'];
                                    @endphp
                                    <td>
                                        <button id="{{'buttonCertStatus'.$Servicio->SolSerSlug}}"
                                            onclick="ModalFacturacion('{{$Servicio->SolSerSlug}}', '{{$Servicio->ID_SolSer}}', '{{in_array($Servicio->SolSerStatus, $Status)}}', 'Facturada', 'facturar')"
                                            {{in_array($Servicio->SolSerStatus, $Status) ? '' :  'disabled'}}
                                            style="text-align: center;"
                                            class="{{'classFacturarStatus'.$Servicio->SolSerSlug}} btn btn-{{$Servicio->SolSerStatus == 'Facturado' ? 'default' : 'info'}}"><i class="fas fa-certificate"></i>
                                            {{'Facturar'}}</button>
                                    </td>
                                    @endif
                                    @if(in_array(Auth::user()->UsRol, Permisos::SolSerCertifi) || in_array(Auth::user()->UsRol2, Permisos::SolSerCertifi))
                                    @php
                                    $Status = ['Conciliado', 'Tratado', 'Facturado'];
                                    @endphp
                                    <td>
                                        <button id="{{'buttonCertStatus'.$Servicio->SolSerSlug}}"
                                            onclick="ModalCertificacion('{{$Servicio->SolSerSlug}}', '{{$Servicio->ID_SolSer}}', '{{in_array($Servicio->SolSerStatus, $Status)}}', 'Certificada', 'certificar')"
                                            {{in_array($Servicio->SolSerStatus, $Status) ? '' :  'disabled'}}
                                            style="text-align: center;"
                                            class="{{'classCertStatus'.$Servicio->SolSerSlug}} btn btn-{{$Servicio->SolSerStatus == 'Certificacion' ? 'default' : 'success'}}"><i
                                                class="fas fa-certificate"></i>
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
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">No, salir</button>
                                            <button type="button" id="buttonFacturarStatusOK`+slug+`" data-dismiss="modal" class='btn btn-success'>Si, acepto</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);
                        envsubmit();
                        $('#myModal').modal();
                        $('#buttonFacturarStatusOK'+slug).on( "click", function() {
                            $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                            });
                            $.ajax({
                            url: "{{url('/facturarservicio')}}/"+slug,
                            method: 'GET',
                            data:{},
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
                            },
                            error: function(error){
                                let buttonsubmit = $('.classFacturarStatus'+slug);
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
@endsection
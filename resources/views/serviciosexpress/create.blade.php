@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #d4fc79, #00C851); padding-right:30vw; position:relative; overflow:hidden;">
    Solicitudes Express
    <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-16 col-md-offset-0">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('adminlte_lang::message.solsertitlecreate') }}</h3>
                </div>

                <form role="form" id="CreateSolSer" action="/serviciosexpress" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <p>{{$error}}</p>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label>Cliente</label>
                                <small class="help-block with-errors">*</small>
                                <select id="FK_SolSerCliente" name="FK_SolSerCliente" class="form-control" required data-validate="true">
                                    <option value="">{{ trans('adminlte_lang::message.select') }}</option>
                                    @foreach ($Clientes as $Cliente)
                                    <option value="{{$Cliente->CliSlug}}">{{$Cliente->CliName.' ('.$Cliente->CliNit}})</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">{{'comprobante de pago'}}</label>
                            <small class="help-block with-errors">*</small>
                            <input type="file" class="form-control" id="pagoComprobante" name="pagoComprobante" type="file" data-validate="true" required data-filesize="2048" class="form-control" data-accept="jpg,jpe,png,jpeg,pdf" accept=".jpg,.jpe,.peg,.jpeg,.png,.pdf">
                        </div> --}}
                        <div class="form-group col-md-6">
                            <!-- image-preview-filename input [CUT FROM HERE]-->
                            <label for="exampleInputEmail1">{{'comprobante de pago'}}</label>
                            <small class="help-blockwith-errors">*</small>
                            <div class="input-group image-preview">
                                <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                <span class="input-group-btn">
                                    <!-- image-preview-clear button -->
                                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                        <i class="far fa-trash-alt"></i> Borrar
                                    </button>
                                    <!-- image-preview-input -->
                                    <div class="btn btn-default image-preview-input">
                                        <i class="fas fa-folder-open"></i>
                                        <span class="image-preview-input-title">Buscar</span>
                                        <input id="pagoComprobante" type="file" name="pagoComprobante" data-validate="true" required data-filesize="2048" class="form-control" data-accept="jpg,jpe,png,jpeg,pdf" accept=".jpg,.jpe,.peg,.jpeg,.png,.pdf" /> <!-- rename it -->
                                    </div>
                                </span>
                            </div><!-- /input-group image-preview [TO HERE]-->
                        </div>
                        <div class="form-group col-md-6">
                            <label>Sede</label>
                            <small class="help-block with-errors">*</small>
                            <select id="SedeSlug" name="SedeSlug" class="form-control" required data-validate="true">
                                <option value="">{{ trans('adminlte_lang::message.select') }}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fechadepago">{{'fecha de pago'}}</label>
                            <small class="help-block with-errors">*</small>
                            <input type="date" class="form-control" id="fechadepago" name="fechadepago" required value="{{date('Y-m-d')}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Referencia">{{'Referencia de la Transacción'}}</label>
                            <small class="help-block with-errors">*</small>
                            <input type="text" class="form-control" id="Referencia" name="Referencia" maxlength="30" required value="P-5000">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="montodepago">{{'monto de pago'}}</label>
                            <small class="help-block with-errors">*</small>
                            <input type="number" class="form-control" id="montodepago" name="montodepago" step=".1" min="0" required value="35000">
                        </div>
                        <div id="mediodepagoDiv" class="form-group col-md-3">
                            <label>medio de pago</label>
                            <small class="help-block with-errors">*</small>
                            <select class="form-control" id="mediodepago" name="mediodepago" required>
                                <option value="">seleccione...</option>
                                <option selected value="app nequi">app nequi</option>
                                <option value="app davivienda">app davivienda</option>
                                <option value="app daviplata">app daviplata</option>
                                <option value="transferencia davivienda">transferencia davivienda</option>
                                <option value="transferencia bancolombia">transferencia bancolombia</option>
                                <option value="transferencia avvillas">transferencia avvillas</option>
                                <option value="transferencia occidente">transferencia occidente</option>
                                <option value="deposito davivienda">deposito davivienda</option>
                                <option value="deposito bancolombia">deposito bancolombia</option>
                                <option value="deposito avvillas">deposito avvillas</option>
                                <option value="deposito occidente">deposito occidente</option>
                            </select>
                        </div>
                        <div id="SolServCantidadDiv" class="form-group col-md-3">
                            <label>N° de Servicios</label>
                            <small class="help-block with-errors">*</small>
                            <select class="form-control" id="SolServCantidad" name="SolServCantidad" required>
                                <option value="">seleccione...</option>
                                <option value="12">12</option>
                                <option value="6">6</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option selected value="1">1</option>
                            </select>
                        </div>
                        <div id="SolServFrecuenciaDiv" class="form-group col-md-3">
                            <label>Frecuencia de recolección</label>
                            <small class="help-block with-errors">*</small>
                            <select class="form-control" id="SolServFrecuencia" name="SolServFrecuencia" required>
                                <option value="">seleccione...</option>
                                <option value="semanal">semanal</option>
                                <option value="quincenal">quincenal</option>
                                <option selected value="mensual">mensual</option>
                                <option value="bimensual">bimensual</option>
                                <option value="trimestral">trimestral</option>
                                <option value="semestral">semestral</option>
                                <option value="anual">anual</option>
                            </select>
                        </div>
                        <div id="SolServTypeRecolectionDiv" class="form-group col-md-3">
                            <label>Tipo de recolección</label>
                            <small class="help-block with-errors">*</small>
                            <select class="form-control" id="SolServTypeRecolection" name="SolServTypeRecolection" required>
                                <option value="">seleccione...</option>
                                <option value="General">General</option>
                                <option value="Especifica">Especifica</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <center>
                                <label>Observaciones</label>
                                <button type="button" class="btn btn-box-tool boton" style="color: black;" data-toggle="collapse" data-target=".Observaciones" onclick="AnimationMenusForm('.Observaciones')" title="Reducir/Ampliar"><i class="fa fa-plus"></i></button>
                            </center>
                            <div class="form-group col-md-12 collapse Observaciones" style="margin-bottom: 1em; padding-left:0; padding-right:0;">
                                <small id="caracteresrestantes" class="help-block with-errors"></small>
                                <textarea onchange="updatecaracteres()" id="textDescription" rows="5" style="resize: vertical;" maxlength="4000" class="form-control col-xs-12" name="SolSerDescript"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="text-align: center;">
                        <hr style="border-color: green; border-width:2px;">
                        <b><a class="load"></a>{{ trans('adminlte_lang::message.solserrespelsend') }}<a class="load"></a></b>
                    </div>
                    <div id="Respels" class="col-md-12">
                        <input type="text" hidden name="SGenerador[0]" id="SGenerador">
                        <div id="DivRepel0" class="form-group col-md-16">
                        </div>
                    </div>
            </div>
            <div class="box-footer">
                <button type="submit" id="Submit2" class="btn btn-success pull-right">Solicitar</button>
                {{-- <button type="submit" form="CreateSolSer" id="Submit" class="btn btn-success pull-right" style="display: none;">vamos</button> --}}
            </div>
            </form>


        </div>
    </div>
</div>
</div>
@endsection
@section('NewScript')
<script>
    function Switch(){
	$("#SolSerBascula").bootstrapSwitch();
	$("#SolSerCapacitacion").bootstrapSwitch();
	$("#SolSerMasPerson").bootstrapSwitch();
	$("#SolSerVehicExclusive").bootstrapSwitch();
	$("#SolSerPlatform").bootstrapSwitch();
	$("#SolSerDevolucion").bootstrapSwitch();
}
Switch();
$(document).ready(function(){
	var area = document.getElementById("textDescription");
	var message = document.getElementById("caracteresrestantes");
	var maxLength = 4000;
	$('#textDescription').keyup(function updatecaracteres() {
		message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
	});
    $("#CreateSolSer").validator({
        html: true,
        delay: 500,
        submitButtons: '#Submit2',
        feedback: {
            success: '',
            error: ''
        },
        custom: {
            filesize: function($el) {
                var maxBytes = $el.data("filesize")*1024;
                if ($el[0].files[0] && $el[0].files[0].size > maxBytes) {
                    return "El archivo no debe pesar mas de " + maxBytes/1024/1024 + " MB.";
                }
            },
            filessizemultiple: function($el) {
                var maxBytes = $el.data("filessizemultiple")*1024;
                var max = 0;
                for (var i = 0; i < $el[0].files.length; i++) {
                    if ($el[0].files[i] && $el[0].files[i].size > maxBytes) {
                        return "El archivo ("+($el[0].files[i].name)+") no debe pesar mas de " + maxBytes/1024/1024 + " MB.";
                    }
                }
            },
            accept: function ($el){
                var permitido = $el.data("accept");
                if ($el[0].files[0]) {
                    var tipo = $el[0].files[0].type.split('/').pop();
                }else{
                    var tipo = "";
                }
                var existe = permitido.indexOf(tipo);
                if ($el[0].files[0] && existe <= 0) {
                    return "Las extensiones permitidas son: "+permitido;
                }
            },
        }
    });
})
// funcion para previsualizar la fotografia del soporte

$(document).on('click', '#close-preview', function(){
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
            $('.image-preview').popover('show');
        },
        function () {
            $('.image-preview').popover('hide');
        }
    );
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "Debe cargar el comprobante en formato pdf, png o jpg",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Buscar");
    });
    // Create the preview image
    $(".image-preview-input input:file").change(function (){
        var img = $('<embed/>', {
            id: 'dynamic',
            width:'100%',
            height:'auto'
        });
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Cambiar");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }
        reader.readAsDataURL(file);
    });
});
</script>
@include('serviciosexpress.layaoutsSolSer.functionsSolSerExpress')
@endsection

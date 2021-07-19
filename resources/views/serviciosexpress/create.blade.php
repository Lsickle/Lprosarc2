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

				<form role="form" id="CreateSolSer" action="/serviciosexpress" method="POST" enctype="multipart/form-data" data-toggle="validator">
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
								<select id="FK_SolSerCliente" name="FK_SolSerCliente" class="form-control" required="" data-validate="true">
									<option value="">{{ trans('adminlte_lang::message.select') }}</option>
									@foreach ($Clientes as $Cliente)
									<option value="{{$Cliente->CliSlug}}">{{$Cliente->CliName.' ('.$Cliente->CliNit}})</option>
									@endforeach
								</select>
							</div>
                            {{-- <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">{{'comprobante de pago'}}</label>
                                <small class="help-block with-errors">*</small>
                                <input type="file" class="form-control" id="pagoComprobante" name="pagoComprobante" type="file" data-validate="true" required data-filesize="2048" class="form-control" data-accept="jpg, jpe, png, jpeg, pdf" accept=".jpg,.jpe,.peg,.jpeg,.png,.pdf">
                            </div> --}}
                            <div class="form-group col-md-6">
                                <!-- image-preview-filename input [CUT FROM HERE]-->
                                <label for="exampleInputEmail1">{{'comprobante de pago'}}</label>
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
                                            <input id="pagoComprobante" type="file" name="pagoComprobante" data-validate="true" required data-filesize="2048" class="form-control" data-accept="jpg, jpe, png, jpeg, pdf" accept=".jpg,.jpe,.peg,.jpeg,.png,.pdf"/> <!-- rename it -->
                                        </div>
                                    </span>
                                </div><!-- /input-group image-preview [TO HERE]-->
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fechadepago">{{'fecha de pago'}}</label>
                                <small class="help-block with-errors">*</small>
                                <input type="date" class="form-control" id="fechadepago" name="fechadepago" required value="{{date('Y-m-d')}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="montodepago">{{'monto de pago'}}</label>
                                <small class="help-block with-errors">*</small>
                                <input type="number" class="form-control" id="montodepago" name="montodepago" step=".1" min="0" value="35000" required>
                            </div>
                            <div id="mediodepagoDiv" class="form-group col-md-6">
                                <label>medio de pago</label>
                                <small class="help-block with-errors">*</small>
                                <select class="form-control" id="mediodepago" name="mediodepago" required="">
                                    <option value="app nequi">app nequi</option>
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
							<div id="SolServCantidadDiv" class="form-group col-md-6">
								<label>N° de Servicios</label>
								<small class="help-block with-errors">*</small>
								<select class="form-control" id="SolServCantidad" name="SolServCantidad" required="">
									<option value="12">12</option>
									<option value="6">6</option>
									<option value="4">4</option>
									<option value="3">3</option>
									<option value="2">2</option>
									<option value="1">1</option>
								</select>
							</div>
							<div id="SolServFrecuenciaDiv" class="form-group col-md-6">
								<label>Frecuencia de recolección</label>
								<small class="help-block with-errors">*</small>
								<select class="form-control" id="SolServFrecuencia" name="SolServFrecuencia" required="">
									<option value="semanal">semanal</option>
									<option value="quincenal">quincenal</option>
									<option value="mensual">mensual</option>
									<option value="bimensual">bimensual</option>
									<option value="trimestral">trimestral</option>
									<option value="semestral">semestral</option>
									<option value="anual">anual</option>
								</select>
							</div>
							<div class="col-md-12">
								<center>
									<label>Observaciones</label>
									<button type="button" class="btn btn-box-tool boton" style="color: black;" data-toggle="collapse" data-target=".Observaciones" onclick="AnimationMenusForm('.Observaciones')" title="Reducir/Ampliar"><i class="fa fa-plus"></i></button>
								</center>
								<div class="form-group col-md-12 collapse Observaciones" style="margin-bottom: 1em; padding-left:0; padding-right:0;">
									<small id="caracteresrestantes" class="help-block with-errors"></small>
									<textarea onchange="updatecaracteres()" id="textDescription" rows ="5" style="resize: vertical;" maxlength="4000" class="form-control col-xs-12" name="SolSerDescript"></textarea>
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
						<a onclick="$('#Submit').hasClass('disabled') ? $('#Submit').click() : submitverify()" id="Submit2" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.applyfor') }}</a>
						<button type="submit" id="Submit" style="display: block;">vamos</button>
					</div>
					<div id="ModalSupport"></div>
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
function submitverify(){
	var tipoFacturacion = 'Credito';
	var CantidadTotalkg = 0;
	for (var i = 0; i < contadorGenerador; i++) {
		for (var y = 0; y <= contadorRespel[i]; y++) {
			if($("#SolResKgEnviado"+i+y).val() != null){
				CantidadTotalkg = parseInt(CantidadTotalkg)+parseInt($("#SolResKgEnviado"+i+y).val());
			}
		}
	}
	if(CantidadTotalkg != 0){
		if((CantidadTotalkg >= 0.5)||(tipoFacturacion=='Credito')){
			$("#Submit2").empty();
			$("#Submit2").append(`<i class="fas fa-sync fa-spin"></i> Enviando...`);
			$("#Submit2").attr('disabled', true);
			$('#Submit').click();
		}
		else{
			$('#ModalSupport').empty();
			$('#ModalSupport').append(`
				<div class="modal modal-default fade in" id="SupportPay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<div style="font-size: 5em; color: #f39c12; text-align: center; margin: auto;">
									<i class="fas fa-exclamation-triangle"></i>
									<span style="font-size: 0.3em; color: black;"><p>Su solicitud es inferior a 500kg adjunte el soporte de pago</p></span>
									<span style="font-size: 0.3em; color: black;"><p>Su solicitud es de <b>`+CantidadTotalkg+` kg</b></p></span>
								</div>
							</div>
							<div class="modal-header">
								<div class="form-group col-md-12">
									<label style="color: black; text-align: left;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsersupportpay') }}</b>" data-content="{{ trans('adminlte_lang::message.solsersupportpaydescript') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.solsersupportpay')}}</label>
									<small class="help-block with-errors"></small>
									<input name="SupportPay" type="file" data-filesize="5120" class="form-control" data-accept="pdf" accept=".pdf">
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">No, salir</button>
								<label for="Submit" class='btn btn-success'>Enviar</label>
							</div>
						</div>
					</div>
				</div>
			`);
			popover();
			$('#CreateSolSer').validator('update');
			envsubmit();
			$('#SupportPay').modal();
		}
	}
}
$(document).ready(function(){
	var area = document.getElementById("textDescription");
	var message = document.getElementById("caracteresrestantes");
	var maxLength = 4000;
	$('#textDescription').keyup(function updatecaracteres() {
		message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
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

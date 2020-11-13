@php
$collection2 = collect([]);
@endphp
@foreach($certificado->SolicitudServicio->SolicitudResiduo as $Residuo)
	@if($Residuo->requerimiento->FK_ReqTrata == $certificado->FK_CertTrat&&$Residuo->generespel->gener_sedes->ID_GSede == $certificado->FK_CertGenerSede)
		@if($Residuo->SolResRM2 !== null && is_Array($Residuo->SolResRM2))
			@foreach ($Residuo->SolResRM2 as $rm2 => $value2)
				@php
				$collection2 = $collection2->concat([$value2]);
				@endphp
			@endforeach
		@else
			@if (is_Array($Residuo->SolResRM))
				@foreach ($Residuo->SolResRM as $rm => $value)
					@php
						$collection2 = $collection2->concat([$value]);
					@endphp
				@endforeach
			@else
				@php
					$uniquestring = 'RM Invalido -> '.$Residuo->SolResRM;
				@endphp
			@endif
		@endif
	@endif
@endforeach
@php
if ($collection2->isNotEmpty()) {
	$unicos = collect($collection2->unique());
	$uniquestring = $unicos->values()->join(', ');
}
@endphp
<div id="">
		<div class="col-md-6 form-group has-feedback">
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>Tipo de documento<b>" data-content="Elija el tipo de documentos que corresponda para su creación…<br><ul>
				<li>Certificado Prosarc</li>
				<li>Manifiesto de envió</li>
				<li>Certificado externo (<b>Otros Gestores</b>)</li>
			</ul>">
				<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Tipo de documento
			</label>
			<small class="help-block with-errors">*</small>
			<select id="CertTypeSelect" name="CertType" class="form-control" required>
				<option value="">Seleccione...</option>
				<option {{($certificado->CertType == 0) ? 'selected' : ''}} value="0">Certificado Prosarc</option>
				<option {{($certificado->CertType == 1) ? 'selected' : ''}} value="1">Manifiesto de envió a Gestor</option>
				<option {{($certificado->CertType == 2) ? 'selected' : ''}} value="2">Certificado externo (otros gestores)</option>
			</select>
		</div>
		<div class="col-md-6 form-group">
			@switch($certificado->CertType)
				@case(0)
					<input style="display: none;" name="CertNumeroActual" value="{{$certificado->CertNumero}}">
					@if ($certificado->CertSrc != 'CertificadoDefault.pdf')
						<label id="labelGroupNumDoc">Número de Certificado Actual</label>
						<span id="numberValidateResponse">
							<small class="help-block with-errors" style="color:black;">Número de Certificado actual</small>
						</span>
						<div class="input-group" id="inputGroupNumDoc">
							{{-- <span class="input-group-addon" id="prefijo">M</span> --}}
						<input required oninput="verificarDuplicado()" min="35000" max="999999" id="docNumberInput" name="CertNumero" type="number" class="form-control" placeholder="Número del certificado" value="{{$certificado->CertNumero}}">
							<span class="btn btn-success input-group-addon" id="copiarNumero"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-copy fa-2x"></i> Copiar</span>
						</div>
					@else
						<label id="labelGroupNumDoc">Número de Certificado (Recomendado)</label>
						<div id="numberValidateResponse">
							<small class="help-block with-errors" style="color:black;">Siguiente Número de Certificado</small>
						</div>
						<div class="input-group" id="inputGroupNumDoc">
							{{-- <span class="input-group-addon" id="prefijo">M</span> --}}
							<input required oninput="verificarDuplicado()" min="35000" max="999999" id="docNumberInput" name="CertNumero" type="number" class="form-control" placeholder="Número del certificado" value="{{$proximoCertificado}}">
							<span class="btn btn-success input-group-addon" id="copiarNumero"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-copy fa-2x"></i> Copiar</span>
						</div>
					@endif

					@break
				@case(1)
					<input style="display: none;" name="CertNumeroActual" value="{{$certificado->CertManifNumero}}">
					@if ($certificado->CertSrcManif != 'CertificadoDefault.pdf')
						<label id="labelGroupNumDoc">Número de Manifiesto Actual</label>
						<span id="numberValidateResponse">
							<small class="help-block with-errors" style="color:black;">Número de Manifiesto actual</small>
						</span>
						<div class="input-group" id="inputGroupNumDoc">
							<span class="input-group-addon" id="prefijo">M</span>
							<input required oninput="verificarDuplicado()" min="2000" max="999999" id="docNumberInput" name="CertNumero" type="number" class="form-control" placeholder="Número del manifiesto" value="{{$certificado->CertManifNumero}}">
							<span class="btn btn-success input-group-addon" id="copiarNumero"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-copy fa-2x"></i> Copiar</span>
						</div>
					@else
						<label id="labelGroupNumDoc">Número de Manifiesto (Recomendado)</label>
						<span id="numberValidateResponse">
							<small class="help-block with-errors" style="color:black;">Siguiente Número de Manifiesto</small>
						</span>
						<div class="input-group" id="inputGroupNumDoc">
							<span class="input-group-addon" id="prefijo">M</span>
							<input required oninput="verificarDuplicado()" min="2000" max="999999" id="docNumberInput" name="CertNumero" type="number" class="form-control" placeholder="Número del manifiesto" value="{{$proximoManif}}">
							<span class="btn btn-success input-group-addon" id="copiarNumero"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-copy fa-2x"></i> Copiar</span>
						</div>
					@endif
					@break
				@case(2)
					@if ($certificado->CertSrcManif != 'CertificadoDefault.pdf')
						<label id="labelGroupNumDoc">Número de Certificado Externo Actual</label>
						<div class="input-group" id="inputGroupNumDoc">
							<span class="input-group-addon" id="prefijo">M</span>
						<input max="999999" id="docNumberInput" name="CertNumero" type="number" class="form-control" placeholder="Número del certificado externo" value="{{$certificado->CertNumeroExt}}">
							<span class="btn btn-success input-group-addon" id="copiarNumero"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-copy fa-2x"></i> Copiar</span>
						</div>
					@else
						<label id="labelGroupNumDoc">Número de Certificado Externo</label>
						<div class="input-group" id="inputGroupNumDoc">
							<span class="input-group-addon" id="prefijo">M</span>
							<input max="999999" id="docNumberInput" name="CertNumero" type="number" class="form-control" placeholder="Número del certificado externo" value="{{$proximoManif}}">
							<span class="btn btn-success input-group-addon" id="copiarNumero"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-copy fa-2x"></i> Copiar</span>
						</div>
					@endif
					@break
				@default

					<label>Número</label>
					<div class="input-group" id="inputGroupNumDoc">
						{{-- <span class="input-group-addon" id="prefijo">M</span> --}}
						<input max="999999" id="docNumberInput" name="CertNumero" type="number" class="form-control" placeholder="Número del certificado" value="">
						<span class="btn btn-success input-group-addon" id="copiarNumero"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-copy fa-2x"></i> Copiar</span>
					</div>
					
			@endswitch
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label>Observación</label>
			<input maxlength="200" name="CertObservacion" type="text" class="form-control" placeholder="campo de observación" value="{{$certificado->CertObservacion}}">
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label>Codigo</label>
			<div class="input-group" id="divQrCode">
				<input id="inputQrCode" readonly  type="text" class="form-control" placeholder="Clave para generar codigo QR" value="https://sispro.prosarc.com/img/Certificados/{{$certificado->CertSlug}}.pdf">
				<span class="btn btn-success input-group-addon" id="copiarURL"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-copy fa-2x"></i> Copiar</span>
			</div>
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label># Recibo de materiales</label>
			<input maxlength="128" name="CertNumRm" type="text" class="form-control" placeholder="Numero de Recibo de materiales" value="{{$uniquestring}}">
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label id="srcLabel">Archivo Pdf del Certificado</label>
			<small class="help-block with-errors"></small>
			<div class="input-group">
			<input name="CertSrc" {{($certificado->CertAuthJo == 0||$certificado->CertAuthJl == 0||$certificado->CertAuthDp == 0) ? '' : 'disabled'}} type="file" data-filesize="5120" class="form-control" data-accept="pdf" accept=".pdf">
				<div class="input-group-btn">
					@if($certificado->CertSrc == 'CertificadoDefault.pdf')
					<a class='btn btn-default'><i class='fas fa-file-pdf fa-lg'></i></a>
					@else
					<a method='get' href='/img/Certificados/{{$certificado->CertSrc}}' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
					@endif
				</div>
			</div>
		</div>
		<div class="col-md-6 form-group has-feedback">
			<div class="input-group copyable" id="inputQR">
				<img src="{{$qrCode->writeDataUri()}}" alt="" id="inputQrImg">
				<span class="btn btn-primary" id="copiarQR"><i style="font-size: 1.8rem; color: white;" class="fas fa-copy fa-2x"></i>Copiar QR</span>
			</div>
		</div>
</div>
@section('NewScript')
<script type="text/javascript">
	$(document).ready(function(){
		$("#CertTypeSelect").change(function(e){
			id=$("#CertTypeSelect").val();
			e.preventDefault();
			if (id == 2) {
				$("#prefijo").remove();
				$("#docNumberInput").val('');
				$("#labelGroupNumDoc").empty();
				$("#labelGroupNumDoc").prepend('Número de Certificado Externo');
				$("#srcLabel").empty();
				$("#srcLabel").prepend('Archivo Pdf del Certificado Externo');
				$("#docNumberInput").attr('placeholder','Número de Certificado Externo');
				$("#inputQrCode").val('https://sispro.prosarc.com/img/CertificadosEXT/{{$certificado->CertSlug}}.pdf');
		 	} else {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
					}
				});
				$.ajax({
					url: "{{url('/doc-number')}}/"+id,
					method: 'GET',
					data:{},
					beforeSend: function(){
						$(".load").append('<i class="fas fa-sync-alt fa-spin"></i>');
						$("#docNumberInput").prop('disabled', true);
					},
					success: function(res){
						$("#docNumberInput").empty();
						switch (id) {
							case '0':
								$("#labelGroupNumDoc").empty();
								$("#labelGroupNumDoc").prepend('Número de Certificado (Recomendado)');
								$("#srcLabel").empty();
								$("#srcLabel").prepend('Archivo Pdf del Certificado');
								$("#prefijo").remove();
								$("#docNumberInput").val(res);
								$("#docNumberInput").attr('placeholder','Número de Certificado');
								$("#inputQrCode").val('https://sispro.prosarc.com/img/Certificados/{{$certificado->CertSlug}}.pdf');
								break;
							case '1':
								$("#labelGroupNumDoc").empty();
								$("#labelGroupNumDoc").prepend('Número de Manifiesto (Recomendado)');
								$("#srcLabel").empty();
								$("#srcLabel").prepend('Archivo Pdf del Manifiesto');
								$("#inputGroupNumDoc").prepend('<span class="input-group-addon" id="prefijo">M</span>');
								$("#docNumberInput").attr('placeholder','Número de Manifiesto');
								$("#docNumberInput").val(res);
								$("#inputQrCode").val('https://sispro.prosarc.com/img/Manifiestos/{{$certificado->CertSlug}}.pdf');
								break;
							default:
								$("#labelGroupNumDoc").empty();
								$("#labelGroupNumDoc").prepend('Número de Documento');
								$("#docNumberInput").val('');
								break;
						}
					},
					complete: function(){
						$(".load").empty();
						$("#docNumberInput").prop('disabled', false);
						verificarDuplicado();
					}
				})
			}
			
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#copiarNumero").click(function(e){
			id=$("#CertTypeSelect").val();
			e.preventDefault();
			copiarCertNum("docNumberInput", id);
		});
	});
	$(document).ready(function(){
		$("#copiarURL").click(function(e){
			id=$("#inputQrCode").val();
			e.preventDefault();
			copiarURL("inputQrCode");
		});
	});
	$(".copyable").click(function (e) {
		$(this).attr("contenteditable", true);
		SelectText($(this).get(0));
		document.execCommand('copy');
		window.getSelection().removeAllRanges();
		$(this).removeAttr("contenteditable");
		NotifiTrue('Qr Copiado');
	});
</script>
<script type="text/javascript">
	function copiarCertNum(id_elemento, tipo) {
		var aux = document.createElement("input");
		switch (tipo) {
			case '0':
			aux.setAttribute("value", document.getElementById(id_elemento).value);
			var Mensaje = "¡Número de Certificado Copiado!";
				break;

			case '1':
			aux.setAttribute("value", 'M'+document.getElementById(id_elemento).value);
			var Mensaje = "¡Número de Manifiesto Copiado!";
				break;

			case '2':
			aux.setAttribute("value", document.getElementById(id_elemento).value);
			var Mensaje = "¡Número de Certificado Externo Copiado!";
				break;

			default:
				break;
		}
		document.body.appendChild(aux);
		aux.select();
		document.execCommand("copy");
		document.body.removeChild(aux);
		NotifiTrue(Mensaje);
	}
	function copiarURL(id_elemento) {
		var qrCode = document.createElement("input");
		qrCode.setAttribute("value", document.getElementById(id_elemento).value);
		var Mensaje2 = "¡URL para CódigoQR Copiada!";
		document.body.appendChild(qrCode);
		qrCode.select();
		document.execCommand("copy");
		document.body.removeChild(qrCode);
		NotifiTrue(Mensaje2);
	}
	function SelectText(element) {
		var doc = document;
		if (doc.body.createTextRange) {
			var range = document.body.createTextRange();
			range.moveToElementText(element);
			range.select();
		} else if (window.getSelection) {
			var selection = window.getSelection();
			var range = document.createRange();
			range.selectNodeContents(element);
			selection.removeAllRanges();
			selection.addRange(range);
		}
	}
</script>
<script>
	function verificarDuplicado() {
		var numero = $("#docNumberInput").val();
		var type = $("#CertTypeSelect").val();
		var certNumero = {{$certificado->CertNumero}};
		var certManifNumero = {{$certificado->CertManifNumero}};

		switch (type) {
			case '0':
			var	longitudNumero = 5;
			var numeroActual = certNumero;
			var NombreDoc = 'Certificado';
				break;

			case '1':
			var	longitudNumero = 4;
			var numeroActual = certManifNumero;
			var NombreDoc = 'Manifiesto';
				break;

			default:
				break;
		}
		if ((numero.length >= longitudNumero) && (numero != numeroActual)) {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});
			$.ajax({
				url: "{{url('/verificarduplicado')}}/"+numero+"/"+type,
				method: 'GET',
				data:{},
				beforeSend: function(){
					$("#labelGroupNumDoc").append(' <i class="fas fa-sync-alt fa-spin" style="color:black;"></i>');
					$("#docNumberInput").prop('disabled', true);
				},
				success: function(numeroexiste){
					$("#numberValidateResponse").empty();
					if (numeroexiste==true) {
						$("#numberValidateResponse").prepend('<small class="help-block with-errors" style="color:red;">OJO: Número de '+NombreDoc+' ya esta en uso</small>');
					}else{
						$("#numberValidateResponse").prepend('<small class="help-block with-errors" style="color:green;">Número de '+NombreDoc+' Disponible</small>');
					}
				},
				complete: function(){
					$(".fa-sync-alt").remove();
					$("#docNumberInput").prop('disabled', false);
					$("#docNumberInput").focus();
				}
			})
		} else if(numero == numeroActual){
			$("#numberValidateResponse").empty();
			$("#numberValidateResponse").prepend('<small class="help-block with-errors" style="color:black;">Número  de '+NombreDoc+' actual</small>');
		} else{
			$("#numberValidateResponse").empty();
			$("#numberValidateResponse").prepend('<small class="help-block with-errors" style="color:red;">El Número  de '+NombreDoc+' debe ser de '+longitudNumero+' digitos</small>');
		}
		$("#docNumberInput").focus();
		// $("#docNumberInput").select();
	}
</script>
@endsection

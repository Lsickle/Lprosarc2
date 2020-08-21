<div id="">
	{{-- <div id="form-step-0" role="form" data-toggle="validator"> --}}
		{{-- <div class="col-md-6 form-group has-feedback">
			<label>Tipo</label>
			<input maxlength="128" name="CertType" type="text" class="form-control" placeholder="Nombre del Residuo" value="{{$certificado->CertType}}">
		</div> --}}
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
				<option value="0">Certificado Prosarc</option>
				<option value="1">Manifiesto de envió a Gestor</option>
				<option value="2">Certificado externo (otros gestores)</option>
			</select>
		</div>
		<div class="col-md-6 form-group">
			<label>Número</label>
			<div class="input-group" id="inputGroupNumDoc">
				{{-- <span class="input-group-addon" id="prefijo">M</span> --}}
				<input max="999999" id="docNumberInput" name="CertNumero" type="number" class="form-control" placeholder="Número del certificado" value="">
				<span class="btn btn-success input-group-addon" id="copiarNumero"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-copy fa-2x"></i> Copiar</span>
			</div>
		</div>

		<div class="col-md-6 form-group has-feedback">
			<label>Dato especial</label>
			<input maxlength="32" name="CertiEspName" type="text" class="form-control" placeholder="Dato especial según requerimiento del cliente" value="{{$certificado->CertiEspName}}">
		</div>

		<div class="col-md-6 form-group has-feedback">
			<label>Valor del Dato especial</label>
			<input maxlength="32" name="CertiEspValue" type="text" class="form-control" placeholder="Valor del Dato especial" value="{{$certificado->CertiEspValue}}">
		</div>

		<div class="col-md-6 form-group has-feedback">
			<label>Observación</label>
			<input maxlength="200" name="CertObservacion" type="text" class="form-control" placeholder="campo de observación" value="{{$certificado->CertObservacion}}">
		</div>

		<div class="col-md-6 form-group has-feedback">
			<label>Codigo</label>
			<input readonly  type="text" class="form-control" placeholder="Clave para generar codigo QR" value="https://sispro.prosarc.com/img/Certificados/{{$certificado->CertSlug}}.pdf">
		</div>

		<div class="col-md-6 form-group has-feedback">
			<label># Recibo de materiales</label>
			<input maxlength="128" name="CertNumRm" type="text" class="form-control" placeholder="Numero de Recibo de materiales" value="@foreach($certificado->SolicitudServicio->SolicitudResiduo as $Residuo) @if($Residuo->requerimiento->FK_ReqTrata == $certificado->FK_CertTrat){{$Residuo->SolResRM}}, @endif @endforeach">
		</div>

		<div class="col-md-6 form-group has-feedback">
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 200}' title="<b>CertSrc</b>" data-content="{{ trans('adminlte_lang::LangRespel.tarjetapopoverinfo') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Pdf del Certificado</label>
			<small class="help-block with-errors">*</small>
			<div class="input-group">
				<input name="CertSrc" type="file" data-filesize="5120" class="form-control" data-accept="pdf" accept=".pdf">
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
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>CertAnexo</b>" data-content="{{ trans('adminlte_lang::LangRespel.tarjetapopoverinfo') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Anexos del certificado</label>
			<small class="help-block with-errors">*</small>
			<div class="input-group">
				<input  type="file" data-filesize="5120" class="form-control" data-accept="pdf" accept=".pdf">
				<div class="input-group-btn">
					<a method='get' href='/img/TarjetaEmergencia/' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
				</div>
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
						console.log(res);
						$("#docNumberInput").empty();
						switch (id) {
							case '0':
								$("#prefijo").remove();
								$("#docNumberInput").val(res);
								break;
							case '1':
								$("#inputGroupNumDoc").prepend('<span class="input-group-addon" id="prefijo">M</span>');
								$("#docNumberInput").val(res);
								break;
							default:
								$("#docNumberInput").val('');
								break;
						}
					},
					complete: function(){
						$(".load").empty();
						$("#docNumberInput").prop('disabled', false);
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
</script>
<script type="text/javascript">
	function copiarCertNum(id_elemento, tipo) {
		var aux = document.createElement("input");
		switch (tipo) {
			case '0':
			aux.setAttribute("value", document.getElementById(id_elemento).value);
				break;

			case '1':
			aux.setAttribute("value", 'M'+document.getElementById(id_elemento).value);
				break;

			case '2':
			aux.setAttribute("value", document.getElementById(id_elemento).value);
				break;

			default:
				break;
		}
		document.body.appendChild(aux);
		aux.select();
		document.execCommand("copy");
		document.body.removeChild(aux);
		var Mensaje = "¡Texto Copiado!";
		NotifiTrue(Mensaje);
	}
	
	</script>
@endsection

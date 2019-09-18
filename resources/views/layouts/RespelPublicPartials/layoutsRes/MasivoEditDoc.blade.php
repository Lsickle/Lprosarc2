<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Certificado de Registro</b>" data-content="<p style='width: 50%'>Debe Anexar el documento <b>Certificado de Registro</b> en formato PDF</p>"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Certificado de Registro</label>
<small class="help-block with-errors">*</small>
@if($Respels->SustanciaControladaTipo === 1)
<div class="input-group">
	<input value="{{$Respels->SustanciaControladaDocumento}}" name="SustanciaControladaDocumento" type="file" class="form-control" id="sustanciaFormFile0" data-filesize="2048" accept=".pdf">
	<div class="input-group-btn">
		<a method='get' href='/img/SustanciaControlDoc/{{$Respels->SustanciaControladaDocumento}}' target='_blank' class='btn btn-success'> <i class="fas fa-file-pdf fa-lg"></i></a>
	</div>
</div>
@else
	<input value="{{$Respels->SustanciaControladaDocumento}}" name="SustanciaControladaDocumento" type="file" class="form-control" id="sustanciaFormFile0" data-filesize="2048" accept=".pdf">
@endif
<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Certificado de carencia</b>" data-content="<p style='width: 50%'>Debe Anexar el documento <b>Certificado de Carencia</b> en formato PDF</p>"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Certificado de Carencia </label>
<small class="help-block with-errors">*</small>
@if($Respels->PSustanciaControladaTipo === 0)
<div class="input-group">
	<input name="SustanciaControladaDocumento" type="file" data-filesize="2048" id="sustanciaFormFile0" class="form-control" accept=".pdf">
	<div class="input-group-btn">
		<a method='get' href='/img/SustanciaControlDoc/{{$Respels->PSustanciaControladaDocumento}}' target='_blank' class='btn btn-success'> <i class="fas fa-file-pdf fa-lg"></i></a>
	</div>
</div>
@else
	<input name="SustanciaControladaDocumento" type="file" data-filesize="2048" id="sustanciaFormFile0" class="form-control" accept=".pdf">
@endif

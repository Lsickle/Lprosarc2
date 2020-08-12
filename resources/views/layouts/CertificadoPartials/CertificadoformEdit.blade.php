<div id="">
	{{-- <div id="form-step-0" role="form" data-toggle="validator"> --}}
		{{-- <div class="col-md-6 form-group has-feedback">
			<label>Tipo</label>
			<input maxlength="128" name="CertType" type="text" class="form-control" placeholder="Nombre del Residuo" value="{{$certificado->CertType}}">
		</div> --}}
		<div class="col-md-6 form-group has-feedback">
			<label>Número</label>
			<input disabled maxlength="5" name="CertNumero" type="text" class="form-control" placeholder="Nombre del certificado" value="{{$certificado->CertNumero}}">
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

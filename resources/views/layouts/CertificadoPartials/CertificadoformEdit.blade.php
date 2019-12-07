<div id="">
	{{-- <div id="form-step-0" role="form" data-toggle="validator"> --}}
		<div class="col-md-6 form-group has-feedback">
			<label>Tipo</label>
			<input maxlength="128" name="RespelName" type="text" class="form-control" placeholder="Nombre del Residuo" required value="">
		</div>
		<div class="col-md-6 form-group has-feedback">
			<label>Número</label>
			<input maxlength="128" name="RespelName" type="text" class="form-control" placeholder="Nombre del Residuo" required value="">
		</div>

		<div class="col-md-6 form-group has-feedback">
			<label>CertiEspName</label>
			<input maxlength="128" name="RespelName" type="text" class="form-control" placeholder="Nombre del Residuo" required value="">
		</div>

		<div class="col-md-6 form-group has-feedback">
			<label>CertiEspValue</label>
			<input maxlength="128" name="RespelName" type="text" class="form-control" placeholder="Nombre del Residuo" required value="">
		</div>

		<div class="col-md-6 form-group has-feedback">
			<label>CertObservacion</label>
			<input maxlength="128" name="RespelName" type="text" class="form-control" placeholder="Nombre del Residuo" required value="">
		</div>

		<div class="col-md-6 form-group has-feedback">
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>CertSrc</b>" data-content="{{ trans('adminlte_lang::LangRespel.tarjetapopoverinfo') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>CertSrc</label>
			<small class="help-block with-errors">*</small>
			<div class="input-group">
				<input name="RespelTarj" type="file" data-filesize="5120" class="form-control" data-accept="pdf" accept=".pdf">
				<div class="input-group-btn">
					<a method='get' href='/img/TarjetaEmergencia/' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
				</div>
			</div>
		</div>

		<div class="col-md-6 form-group has-feedback">
			<label>CertSlug</label>
			<input maxlength="128" name="RespelName" type="text" class="form-control" placeholder="Nombre del Residuo" required value="">
		</div>

		<div class="col-md-6 form-group has-feedback">
			<label>CertNumRm</label>
			<input maxlength="128" name="RespelName" type="text" class="form-control" placeholder="Nombre del Residuo" required value="">
		</div>

		<div class="col-md-6 form-group has-feedback">
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>CertAnexo</b>" data-content="{{ trans('adminlte_lang::LangRespel.tarjetapopoverinfo') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>CertAnexo</label>
			<small class="help-block with-errors">*</small>
			<div class="input-group">
				<input name="RespelTarj" type="file" data-filesize="5120" class="form-control" data-accept="pdf" accept=".pdf">
				<div class="input-group-btn">
					<a method='get' href='/img/TarjetaEmergencia/' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
				</div>
			</div>
		</div>
</div>

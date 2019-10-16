<div id="Respels">
	<div id="Residuo">
	{{-- input de la tarjeta de emergencia --}}
			<div class="col-md-12 form-group has-feedback">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="<b>{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}</b>" data-content="{{ trans('adminlte_lang::LangRespel.tarjetapopoverinfo') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::LangRespel.tarjetaemergencia') }}</label>
				<small class="help-block with-errors">*</small>
				@if($Respels->RespelTarj!=='RespelTarjetaDefault.pdf')
				<div class="input-group">
					<input name="RespelTarj" type="file" data-filesize="5120" class="form-control" data-accept="pdf" accept=".pdf">
					<div class="input-group-btn">
						<a method='get' href='/img/TarjetaEmergencia/{{$Respels->RespelTarj}}' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
					</div>
				</div>
				@else
				<div class="input-group">
					<input name="RespelTarj" type="file" data-filesize="5120" class="form-control" data-accept="pdf" accept=".pdf">
					<div class="input-group-btn">
						<a method='get' target='_blank' class='btn btn-default'><i class='fas fa-ban fa-lg'></i></a>
					</div>
				</div>	
				@endif
			</div>
	</div>
</div>

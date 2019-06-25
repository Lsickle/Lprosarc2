<div class="box-tools col-md-12 collapse in Respel`+id_div+`">
	<button type="button" class="btn btn-box-tool boton pull-right" style="color: red; font-size: 1.3em;" onclick="RemoveRespel(`+id_div+`,`+contadorRespel[id_div]+`)" title="Eliminar"><i class="fa fa-times"></i></button>
</div>
<div id="Repel`+id_div+contadorRespel[id_div]+`" class="col-md-12 box box-warning collapse in Respel`+id_div+`">
	<div class="form-group col-md-16">
		<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserrespel') }}</b>" data-content="{{ trans('adminlte_lang::message.solserrespeldescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solserrespel') }}</label>
		<a class="loadrespelnew`+id_div+contadorRespel[id_div]+`"></a>
		<button type="button" class="btn btn-box-tool boton" style="color: #f39c12;" data-toggle="collapse" data-target=".ContentRespel`+id_div+contadorRespel[id_div]+`" onclick="AnimationMenusForm('.ContentRespel`+id_div+contadorRespel[id_div]+`')" title="Reducir/Ampliar"> <i class="fa fa-minus"></i></button>
		<small class="help-block with-errors">*</small>
		<select name="FK_SolResRg[`+id_div+`][]" id="FK_SolResRg`+id_div+contadorRespel[id_div]+`" class="form-control" required="">
		</select>
	</div>
	<div id="RespelData`+id_div+contadorRespel[id_div]+`">
		<div class="form-group col-md-6 collapse in ContentRespel`+id_div+contadorRespel[id_div]+`">
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsertypeunidad') }}</b>" data-content="{{ trans('adminlte_lang::message.solsertypeunidaddescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solsertypeunidad') }}</label>
			<select name="SolResTypeUnidad[`+id_div+`][]" id="SolResTypeUnidad`+id_div+contadorRespel[id_div]+`" class="form-control">
				<option value="">{{ trans('adminlte_lang::message.select') }}</option>
				<option value="99">{{ trans('adminlte_lang::message.solserunidad1') }}</option>
				<option value="98">{{ trans('adminlte_lang::message.solserunidad2') }}</option>
			</select>
		</div>
		<div class="form-group col-md-6 collapse in ContentRespel`+id_div+contadorRespel[id_div]+`">
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsercantidad') }}</b>" data-content="{{ trans('adminlte_lang::message.solsercantidaddescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solsercantidad') }}</label>
			<input type="text" class="form-control numberKg" id="SolResCantiUnidad`+id_div+contadorRespel[id_div]+`" name="SolResCantiUnidad[`+id_div+`][]">
		</div>
		<div class="form-group col-md-6 collapse in ContentRespel`+id_div+contadorRespel[id_div]+`">
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsercantidadkg') }}</b>" data-content="{{ trans('adminlte_lang::message.solsercantidadkgdescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solsercantidadkg') }}</label>
			<small class="help-block with-errors">*</small>
			<input type="text" class="form-control numberKg" id="SolResKgEnviado`+id_div+contadorRespel[id_div]+`" name="SolResKgEnviado[`+id_div+`][]" required="">
		</div>
		<div class="form-group col-md-6 collapse in ContentRespel`+id_div+contadorRespel[id_div]+`">
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserembaja') }}</b>" data-content="{{ trans('adminlte_lang::message.solserembajadescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solserembaja') }}</label>
			<small class="help-block with-errors">*</small>
			<select name="SolResEmbalaje[`+id_div+`][]" id="SolResEmbalaje`+id_div+contadorRespel[id_div]+`" class="form-control" required="">
				<option value="">{{ trans('adminlte_lang::message.select') }}</option>
				<option value="99">{{ trans('adminlte_lang::message.solserembaja1') }}</option>
				<option value="98">{{ trans('adminlte_lang::message.solserembaja2') }}</option>
				<option value="97">{{ trans('adminlte_lang::message.solserembaja3') }}</option>
				<option value="96">{{ trans('adminlte_lang::message.solserembaja4') }}</option>
				<option value="95">{{ trans('adminlte_lang::message.solserembaja5') }}</option>
				<option value="94">{{ trans('adminlte_lang::message.solserembaja6') }}</option>
				<option value="93">{{ trans('adminlte_lang::message.solserembaja7') }}</option>
				<option value="92">{{ trans('adminlte_lang::message.solserembaja8') }}</option>
				<option value="91">{{ trans('adminlte_lang::message.solserembaja9') }}</option>
				<option value="90">{{ trans('adminlte_lang::message.solserembaja10') }}</option>
				<option value="89">{{ trans('adminlte_lang::message.solserembaja11') }}</option>
				<option value="88">{{ trans('adminlte_lang::message.solserembaja12') }}</option>
			</select>
		</div>
		<div class="form-group col-md-16 collapse in ContentRespel`+id_div+contadorRespel[id_div]+`" style="text-align: center;">
			<div class="form-group col-md-12">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserdimension') }}</b>" data-content="{{ trans('adminlte_lang::message.solserdimensiondescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solserdimension') }}</label>
			</div>
			<div class="form-group col-md-4">
				<label for="SolResAlto`+id_div+contadorRespel[id_div]+`">{{ trans('adminlte_lang::message.solserdimension1') }}</label>
				<input type="text" class="form-control numberDimension" id="SolResAlto`+id_div+contadorRespel[id_div]+`" name="SolResAlto[`+id_div+`][]">
			</div>
			<div class="form-group col-md-4">
				<label for="SolResAncho`+id_div+contadorRespel[id_div]+`">{{ trans('adminlte_lang::message.solserdimension2') }}</label>
				<input type="text" class="form-control numberDimension" id="SolResAncho`+id_div+contadorRespel[id_div]+`" name="SolResAncho[`+id_div+`][]">
			</div>
			<div class="form-group col-md-4">
				<label for="SolResProfundo`+id_div+contadorRespel[id_div]+`">{{ trans('adminlte_lang::message.solserdimension3') }}</label>
				<input type="text" class="form-control numberDimension" id="SolResProfundo`+id_div+contadorRespel[id_div]+`" name="SolResProfundo[`+id_div+`][]">
			</div>
		</div>
		<div class="form-group col-md-12 collapse in ContentRespel`+id_div+contadorRespel[id_div]+`" style="text-align: center;">
			<div class="form-group col-md-12">
				<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.requirements') }}</b>" data-content="{{ trans('adminlte_lang::message.requirementsdescript') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.requirements') }}</label>
				<a class="loadrequired`+id_div+contadorRespel[id_div]+`"></a>
			</div>
			<div class="form-group col-md-6" style="border: 2px dashed #00c0ef">
				<div class="form-group col-md-6">
					<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.requiredescarguephoto') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.requiredescarguephotodescrit') }}</p>">
						<label for="SolResFotoDescargue_Pesaje`+id_div+contadorRespel[id_div]+`">{{ trans('adminlte_lang::message.requiredescarguephoto') }}</label>
						<a class="loadrequired`+id_div+contadorRespel[id_div]+`"></a>
						<div style="width: 100%; height: 34px;">
							<input type="checkbox" class="fotoswitch" id="SolResFotoDescargue_Pesaje`+id_div+contadorRespel[id_div]+`" data-name="SolResFotoDescargue_Pesaje1`+id_div+contadorRespel[id_div]+`"/>
							<input type="text" id="SolResFotoDescargue_Pesaje1`+id_div+contadorRespel[id_div]+`" name="SolResFotoDescargue_Pesaje[`+id_div+`][]" hidden value="0">
						</div>
					</label>
				</div>
				<div class="form-group col-md-6">
					<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.requiretratamientophoto') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.requiretratamientophotodescrit') }}</p>">
						<label for="SolResFotoTratamiento`+id_div+contadorRespel[id_div]+`">{{ trans('adminlte_lang::message.requiretratamientophoto') }}</label>
						<div style="width: 100%; height: 34px;">
							<input type="checkbox" class="fotoswitch" id="SolResFotoTratamiento`+id_div+contadorRespel[id_div]+`" value="0" data-name="SolResFotoTratamiento1`+id_div+contadorRespel[id_div]+`"/>
							<input type="text" id="SolResFotoTratamiento1`+id_div+contadorRespel[id_div]+`" name="SolResFotoTratamiento[`+id_div+`][]" hidden value="0">
						</div>
					</label>
				</div>
			</div>
			<div class="form-group col-md-6" style="border: 2px dashed #00c0ef">
				<div class="form-group col-md-6">
					<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.requiredescarguevideo') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.requiredescarguevideodescrit') }}</p>">
						<label for="SolResVideoDescargue_Pesaje`+id_div+contadorRespel[id_div]+`">{{ trans('adminlte_lang::message.requiredescarguevideo') }}</label>
						<div style="width: 100%; height: 34px;">
							<input type="checkbox" class="videoswitch" id="SolResVideoDescargue_Pesaje`+id_div+contadorRespel[id_div]+`" data-name="SolResVideoDescargue_Pesaje1`+id_div+contadorRespel[id_div]+`"/>
							<input type="text" id="SolResVideoDescargue_Pesaje1`+id_div+contadorRespel[id_div]+`" name="SolResVideoDescargue_Pesaje[`+id_div+`][]" hidden value="0">
						</div>
					</label>
				</div>
				<div class="form-group col-md-6">
					<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.requiretratamientovideo') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.requiretratamientovideodescrit') }}</p>">
						<label for="SolResVideoTratamiento`+id_div+contadorRespel[id_div]+`">{{ trans('adminlte_lang::message.requiretratamientovideo') }}</label>
						<div style="width: 100%; height: 34px;">
							<input type="checkbox" class="videoswitch" id="SolResVideoTratamiento`+id_div+contadorRespel[id_div]+`" data-name="SolResVideoTratamiento1`+id_div+contadorRespel[id_div]+`"/>
							<input type="text" id="SolResVideoTratamiento1`+id_div+contadorRespel[id_div]+`" name="SolResVideoTratamiento[`+id_div+`][]" hidden value="0">
						</div>
					</label>
				</div>
			</div>
		</div>
		<br>
	</div>
</div>
<div class="box-tools col-md-12">
	<button type="button" class="btn btn-box-tool pull-right" style="color: red; font-size: 1.3em;" onclick="RemoveRespel(`+id_div+`,`+contadorRespel[id_div]+`)" title="Eliminar"><i class="fa fa-times"></i></button>
</div>
<div id="Repel`+id_div+contadorRespel[id_div]+`" class="col-md-12 box box-warning">
	<div class="form-group col-md-16">
		<label for="FK_SolResRg`+id_div+contadorRespel[id_div]+`">Residuo</label>
		<button type="button" class="btn btn-box-tool" style="color: #f39c12;" data-toggle="collapse" data-target="#RespelData`+id_div+contadorRespel[id_div]+`" title="Reducir/Ampliar"><i class="fas fa-arrows-alt-v"></i></button>
		<small class="help-block with-errors">*</small>
		<select name="FK_SolResRg[`+id_div+`][]" id="FK_SolResRg`+id_div+contadorRespel[id_div]+`" class="form-control" required="">
		</select>
	</div>
	<div id="RespelData`+id_div+contadorRespel[id_div]+`" class="collapse in">
		<div class="form-group col-md-6">
			<label for="SolResTypeUnidad">Unidades de Medida</label>
			<select name="SolResTypeUnidad[`+id_div+`][]" id="SolResTypeUnidad" class="form-control">
				<option value="">Seleccione...</option>
				<option value="99">Unidad</option>
				<option value="98">Litros</option>
			</select>
		</div>
		<div class="form-group col-md-6">
			<label for="SolResCantiUnidad">Cantidad</label>
			<input type="text" class="form-control" id="SolResCantiUnidad" name="SolResCantiUnidad[`+id_div+`][]">
		</div>
		<div class="form-group col-md-6">
			<label for="SolResKgEnviado">Cantidad (Kg)</label>
			<small class="help-block with-errors">*</small>
			<input type="text" class="form-control" id="SolResKgEnviado" name="SolResKgEnviado[`+id_div+`][]" required="">
		</div>
		<div class="form-group col-md-6">
			<label for="SolResEmbalaje">Embalaje</label>
			<small class="help-block with-errors">*</small>
			<select name="SolResEmbalaje[`+id_div+`][]" id="SolResEmbalaje" class="form-control" required="">
				<option value="">Seleccione...</option>
				<option value="99">Bolsas</option>
				<option value="98">Canecas</option>
				<option value="97">Estibas</option>
				<option value="96">Garrafones</option>
				<option value="95">Cajas</option>
			</select>
		</div>
		<div class="form-group col-md-16" style="text-align: center;">
			<div class="form-group col-md-12">
				<label>Dimensiones del Residuo</label>
			</div>
			<div class="form-group col-md-4">
				<label for="SolResAlto">Alto</label>
				<input type="number" class="form-control" id="SolResAlto" name="SolResAlto[`+id_div+`][]">
			</div>
			<div class="form-group col-md-4">
				<label for="SolResAncho">Ancho</label>
				<input type="number" class="form-control" id="SolResAncho" name="SolResAncho[`+id_div+`][]">
			</div>
			<div class="form-group col-md-4">
				<label for="SolResProfundo">Profundo</label>
				<input type="number" class="form-control" id="SolResProfundo" name="SolResProfundo[`+id_div+`][]">
			</div>
		</div>
		<div class="form-group col-md-12" style="text-align: center;">
			<div class="form-group col-md-12">
				<label>Requerimientos</label>
			</div>
			<div class="form-group col-md-6" style="border: 2px dashed #00c0ef">
				<div class="form-group col-md-12">
					<label>Fotos</label>
				</div>
				<div class="form-group col-md-6">
					<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Foto-Descargue</b>" data-content="<p style='width: 50%'> Se requiere registro fotografico del proceso de descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>">
						<label for="SolResFotoDescargue_Pesaje`+id_div+contadorRespel[id_div]+`">Descargue/Pesaje</label>
						<div style="width: 100%; height: 34px;">
							<input type="checkbox" class="fotoswitch" id="SolResFotoDescargue_Pesaje`+id_div+contadorRespel[id_div]+`" data-name="SolResFotoDescargue_Pesaje1`+id_div+contadorRespel[id_div]+`"/>
							<input type="text" id="SolResFotoDescargue_Pesaje1`+id_div+contadorRespel[id_div]+`" name="SolResFotoDescargue_Pesaje[`+id_div+`][]" hidden value="0">
						</div>
					</label>
				</div>
				<div class="form-group col-md-6">
					<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Foto-Tratamiento</b>" data-content="<p style='width: 50%'> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>">
						<label for="SolResFotoTratamiento`+id_div+contadorRespel[id_div]+`">Tratamiento</label>
						<div style="width: 100%; height: 34px;">
							<input type="checkbox" class="fotoswitch" id="SolResFotoTratamiento`+id_div+contadorRespel[id_div]+`" value="0" data-name="SolResFotoTratamiento1`+id_div+contadorRespel[id_div]+`"/>
							<input type="text" id="SolResFotoTratamiento1`+id_div+contadorRespel[id_div]+`" name="SolResFotoTratamiento[`+id_div+`][]" hidden value="0">
						</div>
					</label>
				</div>
			</div>
			<div class="form-group col-md-6" style="border: 2px dashed #00c0ef">
				<div class="form-group col-md-12">
					<label>Videos</label>
				</div>
				<div class="form-group col-md-6">
					<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Video-Descargue</b>" data-content="<p style='width: 50%'> Se requiere video del proceso de Descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>">
						<label for="SolResVideoDescargue_Pesaje`+id_div+contadorRespel[id_div]+`">Descargue/Pesaje</label>
						<div style="width: 100%; height: 34px;">
							<input type="checkbox" class="videoswitch" id="SolResVideoDescargue_Pesaje`+id_div+contadorRespel[id_div]+`" data-name="SolResVideoDescargue_Pesaje1`+id_div+contadorRespel[id_div]+`"/>
							<input type="text" id="SolResVideoDescargue_Pesaje1`+id_div+contadorRespel[id_div]+`" name="SolResVideoDescargue_Pesaje[`+id_div+`][]" hidden value="0">
						</div>
					</label>
				</div>
				<div class="form-group col-md-6">
					<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Video-Tratamiento</b>" data-content="<p style='width: 50%'> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>">
						<label for="SolResVideoTratamiento`+id_div+contadorRespel[id_div]+`">Tratamiento</label>
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
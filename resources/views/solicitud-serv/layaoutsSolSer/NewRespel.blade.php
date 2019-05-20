<div id="Repel`+contadorRespel+`" class="col-md-12 box box-warning">
	<div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" style="color: red;" onclick="RemoveRespel(`+contadorRespel+`)" title="Eliminar"><i class="fa fa-times"></i></button>
	</div>
	<label>Residuo</label>
	<button type="button" class="btn btn-box-tool" style="color: #f39c12;" data-toggle="collapse" data-target="#RespelData`+contadorRespel+`" title="Reducir/Ampliar"><i class="fas fa-arrows-alt-v"></i></button>
	<select name="SGenerador[`+id+`]" id="SGenerador" class="form-control">
		<option value="">Seleccione...</option>
	</select>
	<br>
	<div id="RespelData`+contadorRespel+`" class="collapse in">
		<div class="col-md-6">
			<label>Unidades de Medida</label>
			<input type="text" class="form-control">
		</div>
		<div class="col-md-6">
			<label>Cantidad</label>
			<input type="text" class="form-control">
		</div>
		<div class="col-md-6">
			<label>Cantidad (Kg)</label>
			<input type="text" class="form-control">
		</div>
		<div class="col-md-6">
			<label>Tratamiento</label>
			<input type="text" class="form-control">
		</div>
		<div class="col-md-12" style="text-align: center;">
			<div class="col-md-12">
				<label>Requerimientos</label>
			</div>
			<div class="col-md-6" style="border: 2px dashed #00c0ef">
				<div class="col-md-12">
					<label>Fotos</label>
				</div>
				<div class="col-md-6">
					<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Foto-Descargue</b>" data-content="<p style='width: 50%'> Se requiere registro fotografico del proceso de descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>">
						<label>Descargue/Pesaje</label>
						<div style="width: 100%; height: 34px;">
							<input type="checkbox" class="fotoswitch" name="ReqFotoDescargue"/>
						</div>
					</label>
				</div>
				<div class="col-md-6">
					<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Foto-Tratamiento</b>" data-content="<p style='width: 50%'> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>">
						<label>Tratamiento</label>
						<div style="width: 100%; height: 34px;">
							<input type="checkbox" class="fotoswitch" name="ReqFotoDestruccion"/>
						</div>
					</label>
				</div>
			</div>
			<div class="col-md-6" style="border: 2px dashed #00c0ef">
				<div class="col-md-12">
					<label>Videos</label>
				</div>
				<div class="col-md-6">
					<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Video-Descargue</b>" data-content="<p style='width: 50%'> Se requiere video del proceso de Descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>">
						<label>Descargue/Pesaje</label>
						<div style="width: 100%; height: 34px;">
							<input type="checkbox" class="videoswitch" name="ReqVideoDescargue"/>
						</div>
					</label>
				</div>
				<div class="col-md-6">
					<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Video-Tratamiento</b>" data-content="<p style='width: 50%'> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>">
						<label>Tratamiento</label>
						<div style="width: 100%; height: 34px;">
							<input type="checkbox" class="videoswitch" name="ReqVideoDestruccion"/>
						</div>
					</label>
				</div>
			</div>
		</div>
		<br>
	</div>
</div>
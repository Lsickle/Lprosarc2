<div id="Generador`+contadorGenerador+`" class="col-md-12">
	<div class="box box-success col-md-16">
		<div class="col-md-12">
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" style="color: red;" onclick="RemoveGenerador(`+contadorGenerador+`)" title="Eliminar"><i class="fa fa-times"></i></button>
			</div>
			<label for="">Seleccione el generador</label>
			<button type="button" class="btn btn-box-tool" style="color: #00a65a;" data-toggle="collapse" data-target="#DivRepel`+contadorGenerador+`" title="Reducir/Ampliar"><i class="fas fa-arrows-alt-v"></i></button>
			<select name="SGenerador[`+contadorGenerador+`]" id="SGenerador" class="form-control">
				<option value="">Seleccione...</option>
				@foreach($SGeneradors as $SGenerador)
				<option value="{{$SGenerador->ID_GSede}}">{{$SGenerador->GSedeName}}</option>
				@endforeach
			</select>
			<br>
		</div>
		<div id="DivRepel`+contadorGenerador+`" class="col-md-12 collapse in">
			<div id="Repel`+contadorRespel+`" class="col-md-12 box box-warning">
				<label>Residuo</label>
				<button type="button" class="btn btn-box-tool" style="color: #f39c12;" data-toggle="collapse" data-target="#RespelData`+contadorRespel+`" title="Reducir/Ampliar"><i class="fas fa-arrows-alt-v"></i></button>
				<select name="SGenerador[`+contadorGenerador+`]" id="SGenerador" class="form-control">
					<option value="">Seleccione...</option>
				</select>
				<br>
				<div id="RespelData`+contadorRespel+`" class="collapse in">
					<div class="col-md-6">
						<label>Unidades de Medida</label>
						<select name="" id="" class="form-control">
							<option value="">Seleccione...</option>
						</select>
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
						<label>Embalaje</label>
						<select name="" id="" class="form-control">
							<option value="">Seleccione...</option>
						</select>
					</div>
					<div class="col-md-16" style="text-align: center;">
						<div class="col-md-12">
							<label>Dimensiones del Residuo</label>
						</div>
						<div class="col-md-4">
							<label>Alto</label>
							<input type="number" class="form-control">
						</div>
						<div class="col-md-4">
							<label>Ancho</label>
							<input type="number" class="form-control">
						</div>
						<div class="col-md-4">
							<label>Profundo</label>
							<input type="number" class="form-control">
						</div>
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
			<div id="AddRespel`+contadorRespel+`" class="col-md-16 col-md-offset-5 col-xs-offset-5">
				<a onclick="AgregarRegistro(`+contadorRespel+`)" id="Agregar" class="btn btn-success"><i class="fas fa-plus"></i> Añadir</a><br><br>
			</div>
		</div>
	</div>
</div>
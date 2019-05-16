<div id="GenerRes">
	<div class="col-md-12">
		<label for="">Seleccione el generador</label>
		<select name="SGenerador[`+contador+`]" id="SGenerador" class="form-control">
			<option value="1">Seleccione...</option> @foreach($SGeneradors as $SGenerador)
			<option value="{{$SGenerador->ID_GSede}}">{{$SGenerador->GSedeName}}</option> @endforeach
		</select>
	</div>
	<div class="divRes">
		<div id="divResiduos" class="col-md-3">
			<a onclick="AgregarRegistro(`+contador+`)" id="Agregar" class="btn btn-success"><i class="fas fa-plus"></i> Añadir</a><br><br>
			<label>Residuos</label><hr>
			<div id="divRespel`+contador+`"></div>
		</div>
		<div class="col-md-9 smartwizard">
			<ul>
				<li><a href="#step-1"><b>Descripción</b><br/><small>Datos del residuo</small></a></li>
				<li><a href="#step-2"><b>Requerimientos</b><br/><small>Requerimientos del residuo</small></a></li>
			</ul>
			<div>
				<div id="step-1">
					<div class="col-md-3">
						<br><label>Unidades</label><hr>
						<div id="divUnidades`+contador+`"></div>
					</div>
					<div class="col-md-3">
						<br><label>Tipo</label><hr>
						<div id="divTipoCate`+contador+`"></div>
					</div>
					<div class="col-md-3">
						<br><label>Cantidad</label><hr>
						<div id="divCateEnviado`+contador+`"></div>
					</div>
					<div class="col-md-3">
						<br><label>Tratamiento</label><hr>
						<div id="divTratamiento`+contador+`"></div>
					</div>
				</div>
				<div id="step-2">
					<div class="divReq">
						<label title="Foto Cargue">F.Ca</label>
						<label title="Foto Descargue">F.De</label>
						<label title="Foto Persaje">F.Pe</label>
						<label title="Foto Reempacado">F.Re</label>
						<label title="Foto Mezclaje">F.Me</label>
						<label title="Foto Destrucción">F.Des</label>
						<label title="Video Cargue">V.Ca</label>
						<label title="Video Descargue">V.De</label>
						<label title="Video Persaje">V.Pe</label>
						<label title="Video Reempacado">V.Re</label>
						<label title="Video Mezclaje">V.Me</label>
						<label title="Video Destrucción">V.Des</label>
						<label title="Devolucion">Dev</label>
						<label title="Planillas">Pla</label>
						<label title="Alistamiento">Ali</label>
						<label title="Capacitación">Cap</label>
						<label title="Bascula">Bas</label>
						<label title="Vehiculo con Plataforma">Ve.P</label>
						<label title="Certificación Especial">Cer</label>
					</div>
					<div class="divReq">
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<input class="inputcheck" type="checkbox"/>
						<hr>
					</div>
					<div class="divReq" id="divRequerimientos`+contador+`"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="box box-info"></div>
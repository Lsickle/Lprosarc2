<div id="Repel`+contadorRespel+`" class="col-md-12 box box-warning">
	<div class="box-tools pull-right">
		<button type="button" class="btn btn-box-tool" onclick="RemoveRespel(`+contadorRespel+`)" title="Eliminar"><i class="fa fa-times"></i></button>
	</div>
	<label>Residuo</label>
	<button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#RespelData`+contadorRespel+`" title="Reducir/Ampliar"><i class="fas fa-arrows-alt-v"></i></button>
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
		<div class="col-md-12">
			<label>Requerimientos</label>
			<input type="text" class="form-control">
		</div>
		<br>
	</div>
</div>
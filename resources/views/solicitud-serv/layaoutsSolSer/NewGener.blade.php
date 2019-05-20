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
				<div id="RespelData`+contadorRespel+`" class="collapse">
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
			<div id="AddRespel`+contadorRespel+`" class="col-md-16 col-md-offset-5">
				<a onclick="AgregarRegistro(`+contadorRespel+`)" id="Agregar" class="btn btn-success"><i class="fas fa-plus"></i> Añadir</a><br><br>
			</div>
		</div>
	</div>
</div>
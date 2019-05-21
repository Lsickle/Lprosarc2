<div id="Generador`+contadorGenerador+`" class="col-md-12">
	<div class="box box-success col-md-16">
		<div class="col-md-12">
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" style="color: red;" onclick="RemoveGenerador(`+contadorGenerador+`)" title="Eliminar"><i class="fa fa-times"></i></button>
			</div>
			<label for="">Seleccione el generador</label>
			<button type="button" class="btn btn-box-tool" style="color: #00a65a;" data-toggle="collapse" data-target="#DivRepel`+contadorGenerador+`" title="Reducir/Ampliar"><i class="fas fa-arrows-alt-v"></i></button>
			<select name="SGenerador[`+contadorGenerador+`]" id="SGenerador" class="form-control">
				<option onclick="HiddenResiduosGener(`+contadorGenerador+`)" value="">Seleccione...</option>
				@foreach($SGeneradors as $SGenerador)
				<option onclick="ResiduosGener(`+contadorGenerador+`,{{$SGenerador->ID_GSede}})" value="{{$SGenerador->ID_GSede}}">{{$SGenerador->GenerShortname.' ('.$SGenerador->GSedeName.')'}}</option>
				@endforeach
			</select>
			<br>
		</div>
		<div id="DivRepel`+contadorGenerador+`" class="col-md-12 collapse in">
		</div>
	</div>
</div>
<div class="box-tools col-md-12">
	<button type="button" class="btn btn-box-tool pull-right" style="color: red; font-size: 1.3em;" onclick="RemoveGenerador(`+contadorGenerador+`)" title="Eliminar"><i class="fa fa-times"></i></button>
</div>
<div id="Generador`+contadorGenerador+`" class="box box-success col-md-12">
	<div class="form-group col-md-16">
		<label for="">Seleccione el generador</label>
		<small class="help-block with-errors">*</small>
		<button type="button" class="btn btn-box-tool" style="color: #00a65a;" data-toggle="collapse" data-target="#DivRepel`+contadorGenerador+`" title="Reducir/Ampliar"><i class="fas fa-arrows-alt-v"></i></button>
		<select name="SGenerador[`+contadorGenerador+`]" id="SGenerador" class="form-control" required="">
			<option onclick="HiddenResiduosGener(`+contadorGenerador+`)" value="">Seleccione...</option>
			@foreach($SGeneradors as $SGenerador)
			<option onclick="ResiduosGener(`+contadorGenerador+`,'{{$SGenerador->GSedeSlug}}')" value="{{$SGenerador->GSedeSlug}}">{{$SGenerador->GenerShortname.' ('.$SGenerador->GSedeName.')'}}</option>
			@endforeach
		</select>
		<br>
	</div>
	<div id="DivRepel`+contadorGenerador+`" class="col-md-16 collapse in">
	</div>
</div>
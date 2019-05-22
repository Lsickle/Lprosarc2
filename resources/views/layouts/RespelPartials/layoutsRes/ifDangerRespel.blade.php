
<div class="col-md-6 form-group">
	<label>¿Sustancia controlada?
		<a href="{{route('ClasificacionA')}}" target="_blank"> Resolución Número 1 del 2015 <i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i></a>
	</label>
	<select id="selectDanger0" name="SustanciaControlada[]" class="form-control" required>
		<option onclick="setNoControlada(`+id+`)">No</option>
		<option onclick="setControlada(`+id+`)">Si</option>
	</select>
</div><div class="col-md-6 form-group" style="text-align: center;">
    <label>Tipo de clasificación</label><br>
    <a class="btn btn-success" id="ClasifY`+id+`" onclick="AgregarY(`+id+`)">Y</a>
    <a class="btn btn-default" id="ClasifA`+id+`" onclick="AgregarA(`+id+`)">A</a>
</div>
<div class="col-md-6 form-group" id="Clasif`+id+`">
    @include('layouts.RespelPartials.layoutsRes.ClasificacionYCreate')
</div>

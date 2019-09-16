<input type="text" hidden="" name="SustanciaControladaTipo" value="1">

<label>Nombre de la sustancia</label>
<select name="SustanciaControladaNombre" class="form-control">
	<option {{ ($Respels->PSustanciaControladaNombre === 'Aceite combustible para motor- ACPM' ? 'selected' : '') }} value="Aceite combustible para motor- ACPM">Aceite combustible para motor- ACPM</option>
	<option {{ ($Respels->PSustanciaControladaNombre === 'Hidróxido de sodio' ? 'selected' : '') }} value="Hidróxido de sodio">Hidróxido de sodio</option>
	<option {{ ($Respels->PSustanciaControladaNombre === 'Cemento' ? 'selected' : '') }} value="Cemento">Cemento</option>
	<option {{ ($Respels->PSustanciaControladaNombre === 'Gasolina para motor' ? 'selected' : '') }} value="Gasolina para motor">Gasolina para motor</option>
</select>


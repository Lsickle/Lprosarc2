<div class="col-md-6">
<label>Nombre</label>
<input name="RespelName" type="text" class="form-control" placeholder="Nombre del Residuo" value="{{$Respels->RespelName}}" required>
</div>
<div class="col-md-6">
<label>Descripcion</label>
<input name="RespelDescrip" type="text" class="form-control" placeholder="Descripcion del Residuo" value="{{$Respels->RespelDescrip}}" required>
</div>
<div class="col-md-6" style="padding-top: 18px;">
	<label>Tipo de clasificación</label>
	@if($Respels->YRespelClasf4741 <> null)
		<label style="margin: 0 3em;"> <spam> Y </spam>
			<input type="radio" id="ClasifY" checked="" onclick="Agregar()" name="ResTippCasif" value="Y"> 
		</label>
		<label> <spam> A </spam>
			<input type="radio" id="ClasifA" onclick="Agregar()" name="ResTippCasif" value="A"> 
		</label>
	@else
		<label style="margin: 0 3em;"> <spam> Y </spam>
			<input type="radio" id="ClasifY" onclick="Agregar()" name="ResTippCasif" value="Y"> 
		</label>
		<label> <spam> A </spam>
			<input type="radio" id="ClasifA" checked="" onclick="Agregar()" name="ResTippCasif" value="A"> 
		</label>
	@endif
</div>
<div class="col-md-6" id="Clasif">
</div>
<div class="col-md-6">
	<label>Peligrosidad del residuo</label>
	<select name="RespelIgrosidad[]" class="form-control" required>
		<option {{$Respels->RespelIgrosidad == 'Inflamable' ? 'selected' : '' }}>Inflamable</option>
		<option {{$Respels->RespelIgrosidad == 'Toxico' ? 'selected' : '' }}>Toxico</option>
		<option {{$Respels->RespelIgrosidad == 'Biologico' ? 'selected' : '' }}>Biologico</option>
		<option {{$Respels->RespelIgrosidad == 'Corrosivo' ? 'selected' : '' }}>Corrosivo</option>
		<option {{$Respels->RespelIgrosidad == 'Reactivo' ? 'selected' : '' }}>Reactivo</option> 
	</select>
</div>
<div class="col-md-6">
	<label>Estado del residuo</label>
	<select name="RespelEstado" class="form-control" >
		<option {{$Respels->RespelEstado == 'Liquido' ? 'selected' : '' }}>Liquido</option>
		<option {{$Respels->RespelEstado == 'Solido' ? 'selected' : '' }}>Solido</option>
		<option {{$Respels->RespelEstado == 'Gaseoso' ? 'selected' : '' }}>Gaseoso</option>
		<option {{$Respels->RespelEstado == 'Mezcla' ? 'selected' : '' }}>Mezcla</option>
	</select>
</div>
<div class="col-md-4">
	<label>Hoja de seguridad</label>
	<input type="text" class="form-control" readonly="" name="HojaSeguridad" value="{{$Respels->RespelHojaSeguridad}}">
</div>
<div class="col-md-2">
	<label>Ver y/o Cambiar</label><br>
	<a method='get' href='/img/HojaSeguridad/{{$Respels->RespelHojaSeguridad}}' target='_blank' class='btn btn-success'><i class='fas fa-search'></i></a>
	<label for="RespelHojaSeguridad" class='btn btn-warning'><i class="fas fa-exchange-alt"></i></label>
	<input id="RespelHojaSeguridad" name="RespelHojaSeguridad" style="display: none;" type="file" accept=".pdf" class="form-control">
</div>
<div class="col-md-4">
	<label>Tarjeta De Emergencia</label>
	<input type="text" class="form-control" readonly="" name="RespelTarj" value="{{$Respels->RespelTarj}}">
</div>
<div class="col-md-2">
	<label>Ver y/o Cambiar</label><br>
	<a method='get' href='/img/TarjetaEmergencia/{{$Respels->RespelTarj}}' target='_blank' class='btn btn-success'><i class='fas fa-search'></i></a>
	<label for="RespelTarj" class='btn btn-warning'><i class="fas fa-exchange-alt"></i></label>
	<input id="RespelTarj" name="RespelTarj" type="file" class="form-control" style="display: none;" accept=".pdf">
</div>
@if(Auth::user()->UsRol=='Programador'||Auth::user()->UsRol=='admin'||Auth::user()->UsRol=='JefeOperacion')
	<div class="col-md-12">
		<label>Estado de aprobación</label>
		<select name="RespelStatus" class="form-control">
			<option {{$Respels->RespelStatus == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
			<option {{$Respels->RespelStatus == 'Negado' ? 'selected' : '' }}>Negado</option>
			<option {{$Respels->RespelStatus == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
			<option {{$Respels->RespelStatus == 'Incompleto' ? 'selected' : '' }}>Incompleto</option>
		</select>
	</div>
@endif

<script>
	var ClasifY = '<label >Clasificacion Y, segun <a href="{{route('ClasificacionY')}}" target="_blank"> Decreto Número 4741 </a> </label> <select name="YRespelClasf4741[]" class="form-control"> <option {{$Respels->YRespelClasf4741 == '' ? 'selected' : '' }}>Seleccione...</option> <option {{$Respels->YRespelClasf4741 == 'Y1' ? 'selected' : '' }}>Y1</option> <option {{$Respels->YRespelClasf4741 == 'Y2' ? 'selected' : '' }}>Y2</option> <option {{$Respels->YRespelClasf4741 == 'Y3' ? 'selected' : '' }}>Y3</option> <option {{$Respels->YRespelClasf4741 == 'Y4' ? 'selected' : '' }}>Y4</option> <option {{$Respels->YRespelClasf4741 == 'Y5' ? 'selected' : '' }}>Y5</option> <option {{$Respels->YRespelClasf4741 == 'Y6' ? 'selected' : '' }}>Y6</option> <option {{$Respels->YRespelClasf4741 == 'Y7' ? 'selected' : '' }}>Y7</option> <option {{$Respels->YRespelClasf4741 == 'Y8' ? 'selected' : '' }}>Y8</option> <option {{$Respels->YRespelClasf4741 == 'Y9' ? 'selected' : '' }}>Y9</option> <option {{$Respels->YRespelClasf4741 == 'Y10' ? 'selected' : '' }}>Y10</option> <option {{$Respels->YRespelClasf4741 == 'Y11' ? 'selected' : '' }}>Y11</option> <option {{$Respels->YRespelClasf4741 == 'Y12' ? 'selected' : '' }}>Y12</option> <option {{$Respels->YRespelClasf4741 == 'Y13' ? 'selected' : '' }}>Y13</option> <option {{$Respels->YRespelClasf4741 == 'Y14' ? 'selected' : '' }}>Y14</option> <option {{$Respels->YRespelClasf4741 == 'Y15' ? 'selected' : '' }}>Y15</option> <option {{$Respels->YRespelClasf4741 == 'Y16' ? 'selected' : '' }}>Y16</option> <option {{$Respels->YRespelClasf4741 == 'Y17' ? 'selected' : '' }}>Y17</option> <option {{$Respels->YRespelClasf4741 == 'Y18' ? 'selected' : '' }}>Y18</option> <option {{$Respels->YRespelClasf4741 == 'Y19' ? 'selected' : '' }}>Y19</option> <option {{$Respels->YRespelClasf4741 == 'Y20' ? 'selected' : '' }}>Y20</option> <option {{$Respels->YRespelClasf4741 == 'Y21' ? 'selected' : '' }}>Y21</option> <option {{$Respels->YRespelClasf4741 == 'Y22' ? 'selected' : '' }}>Y22</option> <option {{$Respels->YRespelClasf4741 == 'Y23' ? 'selected' : '' }}>Y23</option> <option {{$Respels->YRespelClasf4741 == 'Y24' ? 'selected' : '' }}>Y24</option> <option {{$Respels->YRespelClasf4741 == 'Y25' ? 'selected' : '' }}>Y25</option> <option {{$Respels->YRespelClasf4741 == 'Y26' ? 'selected' : '' }}>Y26</option> <option {{$Respels->YRespelClasf4741 == 'Y27' ? 'selected' : '' }}>Y27</option> <option {{$Respels->YRespelClasf4741 == 'Y28' ? 'selected' : '' }}>Y28</option> <option {{$Respels->YRespelClasf4741 == 'Y29' ? 'selected' : '' }}>Y29</option> <option {{$Respels->YRespelClasf4741 == 'Y30' ? 'selected' : '' }}>Y30</option> <option {{$Respels->YRespelClasf4741 == 'Y31' ? 'selected' : '' }}>Y31</option> <option {{$Respels->YRespelClasf4741 == 'Y32' ? 'selected' : '' }}>Y32</option> <option {{$Respels->YRespelClasf4741 == 'Y33' ? 'selected' : '' }}>Y33</option> <option {{$Respels->YRespelClasf4741 == 'Y34' ? 'selected' : '' }}>Y34</option> <option {{$Respels->YRespelClasf4741 == 'Y35' ? 'selected' : '' }}>Y35</option> <option {{$Respels->YRespelClasf4741 == 'Y36' ? 'selected' : '' }}>Y36</option> <option {{$Respels->YRespelClasf4741 == 'Y37' ? 'selected' : '' }}>Y37</option> <option {{$Respels->YRespelClasf4741 == 'Y38' ? 'selected' : '' }}>Y38</option> <option {{$Respels->YRespelClasf4741 == 'Y39' ? 'selected' : '' }}>Y39</option> <option {{$Respels->YRespelClasf4741 == 'Y40' ? 'selected' : '' }}>Y40</option> <option {{$Respels->YRespelClasf4741 == 'Y41' ? 'selected' : '' }}>Y41</option> <option {{$Respels->YRespelClasf4741 == 'Y42' ? 'selected' : '' }}>Y42</option> <option {{$Respels->YRespelClasf4741 == 'Y43' ? 'selected' : '' }}>Y43</option> <option {{$Respels->YRespelClasf4741 == 'Y44' ? 'selected' : '' }}>Y44</option> <option {{$Respels->YRespelClasf4741 == 'Y45' ? 'selected' : '' }}>Y45</option> </select> <input type="text" hidden="" name="ARespelClasf4741[]" value="">';

	var ClasifA = '<label >Clasificacion A, segun <a href="{{route('ClasificacionA')}}" target="_blank"> Decreto Número 4741  </a>  </label> <select name="ARespelClasf4741[]" class="form-control"> <option {{$Respels->ARespelClasf4741 == '' ? 'selected' : '' }}>Seleccione...</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1010</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1020</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1030</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1040</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1050</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1060</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1070</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1080</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1090</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1100</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1110</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1120</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1130</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1140</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1150</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1160</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1170</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A1180</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A2010</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A2020</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A2030</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A2040</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A2050</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A2060</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3010</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3020</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3030</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3040</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3050</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3060</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3070</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3080</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3090</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3100</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3110</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3120</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3130</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3140</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3150</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3160</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3170</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3180</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3190</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A3200</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A4010</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A4020</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A4030</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A4040</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A4050</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A4060</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A4070</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A4080</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A4090</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A4100</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A4110</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A4120</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A4130</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A4140</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A4150</option> <option {{$Respels->ARespelClasf4741 == 'Incompleto' ? 'selected' : '' }}>A4160</option> </select> <input type="text" hidden="" name="YRespelClasf4741[]" value="">';
	@if($Respels->YRespelClasf4741 <> null)
		window.onload = function(){ $("#Clasif").append(ClasifY); }
	@else
		window.onload = function(){ $("#Clasif").append(ClasifA); }
	@endif
	function Agregar()
		{
			if ($("#ClasifY").prop('checked')){
				$("#Clasif").empty();
				$("#Clasif").append(ClasifY);
			}
			else{
				$("#Clasif").empty();
				$("#Clasif").append(ClasifA);
			}
		}
</script>
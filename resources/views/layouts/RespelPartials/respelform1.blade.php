<div id="Respels">
	<div id="Residuo">
		<div class="col-md-6">
			<label>Nombre</label>
			<input name="RespelName[]" type="text" class="form-control" placeholder="Nombre del Residuo" required>
		</div> 
		<div class="col-md-6">
			<label>Descripcion</label>
			<input name="RespelDescrip[]" type="text" class="form-control" placeholder="Descripcion del Residuo">
		</div> 
		<div class="col-md-6" style="padding-top: 18px;">
			<label>Tipo de clasificación</label> <label style="margin: 0 3em;"> <spam> Y </spam>
				<input type="radio" id="ClasifY0" checked="" onclick="Agregar(0)" name="ResTippCasif" value="Y"> </label>
			<label> <spam> A </spam>
				<input type="radio" id="ClasifA0" onclick="Agregar(0)" name="ResTippCasif" value="A"> </label>
			</div> 
		<div class="col-md-6" id="Clasif0">
		</div> 
		<div class="col-md-6">
			<label>Peligrosidad del residuo</label>
			<select name="RespelIgrosidad[]" class="form-control" required>
				<option value="Inflamable">Selecione...</option>
				<option>Inflamable</option>
				<option>Toxico</option>
				<option>Biologico</option>
				<option>Corrosivo</option>
				<option>Reactivo</option> </select>
		</div> 
		<div class="col-md-6">
			<label>Estado del residuo</label>
			<select name="RespelEstado[]" class="form-control" required>
				<option value="">Selecione...</option>
				<option value="Liquido">Liquido</option>
				<option value="Solido">Solido</option>
				<option value="Gaseoso">Gaseoso</option>
				<option value="Mezcla">Mezcla</option> </select>
		</div> 
		<div class="col-md-6">
			<label>Hoja de seguridad</label>
			<input name="RespelHojaSeguridad[]" type="file" class="form-control" accept=".png, .jpg, .jpeg,.pdf" required>
		</div> 
		<div class="col-md-6">
			<label>Tarjeta De Emergencia</label>
			<input name="RespelTarj[]" type="file" class="form-control" accept=".png, .jpg, .jpeg,.pdf">
		</div> 
		<div class="col-md-12"> <hr>
		</div> 
	</div>
</div>

<script>
	var contador = 1;
	var ClasifY = '<label >Clasificacion Y, segun <a href="{{route('ClasificacionY')}}" target="_blank"> Decreto Número 4741</a></label> <select name="YRespelClasf4741[]" class="form-control"> <option value="">Selecione...</option> <option value="Y1">Y1</option> <option value="Y2">Y2</option> <option value="Y3">Y3</option> <option value="Y4">Y4</option> <option value="Y5">Y5</option> <option value="Y6">Y6</option> <option value="Y7">Y7</option> <option value="Y8">Y8</option> <option value="Y9">Y9</option> <option value="Y10">Y10</option> <option value="Y11">Y11</option> <option value="Y12">Y12</option> <option value="Y13">Y13</option> <option value="Y14">Y14</option> <option value="Y15">Y15</option> <option value="Y16">Y16</option> <option value="Y17">Y17</option> <option value="Y18">Y18</option> <option value="Y19">Y19</option> <option value="Y20">Y20</option> <option value="Y21">Y21</option> <option value="Y22">Y22</option> <option value="Y23">Y23</option> <option value="Y24">Y24</option> <option value="Y25">Y25</option> <option value="Y26">Y26</option> <option value="Y27">Y27</option> <option value="Y28">Y28</option> <option value="Y29">Y29</option> <option value="Y30">Y30</option> <option value="Y31">Y31</option> <option value="Y32">Y32</option> <option value="Y33">Y33</option> <option value="Y34">Y34</option> <option value="Y35">Y35</option> <option value="Y36">Y36</option> <option value="Y37">Y37</option> <option value="Y38">Y38</option> <option value="Y39">Y39</option> <option value="Y40">Y40</option> <option value="Y41">Y41</option> <option value="Y42">Y42</option> <option value="Y43">Y43</option> <option value="Y44">Y44</option> <option value="Y45">Y45</option> </select>';
	var ClasifA = '<label >Clasificacion A, segun <a href="{{route('ClasificacionA')}}" target="_blank"> Decreto Número 4741</a></label> <select name="ARespelClasf4741[]" class="form-control"> <option value="">Selecione...</option> <option value="A1010">A1010</option> <option value="A1020">A1020</option> <option value="A1030">A1030</option> <option value="A1040">A1040</option> <option value="A1050">A1050</option> <option value="A1060">A1060</option> <option value="A1070">A1070</option> <option value="A1080">A1080</option> <option value="A1090">A1090</option> <option value="A1100">A1100</option> <option value="A1110">A1110</option> <option value="A1120">A1120</option> <option value="A1130">A1130</option> <option value="A1140">A1140</option> <option value="A1150">A1150</option> <option value="A1160">A1160</option> <option value="A1170">A1170</option> <option value="A1180">A1180</option> <option value="A2010">A2010</option> <option value="A2020">A2020</option> <option value="A2030">A2030</option> <option value="A2040">A2040</option> <option value="A2050">A2050</option> <option value="A2060">A2060</option> <option value="A3010">A3010</option> <option value="A3020">A3020</option> <option value="A3030">A3030</option> <option value="A3040">A3040</option> <option value="A3050">A3050</option> <option value="A3060">A3060</option> <option value="A3070">A3070</option> <option value="A3080">A3080</option> <option value="A3090">A3090</option> <option value="A3100">A3100</option> <option value="A3110">A3110</option> <option value="A3120">A3120</option> <option value="A3130">A3130</option> <option value="A3140">A3140</option> <option value="A3150">A3150</option> <option value="A3160">A3160</option> <option value="A3170">A3170</option> <option value="A3180">A3180</option> <option value="A3190">A3190</option> <option value="A3200">A3200</option> <option value="A4010">A4010</option> <option value="A4020">A4020</option> <option value="A4030">A4030</option> <option value="A4040">A4040</option> <option value="A4050">A4050</option> <option value="A4060">A4060</option> <option value="A4070">A4070</option> <option value="A4080">A4080</option> <option value="A4090">A4090</option> <option value="A4100">A4100</option> <option value="A4110">A4110</option> <option value="A4120">A4120</option> <option value="A4130">A4130</option> <option value="A4140">A4140</option> <option value="A4150">A4150</option> <option value="A4160">A4160</option> </select>';
	window.onload = function(){ $("#Clasif0").append(ClasifY); }
	function AgregarRes(){
		var Residuo = '<div id="Residuo'+contador+'"> <div class="col-md-12"> <label onclick="EliminarRes('+contador+')" style="float: right; color: red; margin-top: 0; font-size: 2em;"><i class="fas fa-times-circle"></i></label> </div> <div class="col-md-6"> <label>Nombre</label> <input name="RespelName[]" type="text" class="form-control" placeholder="Nombre del Residuo" required> </div> <div class="col-md-6"> <label>Descripcion</label> <input name="RespelDescrip[]" type="text" class="form-control" placeholder="Descripcion del Residuo"> </div> <div class="col-md-6" style="padding-top: 18px;"> <label>Tipo de clasificación</label> <label style="margin: 0 3em;"> <spam> Y </spam> <input type="radio" id="ClasifY'+contador+'" checked="" onclick="Agregar('+contador+')" name="ResTippCasif" value="Y"> </label> <label> <spam> A </spam> <input type="radio" id="ClasifA'+contador+'" onclick="Agregar('+contador+')" name="ResTippCasif" value="A"> </label> </div> <div class="col-md-6" id="Clasif'+contador+'"> </div> <div class="col-md-6"> <label>Peligrosidad del residuo</label> <select name="RespelIgrosidad[]" class="form-control" required> <option value="Inflamable">Selecione...</option> <option>Inflamable</option> <option>Toxico</option> <option>Biologico</option> <option>Corrosivo</option> <option>Reactivo</option> </select> </div> <div class="col-md-6"> <label>Estado del residuo</label> <select name="RespelEstado[]" class="form-control" required> <option value="">Selecione...</option> <option value="Liquido">Liquido</option> <option value="Solido">Solido</option> <option value="Gaseoso">Gaseoso</option> <option value="Mezcla">Mezcla</option> </select> </div> <div class="col-md-6"> <label>Hoja de seguridad</label> <input name="RespelHojaSeguridad[]" type="file" class="form-control" accept=".png, .jpg, .jpeg,.pdf" required> </div> <div class="col-md-6"> <label>Tarjeta De Emergencia</label> <input name="RespelTarj[]" type="file" class="form-control" accept=".png, .jpg, .jpeg,.pdf"> </div> <div class="col-md-12"> <hr> </div> </div>';
		$("#Respels").append(Residuo);
		$("#Clasif"+contador).append(ClasifY);
		contador= parseInt(contador)+1;
	}
	function Agregar(id)
		{
			if ($("#ClasifY"+id).prop('checked')){
				$("#Clasif"+id).empty();
				$("#Clasif"+id).append(ClasifY);
			}
			else{
				$("#Clasif"+id).empty();
				$("#Clasif"+id).append(ClasifA);
			}
		}
	function EliminarRes(id){
		$("#Residuo"+id).remove();
	}
</script>

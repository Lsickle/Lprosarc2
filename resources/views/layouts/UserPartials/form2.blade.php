<div class=" requirements-component form-group" required>
	<label class="control-label col-md-3 col-sm-3 col-xs-12"><h3>Externos</h3></label>
	<div class="col-md-9 col-sm-9 col-xs-12">
    <div class="">
      <label>
        <input hidden class="" type="radio" name="UsRol" value=""/>
      </label>
    </div>
		<div class="">
			<label>
				<input class="testswitch" type="radio" name="UsRol" value="Usuario"/> Usuario general
			</label>
		</div>
		<div class="">
			<label>
				<input class="testswitch" type="radio" name="UsRol" value="Cliente"/> Cliente registrado
			</label>
		</div>
		<div class="">
			<label>
				<input class="testswitch" type="radio" name="UsRol" value="Generador"/> Generador de residuos
			</label>
		</div>
		<div class="">
			<label>
				<input class="testswitch" type="radio" name="UsRol" value="Auditor"/> Auditor Externo
			</label>
		</div>
	</div>
  <label class="control-label col-md-3 col-sm-3 col-xs-12"><h3>Internos</h3></label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    {{-- <div class="">
      <label>
        <input class="testswitch" type="radio" name="UsRol" value="AdminPlanta"/> Director de Planta
      </label>
    </div> --}}
    {{-- <div class="">
      <label>
        <input class="testswitch" type="radio" name="UsRol" value="Programador"/> Programador de Software
      </label>
    </div> --}}
    <div class="">
      <label>
        <input class="testswitch" type="radio" name="UsRol" value="JefeLogistica"/> Jefe de Logistica
      </label>
    </div>
    <div class="">
      <label>
        <input class="testswitch" type="radio" name="UsRol" value="AuxiliarLogistica"/> Auxiliar de Logistica
      </label>
    </div>
    <div class="">
      <label>
        <input class="testswitch" type="radio" name="UsRol" value="AsistenteLogistica"/> Asistente de Logistica
      </label>
    </div>
    <div class="">
      <label>
        <input class="testswitch" type="radio" name="UsRol" value="JefeOperacion"/> Jefe de Operaciones
      </label>
    </div>
    <div class="">
      <label>
        <input class="testswitch" type="radio" name="UsRol" value="SupervisorTurno"/> Supervisor de Turno
      </label>
    </div>
    <div class="">
      <label>
        <input class="testswitch" type="radio" name="UsRol" value="EncargadoAlmacen"/> Encargado de Almacen
      </label>
    </div>
    <div class="">
      <label>
        <input class="testswitch" type="radio" name="UsRol" value="EncargadoHorno"/> Encargado de Horno
      </label>
    </div>
    <div class="">
      <label>
        <input class="testswitch" type="radio" name="UsRol" value="Tesoreria"/> Tesoreria
      </label>
    </div>
    <div class="">
      <label>
        <input class="testswitch" type="radio" name="UsRol" value="AdminCuenta"/> Administrador de cuenta
      </label>
    </div>
   {{--  <div class="">
      <label>
        <input class="testswitch" type="radio" name="UsRol" value="AdminComercial"/> Director Comercial
      </label>
    </div> --}}
  </div>
</div>
<script src="">
$(document).ready(function(){
  function getInputsByValue(value){
        var value = '{{$user->UsRol}}';
        var allInputs = document.getElementsByName('UsRol');
        var results = [];
        for(var x=0;x<allInputs.length;x++){
            if(allInputs[x].value == value){
              allInputs[x].setAttribute("checked");
            }
                // results.push(allInputs[x]);     
        // return results;
        console.log(value);
  };
  // document.querySelectorAll("input[value={{$user->UsRol}}]").setAttribute("checked");
  };
});  
// window.onload=getInputsByValue;
</script>
                    
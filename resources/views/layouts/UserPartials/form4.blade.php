<div class=" requirements-component form-group" required>
	<label class="control-label col-md-3 col-sm-3 col-xs-12"><h3>Externos</h3></label>
	<div class="col-md-9 col-sm-9 col-xs-12">
    @if ($user->UsRol2=="")
    <div class="">
      <label>
        <input checked class="" type="radio" name="UsRol2" value=""/>Sin Rol Asignado
      </label>
    </div>
    @else
      <div class="">
        <label>
        </label>
      </div>
    @endif
    {{-- Swicht Usuario --}}
    @if ($user->UsRol2=="Usuario")
      <div class="">
        <label>
          <input checked class="testswitch" type="radio" name="UsRol2" value="Usuario"/> Usuario general
        </label>
      </div>
    @else
      <div class="">
        <label>
          <input class="testswitch" type="radio" name="UsRol2" value="Usuario"/> Usuario general
        </label>
      </div>
    @endif
    {{-- Swicht Cliente --}}
    @if ($user->UsRol2=="Cliente")
      <div class="">
        <label>
          <input checked class="testswitch" type="radio" name="UsRol2" value="Cliente"/> Cliente registrado
        </label>
      </div>
    @else
      <div class="">
        <label>
          <input class="testswitch" type="radio" name="UsRol2" value="Cliente"/> Cliente registrado
        </label>
      </div>
    @endif
		{{-- Swicht Generador --}}
    @if ($user->UsRol2=="Generador")
      <div class="">
        <label>
          <input checked class="testswitch" type="radio" name="UsRol2" value="Generador"/> Generador de residuos
        </label>
      </div>
    @else
      <div class="">
        <label>
          <input class="testswitch" type="radio" name="UsRol2" value="Generador"/> Generador de residuos
        </label>
      </div>
    @endif

    {{-- Swicht Auditor --}}
    @if ($user->UsRol2=="Auditor")
      <div class="">
        <label>
          <input checked class="testswitch" type="radio" name="UsRol2" value="Auditor"/> Auditor Externo
        </label>
      </div>
    @else
      <div class="">
        <label>
          <input class="testswitch" type="radio" name="UsRol2" value="Auditor"/> Auditor Externo
        </label>
      </div>
    @endif

	</div>
  <label class="control-label col-md-3 col-sm-3 col-xs-12"><h3>Internos</h3></label>
  <div class="col-md-9 col-sm-9 col-xs-12">


    {{-- Swicht JefeLogistica --}}
    @if ($user->UsRol2=="JefeLogistica")
      <div class="">
        <label>
          <input checked class="testswitch" type="radio" name="UsRol2" value="JefeLogistica"/> Jefe de Logistica
        </label>
      </div>
    @else
      <div class="">
        <label>
          <input class="testswitch" type="radio" name="UsRol2" value="JefeLogistica"/> Jefe de Logistica
        </label>
      </div>
    @endif

    {{-- Swicht AuxiliarLogistica --}}
    @if ($user->UsRol2=="AuxiliarLogistica")
      <div class="">
        <label>
          <input checked class="testswitch" type="radio" name="UsRol2" value="AuxiliarLogistica"/> Auxiliar de Logistica
        </label>
      </div>
    @else
      <div class="">
        <label>
          <input class="testswitch" type="radio" name="UsRol2" value="AuxiliarLogistica"/> Auxiliar de Logistica
        </label>
      </div>
    @endif

    {{-- Swicht AsistenteLogistica --}}
    @if ($user->UsRol2=="AsistenteLogistica")
      <div class="">
        <label>
          <input checked class="testswitch" type="radio" name="UsRol2" value="AsistenteLogistica"/> Asistente de Logistica
        </label>
      </div>
    @else
      <div class="">
        <label>
          <input class="testswitch" type="radio" name="UsRol2" value="AsistenteLogistica"/> Asistente de Logistica
        </label>
      </div>
    @endif

    {{-- Swicht JefeOperacion --}}
    @if ($user->UsRol2=="JefeOperacion")
      <div class="">
        <label>
          <input checked class="testswitch" type="radio" name="UsRol2" value="JefeOperacion"/> Jefe de Operaciones
        </label>
      </div>
    @else
      <div class="">
        <label>
          <input class="testswitch" type="radio" name="UsRol2" value="JefeOperacion"/> Jefe de Operaciones
        </label>
      </div>
    @endif

    {{-- Swicht SupervisorTurno --}}
    @if ($user->UsRol2=="SupervisorTurno")
      <div class="">
        <label>
          <input checked class="testswitch" type="radio" name="UsRol2" value="SupervisorTurno"/> Supervisor de Turno
        </label>
      </div>
    @else
      <div class="">
        <label>
          <input class="testswitch" type="radio" name="UsRol2" value="SupervisorTurno"/> Supervisor de Turno
        </label>
      </div>
    @endif

    {{-- Swicht EncargadoAlmacen --}}
    @if ($user->UsRol2=="EncargadoAlmacen")
      <div class="">
        <label>
          <input checked class="testswitch" type="radio" name="UsRol2" value="EncargadoAlmacen"/> Encargado de Almacen
        </label>
      </div>
    @else
      <div class="">
        <label>
          <input class="testswitch" type="radio" name="UsRol2" value="EncargadoAlmacen"/> Encargado de Almacen
        </label>
      </div>
    @endif

    {{-- Swicht EncargadoHorno --}}
    @if ($user->UsRol2=="EncargadoHorno")
      <div class="">
        <label>
          <input checked class="testswitch" type="radio" name="UsRol2" value="EncargadoHorno"/> Encargado de Horno
        </label>
      </div>
    @else
      <div class="">
        <label>
          <input class="testswitch" type="radio" name="UsRol2" value="EncargadoHorno"/> Encargado de Horno
        </label>
      </div>
    @endif


    {{-- Swicht Tesoreria --}}
    @if ($user->UsRol2=="Tesoreria")
      <div class="">
        <label>
          <input checked class="testswitch" type="radio" name="UsRol2" value="Tesoreria"/> Tesoreria
        </label>
      </div>
    @else
      <div class="">
        <label>
          <input class="testswitch" type="radio" name="UsRol2" value="Tesoreria"/> Tesoreria
        </label>
      </div>
    @endif

    {{-- Swicht AdminCuenta --}}
    @if ($user->UsRol2=="AdminCuenta")
      <div class="">
        <label>
          <input checked class="testswitch" type="radio" name="UsRol2" value="AdminCuenta"/> Administrador de cuenta
        </label>
      </div>
    @else
      <div class="">
        <label>
          <input class="testswitch" type="radio" name="UsRol2" value="AdminCuenta"/> Administrador de cuenta
        </label>
      </div>
    @endif
    {{-- validacion de permisos para ver swicht de los siguientes roles--}}
    @if (Auth::user()->UsRol2 == "Programador"||Auth::user()->UsRol2 == "admin")
      {{-- Swicht AdminComercial --}}
      @if ($user->UsRol2=="AdminComercial")
        <div class="">
          <label>
            <input checked class="testswitch" type="radio" name="UsRol2" value="AdminComercial"/> Director Comercial
          </label>
        </div>
      @else
        <div class="">
          <label>
            <input class="testswitch" type="radio" name="UsRol2" value="AdminComercial"/> Director Comercial
          </label>
        </div>
      @endif

      {{-- Swicht AdminPlanta --}}
      @if ($user->UsRol2=="admin")
        <div class="">
          <label>
            <input checked class="testswitch" type="radio" name="UsRol2" value="admin"/> Director de Planta
          </label>
        </div>
      @else
        <div class="">
          <label>
            <input class="testswitch" type="radio" name="UsRol2" value="admin"/> Director de Planta
          </label>
        </div>
      @endif

      {{-- Swicht Programador --}}
      @if ($user->UsRol2=="Programador")
        <div class="">
          <label>
            <input checked class="testswitch" type="radio" name="UsRol2" value="Programador"/> Programador de Software
          </label>
        </div>
      @else
        <div class="">
          <label>
            <input class="testswitch" type="radio" name="UsRol2" value="Programador"/> Programador de Software
          </label>
        </div>
      @endif
    @endif
  </div>
</div>
{{-- <script>
document.addEventListener("DOMContentLoaded", function(){
  var value = '{{$user->UsRol2}}';
  var allInputs = document.getElementsByName('UsRol2');
  var results = [];
  for(var x=1;x<allInputs.length;x++){
    if(allInputs[x].value == value){
      allInputs[x].contents().unwrap().wrap('<input checked class="testswitch" type="radio" name="UsRol2" value="'+value+'"/>');
      results.push(allInputs[x]);
      console.log(results);
    }
        
// return results;
    
  };
});  
// window.onload=getInputsByValue;
</script> --}}
                    
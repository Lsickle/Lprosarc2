@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientregistertittle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.clientregistertittle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Datos Básicos de la empresa</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
					</div>
				</div>
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary">
							{{-- <div class="box-header with-border">
								<h3 class="box-title">Quick Example</h3>
							</div> --}}
							<!-- /.box-header -->
                            <!-- form start -->
                            <div class="fingerprint-spinner" id="loadingTable">
								<div class="spinner-ring"><b style="font-size: 1.8rem;">L</b></div>
								<div class="spinner-ring"><b style="font-size: 1.8rem;">o</b></div>
								<div class="spinner-ring"><b style="font-size: 1.8rem;">a</b></div>
								<div class="spinner-ring"><b style="font-size: 1.8rem;">d</b></div>
								<div class="spinner-ring"><b style="font-size: 1.8rem;">i</b></div>
								<div class="spinner-ring"><b style="font-size: 1.8rem;">n</b></div>
								<div class="spinner-ring"><b style="font-size: 1.8rem;">g</b></div>
								<div class="spinner-ring"><b style="font-size: 1.8rem;">.</b></div>
								<div class="spinner-ring"><b style="font-size: 1.8rem;">.</b></div>
							</div>
							<form role="form" action="/clientes" method="POST" enctype="multipart/form-data">
                                {{-- @csrf --}}
                                {{ csrf_field() }}
                                <div class="box-body" hidden onload="renderTable()" id="readyTable">
									<div class="tab-pane" id="addRowWizz">
										<p>Añada la información necesaria completando los campos requeridos</p>
										<div class="smartwizardCli">
											<ul>
												<li><a href="#step-1"><b>Paso 1</b><br /><small>Datos de la Empresa</small></a></li>
												<li><a href="#step-2"><b>Paso 2</b><br /><small>Datos de la sede</small></a></li>
												<li><a href="#step-3"><b>Paso 3</b><br /><small>Datos de la persona de Contacto</small></a></li>
											</ul>
											<!-- general form elements -->
								            <div class="row">
												<div id="step-1" class="">
													<div class="col-md-12">
                                                        <label for="ClienteInputNit">NIT</label>
                                                        <input minlength="17" maxlength="17" required="true" name="CliNit" autofocus="true" type="text" class="form-control CliNit" id="ClienteInputNit" placeholder="XXX.XXX.XXX-X">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="ClienteInputRazon">Razón Social</label>
                                                        <input required="true" name="CliName" type="text" class="form-control" id="ClienteInputRazon" placeholder="PROTECCION SERVICIOS AMBIENTALES RESPEL DE COLOMBIA S.A. ESP.">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="ClienteInputNombre">Nombre Corto</label>
                                                        <input required="true" name="CliShortname" type="text" class="form-control" id="ClienteInputNombre" placeholder="Prosarc">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="tipo">Tipo de Empresa</label>
                                                        <select class="form-control" id="tipo" name="CliType" required>
                                                            <option onclick="HiddenOtroType()" value="">Seleccione...</option>
                                                            <option onclick="HiddenOtroType()">Organico</option>
                                                            <option onclick="HiddenOtroType()">Biologico</option>
                                                            <option onclick="HiddenOtroType()">Industrial</option>
                                                            <option onclick="HiddenOtroType()" >Medicamentos</option>
                                                            <option onclick="OtroType()" value="">Otro</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6" id="otroTyp">
                                                    </div>
                                                    @if(Auth::user()->UsRol !== "Cliente")
                                                    <div class="col-md-6">
                                                        <label for="categoria">Categoría</label>
                                                        <select class="form-control" id="categoria" name="CliCategoria" required>
                                                            <option value="">Seleccione...</option>
                                                            <option>Cliente</option>
                                                            <option>Transportador</option>
                                                            <option>Proveedor</option>
                                                        </select>
                                                    </div>
                                                    @endif
                                                    {{-- <button class="btn btn-primary" type="reset" href="#step-2">Siguiente</button> --}}
                                                    {{-- <div class="box-footer" style="display:flex; justify-content:center">
                                                            <a id="sasd" class="btn btn-primary" onclick="verifyCli()">Siguiente</a>
                                                        </div> --}}
                                                </div>
                                                <div id="step-2" class="">
                                                    <div class="col-md-12">
                                                        <h2>Sede Principal</h2>
                                                    </div>
													<div class="col-md-6">
                                                        <label for="sedeinputname">Nombre</label>
                                                        <input type="text" class="form-control" id="sedeinputname" placeholder="Prosarc" name="SedeName" required="true">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="sedeinputemail">Email</label>
                                                        <input type="email" class="form-control" id="sedeinputemail" placeholder="Sistemas@prosarc.com" name="SedeEmail" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="departamento">Departamento</label>
                                                        <select class="form-control" id="departamento" name="departamento" required="true" data-dependent="FK_SedeMun">
                                                            <option onclick="Disabled()" value="">Seleccione...</option>
                                                            @foreach ($Departamentos as $Departamento)		
                                                                <option value="{{$Departamento->ID_Depart}}" onclick="Enabled()">{{$Departamento->DepartName}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="FK_SedeMun">Municipio</label>
                                                        <select class="form-control" id="FK_SedeMun" name="FK_SedeMun"  disabled>
                                                            <option value="">Seleccione...</option>
                                                            {{-- @foreach ($Municipios as $Municipio) 
                                                                <option value="{{$Municipio->ID_Mun}}">{{$Municipio->MunName}}</option> 
                                                            @endforeach --}}
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="sedeinputcelular">Celular</label>
                                                        <input type="text" class="form-control" id="sedeinputcelular" placeholder="3014145321" name="SedeCelular">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="sedeinputaddress">Dirección</label>
                                                        <input type="text" class="form-control" id="sedeinputaddress" placeholder="cll 23 #11c-03" name="SedeAddress" required>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <label for="sedeinputphone1">Teléfono</label>
                                                        <input type="tel" class="form-control" id="sedeinputphone1" placeholder="031-4123141" name="SedePhone1" maxlength="16">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="sedeinputext1">Extensión</label>
                                                        <input type="number" class="form-control" id="sedeinputext1" placeholder="1555" name="SedeExt1" max="9999">
                                                    </div>
                                                    <div id="telefono2">
                                                    </div>
                                                    <div class="box-footer" style="display:flex; justify-content:center">
                                                        <a id="tel" onclick="Tel()"class="btn btn-info">Otro Teléfono</a>
                                                    </div>
                                                    <div id="divSede">
                                                    </div>
                                                    {{-- <a href="step-1"class="btn btn-primary">Anterior</a>
                                                    <a href="step-3"class="btn btn-primary">Siguiente</a> --}}
                                                </div>
                                                <div id="step-3" class="">
                                                    <h2>Persona de Contacto</h2>
                                                    <div class="col-md-6">
                                                        <label for="AreaName">Area</label>
                                                        <input type="text" class="form-control" id="AreaName" placeholder="Nombre del Area" name="AreaName" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="CargName">Cargo</label>
                                                        <input type="text" class="form-control" id="CargName" placeholder="Nombre del Cargo" name="CargName" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="PersFirstName">Nombre</label>
                                                        <input type="text" class="form-control" id="PersFirstName" placeholder="Nombre de la Persona" name="PersFirstName" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="PersLastName">Apellido</label>
                                                        <input type="text" class="form-control" id="PersLastName" placeholder="Apellido de la Persona" name="PersLastName" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="PersEmail">Email</label>
                                                        <input type="text" class="form-control" id="PersEmail" placeholder="Email de la Persona" name="PersEmail" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="PersSecondName">Celular</label>
                                                        <input type="text" class="form-control" id="PersSecondName" placeholder="Numero de celular" name="PersCellphone">
                                                    </div>
                                                    <a href="step-2"class="btn btn-primary">Anterior</a>
                                                    <input hidden value="1" name="number">
                                                    <div class="box-footer" style="float:right; margin-right:5%">
                                                        <button type="submit" class="btn btn-primary">Registrar</button>
                                                    </div>
                                                </div>
											</div>
										</div>
									</div>
								</div>
                                {{-- <div class="col-md-12"> --}}
                                    {{-- </div> --}}
                                    <!-- /.box-body -->
							</form>
						</div>
						<!-- /.box -->
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!--/.col (right) -->
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</div>
<script>
    function Tel(){
        var Telefono = '<div class="col-md-6" id="sedeinputphone2"><label for="sedeinputphone2">Teléfono 2</label><input type="tel" class="form-control" id="sedeinputphone2" placeholder="(031)-412 3141" name="SedePhone2" maxlength="16"></div><div class="col-md-6" id="sedeinputext2"><label for="sedeinputext2">Extensión 2</label><input type="number" class="form-control" id="sedeinputext2" placeholder="1555" name="SedeExt2" max="9999"></div>';
        $('#telefono2').append(Telefono);
        $('#tel').remove();
    }
    function Enabled(){
        document.getElementById("FK_SedeMun").disabled = false;
    }
        // var departamento = document.getElementById("departamento").value;
        
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // $.ajax({
        //     url:"{{url('/clientes-2')}}",
        //     method:'post',
        //     // type:"POST",
        //     dataType: 'json',
        //     data:{
        //         departamento
        //     },
        //     success: function (msg) {
        //         alert("Se ha realizado el POST con exito " + departamento);
        // }
        // }); 
    function Disabled(){
        document.getElementById("FK_SedeMun").disabled = true;
    }
    function OtroType(){
        var Otro ='<div id="otroType"><label for="otroType">¿Cuál?</label><input name="CliType" type="text" class="form-control" id="otroType"></div>';
        $('#otroTyp').append(Otro);
    }
    function HiddenOtroType(){
        $('#otroType').remove();
    }
</script>
<script>
    $(document).ready(function(){
        $('#departamento').change(function(){
            if($(this).val() != ''){
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="token"]').val();
                $.ajax({
                    // url:"{{url('/clientes-2')}}",
                    url:"{{ route('clientes.ajax') }}",
                    method:'POST',
                    data:{
                        selelect:select, value:value, dependent:dependent, _token:_token
                    },
                    success:function(result){
                        $('#'+dependent).html(result);
                    }
                });
            }
        });
    });

    // function verifyCli(){
    //     var ClienteInputNit, ClienteInputRazon, ClienteInputNombre, CliType;
    //     ClienteInputNit = document.getElementById("ClienteInputNit").value;
    //     ClienteInputRazon = document.getElementById("ClienteInputRazon").value;
    //     ClienteInputNombre = document.getElementById("ClienteInputNombre").value;

    //     // CliType = document.getElementById("tipo").value;
        
    //     window.location = "#step-2";
    //     // if(ClienteInputNit = null || ClienteInputRazon = null || ClienteInputNombre = null ){

    //     // alert("llene los campos");
    //     // }else{
    //     // }
    // }

</script>

@endsection

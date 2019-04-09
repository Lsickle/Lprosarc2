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
                                @csrf
                                <div class="box-body" hidden onload="renderTable()" id="readyTable">
									<div class="tab-pane" id="addRowWizz">
										<p>Añada la información necesaria completando los campos requeridos</p>
										<div id="smartwizard">
											<ul>
												<li><a href="#step-1"><b>Paso 1</b><br /><small>Datos de la Empresa</small></a></li>
												<li><a href="#step-2"><b>Paso 2</b><br /><small>Datos de la sede</small></a></li>
											</ul>
											<!-- general form elements -->
								            <div class="row">
												<div id="step-1" class="">

													<div class="form-group">
                                                        <label for="ClienteInputNit">NIT</label>
                                                        <input minlength="17" maxlength="17" required="true" name="CliNit" autofocus="true" type="text" class="form-control" id="ClienteInputNit" placeholder="XXX.XXX.XXX.XXX-X">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ClienteInputRazon">Razon Social</label>
                                                        <input required="true" name="CliName" type="text" class="form-control" id="ClienteInputRazon" placeholder="PROTECCION SERVICIOS AMBIENTALES RESPEL DE COLOMBIA S.A. ESP.">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Nombre Corto</label>
                                                        <input required="true" name="CliShortname" type="text" class="form-control" id="ClienteInputNombre" placeholder="Prosarc">
                                                    </div>
                                                </div>

                                                <div id="step-2" class="">
                                                    <div class="col-md-12">
                                                        <h2>Sede</h2>
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
                                                        <select class="form-control" id="departamento" name="Departamento" required="true" >
                                                            {{-- <option value="">Seleccione...</option> --}}
                                                            @foreach ($Departamentos as $Departamento)		
                                                                <option value="{{$Departamento->ID_Depart}}" onclick="enabled()">{{$Departamento->DepartName}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="GSedemunicipio">Municipio</label>
                                                        <select class="form-control" id="GSedemunicipio" name="FK_SedeMun" required disabled>
                                                        <option value="">Seleccione...</option>
                                                        @foreach ($Municipios as $Municipio)
                                                            <option value="{{$Municipio->ID_Mun}}">{{$Municipio->MunName}}</option>
                                                        @endforeach
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

                                                    <div class="col-md-6" id="sedeinputphone2" style="display: none;">
                                                        <label for="sedeinputphone2">Teléfono 2</label>
                                                        <input type="tel" class="form-control" id="sedeinputphone2" placeholder="(031)-412 3141" name="SedePhone2" maxlength="16">
                                                    </div>
                                                    <div class="col-md-6" id="sedeinputext2" style="display: none;">
                                                        <label for="sedeinputext2">Extensión 2</label>
                                                        <input type="number" class="form-control" id="sedeinputext2" placeholder="1555" name="SedeExt2" max="9999">
                                                    </div>
                                                    <div class="box-footer" style="display:flex; justify-content:center">
                                                        <a id="tel" onclick="Tel()"class="btn btn-info">Otro Teléfono</a>
                                                    </div>
                                                    <div id="divSede">
                                                    </div>
                                                    <input hidden value="1" name="number">
                                                    <div class="col-md-12">

                                                        <div class="box-footer" style="float:left;">
                                                            <a id="add" onclick="AddSedes()" class="btn btn-success"><i class="fas fa-plus"> </i> Agregar Sede</a>
                                                        </div> 
                                                        <div class="box-footer" style="float:right; margin-right:5%">
                                                            <button type="submit" class="btn btn-primary">Registrar</button>
                                                        </div>
                                                    </div>
												</div>
											</div>
										</div>
									</div>
								</div>
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
        document.getElementById("sedeinputphone2").style.display = "block";
        document.getElementById("sedeinputext2").style.display = "block";
        document.getElementById("tel").style.display = "none";
    }
    function enabled(){
        // var Departamento =document.getElementById("Departamento").value;
        // if(Departamento !== ""){
            var Departamento = document.getElementById("departamento").value;
        // }
            $.ajax({
            type:'post',
            url:'../app/Http/Controllers/cliencontroller.php',
            data:Departamento   
        });
        document.getElementById("GSedemunicipio").disabled = false;
    }
    var contador = 1;
    function AddSedes(){
        var Sede = '<div id="Sede['+contador+']"><div class="col-md-12"><h2>Sede <a id="delete['+contador+']" onclick="fin('+contador+')" class="btn btn-danger" style="float:right;"><i class="fas fa-times"></i> Borrar</a></h2></div><div class="col-md-6"><label for="sedeinputname['+contador+']">Nombre</label><input type="text" class="form-control" id="sedeinputname['+contador+']" placeholder="Prosarc" name="SedeName['+contador+']" required="true"></div><div class="col-md-6"><label for="sedeinputemail['+contador+']">Email</label><input type="email" class="form-control" id="sedeinputemail['+contador+']" placeholder="Sistemas@prosarc.com" name="SedeEmail['+contador+']" required></div><div class="col-md-6"><label for="departamento['+contador+']">Departamento</label><select class="form-control" id="departamento['+contador+']" name="Departamento['+contador+']" required="true" ><option value="">Seleccione...</option>@foreach ($Departamentos as $Departamento)		<option value="{{$Departamento->ID_Depart}}" onclick="enabled()">{{$Departamento->DepartName}}</option>@endforeach</select></div><div class="col-md-6"><label for="GSedemunicipio['+contador+']">Municipio</label><select class="form-control" id="GSedemunicipio['+contador+']" name="FK_SedeMun['+contador+']" required disabled="true"><option value="">Seleccione...</option>@foreach ($Municipios as $Municipio)<option value="{{$Municipio->ID_Mun}}">{{$Municipio->MunName}}</option>@endforeach</select></div><div class="col-md-6"><label for="sedeinputcelular['+contador+']">Celular</label><input type="text" class="form-control" id="sedeinputcelular['+contador+']" placeholder="3014145321" name="SedeCelular['+contador+']"></div><div class="col-md-6"><label for="sedeinputaddress['+contador+']">Dirección</label><input type="text" class="form-control" id="sedeinputaddress['+contador+']" placeholder="cll 23 #11c-03" name="SedeAddress['+contador+']" required></div><div class="col-md-6"><label for="sedeinputphone1['+contador+']">Teléfono</label><input type="tel" class="form-control" id="sedeinputphone1['+contador+']" placeholder="031-4123141" name="SedePhone1['+contador+']" maxlength="16"></div><div class="col-md-6"><label for="sedeinputext1['+contador+']">Extensión</label><input type="number" class="form-control" id="sedeinputext1['+contador+']" placeholder="1555" name="SedeExt1['+contador+']" max="9999"></div><div class="col-md-6" id="sedeinputphone2['+contador+']" style="display: none;"><label for="telefono2['+contador+']">Teléfono 2</label><input type="tel" class="form-control" id="telefono2['+contador+']" placeholder="(031)-412 3141" name="SedePhone2['+contador+']" maxlength="16"></div><div class="col-md-6" id="sedeinputext2['+contador+']" style="display: none;"><label for="ext2['+contador+']">Extensión 2</label><input type="number" class="form-control" id="ext2['+contador+']" placeholder="1555" name="SedeExt2['+contador+']" max="9999"></div><div class="box-footer" style="display:flex; justify-content:center"><a class="btn btn-info" id="tel['+contador+']" onclick="TelExt('+contador+')" name="tel">Otro Teléfono</a></div></div></div>';

        $("#divSede").append(Sede);
// $("#sedeinputphone1['+contador+']").children(Sede).remove();


    
    contador= parseInt(contador)+1;
}
    
    function TelExt(id){
        document.getElementById("SedePhone2"+id).style.display = "block";
        document.getElementById("SedeExt2"+id).style.display = "block";
        document.getElementById("tel"+id).style.display = "none";
    }
    function fin(id){
        document.getElementById("Sede"+id).style.display = "none";
    }
    

</script>

@endsection

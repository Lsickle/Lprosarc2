<div id="tratamiento`+contador+`Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
    <div class="col-md-8" style="margin-bottom: 0.25em;">
        <label data-trigger="hover" data-toggle="popover" title="Seleccione Un Tratamiento" data-content="<p> Seleccione entre los tratamientos Viables(segun la Clasificación del residuo) o cualquiera de los tratamientos previamente registrados en la aplicacion SiReS</b></p>" for="tratamiento`+contador+`">
        Tratamiento
        </label>
        <select class="selecttrat" id="opciontratamiento`+contador+`" name="Opcion[`+contador+`][Tratamiento]" style="width:100%;">
            <option disabled="true" selected="true">Seleccione un Tratamiento...</option>
            <optgroup label="--------------Viables--------------">
                @foreach($tratamientosViables as $tratamientoviable)
                    @foreach($tratamientoviable->tratamientos as $tratamientoviable1)
                        <option onclick="recargarAjaxTratamiento(`+contador+`)" value="{{$tratamientoviable1->ID_Trat}}">{{"$tratamientoviable1->TratName"}} - {{"$tratamientoviable1->CliShortname"}}</option>
                    @endforeach
                @endforeach
            </optgroup>
            <optgroup label="----------Prosarc S.A. ESP----------">
                @foreach($tratamientos as $tratamiento)
                    @if($tratamiento->TratTipo == 0)
                    <option onclick="recargarAjaxTratamiento(`+contador+`)" value="{{$tratamiento->ID_Trat}}">{{"$tratamiento->TratName"}} - {{"$tratamiento->CliShortname"}}</option>
                    @endif
                @endforeach
            </optgroup>
            <optgroup label="-----------Otros Gestores-----------">
                @foreach($tratamientos as $tratamiento)
                    @if($tratamiento->TratTipo == 1)
                    <option onclick="recargarAjaxTratamiento(`+contador+`)" value="{{$tratamiento->ID_Trat}}">{{"$tratamiento->TratName"}} - {{"$tratamiento->CliShortname"}}</option>
                    @endif
                @endforeach 
            </optgroup>
        </select>
    </div>
    <div class="col-md-2">
        <div class="col-md-12">
            <label data-trigger="hover" data-toggle="popover" title="Tratamiento Ofertado</b>" data-content="<p> autorización para que el cliente pueda elegir el tratamiento de este residuo al momento de realizar la solicitud de servicio</p>">  Ofertado</label>
            <input type="radio" class="testswitch" id="ofert`+contador+`" name="TratOfertado" value="`+contador+`" />  
        </div>
    </div>
    <div class="col-md-2">
        <div class="col-md-12">
            <label data-trigger="hover" data-toggle="popover" title="Eliminar Tratamiento</b>" data-content="<p>Al eliminar el tratamiento automaticamente se eliminaran las tarifas relacionadas</p>"> Eliminar</label>
            <button class="btn btn-danger droOptionButton" {{in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial) ? 'Disabled' : '' }} onclick="EliminarOption(`+contador+`)" id="droOptionButton`+contador+`"><i class="fas fa-trash"></i></button> 
        </div>
    </div>
</div>

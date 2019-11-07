
@php
    if ($opcion['ofertado'] == 1||$opcion['en_uso'] == 1) {
        $OpcionOfertada = 1;
    }else{
        $OpcionOfertada = 0;
    }
@endphp

<div id="tratamiento{{$contadorphp}}Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
    {{-- input de control para requerimiento --}}
    <input hidden type="text" name="Opcion[{{$contadorphp}}][ReqSlug]" value="{{$opcion['ReqSlug']}}">
    {{-- form start --}}
    <div class="col-md-8" style="margin-bottom: 0.25em;">
        <label data-trigger="hover" data-toggle="popover" title="Seleccione Un Tratamiento" data-content="<p> Seleccione entre los tratamientos Viables(segun la Clasificación del residuo) o cualquiera de los tratamientos previamente registrados en la aplicacion SiReS</b></p>" for="tratamiento{{$contadorphp}}">
        Tratamiento
        </label>
        <select {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) && $OpcionOfertada==0 ? '' : 'disabled' }} class="selecttrat" id="opciontratamiento{{$contadorphp}}" name="Opcion[{{$contadorphp}}][Tratamiento]" style="width:100%;">
            <option disabled="true" selected="true">Seleccione un Tratamiento...</option>
            <optgroup label="--------------Viables--------------">
                @foreach($tratamientosViables as $tratamientoviable)
                    @foreach($tratamientoviable->tratamientosConGestor as $tratamientoviable)
                        <option onclick="recargarAjaxTratamiento({{$contadorphp}})" value="{{$tratamientoviable->ID_Trat}}">{{"$tratamientoviable->TratName"}} - {{"$tratamientoviable->CliShortname"}}</option>
                    @endforeach
                @endforeach
            </optgroup>
            <optgroup label="----------Prosarc S.A. ESP----------">
                @foreach($tratamientos as $tratamiento)
                    @if($tratamiento->TratTipo == 0)
                    <option  {{ $opcion->FK_ReqTrata === $tratamiento->ID_Trat ? "selected" : "" }} onclick="recargarAjaxTratamiento({{$contadorphp}})" value="{{$tratamiento->ID_Trat}}">{{"$tratamiento->TratName"}} - {{"$tratamiento->CliShortname"}}</option>
                    @endif
                @endforeach
            </optgroup>
            <optgroup label="-----------Otros Gestores-----------">
                @foreach($tratamientos as $tratamiento)
                    @if($tratamiento->TratTipo == 1)
                    <option {{ $opcion->FK_ReqTrata === $tratamiento->ID_Trat ? "selected" : "" }} onclick="recargarAjaxTratamiento({{$contadorphp}})" value="{{$tratamiento->ID_Trat}}">{{"$tratamiento->TratName"}} - {{"$tratamiento->CliShortname"}}</option>
                    @endif
                @endforeach 
            </optgroup>
        </select>
        @if(in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial)||$OpcionOfertada==1)
            <input hidden name="Opcion[{{$contadorphp}}][Tratamiento]" value="{{$opcion->FK_ReqTrata}}"> 
        @endif
    </div>
    <div class="col-md-2">
        <div class="col-md-12">
            <label data-trigger="hover" data-toggle="popover" title="Tratamiento Ofertado</b>" data-content="<p> autorización para que el cliente pueda elegir el tratamiento de este residuo al momento de realizar la solicitud de servicio</p>">  Ofertado</label>
            <input {{in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial) ? '' : 'disabled' }} {{$opcion['ofertado'] == 1 ? "checked=true" : ""}} type="radio" class="ofertaswitch" id="ofert{{$contadorphp}}" name="TratOfertado" value="{{$contadorphp}}"/>
            @if((in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) && ($opcion['ofertado'] == 1))
                <input hidden name="TratOfertado" value="{{$contadorphp}}"> 
            @endif
        </div>
    </div>
    <div class="col-md-2">
        <div class="col-md-12">
            <label data-trigger="hover" data-toggle="popover" title="Eliminar Tratamiento</b>" data-content="<p>Al eliminar el tratamiento automaticamente se eliminaran las tarifas relacionadas</p>"> Eliminar</label>
            <button class="btn btn-danger droOptionButton" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) && $OpcionOfertada==0 ? '' : 'disabled' }} onclick="EliminarOption({{$contadorphp}})" id="droOptionButton{{$contadorphp}}"><i class="fas fa-trash"></i></button> 
        </div>
    </div>
</div>
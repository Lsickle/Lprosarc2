<div id="tratamiento`+contador+`Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
    <div class="col-md-8" style="margin-bottom: 0.25em;">
        <label for="tratamiento`+contador+`">tratamiento</label>
        <select class="form-control" id="tratamiento`+contador+`" name="FK_ReqTrata[]">
            <option disabled="true">seleccione...</option>
            <optgroup label="Tratamientos Viables">
                @foreach($tratamientosViables as $tratamientoviable)
                    @foreach($tratamientoviable->tratamientos as $tratamientoviable1)
                        <option onclick="recargarAjaxTratamiento(`+contador+`)" value="{{$tratamientoviable1->ID_Trat}}"><b><b>{{"$tratamientoviable1->TratName"}}</b></b> - {{"$tratamientoviable1->CliName"}}</option>
                    @endforeach
                @endforeach
            </optgroup>
            <optgroup label="Interno">
                @foreach($tratamientos as $tratamiento)
                    @if($tratamiento->TratTipo == 0)
                    <option onclick="recargarAjaxTratamiento(`+contador+`)" value="{{$tratamiento->ID_Trat}}"><b><b>{{"$tratamiento->TratName"}}</b></b> - {{"$tratamiento->CliName"}}</option>
                    @endif
                @endforeach
            </optgroup>
            <optgroup label="Externo">
                @foreach($tratamientos as $tratamiento)
                    @if($tratamiento->TratTipo == 1)
                    <option onclick="recargarAjaxTratamiento(`+contador+`)" value="{{$tratamiento->ID_Trat}}"><b><b>{{"$tratamiento->TratName"}}</b></b> - {{"$tratamiento->CliName"}}</option>
                    @endif
                @endforeach 
            </optgroup>
        </select>
    </div>
    <div class="col-md-2">
        <div class="col-md-12">
            <label data-trigger="hover" data-toggle="popover" title="<b>Tratamiento Ofertado</b>" data-content="<p> autorización para que el cliente pueda elegir el tratamiento de este residuo al momento de realizar la solicitud de servicio</p>">  Ofertado</label>
            <input  type="checkbox" class="testswitch" id="ofert`+contador+`" name="TratOfertado[]"/>  
        </div>
    </div>
    <div class="col-md-2">
        <div class="col-md-12">
            <label data-trigger="hover" data-toggle="popover" title="<b>Eliminar Tratamiento</b>" data-content="<p> autorización para que el cliente pueda elegir el tratamiento de este residuo al momento de realizar la solicitud de servicio</p>"> Eliminar</label>
            <button class="btn btn-danger" {{in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial) ? 'Disabled' : '' }} onclick="EliminarOption(`+contador+`)"><i class="fas fa-trash"></i></button> 
        </div>
    </div>
</div>

<div class="col-md-10">
    <label for="tratamiento0">Opción 1</label>
    <select class="form-control" id="tratamiento0" name="FK_ReqTrata[]">
  		<option>seleccione...</option>
    	<optgroup label="Interno">
    		@foreach($tratamientos as $tratamiento)
	    		@if($tratamiento->TratTipo == 0)
	    		<option value="{{$tratamiento->ID_Trat}}"><b><b>{{"$tratamiento->TratName"}}</b></b> - {{"$tratamiento->CliName"}}</option>
	    		@endif
	    	@endforeach
    	</optgroup>
    	<optgroup label="Externo">
    		@foreach($tratamientos as $tratamiento)
	    		@if($tratamiento->TratTipo == 1)
	    		<option value="{{$tratamiento->ID_Trat}}"><b><b>{{"$tratamiento->TratName"}}</b></b> - {{"$tratamiento->CliName"}}</option>
	    		@endif
	    	@endforeach	
    	</optgroup>
    </select>
</div> <b></b>
<div class="col-md-2">
    <div class="col-md-12">
        <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tratamiento Ofertado</b>" data-content="<p style='width: 50%'> autorización para que el cliente pueda elegir el tratamiento de este residuo al momento de realizar la solicitud de servicio</p>">  Ofertado</label>
        <input  type="checkbox" class="testswitch" id="ofert0" name="TratOfertado"/>  
    </div>
</div>
@section('NewScript')
<script>
function Switch(){
    if ({{in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial) ? '' : 'true' }}) {
        $("#ofert0").bootstrapSwitch('disabled',true);
    }
}
Switch();
</script>
@endsection
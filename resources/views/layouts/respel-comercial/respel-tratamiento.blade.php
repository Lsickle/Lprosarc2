<div class="col-md-6">
    <label for="select1">Tratamiento 1</label>
    <select class="form-control" id="select1" name="TratTipo">
  		<option>seleccione...</option>
    	<optgroup label="Interno">
    		@foreach($tratamientos as $tratamiento)
	    		@if($tratamiento->TratTipo == 0)
	    		<option value="{{$tratamiento->ID_Trat}}">{{"$tratamiento->TratName"}} - {{"$tratamiento->CliName"}}</option>
	    		@endif
	    	@endforeach	
    	</optgroup>
    	<optgroup label="Externo">
    		@foreach($tratamientos as $tratamiento)
	    		@if($tratamiento->TratTipo == 1)
	    		<option value="{{$tratamiento->ID_Trat}}">{{"$tratamiento->TratName"}} - {{"$tratamiento->CliName"}}</option>
	    		@endif
	    	@endforeach	
    	</optgroup>
    </select>
</div>

<div class="col-md-6">
    <label for="select1">Tratamiento 2</label>
    <select class="form-control" id="select1" name="TratTipo">
    	<option>seleccione...</option>
    	<optgroup label="Interno">
    		@foreach($tratamientos as $tratamiento)
	    		@if($tratamiento->TratTipo == 0)
	    		<option value="{{$tratamiento->ID_Trat}}">{{"$tratamiento->TratName"}} - {{"$tratamiento->CliName"}}</option>
	    		@endif
	    	@endforeach	
    	</optgroup>
    	<optgroup label="Externo">
    		@foreach($tratamientos as $tratamiento)
	    		@if($tratamiento->TratTipo == 1)
	    		<option value="{{$tratamiento->ID_Trat}}">{{"$tratamiento->TratName"}} - {{"$tratamiento->CliName"}}</option>
	    		@endif
	    	@endforeach	
    	</optgroup>
    </select>
</div>

<div class="col-md-6">
    <label for="select1">Tratamiento 3</label>
    <select class="form-control" id="select1" name="TratTipo">
    	<option>seleccione...</option>
    	<optgroup label="Interno">
    		@foreach($tratamientos as $tratamiento)
	    		@if($tratamiento->TratTipo == 0)
	    		<option value="{{$tratamiento->ID_Trat}}">{{"$tratamiento->TratName"}} - {{"$tratamiento->CliName"}}</option>
	    		@endif
	    	@endforeach	
    	</optgroup>
    	<optgroup label="Externo">
    		@foreach($tratamientos as $tratamiento)
	    		@if($tratamiento->TratTipo == 1)
	    		<option value="{{$tratamiento->ID_Trat}}">{{"$tratamiento->TratName"}} - {{"$tratamiento->CliName"}}</option>
	    		@endif
	    	@endforeach	
    	</optgroup>
    </select>
</div>

<div class="col-md-6">
    <label for="select2">Gestor</label>
    <select class="form-control" id="select2" name="FK_TratProv" required="true">
        @foreach($Sedes as $sede)
            <option value="{{$sede->ID_Sede}}">{{$sede->SedeName}}</option>
        @endforeach
    </select>
</div>

<div class="col-md-6">
    <label for="input2">Pretratamiento</label>
    <input id="input2" class="form-control" type="text" name="TratPretratamiento">
</div>

<script>


</script>
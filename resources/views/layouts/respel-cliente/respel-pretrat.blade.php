{{-- ingreso de inputs para el pretratamiento --}}
<div id="pretratamiento{{$contadorphp}}Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	<div class="col-md-12" style="margin-bottom: 0.25em;">
	    <label for="pretratamiento{{$contadorphp}}">Pretratamiento</label>
	    <select disabled multiple="multiple" class="form-control" id="pretratamiento{{$contadorphp}}">
	    	@if(isset($opcion['tratamientos'][0]))
		    	@foreach($opcion['tratamientos'][0]->pretratamientos as $pretratamiento)
					<option
						@foreach($opcion->pretratamientosSelected as $pretratSelected)
							@if($pretratSelected->ID_PreTrat == $pretratamiento->ID_PreTrat)
				    			 selected 
			    	    	@endif
			    		@endforeach
					>{{$pretratamiento->PreTratName}}</option>
		    	@endforeach
	    	@endif
	    </select>
	</div>
</div>
{{-- fin de ingreso de inputs para el pretratamiento --}}
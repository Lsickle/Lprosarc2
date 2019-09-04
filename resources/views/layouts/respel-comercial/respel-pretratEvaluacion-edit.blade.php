
@php
    if ($opcion['ofertado'] == 1) {
        $OpcionOfertada = 1;
    }else{
        $OpcionOfertada = 0;
    }
@endphp

{{-- ingreso de inputs para el pretratamiento --}}
<div id="pretratamiento{{$contadorphp}}Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	{{-- <hr class="col-md-10 col-md-offset-1 align-self-center"  id="pretratsparator{{$contadorphp}}" /> --}}
	<div class="col-md-12" style="margin-bottom: 0.25em;">
	    <label for="pretratamiento{{$contadorphp}}">Pretratamiento</label>
	    <select {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) && $OpcionOfertada==0 ? '' : 'disabled' }} multiple="multiple" class="form-control" id="pretratamiento{{$contadorphp}}" name="Opcion[{{$contadorphp}}][Pretratamientos][]">
	    	@if(isset($opcion['tratamientos'][0]))
		    	@foreach($opcion['tratamientos'][0]->pretratamientos as $pretratamiento)
					<option
						@foreach($opcion->pretratamientosSelected as $pretratSelected)
							@if($pretratSelected->ID_PreTrat == $pretratamiento->ID_PreTrat)
				    			 selected 
			    	    	@endif
			    		@endforeach
					value="{{$pretratamiento->ID_PreTrat}}">{{$pretratamiento->PreTratName}}</option>
		    	@endforeach
	    	@endif
	    </select>
    	@foreach($opcion['tratamientos'][0]->pretratamientos as $pretratamiento)
			@foreach($opcion->pretratamientosSelected as $pretratSelected)
				@if($pretratSelected->ID_PreTrat == $pretratamiento->ID_PreTrat)
	    			 @if(in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial)||$OpcionOfertada==1)
	    			     <input hidden name="Opcion[{{$contadorphp}}][Pretratamientos][]" value="{{$pretratamiento->ID_PreTrat}}"> 
	    			 @endif
    	    	@endif
    		@endforeach
    	@endforeach
	</div>
</div>
{{-- fin de ingreso de inputs para el pretratamiento --}}
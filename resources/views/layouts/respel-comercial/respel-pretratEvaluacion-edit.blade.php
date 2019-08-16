
@php
    if ($tratamientoelegido->pivot->Ofertado == 1) {
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
	    	@foreach($PretratamientosSeleccionables as $tratamientoSelecionable)
	    		@if($tratamientoSelecionable->ID_Trat == $tratamientoelegido->ID_Trat)
	    			@foreach($tratamientoSelecionable->pretratamientos as $pretratamiento)
	    				@foreach($respelConPretratamientos as $respelConPretratamiento)
	    					<option
	    					@foreach($respelConPretratamiento->pretratamientosActivados as $pA)
			    				@if($pA->pivot['FK_Trat'] == $tratamientoelegido->ID_Trat && $pA->pivot['FK_PreTrat'] == $pretratamiento->ID_PreTrat)
			    	    			 selected 
			    	    		@endif
	    	    			@endforeach
	    	    			value="{{$pretratamiento->ID_PreTrat}}">{{$pretratamiento->PreTratName}}</option>
	    	    		@endforeach
	    	    	@endforeach
	    	    @endif
	    	@endforeach
	    </select>

    	@foreach($PretratamientosSeleccionables as $tratamientoSelecionable)
    		@if($tratamientoSelecionable->ID_Trat == $tratamientoelegido->ID_Trat)
    			@foreach($tratamientoSelecionable->pretratamientos as $pretratamiento)
    				@foreach($respelConPretratamientos as $respelConPretratamiento)
    					@foreach($respelConPretratamiento->pretratamientosActivados as $pA)
							@if($pA->pivot['FK_Trat'] == $tratamientoelegido->ID_Trat && $pA->pivot['FK_PreTrat'] == $pretratamiento->ID_PreTrat)
				    			 @if(in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial)||$OpcionOfertada==1)
				    			     <input hidden name="Opcion[{{$contadorphp}}][Pretratamientos][]" value="{{$pretratamiento->ID_PreTrat}}"> 
				    			 @endif
				    		@endif
						@endforeach
    	    		@endforeach
    	    	@endforeach
    	    @endif
    	@endforeach
	</div>
{{-- 	<div class="col-md-6" id="pretratdescription{{$contadorphp}}">
		<label for="inputdescript[]">{{ trans('adminlte_lang::LangTratamiento.pretratdescript') }} </label>
		<div class="input-group">
			<input maxlength="250" id="inputdescript[]" class="form-control" type="text" name="PreTratDescription[]">
			<a class="input-group-addon" data-toggle="popover" title="{{ trans('adminlte_lang::LangTratamiento.popovertittle2') }}" data-content="<p style='width: 50%'>{{ trans('adminlte_lang::LangTratamiento.popoverdescript2') }}</p>"><i class="fas fa-info-circle"></i></a>
		</div>
	</div> --}}
</div>
{{-- fin de ingreso de inputs para el pretratamiento --}}
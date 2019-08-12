{{-- ingreso de inputs para el pretratamiento --}}
<div id="pretratamiento{{$contadorphp}}Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	{{-- <hr class="col-md-10 col-md-offset-1 align-self-center"  id="pretratsparator{{$contadorphp}}" /> --}}
	<div class="col-md-12" style="margin-bottom: 0.25em;">
	    <label for="pretratamiento{{$contadorphp}}">Pretratamiento</label>
	    <select multiple="multiple" class="form-control" id="pretratamiento{{$contadorphp}}" name="Opcion[{{$contadorphp}}][Pretratamientos][]">
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
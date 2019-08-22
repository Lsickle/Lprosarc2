<div id="tarifa{{$contadorphp}}Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	<div id="rango{{$contadorphp}}Container" class="col-md-12" style="margin-bottom: 0.25em;">
    	@php
    		$x = 0;
    	@endphp
			@foreach($opcion->tarifas as $tarifa)
					<div class="pull-left col-md-3" style="max-height: 2.3em;">
						<label for="expireRange{{$contadorphp}}" style="font-size: 0.9em;">Vencimiento</label>
						<input disabled id="expireRange{{$contadorphp}}" type="date" class="form-control" value="{{$tarifa->TarifaVencimiento}}">
					</div>
		
					<div class="pull-left col-md-3">
						<label style="font-size: 0.9em;" data-trigger="hover" data-toggle="popover" title="<b>Frecuencia</b>" data-content="<p> se tomara en cuenta para la aplicación de la tarifa respectiva y el calculo del precio según la frecuencia de la cantidad puesta en planta Prosarc S.A. ESP</p>" for="frecrangeSelect{{$contadorphp}}">Frec.</label>
						<select disabled id="frecrangeSelect{{$contadorphp}}">
							<option {{$tarifa->TarifaFrecuencia == 'N/A' ? "selected" : ""}}>N/A</option>
							<option {{$tarifa->TarifaFrecuencia == 'Mensual' ? "selected" : ""}}>Mensual</option>
							<option {{$tarifa->TarifaFrecuencia == 'Servicio' ? "selected" : ""}}>Servicio</option>
						</select>
					</div>
					<div class="pull-left col-md-2">
						<label style="font-size: 0.9em;" for="typerangeSelect{{$contadorphp}}">Tipo</label>
						<select disabled id="typerangeSelect{{$contadorphp}}">
							<option {{$tarifa->Tarifatipo == "Kg" ? "selected" : "" }} >Kg</option>
							<option {{$tarifa->Tarifatipo == "Lt" ? "selected" : "" }} >Lt</option>
							<option {{$tarifa->Tarifatipo == "Unid" ? "selected" : "" }} >Unid</option>
						</select>
					</div>
	
					@if(count($tarifa->rangos) > 0)
						@foreach($tarifa->rangos as $rango)
							@php
							$last = $last+1;
							@endphp
							<div class="col-md-3" id="rango{{$contadorphp}}{{$last}}">
								<label style="font-size: 0.8em;" for="rangopriceinput{{$contadorphp}}{{$last}}">Desde {{$rango->TarifaDesde}} </label>
								<input id="rangopriceinput{{$contadorphp}}{{$last}}" disabled type="number" class="form-control" value="{{$rango->TarifaPrecio}}">
							</div>
			    		@endforeach
			    	@else
	
		    			<div class="col-md-3" id="rango{{$contadorphp}}{{$last}}">
		    				<label style="font-size: 0.8em;" for="rangopriceinput{{$contadorphp}}{{$last}}">Desde {{$last}} </label>
		    				<input disabled id="rangopriceinput{{$contadorphp}}{{$last}}"  type="number" class="form-control" placeholder="Precio">
		    			</div>
		    			@php
		    			$last = $last+1;
		    			@endphp
					@endif
	    		@php
	    			$x=$x+1;
	    		@endphp
	    	@endforeach
	</div>
</div>
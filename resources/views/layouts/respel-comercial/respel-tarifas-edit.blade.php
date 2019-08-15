<div id="tarifa{{$contadorphp}}Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	<div id="rango{{$contadorphp}}Container" class="col-md-12" style="margin-bottom: 0.25em;">
    	@foreach($tarifasConRangos as $tarifaConRangos)
			@foreach($tarifaConRangos->tarifasAsignadas as $tarifa)
				@if($tarifa->pivot['FK_Trat'] == $tratamientoelegido->ID_Trat)
					<div class="pull-left col-md-3" style="max-height: 2.3em;">
						<label for="expireRange{{$contadorphp}}" style="font-size: 0.9em;">Vencimiento</label>
						<input id="expireRange{{$contadorphp}}" name="Opcion[{{$contadorphp}}][TarifaVencimiento]" type="date" class="form-control" value="{{$tarifa->TarifaVencimiento}}">
					</div>
					<div class="pull-right col-md-1">
						<label for="addrangeButton{{$contadorphp}}">Más</label>
						<button style="cursor: cell;" onclick="AgregarRango({{$contadorphp}})" class="btn btn-primary addrangeButton" id="addrangeButton{{$contadorphp}}"> <i class="fa fa-plus"></i></button>
					</div>
					<div class="pull-left col-md-3">
						<label style="font-size: 0.9em;" data-trigger="hover" data-toggle="popover" title="<b>Frecuencia</b>" data-content="<p> se tomara en cuenta para la aplicación de la tarifa respectiva y el calculo del precio según la frecuencia de la cantidad puesta en planta Prosarc S.A. ESP</p>" for="frecrangeSelect{{$contadorphp}}">Frec.</label>
						<select id="frecrangeSelect{{$contadorphp}}" name="Opcion[{{$contadorphp}}][TarifaFrecuencia]">
							<option {{$tarifa->TarifaFrecuencia == 'N/A' ? "selected" : ""}}>N/A</option>
							<option {{$tarifa->TarifaFrecuencia == 'Mensual' ? "selected" : ""}}>Mensual</option>
							<option {{$tarifa->TarifaFrecuencia == 'Servicio' ? "selected" : ""}}>Servicio</option>
						</select>
					</div>
					<div class="pull-left col-md-2">
						<label style="font-size: 0.9em;" for="typerangeSelect{{$contadorphp}}">Tipo</label>
						<select id="typerangeSelect{{$contadorphp}}" name="Opcion[{{$contadorphp}}][Tarifatipo]">
							<option {{$tarifa->Tarifatipo == "Kg" ? "selected" : "" }} >Kg</option>
							<option {{$tarifa->Tarifatipo == "Lt" ? "selected" : "" }} >Lt</option>
							<option {{$tarifa->Tarifatipo == "Unid" ? "selected" : "" }} >Unid</option>
						</select>
					</div>
					<script type="text/javaScript">
						    contadorRango[{{$contadorphp}}] = [];
					</script>
					@if(count($tarifa->rangos) > 0)
						@foreach($tarifa->rangos as $rango)
						<script type="text/javaScript">
								contadorRango[{{$contadorphp}}][{{$last}}] = {{$last}};
						</script>
							@php
							$last = $last+1;
							@endphp
							<div class="col-md-3" id="rango{{$contadorphp}}{{$last}}">
								<label style="font-size: 0.8em;" for="rangopriceinput{{$contadorphp}}{{$last}}">Desde {{$rango->TarifaDesde}} </label>
								@if($rango->TarifaDesde != 0)
								<a onclick="EliminarRango({{$contadorphp}},{{$last}})" id="minusrangeButton{{$contadorphp}}{{$last}}"><i style="color:red; margin: 0; padding: 0; margin-top: 0.25em; cursor: pointer;" class="fa fa-trash-alt pull-right"></i></a>
								@endif
								<input id="rangopriceinput{{$contadorphp}}{{$last}}" name="Opcion[{{$contadorphp}}][TarifaPrecio][]" type="number" class="form-control" placeholder="Precio" min="10" value="{{$rango->TarifaPrecio}}">
								<input name="Opcion[{{$contadorphp}}][TarifaDesde][]" hidden value="{{$rango->TarifaDesde}}">
							</div>
			    		@endforeach
			    	@else
			    		<script type="text/javaScript">
			    				contadorRango[{{$contadorphp}}][{{$last}}] = {{$last}};
			    		</script>
		    			<div class="col-md-3" id="rango{{$contadorphp}}{{$last}}">
		    				<label style="font-size: 0.8em;" for="rangopriceinput{{$contadorphp}}{{$last}}">Desde {{$last}} </label>
		    				<input id="rangopriceinput{{$contadorphp}}{{$last}}" name="Opcion[{{$contadorphp}}][TarifaPrecio][]" type="number" class="form-control" placeholder="Precio" min="10">
		    				<input name="Opcion[{{$contadorphp}}][TarifaDesde][]" hidden value="{{$last}}">
		    			</div>
		    			@php
		    			$last = $last+1;
		    			@endphp
					@endif
	    		@endif
	    	@endforeach
    	@endforeach
		
	</div>
</div>
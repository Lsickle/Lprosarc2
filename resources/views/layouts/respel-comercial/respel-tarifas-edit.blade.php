<div id="tarifa{{$contadorphp}}Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	<div style="padding: 0.25em; background-color: #222d32; color: #b8c7ce" class="panel-heading">
	  <h5 class="panel-title">Tratamiento:<b style="color: #E8E8E8" id="tarifa{{$contadorphp}}TratName"> {{$opcion->tratamientos[0]->TratName}}</b>{{-- 	<small>Subtext for header</small> --}}</h5>
	</div>
	<div id="rango{{$contadorphp}}Container" class="col-md-12" style="padding-bottom: 0.25em;">
    	@php
    		$x = 0;
    	@endphp
			@foreach($opcion->tarifas as $tarifa)
				<div class=row>
					<div class="col-md-4 col-sm-6" style="max-height: 58.1px;">
						<label for="expireRange{{$contadorphp}}" style="font-size: 0.9em; margin-bottom: 0px;">Vencimiento</label>
						<input {{in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL) ? '' : 'disabled' }} id="expireRange{{$contadorphp}}" name="Opcion[{{$contadorphp}}][TarifaVencimiento]" type="date" class="form-control" value="{{$tarifa->TarifaVencimiento}}">
						@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
					   		<input type="date" hidden name="Opcion[{{$contadorphp}}][TarifaVencimiento]" value="{{$tarifa->TarifaVencimiento}}">
					    @endif
					</div>
					<div class="col-md-3 col-sm-6">
						<label for="frecrangeSelect{{$contadorphp}}" style="font-size: 0.9em;" data-trigger="hover" data-toggle="popover" title="<b>Frecuencia</b>" data-content="<p> se tomara en cuenta para la aplicación de la tarifa respectiva y el calculo del precio según la frecuencia de la cantidad puesta en planta Prosarc S.A. ESP</p>" >Frec.</label>
						<select {{in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL) ? '' : 'disabled' }} id="frecrangeSelect{{$contadorphp}}" name="Opcion[{{$contadorphp}}][TarifaFrecuencia]">
							<option {{$tarifa->TarifaFrecuencia == 'N/A' ? "selected" : ""}}>N/A</option>
							<option {{$tarifa->TarifaFrecuencia == 'Mensual' ? "selected" : ""}}>Mensual</option>
							<option {{$tarifa->TarifaFrecuencia == 'Servicio' ? "selected" : ""}}>Servicio</option>
						</select>
						@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
					   		<input hidden name="Opcion[{{$contadorphp}}][TarifaFrecuencia]" value="{{$tarifa->TarifaFrecuencia}}">
					    @endif
					</div>
					<div class="col-md-3 col-sm-6">
						<label style="font-size: 0.9em;" for="typerangeSelect{{$contadorphp}}">Tipo</label>
						<select {{in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL) ? '' : 'disabled' }} id="typerangeSelect{{$contadorphp}}" name="Opcion[{{$contadorphp}}][Tarifatipo]">
							<option {{$tarifa->Tarifatipo == "Kg" ? "selected" : "" }} >Kg</option>
							<option {{$tarifa->Tarifatipo == "Lt" ? "selected" : "" }} >Lt</option>
							<option {{$tarifa->Tarifatipo == "Unid" ? "selected" : "" }} >Unid</option>
						</select>
						@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
					   		<input hidden name="Opcion[{{$contadorphp}}][Tarifatipo]" value="{{$tarifa->Tarifatipo}}">
					    @endif
					</div>
					<div class="col-md-2 col-sm-6">
						<label for="addrangeButton{{$contadorphp}}">Añadir Rango</label>
						<button {{in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL) ? '' : 'disabled' }} style="cursor: cell;" onclick="AgregarRango({{$contadorphp}})" class="btn btn-primary btn-block addrangeButton" id="addrangeButton{{$contadorphp}}"> <i class="fa fa-plus"></i></button>
					</div>
					<script type="text/javaScript">
						    contadorRango[{{$contadorphp}}] = [];
							document.getElementById("addrangeButton{{$contadorphp}}").addEventListener("click", function(event){
							  event.preventDefault()
							});
					</script>
				</div>
				<div class="row" id="rango{{$contadorphp}}row">
					@if(count($tarifa->rangos) > 0)
						@foreach($tarifa->rangos as $rango)
						<script type="text/javaScript">
								contadorRango[{{$contadorphp}}][{{$last}}] = {{$last}};
						</script>
							@php
							$last = $last+1;
							@endphp
							<input hidden type="text" name="Opcion[{{$contadorphp}}][ID_Rango][]" value="{{$rango->ID_Rango}}">
							<div id="rangodefault{{$contadorphp}}{{$last}}">
							</div>
							<div class="col-md-3 col-sm-6" {{-- {{$last > 1 ? "pull-left": "pull-right"}}" --}} id="rango{{$contadorphp}}{{$last}}">
								<label style="font-size: 0.8em;" for="rangopriceinput{{$contadorphp}}{{$last}}">Desde {{isset($rango->TarifaDesde) ? $rango->TarifaDesde : 0 }} </label>
								@if(($rango->TarifaDesde != 0)&&(in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL)))
									<a onclick="EliminarRango({{$contadorphp}},{{$last}})" id="minusrangeButton{{$contadorphp}}{{$last}}"><i style="color:red; margin: 0; padding: 0; margin-top: 0.25em; cursor: pointer;" class="fa fa-trash-alt pull-right"></i></a>
									<div class="input-group">
										<input id="rangopriceinput{{$contadorphp}}{{$last}}" name="Opcion[{{$contadorphp}}][TarifaPrecio][]" type="number" class="form-control  addon-inline" placeholder="Precio" min="0" value="{{$rango->TarifaPrecio}}">
										<span class="input-group-addon addon-inline input-source-observer">$</span>
									</div>
									<input name="Opcion[{{$contadorphp}}][TarifaDesde][]" hidden value="{{$rango->TarifaDesde}}">
								@else
									<div class="input-group">
										<input disabled id="rangopriceinput{{$contadorphp}}{{$last}}" name="Opcion[{{$contadorphp}}][TarifaPrecio][]" type="number" class="form-control  addon-inline" placeholder="Precio" min="0" value="{{$rango->TarifaPrecio}}">
										<span class="input-group-addon addon-inline input-source-observer">$</span>
									</div>
									<input name="Opcion[{{$contadorphp}}][TarifaDesde][]" hidden value="{{$rango->TarifaDesde}}">
									@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
										<input name="Opcion[{{$contadorphp}}][TarifaPrecio][]" hidden value="{{$rango->TarifaPrecio}}">
									@endif
								@endif
							</div>
			    		@endforeach
			    	@else
			    		<script type="text/javaScript">
			    				contadorRango[{{$contadorphp}}][{{$last}}] = {{$last}};
			    		</script>
		    			<div class="col-md-3 col-sm-6" id="rango{{$contadorphp}}{{$last}}">
		    				<label style="font-size: 0.8em;" for="rangopriceinput{{$contadorphp}}{{$last}}">Desde {{$last}} </label>
							@if (in_array(Auth::user()->UsRol, Permisos::COMERCIAL)||in_array(Auth::user()->UsRol2, Permisos::COMERCIAL))
								<input id="rangopriceinput{{$contadorphp}}{{$last}}" name="Opcion[{{$contadorphp}}][TarifaPrecio][]" type="number" class="form-control" placeholder="Precio" min="0">
								<input name="Opcion[{{$contadorphp}}][TarifaDesde][]" hidden value="{{$last}}">
							@else
								<input disabled id="rangopriceinput{{$contadorphp}}{{$last}}" name="Opcion[{{$contadorphp}}][TarifaPrecio][]" type="number" class="form-control" placeholder="Precio" min="0">
								<input name="Opcion[{{$contadorphp}}][TarifaDesde][]" hidden value="{{$last}}">
								@if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
									<input name="Opcion[{{$contadorphp}}][TarifaPrecio][]" hidden>
								@endif
							@endif
		    				
		    			</div>
		    			@php
		    			$last = $last+1;
		    			@endphp
					@endif
				</div>
	    		@php
	    			$x=$x+1;
	    		@endphp
	    	@endforeach		
	</div>
</div>
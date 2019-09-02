@php
    if ($opcion['ofertado'] == 1) {
        $OpcionOfertada = 1;
    }else{
        $OpcionOfertada = 0;
    }
@endphp

<div id="requerimiento{{$contadorphp}}Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	<div style="margin-top: 0.25em;">
		<div class="col-md-2 col-xs-6">
			<label data-trigger="hover" data-toggle="popover" title="<b>Foto-Descargue</b>" data-content="<p> Se requiere registro fotografico del proceso de descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Descargue Pesaje
			<input id="ReqFotoDescargue{{$contadorphp}}" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) && ($OpcionOfertada==0) ? '' : 'disabled=true' }} {{$opcion['ReqFotoDescargue'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="pull-bottom fotoswitch" name="Opcion[{{$contadorphp}}][ReqFotoDescargue]"/>
			</label>
			@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['ReqFotoDescargue'] == 1)) 
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqFotoDescargue]" value="1">
		 	@endif
		 	@if((in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))&&($opcion['ReqFotoDescargue'] == 1)&&($OpcionOfertada==1)) 
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqFotoDescargue]" value="1">
		 	@endif
		</div>
		<div class="col-md-2 col-xs-6">
			<label data-trigger="hover" data-toggle="popover" title="<b>Foto-Tratamiento</b>" data-content="<p> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>"><br>  Tratamiento
			<input id="ReqFotoDestruccion{{$contadorphp}}" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) && ($OpcionOfertada==0) ? '' : 'disabled=true' }} {{$opcion['ReqFotoDestruccion'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="pull-bottom fotoswitch" name="Opcion[{{$contadorphp}}][ReqFotoDestruccion]"/>
			</label>
		 	@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['ReqFotoDestruccion'] == 1)) 
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqFotoDestruccion]" value="1">
		 	@endif
		 	@if((in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))&&($opcion['ReqFotoDestruccion'] == 1)&&($OpcionOfertada==1)) 
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqFotoDestruccion]" value="1">
		 	@endif
		</div>
		<div class="col-md-2 col-xs-6 col-md-offset-1">
			<label data-trigger="hover" data-toggle="popover" title="<b>Video-Descargue</b>" data-content="<p> Se requiere video del proceso de Descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Descargue Pesaje
			<input id="ReqVideoDescargue{{$contadorphp}}" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) && ($OpcionOfertada==0) ? '' : 'disabled=true' }} {{$opcion['ReqVideoDescargue'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="pull-bottom videoswitch" name="Opcion[{{$contadorphp}}][ReqVideoDescargue]"/>
			</label>
		 	@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['ReqVideoDescargue'] == 1))
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqVideoDescargue]" value="1">
		 	@endif
		 	@if((in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))&&($opcion['ReqVideoDescargue'] == 1)&&($OpcionOfertada==1))
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqVideoDescargue]" value="1">
		 	@endif
		</div>
		<div class="col-md-2 col-xs-6">
			<label data-trigger="hover" data-toggle="popover" title="<b>Video-Tratamiento</b>" data-content="<p> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>"><br> Tratamiento
			<input id="ReqVideoDestruccion{{$contadorphp}}" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) && ($OpcionOfertada==0) ? '' : 'disabled=true' }} {{$opcion['ReqVideoDestruccion'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="pull-bottom videoswitch" name="Opcion[{{$contadorphp}}][ReqVideoDestruccion]"/>
			</label>
		 	@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['ReqVideoDestruccion'] == 1))
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqVideoDestruccion]" value="1">
		 	@endif
		 	@if((in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))&&($opcion['ReqVideoDestruccion'] == 1)&&($OpcionOfertada==1))
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqVideoDestruccion]" value="1">
		 	@endif
		</div>
		<div class="col-md-2 col-xs-6 col-md-offset-1">
			<label data-trigger="hover" data-toggle="popover" title="<b>Devolución de embalaje</b>" data-content="<p> Se requiere que los embalajes sean devueltos al cliente/generador</p>"> Devolver embalaje
			<input id="ReqDevolucion{{$contadorphp}}" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) && ($OpcionOfertada==0) ? '' : 'disabled=true' }} {{$opcion['ReqDevolucion'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="pull-bottom embalajeswitch" name="Opcion[{{$contadorphp}}][ReqDevolucion]"/>
			</label>
		 	@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['ReqDevolucion'] == 1))
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqDevolucion]" value="1">
		    @endif
		    @if((in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))&&($opcion['ReqDevolucion'] == 1)&&($OpcionOfertada==1))
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqDevolucion]" value="1">
		    @endif
		</div>
	</div>
</div>

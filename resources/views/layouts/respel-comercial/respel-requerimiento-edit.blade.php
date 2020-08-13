@php
    if ($opcion['ofertado'] == 1||$opcion['en_uso'] == 1) {
        $OpcionOfertada = 1;
    }else{
        $OpcionOfertada = 0;
    }
@endphp

<div id="requerimiento{{$contadorphp}}Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	<div style="padding: 0.25em; background-color: #222d32; color: #b8c7ce" class="panel-heading">
	  <h5 class="panel-title">Tratamiento:<b style="color: #E8E8E8" id="requerimiento{{$contadorphp}}TratName"> {{$opcion->tratamientos[0]->TratName}}</b>{{-- 	<small>Subtext for header</small> --}}</h5>
	</div>
	<div>
		<div class="col-md-2 col-xs-6">
			<label data-trigger="hover" data-toggle="popover" title="<b>Foto-Descargue</b>" data-content="<p> Se requiere registro fotografico del proceso de descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Foto Descargue
			<input id="ReqFotoDescargue{{$contadorphp}}" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} {{$opcion['ReqFotoDescargue'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="fotoswitch" name="Opcion[{{$contadorphp}}][ReqFotoDescargue]"/>
			</label>
		 	@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['ReqFotoDescargue'] == 1)&&($OpcionOfertada==1)) 
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqFotoDescargue]" value="1">
		 	@endif
		</div>
		<div class="col-md-2 col-xs-6">
			<label data-trigger="hover" data-toggle="popover" title="<b>Foto-Tratamiento</b>" data-content="<p> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Foto Tratamiento
			<input id="ReqFotoDestruccion{{$contadorphp}}" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} {{$opcion['ReqFotoDestruccion'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="fotoswitch" name="Opcion[{{$contadorphp}}][ReqFotoDestruccion]"/>
			</label>
		 	@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['ReqFotoDestruccion'] == 1)&&($OpcionOfertada==1)) 
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqFotoDestruccion]" value="1">
		 	@endif
		</div>
		<div class="col-md-2 col-xs-6">
			<label data-trigger="hover" data-toggle="popover" title="<b>Video-Descargue</b>" data-content="<p> Se requiere video del proceso de Descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Video Descargue
			<input id="ReqVideoDescargue{{$contadorphp}}" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} {{$opcion['ReqVideoDescargue'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="videoswitch" name="Opcion[{{$contadorphp}}][ReqVideoDescargue]"/>
			</label>
		 	@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['ReqVideoDescargue'] == 1)&&($OpcionOfertada==1))
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqVideoDescargue]" value="1">
		 	@endif
		</div>
		<div class="col-md-2 col-xs-6">
			<label data-trigger="hover" data-toggle="popover" title="<b>Video-Tratamiento</b>" data-content="<p> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Video Tratamiento
			<input id="ReqVideoDestruccion{{$contadorphp}}" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} {{$opcion['ReqVideoDestruccion'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="videoswitch" name="Opcion[{{$contadorphp}}][ReqVideoDestruccion]"/>
			</label>
		 	@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['ReqVideoDestruccion'] == 1)&&($OpcionOfertada==1))
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqVideoDestruccion]" value="1">
		 	@endif
		</div>
		<div class="col-md-2 col-xs-6">
			<label data-trigger="hover" data-toggle="popover" title="<b>Devolución de embalaje</b>" data-content="<p> Se requiere que los embalajes sean devueltos al cliente/generador</p>"> Devolver embalaje
			<input id="ReqDevolucion{{$contadorphp}}" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} {{$opcion['ReqDevolucion'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="embalajeswitch" name="Opcion[{{$contadorphp}}][ReqDevolucion]"/>
			</label>
		 	@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['ReqDevolucion'] == 1)&&($OpcionOfertada==1))
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqDevolucion]" value="1">
		    @endif
		</div>
		<div class="col-md-2 col-xs-6">
			<label data-trigger="hover" data-toggle="popover" title="<b>Tratamiento Auditable</b>" data-content="<p> Se requiere que el tratamiento del residuo sea auditado por personal del Cliente/Generador </p>"> Tratamiento Auditable
			<input id="ReqAuditoria{{$contadorphp}}" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} {{$opcion['ReqAuditoria'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="auditoriaswitch" name="Opcion[{{$contadorphp}}][ReqAuditoria]"/>
			</label>
		 	@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['ReqAuditoria'] == 1)&&($OpcionOfertada==1))
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqAuditoria]" value="1">
		    @endif
		</div>
	</div>
</div>

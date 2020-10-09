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
			<label data-trigger="hover" data-toggle="popover" title="<b>Foto-Descargue</b>" data-content="<p> Se requiere registro fotografico del proceso de descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Foto</br>Descargue
				<input id="main_Opcion{{$contadorphp}}ReqFotoDescargue" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} {{$opcion['ReqFotoDescargue'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="fotoswitchedit" name="Opcion[{{$contadorphp}}][ReqFotoDescargue]"/>
			</label>
			@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['ReqFotoDescargue'] == 1)&&($OpcionOfertada==1)) 
				<input hidden name="Opcion[{{$contadorphp}}][ReqFotoDescargue]" value="1">
			@endif
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de Activación</b>" data-content="<p style='width: 50%'> Seleccione: <ul><li> Automático: <b>(A)</b> El requerimiento se active automáticamente en las nuevas solicitudes de servicio</li> <li> Manual: <b>(M)</b>,  El cliente debe activar el requerimiento cuando lo requiera</li></ul> <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
				<label for="auto_RequeCliBascula"></label>
				<div style="width: 100%; height: 34px;">
					<input {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} value="1" type="checkbox" class="autoswitch" id="Opcion{{$contadorphp}}ReqFotoDescargue" name="Opcion[{{$contadorphp}}][auto_ReqFotoDescargue]" {{$opcion['auto_ReqFotoDescargue'] == 1 ? 'checked' : ''}}>
				</div>
			</label>
			@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['auto_ReqFotoDescargue'] == 1)&&($OpcionOfertada==1)) 
				<input hidden name="Opcion[{{$contadorphp}}][auto_ReqFotoDescargue]" value="1">
			@endif
		</div>
		<div class="col-md-2 col-xs-6">
			<label data-trigger="hover" data-toggle="popover" title="<b>Foto-Tratamiento</b>" data-content="<p> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Foto</br>Tratamiento 
				<input id="ReqFotoDestruccion{{$contadorphp}}" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} {{$opcion['ReqFotoDestruccion'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="fotoswitchedit" name="Opcion[{{$contadorphp}}][ReqFotoDestruccion]"/>
			</label>
			@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['ReqFotoDestruccion'] == 1)&&($OpcionOfertada==1)) 
				<input hidden name="Opcion[{{$contadorphp}}][ReqFotoDestruccion]" value="1">
			@endif
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de Activación</b>" data-content="<p style='width: 50%'> Seleccione: <ul><li> Automático: <b>(A)</b> El requerimiento se active automáticamente en las nuevas solicitudes de servicio</li> <li> Manual: <b>(M)</b>,  El cliente debe activar el requerimiento cuando lo requiera</li></ul> <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
				<label for="auto_RequeCliBascula"></label>
				<div style="width: 100%; height: 34px;">
					<input {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} value="1" type="checkbox" class="autoswitch" id="Opcion[{{$contadorphp}}][ReqFotoDestruccion]" name="Opcion[{{$contadorphp}}][auto_ReqFotoDestruccion]" {{$opcion['auto_ReqFotoDestruccion'] == 1 ? 'checked' : ''}}>
				</div>
			</label>
			@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['auto_ReqFotoDestruccion'] == 1)&&($OpcionOfertada==1)) 
				<input hidden name="Opcion[{{$contadorphp}}][auto_ReqFotoDestruccion]" value="1">
			@endif
		</div>
		<div class="col-md-2 col-xs-6">
			<label data-trigger="hover" data-toggle="popover" title="<b>Video-Descargue</b>" data-content="<p> Se requiere video del proceso de Descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Video</br>Descargue
				<input id="ReqVideoDescargue{{$contadorphp}}" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} {{$opcion['ReqVideoDescargue'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="videoswitch" name="Opcion[{{$contadorphp}}][ReqVideoDescargue]"/>
			</label>
		 	@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['ReqVideoDescargue'] == 1)&&($OpcionOfertada==1))
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqVideoDescargue]" value="1">
			 @endif
			 <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de Activación</b>" data-content="<p style='width: 50%'> Seleccione: <ul><li> Automático: <b>(A)</b> El requerimiento se active automáticamente en las nuevas solicitudes de servicio</li> <li> Manual: <b>(M)</b>,  El cliente debe activar el requerimiento cuando lo requiera</li></ul> <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
				<label for="auto_RequeCliBascula"></label>
				<div style="width: 100%; height: 34px;">
					<input {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} value="1" type="checkbox" class="autoswitch" id="Opcion[{{$contadorphp}}][ReqVideoDescargue]" name="Opcion[{{$contadorphp}}][auto_ReqVideoDescargue]" {{$opcion['auto_ReqVideoDescargue'] == 1 ? 'checked' : ''}}>
				</div>
			</label>
			@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['auto_ReqVideoDescargue'] == 1)&&($OpcionOfertada==1)) 
				<input hidden name="Opcion[{{$contadorphp}}][auto_ReqVideoDescargue]" value="1">
			@endif
		</div>
		<div class="col-md-2 col-xs-6">
			<label data-trigger="hover" data-toggle="popover" title="<b>Video-Tratamiento</b>" data-content="<p> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Video</br>Tratamiento
				<input id="ReqVideoDestruccion{{$contadorphp}}" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} {{$opcion['ReqVideoDestruccion'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="videoswitch" name="Opcion[{{$contadorphp}}][ReqVideoDestruccion]"/>
			</label>
		 	@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['ReqVideoDestruccion'] == 1)&&($OpcionOfertada==1))
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqVideoDestruccion]" value="1">
			 @endif
			 <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de Activación</b>" data-content="<p style='width: 50%'> Seleccione: <ul><li> Automático: <b>(A)</b> El requerimiento se active automáticamente en las nuevas solicitudes de servicio</li> <li> Manual: <b>(M)</b>,  El cliente debe activar el requerimiento cuando lo requiera</li></ul> <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
				<label for="auto_RequeCliBascula"></label>
				<div style="width: 100%; height: 34px;">
					<input {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} value="1" type="checkbox" class="autoswitch" id="Opcion[{{$contadorphp}}][ReqVideoDestruccion]" name="Opcion[{{$contadorphp}}][auto_ReqVideoDestruccion]" {{$opcion['auto_ReqVideoDestruccion'] == 1 ? 'checked' : ''}}>
				</div>
			</label>
			@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['auto_ReqVideoDestruccion'] == 1)&&($OpcionOfertada==1)) 
				<input hidden name="Opcion[{{$contadorphp}}][auto_ReqVideoDestruccion]" value="1">
			@endif
		</div>
		<div class="col-md-2 col-xs-6">
			<label data-trigger="hover" data-toggle="popover" title="<b>Devolución de embalaje</b>" data-content="<p> Se requiere que los embalajes sean devueltos al cliente/generador</p>"> Devolver</br>embalaje
				<input id="ReqDevolucion{{$contadorphp}}" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} {{$opcion['ReqDevolucion'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="embalajeswitch" name="Opcion[{{$contadorphp}}][ReqDevolucion]"/>
			</label>
		 	@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['ReqDevolucion'] == 1)&&($OpcionOfertada==1))
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqDevolucion]" value="1">
			@endif
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de Activación</b>" data-content="<p style='width: 50%'> Seleccione: <ul><li> Automático: <b>(A)</b> El requerimiento se active automáticamente en las nuevas solicitudes de servicio</li> <li> Manual: <b>(M)</b>,  El cliente debe activar el requerimiento cuando lo requiera</li></ul> <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
				<label for="auto_RequeCliBascula"></label>
				<div style="width: 100%; height: 34px;">
					<input {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} value="1" type="checkbox" class="autoswitch" id="Opcion[{{$contadorphp}}][ReqDevolucion]" name="Opcion[{{$contadorphp}}][auto_ReqDevolucion]" {{$opcion['auto_ReqDevolucion'] == 1 ? 'checked' : ''}}>
				</div>
			</label>
			@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['auto_ReqDevolucion'] == 1)&&($OpcionOfertada==1)) 
				<input hidden name="Opcion[{{$contadorphp}}][auto_ReqDevolucion]" value="1">
			@endif
		</div>
		<div class="col-md-2 col-xs-6">
			<label data-trigger="hover" data-toggle="popover" title="<b>Tratamiento Auditable</b>" data-content="<p> Se requiere que el tratamiento del residuo sea auditado por personal del Cliente/Generador </p>"> Tratamiento</br>Auditable
				<input id="ReqAuditoria{{$contadorphp}}" {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} {{$opcion['ReqAuditoria'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="auditoriaswitch" name="Opcion[{{$contadorphp}}][ReqAuditoria]"/>
			</label>
		 	@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['ReqAuditoria'] == 1)&&($OpcionOfertada==1))
		    	<input hidden name="Opcion[{{$contadorphp}}][ReqAuditoria]" value="1">
			@endif
			<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Tipo de Activación</b>" data-content="<p style='width: 50%'> Seleccione: <ul><li> Automático: <b>(A)</b> El requerimiento se active automáticamente en las nuevas solicitudes de servicio</li> <li> Manual: <b>(M)</b>,  El cliente debe activar el requerimiento cuando lo requiera</li></ul> <br><b>Nota:</b> si coloca la activacion en automatica el cliente aun podra desactivar el requerimiento cuando este creando o editando la solicitud de servicio</p>">
				<label for="auto_RequeCliBascula"></label>
				<div style="width: 100%; height: 34px;">
					<input {{(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones)) ? '' : 'disabled=true' }} value="1" type="checkbox" class="autoswitch" id="Opcion[{{$contadorphp}}][ReqAuditoria]" name="Opcion[{{$contadorphp}}][auto_ReqAuditoria]" {{$opcion['auto_ReqAuditoria'] == 1 ? 'checked' : ''}}>
				</div>
			</label>
			@if((in_array(Auth::user()->UsRol, Permisos::ComercialYJefeComercial)||in_array(Auth::user()->UsRol2, Permisos::ComercialYJefeComercial))&&($opcion['auto_ReqAuditoria'] == 1)&&($OpcionOfertada==1)) 
				<input hidden name="Opcion[{{$contadorphp}}][auto_ReqAuditoria]" value="1">
			@endif
		</div>
	</div>
</div>

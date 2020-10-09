<div id="requerimiento`+contador+`Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
		<div style="padding: 0.25em; background-color: #222d32; color: #b8c7ce" class="panel-heading">
		  <h5 class="panel-title">Tratamiento:<b style="color: #E8E8E8" id="requerimiento`+contador+`TratName"> Seleccione un Tratamiento...</b>{{-- 	<small>Subtext for header</small> --}}</h5>
		</div>
		<div style="margin-top: 0.25em;">
			<div class="col-md-2 col-xs-6">
				<label data-trigger="hover" data-toggle="popover" data-placement="bottom" title="<b>Foto-Descargue</b>" data-content="<p> Se requiere registro fotografico del proceso de descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Foto Descargue
				<input data-switch="Opcion`+contador+`ReqFotoDescargue" id="main_Opcion`+contador+`ReqFotoDescargue" value="1" type="checkbox" class="fotoswitchedit" name="Opcion[`+contador+`][ReqFotoDescargue]"/>
				</label>
				<label for="Opcion`+contador+`ReqFotoDescargue" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-placement="bottom" title="<b>Tipo de Activación</b>" data-content="<p style='width: 50%'> Seleccione: <ul><li> Automático: <b>(A)</b> El requerimiento se activa automáticamente en las nuevas solicitudes de servicio</li> <li> Manual: <b>(M)</b>,  El cliente debe activar el requerimiento cuando lo requiera</li></ul> <br><b>Nota:</b> si coloca la activación en automatica el cliente aún podra desactivar el requerimiento cuando esté creando o editando la solicitud de servicio</p>">
					<div style="width: 100%; height: 34px;">
						<input data-switch="Opcion`+contador+`ReqFotoDescargue" id="auto_Opcion`+contador+`ReqFotoDescargue" value="1" type="checkbox" class="autoswitch" name="Opcion[`+contador+`][auto_ReqFotoDescargue]">
					</div>
				</label>
			</div>
			<div class="col-md-2 col-xs-6">
				<label data-trigger="hover" data-toggle="popover" data-placement="bottom" title="<b>Foto-Tratamiento</b>" data-content="<p> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>">  Foto Tratamiento
				<input data-switch="Opcion`+contador+`ReqFotoDestruccion" id="main_Opcion`+contador+`ReqFotoDestruccion" value="1" type="checkbox" class="fotoswitchedit" name="Opcion[`+contador+`][ReqFotoDestruccion]"/>
				</label>
				<label for="Opcion`+contador+`ReqFotoDestruccion" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-placement="bottom" title="<b>Tipo de Activación</b>" data-content="<p style='width: 50%'> Seleccione: <ul><li> Automático: <b>(A)</b> El requerimiento se activa automáticamente en las nuevas solicitudes de servicio</li> <li> Manual: <b>(M)</b>,  El cliente debe activar el requerimiento cuando lo requiera</li></ul> <br><b>Nota:</b> si coloca la activación en automatica el cliente aún podra desactivar el requerimiento cuando esté creando o editando la solicitud de servicio</p>">
					<div style="width: 100%; height: 34px;">
						<input data-switch="Opcion`+contador+`ReqFotoDestruccion" id="auto_Opcion`+contador+`ReqFotoDestruccion" value="1" type="checkbox" class="autoswitch" name="Opcion[`+contador+`][auto_ReqFotoDestruccion]">
					</div>
				</label>
			</div>
			<div class="col-md-2 col-xs-6">
				<label data-trigger="hover" data-toggle="popover" data-placement="bottom" title="<b>Video-Descargue</b>" data-content="<p> Se requiere video del proceso de Descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Video Descargue
				<input data-switch="Opcion`+contador+`ReqVideoDescargue" id="main_Opcion`+contador+`ReqVideoDescargue" value="1" type="checkbox" class="videoswitchedit" name="Opcion[`+contador+`][ReqVideoDescargue]"/>
				</label>
				<label for="Opcion`+contador+`ReqVideoDescargue" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-placement="bottom" title="<b>Tipo de Activación</b>" data-content="<p style='width: 50%'> Seleccione: <ul><li> Automático: <b>(A)</b> El requerimiento se activa automáticamente en las nuevas solicitudes de servicio</li> <li> Manual: <b>(M)</b>,  El cliente debe activar el requerimiento cuando lo requiera</li></ul> <br><b>Nota:</b> si coloca la activación en automatica el cliente aún podra desactivar el requerimiento cuando esté creando o editando la solicitud de servicio</p>">
					<div style="width: 100%; height: 34px;">
						<input data-switch="Opcion`+contador+`ReqVideoDescargue" id="auto_Opcion`+contador+`ReqVideoDescargue" value="1" type="checkbox" class="autoswitch" name="Opcion[`+contador+`][auto_ReqVideoDescargue]">
					</div>
				</label>
			</div>
			<div class="col-md-2 col-xs-6">
				<label data-trigger="hover" data-toggle="popover" data-placement="bottom" title="<b>Video-Tratamiento</b>" data-content="<p> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Video Tratamiento
				<input data-switch="Opcion`+contador+`ReqVideoDestruccion" id="main_Opcion`+contador+`ReqVideoDestruccion" value="1" type="checkbox" class="videoswitchedit" name="Opcion[`+contador+`][ReqVideoDestruccion]"/>
				</label>
				<label for="Opcion`+contador+`ReqVideoDestruccion" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-placement="bottom" title="<b>Tipo de Activación</b>" data-content="<p style='width: 50%'> Seleccione: <ul><li> Automático: <b>(A)</b> El requerimiento se activa automáticamente en las nuevas solicitudes de servicio</li> <li> Manual: <b>(M)</b>,  El cliente debe activar el requerimiento cuando lo requiera</li></ul> <br><b>Nota:</b> si coloca la activación en automatica el cliente aún podra desactivar el requerimiento cuando esté creando o editando la solicitud de servicio</p>">
					<div style="width: 100%; height: 34px;">
						<input data-switch="Opcion`+contador+`ReqVideoDestruccion" id="auto_Opcion`+contador+`ReqVideoDestruccion" value="1" type="checkbox" class="autoswitch" name="Opcion[`+contador+`][auto_ReqVideoDestruccion]">
					</div>
				</label>
			</div>
			<div class="col-md-2 col-xs-6">
				<label data-trigger="hover" data-toggle="popover" data-placement="bottom" title="<b>Devolución de embalaje</b>" data-content="<p> Se requiere que los embalajes sean devueltos al Cliente/Generador</p>"> Devolver embalaje
				<input data-switch="Opcion`+contador+`ReqDevolucion" id="main_Opcion`+contador+`ReqDevolucion" value="1" type="checkbox" class="embalajeswitchedit" name="Opcion[`+contador+`][ReqDevolucion]"/>
				</label>
				<label for="Opcion`+contador+`ReqDevolucion" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-placement="bottom" title="<b>Tipo de Activación</b>" data-content="<p style='width: 50%'> Seleccione: <ul><li> Automático: <b>(A)</b> El requerimiento se activa automáticamente en las nuevas solicitudes de servicio</li> <li> Manual: <b>(M)</b>,  El cliente debe activar el requerimiento cuando lo requiera</li></ul> <br><b>Nota:</b> si coloca la activación en automatica el cliente aún podra desactivar el requerimiento cuando esté creando o editando la solicitud de servicio</p>">
					<div style="width: 100%; height: 34px;">
						<input data-switch="Opcion`+contador+`ReqDevolucion" id="auto_Opcion`+contador+`ReqDevolucion" value="1" type="checkbox" class="autoswitch" name="Opcion[`+contador+`][auto_ReqDevolucion]">
					</div>
				</label>
			</div>
			<div class="col-md-2 col-xs-6">
				<label data-trigger="hover" data-toggle="popover" data-placement="bottom" title="<b>Tratamiento Auditable</b>" data-content="<p> Se requiere que el tratamiento del residuo sea auditado por personal del Cliente/Generador</p>"> Tratamiento Auditable
				<input data-switch="Opcion`+contador+`ReqAuditoria" id="main_Opcion`+contador+`ReqAuditoria" value="1" type="checkbox" class="auditoriaswitchedit" name="Opcion[`+contador+`][ReqAuditoria]"/>
				</label>
				<label for="Opcion`+contador+`ReqAuditoria" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-placement="bottom" title="<b>Tipo de Activación</b>" data-content="<p style='width: 50%'> Seleccione: <ul><li> Automático: <b>(A)</b> El requerimiento se activa automáticamente en las nuevas solicitudes de servicio</li> <li> Manual: <b>(M)</b>,  El cliente debe activar el requerimiento cuando lo requiera</li></ul> <br><b>Nota:</b> si coloca la activación en automatica el cliente aún podra desactivar el requerimiento cuando esté creando o editando la solicitud de servicio</p>">
					<div style="width: 100%; height: 34px;">
						<input data-switch="Opcion`+contador+`ReqAuditoria" id="auto_Opcion`+contador+`ReqAuditoria" value="1" type="checkbox" class="autoswitch" name="Opcion[`+contador+`][auto_ReqAuditoria]">
					</div>
				</label>
			</div>
		</div>
</div>

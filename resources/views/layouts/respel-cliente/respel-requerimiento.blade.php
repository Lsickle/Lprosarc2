<div id="requerimiento{{$contadorphp}}Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	<div style="margin-top: 0.25em;">
			<div class="col-md-2 col-xs-6">
				<label data-trigger="hover" data-toggle="popover" title="<b>Foto-Descargue</b>" data-content="<p> Se requiere registro fotografico del proceso de descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Foto Descargue
				<input disabled {{$opcion['ReqFotoDescargue'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="fotoswitch" name="Opcion[`+contador+`][ReqFotoDescargue]"/>
				</label>
			</div>
			<div class="col-md-2 col-xs-6">
				<label data-trigger="hover" data-toggle="popover" title="<b>Foto-Tratamiento</b>" data-content="<p> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>">  Foto Tratamiento
				<input disabled {{$opcion['ReqFotoDestruccion'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="fotoswitch" name="Opcion[`+contador+`][ReqFotoDestruccion]"/>
				</label>
			</div>
			<div class="col-md-2 col-xs-6">
				<label data-trigger="hover" data-toggle="popover" title="<b>Video-Descargue</b>" data-content="<p> Se requiere video del proceso de Descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Video Descargue
				<input disabled {{$opcion['ReqVideoDescargue'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="videoswitch" name="Opcion[`+contador+`][ReqVideoDescargue]"/>
				</label>
			</div>
			<div class="col-md-2 col-xs-6">
				<label data-trigger="hover" data-toggle="popover" title="<b>Video-Tratamiento</b>" data-content="<p> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Video Tratamiento
				<input disabled {{$opcion['ReqVideoDestruccion'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="videoswitch" name="Opcion[`+contador+`][ReqVideoDestruccion]"/>
				</label>
			</div>
			<div class="col-md-2 col-xs-6">
				<label data-trigger="hover" data-toggle="popover" title="<b>Devolución de embalaje</b>" data-content="<p> Se requiere que los embalajes sean devueltos al Cliente/Generador</p>"> Devolver embalaje
				<input disabled {{$opcion['ReqDevolucion'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="embalajeswitch" name="Opcion[`+contador+`][ReqDevolucion]"/>
				</label>
			</div>
			<div class="col-md-2 col-xs-6">
				<label data-trigger="hover" data-toggle="popover" title="<b>Tratamiento Auditable</b>" data-content="<p> Se requiere que el tratamiento del residuo sea auditado por personal del Cliente/Generador</p>"> Tratamiento Auditable
				<input disabled {{$opcion['ReqAuditoria'] == 1 ? 'checked' : ""}} value="1" type="checkbox" class="auditoriaswitch" name="Opcion[`+contador+`][ReqAuditoria]"/>
				</label>
			</div>
		</div>
</div>

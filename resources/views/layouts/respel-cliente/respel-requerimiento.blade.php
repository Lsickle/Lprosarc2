<div id="requerimiento{{$contadorphp}}Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
	<div style="margin-top: 0.25em;">
		<div class="col-md-2 col-xs-6">
			<label data-trigger="hover" data-toggle="popover" title="<b>Foto-Descargue</b>" data-content="<p> Se requiere registro fotografico del proceso de descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Descargue Pesaje
			<input disabled {{$opcion['ReqFotoDescargue'] == 1 ? 'checked' : ""}} type="checkbox" class="pull-bottom fotoswitch"/>
			</label>
		</div>
		<div class="col-md-2 col-xs-6">
			<label data-trigger="hover" data-toggle="popover" title="<b>Foto-Tratamiento</b>" data-content="<p> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>"><br>  Tratamiento
			<input disabled {{$opcion['ReqFotoDestruccion'] == 1 ? 'checked' : ""}} type="checkbox" class="pull-bottom fotoswitch"/>
			</label>
		</div>
		<div class="col-md-2 col-xs-6 col-md-offset-1">
			<label data-trigger="hover" data-toggle="popover" title="<b>Video-Descargue</b>" data-content="<p> Se requiere video del proceso de Descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>"> Descargue Pesaje
			<input disabled {{$opcion['ReqVideoDescargue'] == 1 ? 'checked' : ""}} type="checkbox" class="pull-bottom videoswitch">
			</label>
		</div>
		<div class="col-md-2 col-xs-6">
			<label data-trigger="hover" data-toggle="popover" title="<b>Video-Tratamiento</b>" data-content="<p> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>"><br> Tratamiento
			<input disabled {{$opcion['ReqVideoDestruccion'] == 1 ? 'checked' : ""}} type="checkbox" class="pull-bottom videoswitch"/>
			</label>
		</div>
		<div class="col-md-2 col-xs-6 col-md-offset-1">
			<label data-trigger="hover" data-toggle="popover" title="<b>Devolución de embalaje</b>" data-content="<p> Se requiere que los embalajes sean devueltos al cliente/generador</p>"> Devolver embalaje
			<input disabled {{$opcion['ReqDevolucion'] == 1 ? 'checked' : ""}} type="checkbox" class="pull-bottom embalajeswitch">
			</label>
		</div>
	</div>
</div>

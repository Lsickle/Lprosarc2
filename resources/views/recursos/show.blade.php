@extends('layouts.app')

@section('htmlheader_title','Recursos')

@section('contentheader_title', 'Ver todos los Recursos')
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header with-border">
                    <div class="col-md-12" >
                        @component('layouts.partials.modal')
                            @slot('slug')
                                {{$SolRes->SolResSlug}}
                            @endslot
                            @slot('textModal')
                                el residuo de la solicitud 
                                {{-- <b>N° {{$SolicitudServicio->ID_SolSer}}</b> --}}
                            @endslot
                        @endcomponent
                        @if(!isset($SolSer[0]->ID_SolSer))
                        <div style="display: flex; justify-content:space-between">
                            @if(Auth::user()->UsRol !== trans('adminlte_lang::message.Cliente'))
                                <h3 class="box-title">Solicitud de Servicio</h3>
                                {{-- <a method='get' href='#' data-toggle='modal' data-target='#addRecurso'  class="btn btn-success"><i class="fas fa-plus-circle"></i><b> {{trans('adminlte_lang::message.add')}}</b></a> --}}
                            @else
                                <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$SolRes->SolResSlug}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i> <b>{{trans('adminlte_lang::message.delete')}}</b></a>
                                <a href="/solicitud-residuo/{{$SolRes->SolResSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
                            @endif
                        </div>
                        <form action='/solicitud-residuo/{{$SolRes->SolResSlug}}' method='POST'>
                            @method('DELETE')
                            @csrf
                            <input type="submit" id="Eliminar{{$SolRes->SolResSlug}}" style="display: none;">
                        </form>
                        @else
                            @if(Auth::user()->UsRol !== trans('adminlte_lang::message.Cliente'))
                                <div style="display: flex; justify-content:space-between">
                                    <a method='get' href='#' data-toggle='modal' data-target='#addRecurso'  class="btn btn-success"><i class="fas fa-plus-circle"></i><b> {{trans('adminlte_lang::message.add')}} Recursos</b></a>
                                    <a href="/solicitud-residuo/{{$SolRes->SolResSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
                                </div>
                            @else
                                <center><h4><b>Esta Solicitud</b> ya ha sido <b>programada</b> </h4></center>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row">
					<div class="col-md-12 ">
						<div class="box box-info">
							<div class="col-md-12" style="margin-top: 20px; border-bottom:#f4f4f4 solid 2px;">
								<div class="col-md-12 border-gray">
                                    <div class="col-md-3">
                                        <label>Kilogramos enviados: </label>
                                        <span>{{$SolRes->SolResKgEnviado}}</span>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Kilogramos Recibidos: </label>
                                        <span>{{$SolRes->SolResKgRecibido}}</span>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Kilogramos conciliados: </label>
                                        <span>{{$SolRes->SolResKgConciliado}}</span>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Kilogramos tratados: </label>
                                        <span>{{$SolRes->SolResKgTratado}}111111111</span>
                                    </div>
                                    <hr>
                                </div>
								<div class="col-md-12 border-gray" style="margin-top: 20px;">
                                    <div class="col-md-4">
                                        <label>Alto: </label>
                                        <span>{{$SolRes->SolResAlto}}</span>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Ancho: </label>
                                        <span>{{$SolRes->SolResAncho}}</span>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Profundo: </label>
                                        <span>{{$SolRes->SolResProfundo}}</span>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-3" style="text-align: center;">
                                    <label for="SolResFotoDescargue_Pesaje">Foto pesaje</label>
                                    <div style="width: 100%; height: 34px;">
                                        <input type="checkbox" disabled="" class="testswitch" id="SolResFotoDescargue_Pesaje" name="SolResFotoDescargue_Pesaje" {{$SolRes->SolResFotoDescargue_Pesaje  == 1 ? 'checked' : '' }} hidden="">
                                    </div>
                                </div>
                                <div class="col-md-3" style="text-align: center;">
                                    <label for="SolResFotoDescargue_Pesaje">Foto Traatamineto</label>
                                    <div style="width: 100%; height: 34px;">
                                        <input type="checkbox" disabled="" class="testswitch" id="SolResFotoDescargue_Pesaje" name="SolResFotoDescargue_Pesaje" {{$SolRes->SolResFotoTratamiento  == 1 ? 'checked' : '' }} hidden="">
                                    </div>
                                </div>
                                <div class="col-md-3" style="text-align: center;">
                                    <label for="SolResFotoDescargue_Pesaje">Video pesaje</label>
                                    <div style="width: 100%; height: 34px;">
                                        <input type="checkbox" disabled="" class="testswitch" id="SolResFotoDescargue_Pesaje" name="SolResFotoDescargue_Pesaje" {{$SolRes->SolResVideoDescargue_Pesaje  == 1 ? 'checked' : '' }} hidden="">
                                    </div>
                                </div>
                                <div class="col-md-3" style="text-align: center;">
                                    <label for="SolResFotoDescargue_Pesaje">Video tratamiento</label>
                                    <div style="width: 100%; height: 34px;">
                                        <input type="checkbox" disabled="" class="testswitch" id="SolResFotoDescargue_Pesaje" name="SolResFotoDescargue_Pesaje" {{$SolRes->SolResVideoTratamiento  == 1 ? 'checked' : '' }} hidden="">
                                    </div>
                                </div>
                            </div>
							<div class="col-md-12 border-gray">
								<div class="col-md-6">
									<label>Kilogramos enviados: </label><br>
									<a>{{$SolRes->SolResTypeUnidad}}</a>
								</div>
								<div class="col-md-6">
									<label>Kilogramos conciliados: </label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolRes->SolResCantiUnidad}}</p>">{{$SolRes->SolResCantiUnidad}}</a>
								</div>
								<div class="col-md-6">
									<label>Kilogramos conciliados: </label><br>
									<a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolRes->SolResEmbalaje}}</p>">{{$SolRes->SolResEmbalaje}}</a>
								</div>
                            </div>
							
                        </div>
                    </div>
                </div>
                @if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
                {{-- Modal Añadir Recurso  --}}
                <form role="form" action="/recurso/{{$SolRes->SolResSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator" >
                    @method('PUT')
                    {{csrf_field()}}
                    @csrf
                    <div class="modal modal-default fade in" id="addRecurso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <div style="font-size: 5em; color: green; text-align: center; margin: auto;">
                                        <i class="fas fa-plus-circle"></i>
                                        <span style="font-size: 0.3em; color: black;"><p>Añadir nuevo Recurso</p></span>
                                    </div>
                                </div>
                                <div class="modal-header">
                                    <div class="col-md-12 form-group">
                                        <label for="categoria">Categoría</label><small class="help-block with-errors">*</small>
                                        <select class="form-control select" id="categoria" name="RecCarte" required>
                                            <option value="">Seleccione...</option>
                                            <option>Foto</option>
                                            <option>Video</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="tipo">Tipo</label><small class="help-block with-errors">*</small>
                                        <select class="form-control select" id="tipo" name="RecTipo" required>
                                            <option value="">Seleccione...</option>
                                            {{-- <option>Cargue</option>
                                            <option>Descargue</option>
                                            <option>Reempacado</option>
                                            <option>Mezclado</option>
                                            <option>Destruccion</option> --}}
                                            <option>Pesaje</option>
                                            <option>Tratamiento</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="recursoinputext">Archivos</label><small class="help-block with-errors">*</small>
                                        <input type="file" class="form-control" id="recursoinputext" name="RecSrc[]" accept=".jpg, .jpeg, .png, .mp4" multiple required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>   
                {{-- final del modal --}}
                @endif
				<div class="row">
                    <tbody  hidden onload="renderTable()" id="readyTable">
                        <div class="col-md-12">
                            <center><h3>Recursos</h3></center>
                            <div class="box box-warning">
                                <div class="col-md-6">
                                    <h4>Fotos</h4>
                                    @if (!isset($Fotos[0]->RecTipo))
                                        <img src="../../../img/defaultimage.png" height="300px" width="100%" max-width="1200">
                                    @else
                                        @foreach ($Fotos as $Foto)
                                            <div class="col-md-16">
                                                {{-- <img src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200"> --}}
                                                {{-- <div class="slider">
                                                    <img src="../../../img/Recursos/{{$Recurso->RecSrc}}/{{$Recurso->RecRmSrc}}" >
                                                </div> --}}
                                                <div style="background-image: url('../../../img/Recursos/{{$Foto->RecSrc}}/{{$Foto->RecRmSrc}}');  background-repeat: no-repeat; height: 300px; width:500px; max-width:1200px;  background-size: cover;">
                                                    <nav class="navbar navbar-inverse">
                                                        <div class="container">
                                                            <ul class="nav nav-pills">
                                                                <li role="presentation" class="navbar-brand"><b>{{$Foto->RecTipo}}</b></li>
                                                                <li role="presentation"><a href="../../../img/Recursos/{{$Foto->RecSrc}}/{{$Foto->RecRmSrc}}" target="_blank" title="Ampliar Imagen"><label><i class="fas fa-expand-arrows-alt"></label></i></a></li>
                                                                @if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
                                                                    <li role="presentation"><a href="#" title="Eliminar Imagen"><label for="deleterec"><i class="fas fa-trash-alt"></i></label></a></li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </nav>
                                                </div>
                                                {{-- <button type="submit" class="btn btn-danger" value ="{{$Recurso->ID_Rec}}" name="DeleteRec">Eliminar</button> --}}
                                                <form role="form" action="/recurso/{{$Foto->SlugRec}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="display: none;" value ="{{$Foto->SlugRec}}" name="DeleteRec" id="deleterec"></button>
                                                </form>
                                            </div>
                                        @endforeach
                                    @endif
                                    
                                </div>
                                <div class="col-md-6">
                                    <h4>Videos</h4>
                                    @if (!isset($Videos[0]->RecTipo))
                                        <img src="../../../img/defaultvideo.jpg" height="300px" width="100%" max-width="1200">
                                    @else
                                        @foreach ($Videos as $Video)
                                            {{-- @if ($Video->RecTipo == 'Pesaje') --}}
                                            <div class="col-md-16">
                                                    {{-- <label>{{$Recurso->RecTipo}}</label> --}}
                                                    {{-- <div id="PesajeRec"> --}}
                                                        {{-- @foreach ($Recursos as $Recurso)
                                                            @if ($Recurso->RecTipo == 'Pesaje' and $Recurso->RecCarte == 'Foto') --}}
                                                                {{-- <div> --}}
                                                                    {{-- <img src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200"> --}}
                                                                        {{-- <div class="slider">
                                                                            <img src="../../../img/Recursos/{{$Recurso->RecSrc}}/{{$Recurso->RecRmSrc}}" >
                                                                        </div> --}}
                                                {{-- <div style="background-image: url('../../../img/Recursos/{{$Video->RecSrc}}/{{$Video->RecRmSrc}}');  background-repeat: no-repeat; height: 300px; width:500px; max-width:1200;  background-size: cover;"> --}}
                                                    <nav class="navbar navbar-inverse">
                                                        <div class="container">
                                                            <ul class="nav nav-pills">
                                                                <li role="presentation" class="navbar-brand"><b>{{$Video->RecTipo}}</b></li>
                                                                <li role="presentation"><a href="../../../img/Recursos/{{$Video->RecSrc}}/{{$Video->RecRmSrc}}" target="_blank" title="Ampliar Imagen"><label><i class="fas fa-expand-arrows-alt"></label></i></a></li>
                                                                @if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
                                                                    <li role="presentation"><a href="#" title="Eliminar Imagen" style="color:red;"><label for="deleterec"><i class="fas fa-trash-alt"></i></label></a></li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </nav>
                                                    <video width="500px" muted controls height="300px" src="../../../img/Recursos/{{$Video->RecSrc}}/{{$Video->RecRmSrc}}"></video>
                                                {{-- </div> --}}
                                                {{-- <button type="submit" class="btn btn-danger" value ="{{$Recurso->ID_Rec}}" name="DeleteRec">Eliminar</button> --}}
                                                <form role="form" action="/recurso/{{$Video->SlugRec}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="display: none;" value ="{{$Video->SlugRec}}" name="DeleteRec" id="deleterec"></button>
                                                </form>
                                                            {{-- @endif
                                                        @endforeach   --}}
                                                    {{-- </div> --}}
                                            </div>
                                                {{-- @break --}}
                                            {{-- @endif --}}
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </tbody>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
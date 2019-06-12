@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solser') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.solser') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header with-border">
                    <div class="col-md-12" >
                        @if($SolSer->SolSerStatus === 'Programado' || $SolSer->SolSerStatus === 'Completado' || $SolSer->SolSerStatus === 'Tratado' || $SolSer->SolSerStatus === 'Certificacion')
                            @if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
                                <center><h4>{{trans('adminlte_lang::message.solrestitleclientepart1')}} <b>{{trans('adminlte_lang::message.update')}}</b> {{trans('adminlte_lang::message.o')}} <b>{{trans('adminlte_lang::message.delete')}}</b> {{trans('adminlte_lang::message.solrestitleclientepart2')}}
                                    @switch($SolSer->SolSerStatus)
                                        @case('Programado')
                                            {{trans('adminlte_lang::message.solresProgramador')}}
                                            @break
                                        @case('Completado')
                                            {{trans('adminlte_lang::message.solresCompletado')}}
                                            @break
                                        @case('Tratado')
                                            {{trans('adminlte_lang::message.solresTratado')}}
                                            @break
                                        @case('Certificacion')
                                            {{trans('adminlte_lang::message.solresCertificado')}}
                                            @break
                                    @endswitch
                                    </h4></center>
                            @else
                                <h3 class="box-title">{{trans('adminlte_lang::message.solresrespel')}}</h3>
                                @if($SolSer->SolSerStatus !== 'Programado')
                                    <a href="/solicitud-residuo/{{$SolRes->SolResSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
                                @endif
                            @endif
                        @else
                            @if(Auth::user()->UsRol !== trans('adminlte_lang::message.Cliente'))
                                <h3 class="box-title">{{trans('adminlte_lang::message.solresrespel')}}</h3>
                                {{-- <a method='get' href='#' data-toggle='modal' data-target='#addRecurso'  class="btn btn-success"><i class="fas fa-plus-circle"></i><b> {{trans('adminlte_lang::message.add')}}</b></a> --}}
                            @else
                                @component('layouts.partials.modal')
                                    @slot('slug')
                                        {{$SolRes->SolResSlug}}
                                    @endslot
                                    @slot('textModal')
                                        {{trans('adminlte_lang::message.solresrespel')}}
                                        <b>N° {{$SolSer->ID_SolSer}}</b>
                                    @endslot
                                @endcomponent
                                <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$SolRes->SolResSlug}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i> <b>{{trans('adminlte_lang::message.delete')}}</b></a>
                                <a href="/solicitud-residuo/{{$SolRes->SolResSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
                                <form action='/solicitud-residuo/{{$SolRes->SolResSlug}}' method='POST'>
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" id="Eliminar{{$SolRes->SolResSlug}}" style="display: none;">
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row">
					<div class="col-md-12 ">
						<div class="box box-info">
							<div class="col-md-12">
                                <div class="col-md-16">
                                    <div class="col-md-4 border-gray">
                                        <label>{{trans('adminlte_lang::message.solrestypeunity')}}</label><br>
                                        <a>{{$SolRes->SolResTypeUnidad}}</a>
                                    </div>
                                    <div class="col-md-4 border-gray">
                                        <label>{{trans('adminlte_lang::message.solrescantunity')}}</label><br>
                                        <a>{{$SolRes->SolResCantiUnidad}}</a>
                                    </div>
                                    <div class="col-md-4 border-gray">
                                        <label>{{trans('adminlte_lang::message.solresembalaje')}}</label><br>
                                        <a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolRes->SolResEmbalaje}}</p>">{{$SolRes->SolResEmbalaje}}</a>
                                    </div>
                                </div>
                                <div class="border-gray" id="kgenviados">
                                    <label>{{trans('adminlte_lang::message.soresenviado')}}</label><br>
                                    <a>{{$SolRes->SolResKgEnviado}}</a>
                                </div>
                                @if (Auth::user()->UsRol !== trans('adminlte_lang::message.Cliente'))
                                    <div class="col-md-3 border-gray">
                                        <label>{{trans('adminlte_lang::message.solresresivido')}}</label><br>
                                        <a>{{$SolRes->SolResKgRecibido}}</a>
                                    </div>
                                @endif
                                <div class="border-gray" id="kgconciliados">
                                    <label>{{trans('adminlte_lang::message.solresconciliado')}}</label><br>
                                    <a>{{$SolRes->SolResKgConciliado}}</a>
                                </div>
                                @if (Auth::user()->UsRol !== trans('adminlte_lang::message.Cliente'))
                                    <div class="col-md-3 border-gray">
                                        <label>{{trans('adminlte_lang::message.solrestratado')}}</label><br>
                                        <a>{{$SolRes->SolResKgTratado}}</a>
                                    </div>
                                @endif
                                <div class="col-md-4 border-gray">
                                    <label>Alto: </label><br>
                                    <a>{{$SolRes->SolResAlto}}</a>
                                </div>
                                <div class="col-md-4 border-gray">
                                    <label>Ancho: </label><br>
                                    <a>{{$SolRes->SolResAncho}}</a>
                                </div>
                                <div class="col-md-4 border-gray">
                                    <label>Profundo: </label><br>
                                    <a>{{$SolRes->SolResProfundo}}</a>
                                </div>
                            </div>
                            <div class="col-md-12 border-gray">
                                <center><h4>Requerimientos</h4><center>
                                <div class="col-md-3" style="text-align: center; margin-top: 20px;">
                                    <label for="SolResFotoDescargue_Pesaje">Foto Pesaje/Descargue</label>
                                    <div style="width: 100%; height: 34px;">
                                        <input type="checkbox" disabled="" class="testswitch" id="SolResFotoDescargue_Pesaje" name="SolResFotoDescargue_Pesaje" {{$SolRes->SolResFotoDescargue_Pesaje === 1 ? 'checked' : '' }} hidden="">
                                    </div>
                                </div>
                                <div class="col-md-3" style="text-align: center; margin-top: 20px;">
                                    <label for="SolResFotoDescargue_Pesaje">Foto Tratamineto</label>
                                    <div style="width: 100%; height: 34px;">
                                        <input type="checkbox" disabled="" class="testswitch" id="SolResFotoDescargue_Pesaje" name="SolResFotoDescargue_Pesaje" {{$SolRes->SolResFotoTratamiento  === 1 ? 'checked' : '' }} hidden="">
                                    </div>
                                </div>
                                <div class="col-md-3" style="text-align: center; margin-top: 20px;">
                                    <label for="SolResFotoDescargue_Pesaje">Video Pesaje/Descargue</label>
                                    <div style="width: 100%; height: 34px;">
                                        <input type="checkbox" disabled="" class="testswitch" id="SolResFotoDescargue_Pesaje" name="SolResFotoDescargue_Pesaje" {{$SolRes->SolResVideoDescargue_Pesaje  === 1 ? 'checked' : '' }} hidden="">
                                    </div>
                                </div>
                                <div class="col-md-3" style="text-align: center; margin: 20px 0px 20px 0px; ">
                                    <label for="SolResFotoDescargue_Pesaje">Video Tratamiento</label>
                                    <div style="width: 100%; height: 34px;">
                                        <input type="checkbox" disabled="" class="testswitch" id="SolResFotoDescargue_Pesaje" name="SolResFotoDescargue_Pesaje" {{$SolRes->SolResVideoTratamiento  === 1 ? 'checked' : '' }} hidden="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.SupervisorTurno'))
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
                                    <div id="categoria">
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="tipo">Tipo</label><small class="help-block with-errors">*</small>
                                        <select class="form-control" id="tipo" name="RecTipo" required>
                                            
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="recursoinputext">Archivos</label><small class="help-block with-errors">*</small>
                                        <input type="file" class="form-control" id="recursoinputext" name="RecSrc[]" multiple required>
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
                <div id="deleteRecurso">

                </div>
				<div class="row">
                    @if($SolSer->SolSerStatus === 'Completado' || $SolSer->SolSerStatus === 'Tratado' || $SolSer->SolSerStatus === 'Certificacion')
                        @if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') && $SolSer->SolSerStatus === 'Completado')
                            <div class="col-md-12">
                                <center><h3>
                                    <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Recursos</b>" data-content="En este espacio apareceran las Fotos y Videos que usted haya requerido, una vez que el tratamiento se haya efectuado"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Recursos</label>
                                </h3></center>
                            </div>
                        @else
                            <tbody hidden onload="renderTable()" id="readyTable">
                                <div class="col-md-12">
                                    <center><h3>Recursos</h3></center>
                                    <div class="box box-warning">
                                        <div class="col-md-6">
                                            <h4>
                                                Fotos
                                                @if(Auth::user()->UsRol === trans('adminlte_lang::message.SupervisorTurno') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
                                                    <a method='get' href='#' data-toggle='modal' data-target='#addRecurso' style="color:green" title="Agregar Foto" id="addFoto"><i class="fas fa-plus-circle"></i></a>
                                                @endif
                                            </h4>
                                            @if (!isset($Fotos[0]->RecTipo))
                                                <img src="../../../img/defaultimage.png" height="300px" width="100%" max-width="1200px">
                                            @else
                                                <div style='overflow-y:auto; max-height:600px;'>
                                                    @foreach ($Fotos as $Foto)
                                                        <div class="col-md-12">
                                                            <div style="background-image: url('../../../img/Recursos/{{$Foto->RecSrc}}/{{$Foto->RecRmSrc}}');  background-repeat: no-repeat; height: 300px; width:500px; max-width:500px; background-size: cover; margin-bottom:10px;">
                                                                <nav class="navbar navbar-inverse">
                                                                    <div class="container">
                                                                        <ul class="nav nav-pills" style="padding-top: 2px; max-width:500px" max-width="500px">
                                                                            <li role="presentation" class="navbar-brand" style="color:white;"><i>{{$Foto->RecTipo}}</i></li>
                                                                            <li role="presentation"><a href="../../../img/Recursos/{{$Foto->RecSrc}}/{{$Foto->RecRmSrc}}" target="_blank" title="Ampliar Imagen" style="color:orange;"><label style="cursor:pointer;"><i class="fas fa-expand-arrows-alt"></label></i></a></li>
                                                                            @if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
                                                                                <li role="presentation"><a href="../../../img/Recursos/{{$Foto->RecSrc}}/{{$Foto->RecRmSrc}}" download="{{now().'_'.$Respel->RespelName.'_'.$Foto->RecTipo}}" title="Descargar Imagen"><label style="color:pink; cursor:pointer;"><i class="fas fa-download"></i></label></a></li>
                                                                            @endif
                                                                            @if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.SupervisorTurno'))
                                                                                <li role="presentation"><a href="#" onclick="deleteRecursos(`{{$Foto->SolResSlug}}`, `{{$Foto->RecTipo}}`, `{{$Foto->RecCarte}}`, `{{$Foto->SlugRec}}`)" title="Eliminar Imagen"><label style="color:red; cursor:pointer;"><i class="fas fa-trash-alt"></i></label></a></li>
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                </nav>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-6" style="margin-bottom:10px;">
                                            <h4>
                                                Videos
                                                @if(Auth::user()->UsRol === trans('adminlte_lang::message.SupervisorTurno') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
                                                    <a method='get' href='#' data-toggle='modal' data-target='#addRecurso' style="color:green" title="Agregar Video" id="addVideo"><i class="fas fa-plus-circle"></i></a>
                                                @endif
                                            </h4>
                                            @if (!isset($Videos[0]->RecTipo))
                                                <img src="../../../img/defaultvideo.jpg" height="300px" width="100%" max-width="1200">
                                            @else
                                            <div style='overflow-y:auto; max-height:600px;'>
                                                @foreach ($Videos as $Video)
                                                    <div class="col-md-16">
                                                        <nav class="navbar navbar-inverse">
                                                            <div class="container">
                                                                <ul class="nav nav-pills">
                                                                    <li role="presentation" class="navbar-brand" style="color:white"><i>{{$Video->RecTipo}}</i></li>
                                                                    @if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
                                                                        <li role="presentation"><a href="../../../img/Recursos/{{$Video->RecSrc}}/{{$Video->RecRmSrc}}" download="{{now().'_'.$Respel->RespelName.'_'.$Video->RecTipo}}" title="Descargar Video"><label style="color:pink; cursor:pointer;"><i class="fas fa-download"></i></label></a></li>
                                                                    @endif
                                                                    @if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.SupervisorTurno'))
                                                                        <li role="presentation"><a href="#" onclick="deleteRecursos(`{{$Video->SolResSlug}}`, `{{$Video->RecTipo}}`, `{{$Video->RecCarte}}`, `{{$Video->SlugRec}}`)" title="Eliminar Imagen"><label style="color:red; cursor:pointer;"><i class="fas fa-trash-alt"></i></label></a></li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </nav>
                                                        <video width="500px" style="margin-top:-30px;" muted controls height="250px" src="../../../img/Recursos/{{$Video->RecSrc}}/{{$Video->RecRmSrc}}"></video>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </tbody>
                        @endif
                    @else
                        @if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
                            <div class="col-md-12">
                                <center><h3>
                                    <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Recursos</b>" data-content="En este espacio apareceran las Fotos y Videos que usted haya requerido, una vez que el tratamiento se haya efectuado"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Recursos</label>
                                </h3></center>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@section('NewScript')
<script>
    $("#addFoto").click(function(e){
        $("#categoria").empty();
        $("#tipo").empty();
        $("#categoria").append(`
            <input type="text" hidden value="Foto" name="RecCarte">
        `);
        $("#tipo").append(`
            <option value="">Seleccione...</option>
        `);
        if('{{$SolRes->SolResFotoDescargue_Pesaje}}' === '1'){
            $("#tipo").append(`
                <option>Pesaje/Descargue</option>
            `);
        }
        if('{{$SolRes->SolResFotoTratamiento}}' === '1'){
            $("#tipo").append(`
                <option>Tratamiento</option>
            `);
        }
        $('#recursoinputext').attr('accept', '.jpg,.jpeg,.png')
    });
    $("#addVideo").click(function(e){
        $("#categoria").empty();
        $("#tipo").empty();
        $("#categoria").append(`
            <input type="text" hidden value="Video" name="RecCarte">
        `);
        $("#tipo").append(`
            <option value="">Seleccione...</option>
        `);
        if('{{$SolRes->SolResVideoDescargue_Pesaje}}' === '1'){
            $("#tipo").append(`
                <option>Pesaje/Descargue</option>
            `);
        }
        if('{{$SolRes->SolResVideoTratamiento}}' === '1'){
            $("#tipo").append(`
                <option>Tratamiento</option>
            `);
        }
        $('#recursoinputext').attr('accept', '.mp4')
    });
</script>
<script>
    if('{{Auth::user()->UsRol === trans("adminlte_lang::message.Cliente")}}'){
        $('#kgenviados').addClass('col-md-6');
        $('#kgconciliados').addClass('col-md-6');
    }else{
        $('#kgenviados').addClass('col-md-3');
        $('#kgconciliados').addClass('col-md-3');
    }
</script>
<script>
    function deleteRecursos(slug, tipo, categoria, value){
        $('#deleteRecurso').empty();
        $('#deleteRecurso').append(`
            @component('layouts.partials.modal')
                @slot('slug')
                    `+slug+`
                @endslot
                @slot('textModal')
                    `+categoria+` de `+tipo+`
                @endslot
            @endcomponent
            <form action='/recurso/`+slug+`' method='POST'>
                @method('DELETE')
                @csrf
                <input type="submit" id="Eliminar`+slug+`" style="display: none;">
                <input value="`+value+`" name="DeleteRec" style="display: none;">

            </form>
        `);
        $('#myModal'+slug).modal();
    }
</script>
@endsection
@endsection
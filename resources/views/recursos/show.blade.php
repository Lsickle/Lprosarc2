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
                        @if($SolSer->SolSerStatus === 'Programado' || $SolSer->SolSerStatus === 'Completado' || $SolSer->SolSerStatus === 'Conciliado' || $SolSer->SolSerStatus === 'Tratado' || $SolSer->SolSerStatus === 'Certificacion')
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
                                @if($SolSer->SolSerStatus !== 'Certificacion')
                                    @if($SolSer->SolSerStatus !== 'Programado')
                                        @if(Auth::user()->UsRol !== trans('adminlte_lang::message.JefeLogistica') && $SolSer->SolSerStatus === 'Tratado')
                                            <a href="/solicitud-residuo/{{$SolRes->SolResSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @else
                            @if(Auth::user()->UsRol !== trans('adminlte_lang::message.Cliente'))
                                <h3 class="box-title">{{trans('adminlte_lang::message.solresrespel')}}</h3>
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
                                        @if($SolRes->SolResTypeUnidad === Null)
                                            <a>N/A</a>
                                        @else
                                            <a>{{$SolRes->SolResTypeUnidad}}</a>
                                        @endif
                                    </div>
                                    <div class="col-md-4 border-gray">
                                        <label>{{trans('adminlte_lang::message.solrescantunity')}}</label><br>
                                        @if($SolRes->SolResCantiUnidad === Null)
                                            <a>N/A</a>
                                        @else
                                            <a>{{$SolRes->SolResCantiUnidad}}</a>
                                        @endif
                                    </div>
                                    <div class="col-md-4 border-gray">
                                        <label>{{trans('adminlte_lang::message.solresembalaje')}}</label><br>
                                        <a href="#" class="textpopover popover-left" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SolRes->SolResEmbalaje}}</p>">{{$SolRes->SolResEmbalaje}}</a>
                                    </div>
                                </div>
                                <div class="border-gray" id="kgenviados">
                                    <label>{{trans('adminlte_lang::message.solresenviado')}}</label><br>
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
                                        @if ($SolRes->SolResKgTratado === Null)
                                            <a>0</a>
                                        @else
                                            <a>{{$SolRes->SolResKgTratado}}</a>
                                        @endif
                                    </div>
                                @endif
                                <div class="col-md-4 border-gray">
                                    <label>{{trans('adminlte_lang::message.solresalto')}}</label><br>
                                    @if ($SolRes->SolResAlto === Null)
                                        <a>0</a>
                                    @else
                                        <a>{{$SolRes->SolResAlto}}</a>
                                    @endif
                                </div>
                                <div class="col-md-4 border-gray">
                                    <label>{{trans('adminlte_lang::message.solresancho')}}</label><br>
                                    @if ($SolRes->SolResAncho === Null)
                                        <a>0</a>
                                    @else
                                        <a>{{$SolRes->SolResAncho}}</a>
                                    @endif
                                </div>
                                <div class="col-md-4 border-gray">
                                    <label>{{trans('adminlte_lang::message.solresProfundo')}}</label><br>
                                    @if($SolRes->SolResProfundo === Null)
                                        <a>0</a>
                                    @else
                                        <a>{{$SolRes->SolResProfundo}}</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 border-gray">
                                <center><h4>{{trans('adminlte_lang::message.requirements')}}</h4><center>
                                <div class="col-md-3" style="text-align: center; margin-top: 20px;">
                                    <label for="SolResFotoDescargue_Pesaje">{{trans('adminlte_lang::message.requiredescarguephoto')}}</label>
                                    <div style="width: 100%; height: 34px;">
                                        <input type="checkbox" disabled="" class="testswitch" id="SolResFotoDescargue_Pesaje" name="SolResFotoDescargue_Pesaje" {{$SolRes->SolResFotoDescargue_Pesaje === 1 ? 'checked' : '' }} hidden="">
                                    </div>
                                </div>
                                <div class="col-md-3" style="text-align: center; margin-top: 20px;">
                                    <label for="SolResFotoDescargue_Pesaje">{{trans('adminlte_lang::message.requiretratamientophoto')}}</label>
                                    <div style="width: 100%; height: 34px;">
                                        <input type="checkbox" disabled="" class="testswitch" id="SolResFotoDescargue_Pesaje" name="SolResFotoDescargue_Pesaje" {{$SolRes->SolResFotoTratamiento  === 1 ? 'checked' : '' }} hidden="">
                                    </div>
                                </div>
                                <div class="col-md-3" style="text-align: center; margin-top: 20px;">
                                    <label for="SolResFotoDescargue_Pesaje">{{trans('adminlte_lang::message.requiredescarguevideo')}}</label>
                                    <div style="width: 100%; height: 34px;">
                                        <input type="checkbox" disabled="" class="testswitch" id="SolResFotoDescargue_Pesaje" name="SolResFotoDescargue_Pesaje" {{$SolRes->SolResVideoDescargue_Pesaje  === 1 ? 'checked' : '' }} hidden="">
                                    </div>
                                </div>
                                <div class="col-md-3" style="text-align: center; margin: 20px 0px 20px 0px; ">
                                    <label for="SolResFotoDescargue_Pesaje">{{trans('adminlte_lang::message.requiretratamientovideo')}}</label>
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
                    @if($SolSer->SolSerStatus === 'Programado' || $SolSer->SolSerStatus === 'Completado' || $SolSer->SolSerStatus === 'Conciliado' || $SolSer->SolSerStatus === 'Tratado' || $SolSer->SolSerStatus === 'Certificacion')
                        @if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') && $SolSer->SolSerStatus === 'Completado')
                            <div class="col-md-12">
                                <center>
                                    <h3 data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Recursos</b>" data-content="{{trans('adminlte_lang::message.recursostratamiento')}}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Recursos</h3>
                                </center>
                            </div>
                        @else
                            <tbody hidden onload="renderTable()" id="readyTable">
                                <div class="col-md-12">
                                    <center><h3>{{trans('adminlte_lang::message.recursos')}}</h3></center>
                                    <div class="box box-warning">
                                        <div class="col-md-6" style="margin-bottom:15px;">
                                            <h4>
                                                {{trans('adminlte_lang::message.recursoFoto')}}
                                                @if(Auth::user()->UsRol === trans('adminlte_lang::message.SupervisorTurno') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
                                                    @if ($SolSer->SolSerStatus !== 'Tratado' || $SolSer->SolSerStatus !== 'Certificacion')
                                                        <a method='get' href='#' data-toggle='modal' data-target='#addRecurso' style="color:green" title="{{trans('adminlte_lang::message.recaddfoto')}}" id="addFoto"><i class="fas fa-plus-circle"></i></a>
                                                    @endif
                                                @endif
                                            </h4>
                                            @if (!isset($Fotos[0]->RecTipo))
                                                <img src="../../../img/defaultimage.png" height="300px" width="100%" max-width="1200px">
                                            @else
                                                <div style='overflow-y:auto; overflow-x:hidden; max-height:600px;'>
                                                    @foreach ($Fotos as $Foto)
                                                        <div class="col-md-12">
                                                            <div style="background-image: url('../../../img/Recursos/{{$Foto->RecSrc}}/{{$Foto->RecRmSrc}}');  background-repeat: no-repeat; height: 300px; width:100%; max-width:500px; background-size:100% 300px; margin-bottom:15px;">
                                                                <nav class="navbar navbar-inverse">
                                                                    <div class="container">
                                                                        <ul class="nav nav-pills" style="padding-top: 2px; max-width:500px" max-width="500px">
                                                                            <li role="presentation" class="navbar-brand" style="color:white;"><i>{{$Foto->RecTipo}}</i></li>
                                                                            <li role="presentation"><a href="../../../img/Recursos/{{$Foto->RecSrc}}/{{$Foto->RecRmSrc}}" target="_blank" title="{{trans('adminlte_lang::message.recampliarfoto')}}" style="color:orange;"><label style="cursor:pointer;"><i class="fas fa-expand-arrows-alt"></label></i></a></li>
                                                                            @if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
                                                                                <li role="presentation"><a href="../../../img/Recursos/{{$Foto->RecSrc}}/{{$Foto->RecRmSrc}}" download="{{now().'_'.$Respel->RespelName.'_'.$Foto->RecTipo}}" title="{{trans('adminlte_lang::message.recdowloadfoto')}}"><label style="color:pink; cursor:pointer;"><i class="fas fa-download"></i></label></a></li>
                                                                            @endif
                                                                            @if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.SupervisorTurno'))
                                                                                @if ($SolSer->SolSerStatus === 'Tratado' || $SolSer->SolSerStatus === 'Certificacion')
                                                                                    @if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
                                                                                        <li role="presentation"><a href="#" onclick="deleteRecursos(`{{$Foto->SolResSlug}}`, `{{$Foto->RecTipo}}`, `{{$Foto->RecCarte}}`, `{{$Foto->SlugRec}}`)" title="{{trans('adminlte_lang::message.recdeletefoto')}}"><label style="color:red; cursor:pointer;"><i class="fas fa-trash-alt"></i></label></a></li>
                                                                                    @endif
                                                                                @else                                                                            
                                                                                    <li role="presentation"><a href="#" onclick="deleteRecursos(`{{$Foto->SolResSlug}}`, `{{$Foto->RecTipo}}`, `{{$Foto->RecCarte}}`, `{{$Foto->SlugRec}}`)" title="{{trans('adminlte_lang::message.recdeletefoto')}}"><label style="color:red; cursor:pointer;"><i class="fas fa-trash-alt"></i></label></a></li>
                                                                                @endif
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
                                        <div class="col-md-6" style="margin-bottom:15px;">
                                            <h4>
                                                {{trans('adminlte_lang::message.recursoVideo')}}
                                                @if(Auth::user()->UsRol === trans('adminlte_lang::message.SupervisorTurno') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
                                                    @if ($SolSer->SolSerStatus !== 'Tratado' || $SolSer->SolSerStatus !== 'Certificacion')
                                                        <a method='get' href='#' data-toggle='modal' data-target='#addRecurso' style="color:green" title="{{trans('adminlte_lang::message.recdeletevideo')}}" id="addVideo"><i class="fas fa-plus-circle"></i></a>
                                                    @endif
                                                @endif
                                            </h4>
                                            @if (!isset($Videos[0]->RecTipo))
                                                <img src="../../../img/defaultvideo.jpg" height="auto" width="100%" max-width="1200">
                                            @else
                                            <div style='overflow-y:auto; overflow-x:hidden; max-height:600px;'>
                                                @foreach ($Videos as $Video)
                                                    <div class="col-md-12" style="margin-bottom:10px;">
                                                        <nav class="navbar navbar-inverse">
                                                            <div class="container">
                                                                <ul class="nav nav-pills">
                                                                    <li role="presentation" class="navbar-brand" style="color:white"><i>{{$Video->RecTipo}}</i></li>
                                                                    @if(Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
                                                                        <li role="presentation"><a href="../../../img/Recursos/{{$Video->RecSrc}}/{{$Video->RecRmSrc}}" download="{{now().'_'.$Respel->RespelName.'_'.$Video->RecTipo}}" title="{{trans('adminlte_lang::message.recdeletevideo')}}"><label style="color:pink; cursor:pointer;"><i class="fas fa-download"></i></label></a></li>
                                                                    @endif
                                                                    @if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.SupervisorTurno'))
                                                                        @if ($SolSer->SolSerStatus === 'Tratado' || $SolSer->SolSerStatus === 'Certificacion')
                                                                            @if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
                                                                                <li role="presentation"><a href="#" onclick="deleteRecursos(`{{$Video->SolResSlug}}`, `{{$Video->RecTipo}}`, `{{$Video->RecCarte}}`, `{{$Video->SlugRec}}`)" title="{{trans('adminlte_lang::message.recdeletevideo')}}"><label style="color:red; cursor:pointer;"><i class="fas fa-trash-alt"></i></label></a></li>
                                                                            @endif
                                                                        @else
                                                                            <li role="presentation"><a href="#" onclick="deleteRecursos(`{{$Video->SolResSlug}}`, `{{$Video->RecTipo}}`, `{{$Video->RecCarte}}`, `{{$Video->SlugRec}}`)" title="{{trans('adminlte_lang::message.recdeletevideo')}}"><label style="color:red; cursor:pointer;"><i class="fas fa-trash-alt"></i></label></a></li>
                                                                        @endif
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </nav>
                                                        <div class="col-md-12">
                                                            <video width="100%" height="auto" style="margin-top:-20px;" muted controls  src="../../../img/Recursos/{{$Video->RecSrc}}/{{$Video->RecRmSrc}}"></video>
                                                        </div>
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
                                <center>
                                    <h3 data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{trans('adminlte_lang::message.recursos')}}</b>" data-content="{{trans('adminlte_lang::message.recursostratamiento')}}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.recursos')}}</h3>
                                </center>
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
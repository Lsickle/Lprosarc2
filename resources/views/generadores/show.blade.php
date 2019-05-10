@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.gener') }}
@endsection
@section('contentheader_title')
	{{ trans('adminlte_lang::message.gener') }}
@endsection	
@section('main-content')
<div class="container-fluid spark-screen">
    {{-- seccion de prueba --}}
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    @if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
                    <a href="/generadores/{{$Generador->GenerSlug}}/edit" class="btn btn-warning pull-right"><b>{{ trans('adminlte_lang::message.edit') }}</b></a>
                        @component('layouts.partials.modal')
                            {{$Generador->ID_Gener}}
                        @endcomponent
                        @if($Generador->GenerDelete == 0)
                            <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Generador->ID_Gener}}' class='btn btn-danger pull-left'><b>{{ trans('adminlte_lang::message.delete') }}</b></a>
                            <form action='/generadores/{{$Generador->GenerSlug}}' method='POST'  class="col-12 pull-right">
                                @method('DELETE')
                                @csrf
                                <input type="submit" id="Eliminar{{$Generador->ID_Gener}}" style="display: none;">
                            </form>
                        @else
                            <form action='/generadores/{{$Generador->GenerSlug}}' method='POST' class="pull-right">
                                @method('DELETE')
                                @csrf
                                <input type="submit" class='btn btn-success btn-block' value="{{ trans('adminlte_lang::message.add') }}">
                            </form>
                        @endif
                    @endif
                    <h3 class="profile-username text-center textolargo col-12">{{$Generador->GenerShortname}}</h3>
                    <ul class="list-group list-group-unbordered">
                        @if (Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
                            <li class="list-group-item">
                                <b>{{ trans('adminlte_lang::message.clientcliente') }}</b> 
                                <a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clientcliente') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Cliente->CliShortname}}</p>">{{$Cliente->CliShortname}}</a>
                            </li>
                        @endif
                        <li class="list-group-item">
                            <b>{{ trans('adminlte_lang::message.sclientsede') }}</b> 
                            <a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.sclientsede') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Sede->SedeName}}</p>">{{$Sede->SedeName}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{ trans('adminlte_lang::message.clientNIT') }}</b> 
                            <a href="#" class="pull-right">{{$Generador->GenerNit}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{ trans('adminlte_lang::message.clirazonsoc') }}</b> 
                            <a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Generador->GenerName}}</p>">{{$Generador->GenerName}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b> 
                            <a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clientnombrecorto') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Generador->GenerShortname}}</p>">{{$Generador->GenerShortname}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{ trans('adminlte_lang::message.genercode') }}</b> 
                            <a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.genercode') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Generador->GenerCode}}</p>">{{$Generador->GenerCode}}</a>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

         {{--  Modal Agregar un Residuo a una SedeGener--}}
        <form role="form" action="/respelSedeGener" method="POST" enctype="multipart/form-data" data-toggle="validator">
            @csrf
            
            <div class="modal modal-default fade in" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <div style="font-size: 5em; color: green; text-align: center; margin: auto;">
                                {{-- <i class="fas fa-plus"></i> --}}
                                <i class="fas fa-plus-circle"></i>
                                <span style="font-size: 0.3em; color: black;"><p>Asignar Residuos a la Sede del Generador</p></span>
                            </div> 
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <p>{{$error}}</p>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="modal-body">
                            <div class="col-md-12 form-group">
                                <label for="FK_SGener">Sedes del Generador</label><small class="help-block with-errors">*</small>
                                <select class="form-control select" id="FK_SGener" name="FK_SGener" >
                                    <option value="">{{ trans('adminlte_lang::message.select') }}</option>
                                    @foreach ($GenerSedes as $GenerSede)	
                                        <option value="{{$GenerSede->ID_GSede}}" {{ old('FK_SGener') == $GenerSede->ID_GSede ? 'selected' : '' }}>{{$GenerSede->GSedeName}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="FK_Respel">{{ trans('adminlte_lang::message.MenuRespel') }} </label><small class="help-block with-errors">*</small>
                                <select class="form-control select-multiple" id="FK_Respel" name="FK_Respel[]" multiple>
                                    @if(isset($Residuos))
                                        @foreach ($Residuos as $Residuo)
                                            @foreach ($old as $ID_Res)
                                        {{-- $old --}}
                                                {{-- <option value="{{$Residuo->ID_Respel}}" {{ old('FK_Respel[]') == $Residuo->ID_Respel ? 'selected' : '' }}>{{$Residuo->RespelName}}</option> --}}
                                                <option value="{{$Residuo->ID_Respel}}" {{ $ID_Res == $Residuo->ID_Respel ? 'selected' : '' }}>{{$Residuo->RespelName}}</option>
                                            @endforeach 
                                        @endforeach 
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-success pull-left" data-dismiss="modal">No, salir</button>
                            <button type="submit" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.add') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
      {{-- END Modal --}}
        <div class="col-md-6">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active box-info" ><a href="#residuos" data-toggle="tab">{{ trans('adminlte_lang::message.MenuRespel') }}</a></li>
                    <li><a href="#sedes" data-toggle="tab">{{ trans('adminlte_lang::message.sclientsedes') }}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="residuos">
                        <a href="/respels/create" class="btn btn-primary mx-auto"><b>Crear Residuo</b></a>
                        <a method='get' href='#' data-toggle='modal' data-target='#add'  class="btn btn-primary mx-auto pull-right"><i class="fas fa-plus"></i><b> Asignar Residuos</b></a>
                        <div style='overflow-y:auto; max-height:324px;'>
                            @foreach ($Respels as $Respel)
                                <ul class="list-group" style="list-style:none; margin-top:10px;">
                                    <li class="col-md-11 col-sm-11">
                                        <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light textolargo" style="display:flex; justify-content:center; align-items:center;">{{$Respel->GSedeName}} - {{$Respel->RespelName}}</a></h4>
                                    </li>
                                    <li class="col-md-1 col-sm-1">
                                        {{--  Modal Eliminar un Residuo de una SedeGener--}}
                                        <form action='/respelSedeGener/{{$Respel->ID_SGenerRes}}' method='POST' class="col-12 pull-right">
                                            @method('DELETE')
                                            @csrf
                                            <div class="modal modal-default fade in" id="delete{{$Respel->ID_SGenerRes}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <div style="font-size: 5em; color: red; text-align: center; margin: auto;">
                                                                <i class="fas fa-exclamation-triangle"></i>
                                                                <span style="font-size: 0.3em; color: black;">
                                                                    {{-- <p class="textolargo"><b><i>{{$Respel->GSedeName}} - {{$Respel->RespelName}}</i></b></p> --}}
                                                                    <p>¿Seguro, quiere eliminar <b><i>{{$Respel->RespelName}}</i></b> del generador <b><i>{{$Respel->GSedeName}}</i></b> ?</p>
                                                                </span>
                                                            </div> 
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-success pull-left" data-dismiss="modal">No, salir</button>
                                                            <label for="Eliminar{{$Respel->ID_SGenerRes}}" class='btn btn-danger'>Si, eliminar</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a method='get' href='#' data-toggle='modal' data-target='#delete{{$Respel->ID_SGenerRes}}' style="font-size: 1.5em; color: red; display:flex; justify-content:center;"><i class="fas fa-times-circle"></i></a>
                                            <input type="submit" id="Eliminar{{$Respel->ID_SGenerRes}}" style="display: none;">
                                        </form>
                                        {{-- END Modal --}}
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane" id="sedes">
                        <div style="display:flex; justify-content: center;">
                            <a href="/sgeneradores/create" class="btn btn-primary"><b>Añadir Sedes</b></a>
                        </div>
                        <div style='overflow-y:auto; max-height:324px;'>
                            @foreach ($GenerSedes as $GenerSede)
                                <h4><a href="/sgeneradores/{{$GenerSede->GSedeSlug}}" class="list-group-item list-group-item-action list-group-item-light textolargo" style="display:flex; justify-content:center; align-items:center;">{{$GenerSede->GSedeName}}</a></h4>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

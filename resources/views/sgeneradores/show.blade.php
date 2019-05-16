@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.SGenertitle') }}
@endsection
@section('contentheader_title')
	{{ trans('adminlte_lang::message.SGenertitle') }}
@endsection	
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <div class="col-md-12 col-xs-12">
                        @if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
                            <a href="/sgeneradores/{{$SedeGener->GSedeSlug}}/edit" class="btn btn-warning pull-right"><b>{{ trans('adminlte_lang::message.edit') }}</b></a>
                            @component('layouts.partials.modal')
                                {{$SedeGener->ID_GSede}}
                            @endcomponent
                        @endif
                        @if($SedeGener->GSedeDelete == 0 && Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
                            <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$SedeGener->ID_GSede}}' class='btn btn-danger pull-left'><b>{{ trans('adminlte_lang::message.delete') }}</b></a>
                            <form action='/sgeneradores/{{$SedeGener->GSedeSlug}}' method='POST'  class="col-12 pull-right">
                                @method('DELETE')
                                @csrf
                                <input type="submit" id="Eliminar{{$SedeGener->ID_GSede}}" style="display: none;">
                            </form>
                        @else
                            @if (Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
                                <form action='/sgeneradores/{{$SedeGener->GSedeSlug}}' method='POST' class="pull-right">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" class='btn btn-success btn-block' value="{{ trans('adminlte_lang::message.add') }}">
                                </form>
                            @endif
                        @endif
                    </div>
                    <div>
                        <h3 class="profile-username text-center textolargo col-12">{{$SedeGener->GSedeName}}</h3>
                    </div>
                    <ul class="list-group list-group-unbordered">
                        @if (Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
                            <li class="list-group-item">
                                <b>{{ trans('adminlte_lang::message.clientcliente') }}</b> 
                                <a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clientcliente') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Cliente->CliShortname}}</p>">{{$Cliente->CliShortname}}</a>
                            </li>
                        @endif
                        <li class="list-group-item">
                            <b>{{ trans('adminlte_lang::message.gener') }}</b> 
                            <a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.gener') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Generador->GenerName}}</p>">{{$Generador->GenerName}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{ trans('adminlte_lang::message.address') }}</b> 
                            <a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.adddress') }}')"><i class="far fa-copy"></i></a>
                            <a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.adddress') }}" title="{{ trans('adminlte_lang::message.address') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SedeGener->GSedeAddress}} ({{$Municipio->MunName}} - {{$Departamento->DepartName}})</p>">{{$SedeGener->GSedeAddress}} ({{$Municipio->MunName}} - {{$Departamento->DepartName}})</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{ trans('adminlte_lang::message.mobile') }}</b> 
                            <a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.mobile') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SedeGener->GSedeCelular}}</p>">{{$SedeGener->GSedeCelular}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{ trans('adminlte_lang::message.phone') }}</b> 
                            <a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.phone') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SedeGener->GSedePhone1}}{{' - '.$SedeGener->GSedeExt1}}</p>">{{$SedeGener->GSedePhone1}}{{" - ".$SedeGener->GSedeExt1}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{ trans('adminlte_lang::message.phone') }} 2</b> 
                            <a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.phone') }} 2" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SedeGener->GSedePhone2}}{{' - '.$SedeGener->GSedeExt2}}</p>">{{$SedeGener->GSedePhone2}}{{" - ".$SedeGener->GSedeExt2}}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{ trans('adminlte_lang::message.emailaddress') }}</b>
                            <a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.emailaddress') }}')"><i class="far fa-copy"></i></a>
                            <a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.emailaddress') }}" title="{{ trans('adminlte_lang::message.emailaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$SedeGener->GSedeEmail}}</p>">{{$SedeGener->GSedeEmail}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        {{--  Modal Agregar un Residuo a una SedeGener--}}
        @if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
            <form role="form" action="/respelSGener" method="POST" enctype="multipart/form-data" data-toggle="validator">
                @csrf
                <div class="modal modal-default fade in" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <div style="font-size: 5em; color: green; text-align: center; margin: auto;">
                                    <i class="fas fa-plus-circle"></i>
                                    <span style="font-size: 0.3em; color: black;"><p>{{ trans('adminlte_lang::message.assignrrespelssedegener') }}</p></span>
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
                            <div class=" modal-body col-md-12 form-group">
                                <label for="FK_Respel">{{ trans('adminlte_lang::message.MenuRespel') }} </label><small class="help-block with-errors">*</small>
                                <select class="form-control select-multiple" id="FK_Respel" name="FK_Respel[]" multiple required>
                                    @foreach ($Residuos as $Residuo)
                                        {{-- <option value="{{$Respel->ID_Respel}}" {{ 1 == $Respel->ID_Respel ? 'selected' : '' }}>{{$Respel->RespelName}}</option> --}}
                                        <option value="{{$Residuo->ID_Respel}}">{{$Residuo->RespelName}}</option>
                                    @endforeach     
                                </select>
                                <input type="text" hidden name="FK_SGener" value="{{$SedeGener->GSedeSlug}}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success pull-left" data-dismiss="modal">{{ trans('adminlte_lang::message.modalexit') }}</button>
                                <button type="submit" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.add') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
      {{-- END Modal --}}
        <div class="col-md-6">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active box-info" ><a href="#residuos" data-toggle="tab">{{ trans('adminlte_lang::message.MenuRespel') }}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="residuos">
                        @if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
                            <a href="/respels/create" class="btn btn-primary mx-auto"><b>{{ trans('adminlte_lang::message.respelscreate') }}</b></a>
                            <a method='get' href='#' data-toggle='modal' data-target='#add'  class="btn btn-primary mx-auto pull-right"><i class="fas fa-plus-circle"></i><b> {{ trans('adminlte_lang::message.assignrespels') }}</b></a>
                        @endif
                        <div style='overflow-y:auto; max-height:400px;'>
                            @foreach ($Respels as $Respel)
                                <ul class="list-group" style="list-style:none; margin-top:10px;">
                                    <li class="col-md-11 col-xs-12 col-12">
                                        @if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
                                            <a method='get' href='#' data-toggle='modal' data-target='#delete{{$Respel->ID_SGenerRes}}' style="font-size: 1.5em; color: red; margin-bottom:-2px;" class="pull-right" ><i class="fas fa-times-circle"></i></a>
                                        @endif
                                        <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light textolargo col-md-offset-1" style="display:flex; justify-content:center;" target="_blank">{{$Respel->RespelName}}</a></h4>
                                    </li>
                                    <li class="col-md-12 col-xs-12 col-12">
                                        {{--  Modal Eliminar un Residuo de una SedeGener--}}
                                        @if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))
                                            <form action='/respelSGener/{{$Respel->SlugSGenerRes}}' method='POST' class="col-12 pull-right">
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
                                                                        <p>{{ trans('adminlte_lang::message.modaldeletegener') }} <b><i>{{$Respel->RespelName}}</i></b> {{ trans('adminlte_lang::message.modalsgener') }} <b><i> {{$SedeGener->GSedeName}}</i></b>{{ trans('adminlte_lang::message.?') }} </p>
                                                                    </span>
                                                                </div> 
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-success pull-left" data-dismiss="modal">{{ trans('adminlte_lang::message.modalexit') }}</button>
                                                                <label for="Eliminar{{$Respel->ID_SGenerRes}}" class='btn btn-danger'>{{ trans('adminlte_lang::message.modaldelete') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="submit" id="Eliminar{{$Respel->ID_SGenerRes}}" style="display: none;">
                                            </form>
                                        @endif
                                        {{-- END Modal --}}
                                    </li>
                                </ul>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
                    <h3 class="profile-username text-center textolargo">{{$Generador->GenerShortname}}</h3>
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

                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

         {{--  Modal --}}
        <form role="form" action="/generadores" method="POST" enctype="multipart/form-data" data-toggle="validator">
            <div class="modal modal-default fade in" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <div style="font-size: 5em; text-align: center; margin: auto;">
                    {{-- <i class="fas fa-exclamation-triangle"></i> --}}
                    <span style="font-size: 0.3em; color: black;"><p>Añadir un Residuo a un generador</p></span>
                  </div> 
                </div>
                <div class="modal-body">
                <div class="col-md-12 form-group">
                        <label for="departamento">Sedes de los Generadores</label><small class="help-block with-errors">*</small>
                        <select class="form-control select" id="departamento" name="departamento" required>
                            <option value="">{{ trans('adminlte_lang::message.select') }}</option>
                            @foreach ($GenerSedes as $GenerSede)	
                                <option value="{{$GenerSede->GSedeName}}" {{ old('departamento') == $GenerSede->GSedeName ? 'selected' : '' }}>{{$GenerSede->GSedeName}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label for="municipio">{{ trans('adminlte_lang::message.MenuRespel') }} </label>
                        <select class="form-control select" id="municipio" name="FK_GSedeMun">
                            @if (isset($Municipios))
                                @foreach ($Municipios as $Municipio)
                                    <option value="{{$Municipio->ID_Mun}}" {{ old('FK_GSedeMun') == $Municipio->ID_Mun ? 'selected' : '' }}>{{$Municipio->MunName}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary pull-right" data-dismiss="modal">{{ trans('adminlte_lang::message.add') }}</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      {{-- END Modal --}}

        <!-- /.col -->
        <div class="col-md-6">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active box-info" ><a href="#residuos" data-toggle="tab">{{ trans('adminlte_lang::message.MenuRespel') }}</a></li>
                    <li><a href="#sedes" data-toggle="tab">{{ trans('adminlte_lang::message.sclientsedes') }}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="residuos">
                        <a href="/respels/create" class="btn btn-primary mx-auto">Crear Residuo</a>
                        <a method='get' href='#' data-toggle='modal' data-target='#add'  class="btn btn-primary mx-auto"><b>Añadir Residuo al generador</b></a>

                        {{-- <a href="#add" class="btn btn-primary mx-auto">Añadir Residuo al generador</a> --}}
                        <div style='overflow-y:auto; max-height:358px;'>
                            @foreach ($Respels as $Respel)
                                <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light" style="display:flex; justify-content:center; align-items:center;">{{$Respel->RespelName}}</a></h4>
                                <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light" style="display:flex; justify-content:center; align-items:center;">{{$Respel->RespelName}}</a></h4>
                                <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light" style="display:flex; justify-content:center; align-items:center;">{{$Respel->RespelName}}</a></h4>
                                <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light" style="display:flex; justify-content:center; align-items:center;">{{$Respel->RespelName}}</a></h4>
                                <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light" style="display:flex; justify-content:center; align-items:center;">{{$Respel->RespelName}}</a></h4>
                                <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light" style="display:flex; justify-content:center; align-items:center;">{{$Respel->RespelName}}</a></h4>
                                <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light" style="display:flex; justify-content:center; align-items:center;">{{$Respel->RespelName}}</a></h4>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane" id="sedes">
                        <div style='overflow-y:auto; max-height:358px;'>
                                <a href="/sgeneradores/create" class="btn btn-primary btn-lg btn-block">Crear Sede del generador</a>
                            @foreach ($GenerSedes as $GenerSede)
                                <h4><a href="/sgeneradores/{{$GenerSede->GSedeSlug}}" class="list-group-item list-group-item-action list-group-item-light" style="display:flex; justify-content:center; align-items:center;">{{$GenerSede->GSedeName}}</a></h4>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

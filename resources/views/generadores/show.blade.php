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
        <!-- /.col -->
        <div class="col-md-6">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" id="navbar-example2">
                    <li class="active box-info" ><a href="#activity" data-toggle="tab">Residuos</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <!-- Post -->
                        <div class="post">
                            <div class="user-block">
                                {{-- <ul class="list-group list-group-flush"> --}}
                                <div class="list-group">
                                        <div class="scrollbar scrollbar-primary">
                                                <div class="force-overflow"></div>
                                              </div>
                                    @foreach ($Respels as $Respel)
                                    {{-- <li class="list-group-item"> --}}
                                        <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light" style="display:flex; justify-content:center;">{{$Respel->RespelName}}</a></h4>
                                        <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light" style="display:flex; justify-content:center;">{{$Respel->RespelName}}</a></h4>
                                        <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light" style="display:flex; justify-content:center;">{{$Respel->RespelName}}</a></h4>
                                        <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light" style="display:flex; justify-content:center;">{{$Respel->RespelName}}</a></h4>
                                        <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light" style="display:flex; justify-content:center;">{{$Respel->RespelName}}</a></h4>
                                        <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light" style="display:flex; justify-content:center;">{{$Respel->RespelName}}</a></h4>
                                        <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light" style="display:flex; justify-content:center;">{{$Respel->RespelName}}</a></h4>
                                        <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light" style="display:flex; justify-content:center;">{{$Respel->RespelName}}</a></h4>
                                        <h4><a href="/respels/{{$Respel->RespelSlug}}" class="list-group-item list-group-item-action list-group-item-light" style="display:flex; justify-content:center;">{{$Respel->RespelName}}</a></h4>
                                    @endforeach
                                {{-- </ul> --}}


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    
    <!-- /.row -->
    @endsection

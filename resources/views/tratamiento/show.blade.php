@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::LangTratamiento.tratdetaillong') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #FF856D, #CC0000); padding-right:30vw; position:relative; overflow:hidden;">
    {{ trans('adminlte_lang::LangTratamiento.tratMenu') }}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
{{-- @component('layouts.partials.modal')
{{$tratamiento->ID_Respel}}
@endcomponent --}}
<div class="container-fluid spark-screen">
    <!-- row -->
    <div class="row">
        <!-- col md3 -->
        @component('layouts.partials.modal')
            @slot('slug')
                {{$tratamiento->ID_Trat}}
            @endslot
            @slot('textModal')
                el tratamiento <b>{{$tratamiento->TratName}}</b>
            @endslot
        @endcomponent
        <div class="col-md-3">
            <!-- box -->
            <div class="box box-primary">
                <!-- box body -->
                <div class="box-body box-profile">
                    {{-- <img id="" class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> --}}
                    <h3 class="profile-username text-center">{{$tratamiento->TratName}}</h3>
                    <p class="text-muted text-center">@if($tratamiento->TratTipo=='1')
                        <td>{{ trans('adminlte_lang::LangTratamiento.tratInLong') }}</td>
                        @else
                        <td>{{ trans('adminlte_lang::LangTratamiento.tratOutLong') }}</td>
                        @endif
                    </p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>{{ trans('adminlte_lang::LangTratamiento.tratSince') }}</b>
                            <p class="pull-right" style="color:blue;">{{$tratamiento->created_at->diffForHumans()}}</p>
                        </li>
                    </ul>
                    <a href='/tratamiento/{{$tratamiento->ID_Trat}}/edit' class='btn btn-warning btn-block'><i class='fas fa-edit'></i> {{ trans('adminlte_lang::message.edit') }} </a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box body -->
        </div>
        <!-- /.col md3 -->
        <!-- col md9 -->
        <div class="col-md-9">
            <!-- box -->
            <div class="box">
                <!-- box header -->
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('adminlte_lang::LangTratamiento.tratdetaillong') }}</h3>
                    @if($tratamiento->TratDelete == 0)
                      @if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones) || in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
                      <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$tratamiento->ID_Trat}}' class='btn btn-danger pull-right'><i class="fas fa-trash-alt"></i><b> {{ trans('adminlte_lang::message.delete') }}</b></a>
                      <form action='/tratamiento/{{$tratamiento->ID_Trat}}' method='POST'>
                        @method('DELETE')
                        @csrf
                        <input type="submit" id="Eliminar{{$tratamiento->ID_Trat}}" style="display: none;">
                      </form>
                      @endif
                    @else
                      @if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || in_array(Auth::user()->UsRol2, Permisos::PROGRAMADOR))
                        <form action='/tratamiento/{{$tratamiento->ID_Trat}}' method='POST'>
                          @method('DELETE')
                          @csrf
                          <button type="submit" class='btn btn-success pull-right'>
                            <i class="fas fa-plus-square"></i><b> {{ trans('adminlte_lang::message.add') }}</b>
                          </button>
                        </form>
                      @endif
                    @endif
                </div>
                <!-- /.box header -->
                <!-- box body -->
                <div class="box-body">
                    <!-- nav-tabs-custom -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="#Proveedorpane" data-toggle="tab">{{ trans('adminlte_lang::message.clientGestor') }}</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="#Pretratamientospane" data-toggle="tab">{{ trans('adminlte_lang::LangTratamiento.pretrat') }}s</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#Clasificacionespane" data-toggle="tab">{{ trans('adminlte_lang::LangTratamiento.tratClasf') }}</a>
                            </li>
                        </ul>
                        <!-- nav-content -->
                        <div class="tab-content" style="min-height:40vh;">
                            <!-- tab-pane fade -->
                            <div class="tab-pane fade " id="Proveedorpane">
                                <!-- About Me Box -->
                                <div class="box box-info">
                                    <div class="box-body box-profile">
                                        <h3 class="profile-username text-center">{{$Sede->SedeName}}</h3>
                                        @if (Auth::user()->UsRol === trans('adminlte_lang::message.Administrador'))
                                        <p class="text-muted text-center">{{$Cliente->CliShortname}}</p>
                                        @endif
                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <b>{{ trans('adminlte_lang::message.address') }}</b>
                                                <a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.address') }}')"><i class="far fa-copy"></i></a>
                                                <a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.address') }}" title="{{ trans('adminlte_lang::message.address') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Sede->SedeAddress}} - {{$Sede->MunName}}, {{$Sede->DepartName}}</p>">{{$Sede->SedeAddress}} - {{$Sede->MunName}}, {{$Sede->DepartName}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>{{ trans('adminlte_lang::message.mobile') }}</b> <a class="pull-right">{{$Sede->SedeCelular}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>{{ trans('adminlte_lang::message.phone') }}</b> <a class="pull-right">{{$Sede->SedePhone1}} - {{$Sede->SedeExt1}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>{{ trans('adminlte_lang::message.phone') }} 2</b> <a class="pull-right">{{$Sede->SedePhone2}} - {{$Sede->SedeExt2}}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>{{ trans('adminlte_lang::message.emailaddress') }}</b>
                                                <a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.emailaddress') }}')"><i class="far fa-copy"></i></a>
                                                <a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.emailaddress') }}" title="{{ trans('adminlte_lang::message.emailaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Sede->SedeEmail}}</p>">{{$Sede->SedeEmail}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- tab-pane fade -->
                            <!-- tab-pane fade -->
                            <div class="tab-pane fade in active" id="Pretratamientospane">
                                <div class="form-horizontal">
                                    <ul class="list-group list-group-unbordered">
                                        @php
                                            $conteoDePretratamientos=0;
                                        @endphp 
                                                
                                        @foreach($tratamiento->pretratamientos as $pretratamiento)
                                            @if($pretratamiento->PreTratDelete == 0)
                                                <li class="list-group-item">
                                                    <b>{{$pretratamiento->PreTratName}}</b> <a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.address') }}" title="Descripción del Pretratamiento" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="{{$pretratamiento->PreTratDescription}}">{{$pretratamiento->PreTratDescription}}</a>
                                                </li>
                                                @php
                                                $conteoDePretratamientos = $conteoDePretratamientos + 1;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if($conteoDePretratamientos==0)
                                            <li class="list-group-item">
                                                <p class="text-center"><br><b>{{ trans('adminlte_lang::LangTratamiento.noPretrat') }}</b></p>
                                            </li>
                                        @endif 
                                    </ul>
                                </div>
                            </div>
                            <!-- /.tab-pane fade -->
                            <!-- tab-pane fade -->
                            <div class="tab-pane fade" id="Clasificacionespane">
                                <div class="form-horizontal">
                                    <ul class="list-group list-group-unbordered">
                                        @php
                                            $conteoDeClasificaciones=0;
                                        @endphp 
                                                
                                        @foreach($tratamiento->clasificaciones as $clasificacion)
                                                <li class="list-group-item">
                                                    <b>{{$clasificacion->ClasfCode}}</b> <a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.address') }}" title="Descripción del Pretratamiento" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="{{$clasificacion->ClasfDescription}}">{{$clasificacion->ClasfDescription}}</a>
                                                </li>
                                                @php
                                                $conteoDeClasificaciones = $conteoDePretratamientos + 1;
                                                @endphp
                                        @endforeach
                                        @if($conteoDeClasificaciones==0)
                                            <li class="list-group-item">
                                                <p class="text-center"><br><b>{{ trans('adminlte_lang::LangTratamiento.noClasfif') }}</b></p>
                                            </li>
                                        @endif 
                                    </ul>
                                </div>
                            </div>
                            <!-- /.tab-pane fade -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    {{-- <div class="row">
                        <input class="btn btn-success  pull-right" type="submit" value="Actualizar" style="margin-right:3em" />
                    </div> --}}
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.box body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col md9 -->
    </div>
    <!-- /.row -->
</div>
@endsection

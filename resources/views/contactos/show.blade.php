@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientcontacto') }}
@endsection
@section('contentheader_title')
	{{ trans('adminlte_lang::message.clientcontacto') }}
@endsection	
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <div class="col-md-12 col-xs-12">
                            <a href="/sgeneradores/{{$Cliente->CliSlug}}/edit" class="btn btn-warning pull-right"><b>{{ trans('adminlte_lang::message.edit') }}</b></a>
                            @component('layouts.partials.modal')
                                {{$Cliente->ID_Cli}}
                            @endcomponent
                        @if($Cliente->CliDelete == 0)
                            <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Cliente->ID_Cli}}' class='btn btn-danger pull-left'><b>{{ trans('adminlte_lang::message.delete') }}</b></a>
                            <form action='/sgeneradores/{{$Cliente->CliSlug}}' method='POST'  class="col-12 pull-right">
                                @method('DELETE')
                                @csrf
                                <input type="submit" id="Eliminar{{$Cliente->ID_Cli}}" style="display: none;">
                            </form>
                        @else
                            <form action='/sgeneradores/{{$Cliente->CliSlug}}' method='POST' class="pull-right">
                                @method('DELETE')
                                @csrf
                                <input type="submit" class='btn btn-success btn-block' value="{{ trans('adminlte_lang::message.add') }}">
                            </form>
                        @endif
                    </div>
                    <ul class="list-group list-group-unbordered">
                        <div class="box-body box-profile">
                            <h3 class="profile-username text-center">{{$Cliente->CliShortname}}</h3>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>{{ trans('adminlte_lang::message.clientcategoría') }}</b> <a class="pull-right">{{$Cliente->CliCategoria}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ trans('adminlte_lang::message.clirazonsoc') }}</b> <a class="pull-right">{{$Cliente->CliName}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b> <a class="pull-right">{{$Cliente->CliShortname}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ trans('adminlte_lang::message.clientNIT') }}</b> <a class="pull-right">{{$Cliente->CliNit}}</a>
                                </li>
                            </ul>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active box-info" ><a href="#residuos" data-toggle="tab">{{ trans('adminlte_lang::message.MenuRespel') }}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane text-center" id="residuos">
                            <a href="/sclientes/create" class="btn btn-primary mx-auto"><b>{{ trans('adminlte_lang::message.respelscreate') }}</b></a>
                        <div style='overflow-y:auto; max-height:400px;'>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

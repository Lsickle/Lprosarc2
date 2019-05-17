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
                        <a href="/contactos/{{$Cliente->CliSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{ trans('adminlte_lang::message.edit') }}</b></a>
                        @component('layouts.partials.modal')
                            {{$Cliente->ID_Cli}}
                        @endcomponent
                        @if($Cliente->CliDelete == 0)
                            <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Cliente->ID_Cli}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i><b> {{ trans('adminlte_lang::message.delete') }}</b></a>
                            <form action='/contactos/{{$Cliente->CliSlug}}' method='POST'  class="col-12 pull-right">
                                @method('DELETE')
                                @csrf
                                <input type="submit" id="Eliminar{{$Cliente->ID_Cli}}" style="display: none;">
                            </form>
                        @else
                            <form action='/contactos/{{$Cliente->CliSlug}}' method='POST' class="pull-right">
                                @method('DELETE')
                                @csrf
                                <input type="submit" class='btn btn-success btn-block' value="{{ trans('adminlte_lang::message.add') }}">
                            </form>
                        @endif
                    </div>
                    {{-- <ul class="list-group list-group-unbordered"> --}}
                        <h3 class="profile-username text-center">{{$Cliente->CliShortname}}</h3>
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
                    {{-- </ul> --}}
                </div>
               
                <div class="box-body box-profile">
                        <h3 class="profile-username text-center">{{ trans('adminlte_lang::message.sclientsede') }}</h3>
                    {{-- <ul class="list-group list-group-unbordered"> --}}
                        <li class="list-group-item">
                            <b>{{ trans('adminlte_lang::message.sclientnamesede') }}</b> <a class="pull-right">{{$Sede->SedeName}}</a>
                        </li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.phone') }}</b> <a class="pull-right">{{$Sede->SedePhone1}} - {{$Sede->SedeExt1}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.phone') }} 2</b> <a class="pull-right">{{$Sede->SedePhone2}} - {{$Sede->SedeExt2}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.email') }}</b> <a class="pull-right">{{$Sede->SedeEmail}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.mobile') }}</b> <a class="pull-right">{{$Sede->SedeCelular}}</a>
						</li>
					{{-- </ul> --}}
				</div>
            </div>
        </div>
         {{-- modal de Crear un Vehiculo --}}
         <form role="form" action="/contactos" method="POST" enctype="multipart/form-data" data-toggle="validator">
            @csrf
            
            <div class="modal modal-default fade in" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <div class="modal-body">
                            <div class="form-group col-md-12">
                                <label for="VehicPlaca">{{ trans('adminlte_lang::message.vehicplaca') }}</label><small class="help-block with-errors">*</small>
                                <input type="text" name="VehicPlaca" class="form-control placa" id="VehicPlaca" data-minlength="9" maxlength="9" data-error="{{ trans('adminlte_lang::message.data-error-minlength6') }}" placeholder="{{ trans('adminlte_lang::message.placaplaceholder') }}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="VehicTipo"> {{ trans('adminlte_lang::message.vehictipo') }}</label><small class="help-block with-errors">*</small>
                                <input type="text" name="VehicTipo" class="form-control" id="VehicTipo" maxlength="64">
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="VehicCapacidad">{{ trans('adminlte_lang::message.vehiccapacidad') }}</label><small class="help-block with-errors">*</small>
                                <input type="text" name="VehicCapacidad" class="form-control" id="VehicCapacidad" maxlength="64">
                            </div>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-success pull-left" data-dismiss="modal">{{ trans('adminlte_lang::message.modalexit') }}</button>
                            <button type="submit" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.add') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        {{-- final del modal --}}
        <div class="col-md-6">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active box-info" ><a href="#vehiculo" data-toggle="tab">{{ trans('adminlte_lang::message.vehiculos') }}</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="vehiculo">
                        <div class="text-center">
                            <a href="/contactos/create" class="btn btn-success mx-auto text-center"><i class="fas fa-plus-circle"></i><b> {{ trans('adminlte_lang::message.addvehiculo') }}</b></a>
                        </div>
                        <div style='overflow-y:auto; max-height:422px;'>
                            @foreach ($Vehiculos as $Vehiculo)
                                <div class="box-body box-profile">
                                    <a method='get' href='#' data-toggle='modal' data-target='#edit'  id="editvehiculo" class="btn btn-warning pull-right"><b><i class="fas fa-edit"></i></b></a>
                                    <a method='get' href='#' data-toggle='modal' data-target='#delete'  id="deletevehiculo" class="btn btn-danger pull-left"><i class="fas fa-trash-alt"></i></a>
                                    {{-- <a href="/contactos/{{$Vehiculo->ID_Vehic}}"  class="btn btn-danger pull-left" ><i class="fas fa-trash-alt"></i></a> --}}
                                    <input type="hidden" value="{{$Vehiculo->ID_Vehic}}" id="vehiculoid">
                                    <h3 class="profile-username text-center">{{$Vehiculo->VehicPlaca}}</h3>
                                {{-- <ul class="list-group list-group-unbordered"> --}}
                                    <li class="list-group-item">
                                        <b>{{ trans('adminlte_lang::message.vehicplaca') }}</b> <a class="pull-right">{{$Vehiculo->VehicPlaca}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>{{ trans('adminlte_lang::message.vehiccapacidad') }}</b> <a class="pull-right">{{$Vehiculo->VehicTipo}}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>{{ trans('adminlte_lang::message.vehictipo') }}</b> <a class="pull-right">{{$Vehiculo->VehicCapacidad}}</a>
                                    </li>
                                {{-- </ul> --}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

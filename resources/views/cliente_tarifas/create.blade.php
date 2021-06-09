@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::LangTratamiento.tratMenu') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #FF856D, #CC0000); padding-right:30vw; position:relative; overflow:hidden;">
    {{ trans('adminlte_lang::LangTratamiento.tratnew') }}
  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-16 col-md-offset-0">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('adminlte_lang::LangTratamiento.tratMenu') }}</h3>
                    <div class="box-tools pull-right">
                     <button onclick="AgregarPreTrat()" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i> {{ trans('adminlte_lang::LangTratamiento.pretratadd') }}</button>
                    </div>
                </div>
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <!-- /.box-header -->
                            <!-- form start -->

                            <form role="form" action="/tratamiento" method="POST" enctype="multipart/form-data" id="createtratamientoForm">
                                @csrf
                                <div class="box-body" id="boxbodypretrat">

                                    <div class="col-md-6">
                                        <label for="select2sedes">{{ trans('adminlte_lang::LangTratamiento.manager') }}</label>
                                        <select class="form-control select" id="select2sedes" name="FK_TratProv" required="true">
                                            @foreach($sedes as $sede)
                                            <option value="{{$sede->ID_Sede}}">{{$sede->CliShortname}} - {{$sede->SedeName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="input1">{{ trans('adminlte_lang::LangTratamiento.tratname') }}</label>
                                        <input maxlength="60" id="input1" class="form-control" type="text" name="TratName">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="select2sedes">{{ trans('adminlte_lang::LangTratamiento.tratClasf') }}</label>
                                        <select class="form-control select" id="select2clasf" name="FK_Clasf[]" multiple="multiple">
                                            @foreach($clasificaciones as $clasificacion)
                                            <option value="{{$clasificacion->ID_Clasf}}">{{$clasificacion->ClasfCode}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="select2pretrat">{{ trans('adminlte_lang::LangTratamiento.Pretrat') }}</label>
                                        <select class="form-control select" id="select2pretrat" name="FK_Pretrat[]" multiple="multiple">
                                            @foreach($pretratamientos as $pretratamiento)
                                            <option value="{{$pretratamiento->ID_PreTrat}}">{{$pretratamiento->PreTratName}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                      <div class="panel panel-default" style="margin-top: 2%;">
                                        <div class="panel-heading">
                                          <h3 class="panel-title">Pretratamientos Nuevos</h3>
                                        </div>
                                        <div class="panel-body" id="pretratamientosPanel" >
                                          {{-- /*lista de pretratamientos*/ --}}
                                          
                                        </div>
                                      </div>
                                      <!-- /.box -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success" style="margin-left: 1.5rem;"><i class="fas fa-check"></i> {{ trans('adminlte_lang::LangTratamiento.tratcreate') }}</button>

                                    <a class="btn btn-default btn-close pull-right" style="margin-right: 1.7rem;" href="{{ route('tratamiento.index') }}"><i class="fas fa-backspace" color="red"></i> {{ trans('adminlte_lang::LangTratamiento.cancel') }}</a>
                                </div>
                            </form>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>

<script>
    var contador = 1;
    function attachPopover(){
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover({
                html: true,
                trigger: 'hover',
                placement: 'auto',
            });
        });
    };
    function AgregarPreTrat(){
        var pretratamiento = `@include('layouts.respel-comercial.respel-pretrat')`;
        $("#pretratamientosPanel").append(pretratamiento);
        $("#createtratamientoForm").validator('update');
        contador= parseInt(contador)+1;
        attachPopover();
    }
    function EliminarPreTrat(id){
        $("#pretratname"+id).remove();
        $("#pretratdescription"+id).remove();
        $("#pretratsparator"+id).remove();
        $("#createtratamientoForm").validator('update');
    }
</script>
@endsection

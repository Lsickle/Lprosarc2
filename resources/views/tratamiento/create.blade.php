@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::LangTratamiento.tratMenu') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::LangTratamiento.tratnew') }}
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
                                        <select class="form-control" id="select2sedes" name="FK_TratProv" required="true">
                                            @foreach($sedes as $sede)
                                            <option value="{{$sede->ID_Sede}}">{{$sede->SedeName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="input1">{{ trans('adminlte_lang::LangTratamiento.tratname') }}</label>
                                        <input id="input1" class="form-control" type="text" name="TratName">
                                    </div>

                                    <div class="col-md-12">
                                      <div class="panel panel-default" style="margin-top: 2%;">
                                        <div class="panel-heading">
                                          <h3 class="panel-title">Pretratamientos</h3>
                                        </div>
                                        <div class="panel-body" id="pretratamientosPanel">
                                          {{-- /*lista de pretratamientos*/ --}}
                                          
                                        </div>
                                      </div>
                                      <!-- /.box -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> {{ trans('adminlte_lang::LangTratamiento.tratcreate') }}</button>

                                    <button type="" class="btn btn-danger pull-right"><i class="fas fa-backspace"></i> {{ trans('adminlte_lang::LangTratamiento.cancel') }}</button>
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
        contador= parseInt(contador)-1;
    }
</script>
@endsection

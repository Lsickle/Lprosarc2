@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::LangTratamiento.pretratMenu') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::LangTratamiento.pretratnew') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-16 col-md-offset-0">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ trans('adminlte_lang::LangTratamiento.pretratMenu') }}</h3>
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

                            <form role="form" action="/pretratamiento" method="POST" enctype="multipart/form-data" id="createpretratamientoForm">
                                @csrf
                                <div class="box-body" id="pretratamientosPanel">
                                    <div class="col-md-6" id="pretratname0">
                                        {{-- input oculto para llevar el control y conteo de los ids --}}
                                        <input id="ID_Propo0" class="form-control" type="hidden" name="ID_PreTrat[]">
                                        <label for="input[]">{{ trans('adminlte_lang::LangTratamiento.pretratname') }} </label>
                                        <div class="input-group">
                                            <input maxlength="60" id="input[]" class="form-control" type="text" name="PreTratName[]" required>
                                            <a onclick="EliminarPreTrat(0)" class="input-group-addon" style=" color: red;" data-toggle="popover" title="{{ trans('adminlte_lang::LangTratamiento.pretratname') }}" data-content="{{ trans('adminlte_lang::LangTratamiento.popoverdescript1') }}"><i class="fas fa-backspace"></i></a>
                                        </div><br>      
                                    </div>

                                    <div class="col-md-6" id="pretratdescription0">
                                        <label for="inputdescript[]">{{ trans('adminlte_lang::LangTratamiento.pretratdescript') }} </label>
                                        <div class="input-group">
                                            <input maxlength="250" id="inputdescript[]" class="form-control" type="text" name="PreTratDescription[]">
                                            <a class="input-group-addon" data-toggle="popover" title="{{ trans('adminlte_lang::LangTratamiento.popovertittle2') }}" data-content="<p style='width: 50%'>{{ trans('adminlte_lang::LangTratamiento.popoverdescript2') }}</p>"><i class="fas fa-info-circle"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-success" style="margin-left: 1.5rem;"><i class="fas fa-check"></i> {{ trans('adminlte_lang::LangTratamiento.pretratcreate') }}</button>

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

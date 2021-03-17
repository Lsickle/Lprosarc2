@extends('layouts.app')
@section('htmlheader_title')
Crear Código
@endsection
@section('contentheader_title')
<span
    style="background-image: linear-gradient(40deg, #F1B378, #D66841); padding-right:30vw; position:relative; overflow:hidden;">
    Crear Códigos
    <div
        style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;">
    </div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-16 col-md-offset-0">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Nuevos Códigos</h3>
                    <div class="box-tools pull-right">
                        <button onclick="AgregarRM()" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i> añadir RM</button>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="row">
                        <div class="col-md-12">
                            <form role="form" action="{{route('groupcodes.store')}}" method="POST" enctype="multipart/form-data" id="addvcgroupForm">
                                @csrf
                                @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class="box-body" id="boxbodypretrat">

                                    <div class="col-md-12">
                                        <label for="GC_Empresa">Empresa (Razon Social)</label>
                                        <input class="form-control" id="GC_Empresa" name="GC_Empresa" type="text" maxlength="250" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="VC_cantidad">Cantidad</label>
                                        <input class="form-control" id="VC_cantidad" name="VC_cantidad" type="number" min="0" max="9999" required>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="FK_VCSolSer">Solicitud de Servicio (Número)</label>
                                        <input class="form-control" id="FK_VCSolSer" name="FK_VCSolSer" type="number" min="0" max="50000">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="custom">dato adicional (custom)</label>
                                        <input class="form-control" id="custom" name="custom" type="text" maxlength="250">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="VC_RM">Recibo de Materiales (RM)</label>
                                        <input class="form-control" id="VC_RM" name="VC_RM[]" type="number" min="0" max="50000">
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <input type="submit" forForm="addvcgroupForm " class="btn btn-success pull-right" value="enviar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    function AgregarRM(){
        var pretratamiento = `@include('layouts.groupcodes-layouts.rm')`;
        $("#boxbodypretrat").append(pretratamiento);
        $("#addvcgroupForm").validator('update');
        contador= parseInt(contador)+1;
        attachPopover();
    }
    function EliminarRM(id){
        $("#vcrm"+id).remove();
        $("#addvcgroupForm").validator('update');
    }
</script>
@endsection
@extends('layouts.app')
@section('htmlheader_title')
Editar Código
@endsection
@section('contentheader_title')
<span
    style="background-image: linear-gradient(40deg, #F1B378, #D66841); padding-right:30vw; position:relative; overflow:hidden;">
    Editar Código
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
                    <h3 class="box-title">Editar Códigos</h3>
                    <div class="box-tools pull-right">
                        <button onclick="AgregarRM()" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i>
                            añadir RM</button>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="row">
                        <div class="col-md-12">
                            <form role="form" action="{{route('verifycodes.update', ['id' => $verificationCode->ID_VCode])}}" method="POST"
                                enctype="multipart/form-data" id="addvcgroupForm">
                                @method('PUT')
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
                                        <label for="VC_Empresa">Empresa (Razon Social)</label>
                                        <input class="form-control" id="VC_Empresa" name="VC_Empresa" type="text"
                                    maxlength="250" required value="{{$verificationCode->VC_Empresa}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="FK_VCSolSer">Solicitud de Servicio (Número)</label>
                                        <input class="form-control" id="FK_VCSolSer" name="FK_VCSolSer" type="number"
                                            min="0" max="50000" value="{{$verificationCode->FK_VCSolSer}}">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="custom">dato adicional (custom)</label>
                                        <input class="form-control" id="custom" name="custom" type="text"
                                            maxlength="250" value="{{$verificationCode->custom}}">
                                    </div>
                                    @foreach ($verificationCode->VC_RM as $rm)
                                    <div class="col-md-3" id="vcrm{{$loop->index}}">
                                        <label for="VC_RM[]">Recibo de Materiales (RM)</label>
                                        <div class="input-group">
                                            <input id="VC_RM[]" class="form-control" type="number" min="0" max="50000" name="VC_RM[]" value="{{$rm}}">
                                            <a onclick="EliminarRM({{$loop->index}})" class="input-group-addon" style=" color: red;"><i
                                                    class="fas fa-trash-alt"></i></a>
                                        </div><br>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="box-footer">
                                    <input type="submit" forForm="addvcgroupForm " class="btn btn-success pull-right"
                                        value="enviar">
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
    @foreach ($verificationCode->VC_RM as $item)
        @if ($loop->last)
            var contador = {{$loop->count + 1}};
        @endif
    @endforeach
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
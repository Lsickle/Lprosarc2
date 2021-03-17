@extends('layouts.app')
@section('htmlheader_title')
Códigos de Verificación
@endsection
@section('contentheader_title')
<span
    style="background-image: linear-gradient(40deg, #F1B378, #D66841); padding-right:30vw; position:relative; overflow:hidden;">
    Códigos de Verificación
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
                    <a href="{{route('groupcodes.create')}}" class="btn btn-primary pull-right"><i
                            class="fas fa-plus"></i> Añadir Codigos</a>
                </div>
                <div class="box-body">
                    <div id="ModalStatus"></div>
                    <table class="table table-compact table-bordered table-striped">
                        <thead>
                            <th>id</th>
                            <th>empresa</th>
                            <th>Código</th>
                            <th>Servicio</th>
                            <th>Rm´s</th>
                            <th>custom</th>
                            <th>actualizado:</th>
                            <th>Grupo</th>
                            <th>editar</th>
                        </thead>
                        <tbody>
                            @foreach($codes as $code)
                            <tr>
                                <td>{{$code->ID_VCode}}</td>
                                <td>{{$code->VC_Empresa}}</td>
                                <td>{{$code->VCode}}</td>
                                <td>{{$code->FK_VCSolSer}}</td>
                                <td>
                                    <ul>
                                        @foreach ($code->VC_RM as $rm)
                                        <li>{{$rm}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>{{$code->custom}}</td>
                                <td>{{$code->updated_at}}</td>
                                <td>
                                    <a class="btn btn-info" href="{{route('groupcodes.show', ['id' => $code->FK_VCGroup])}}" target="_blank">{{$code->grupo->ID_GCode}}</a>
                                </td>
                                <td>
                                    <a class="btn btn-warning" href="{{route('verifycodes.edit', ['id' => $code->ID_VCode])}}" target="_blank">Editar {{$code->ID_VCode}}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('NewScript')
<script>

</script>
@endsection
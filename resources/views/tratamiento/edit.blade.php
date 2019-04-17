@extends('layouts.app')
@section('htmlheader_title')
Edición de Tratamiento
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="/tratamiento/{{$tratamiento->ID_Trat}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        {{-- numero de cotizacion --}}
                        <div class="col-md-6">
                            <label for="select1">Tipo</label>
                            <select class="form-control" id="select1" name="TratTipo">
                                <option value="0">Interno</option>
                                <option value="1">Externo</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="select2">Sede del Cliente</label>
                            <select class="form-control" id="select2" name="FK_TratProv" required="true">
                                @foreach($sedes as $sede)
                                    <option value="{{$sede->ID_Sede}}">{{$sede->SedeName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="input1">Nombre</label>
                            <input id="input1" class="form-control" type="text" name="TratName" value="{{$tratamiento->TratName}}">
                        </div>
                        <div class="col-md-6">
                            <label for="input2">Pretratamiento</label>
                            <input id="input2" class="form-control" type="text" name="TratPretratamiento" value="{{$tratamiento->TratPretratamiento}}">
                        </div>
                        <div class="col-md-6">
                            <label for="select3">Residuo que aplica</label>
                            <select class="form-control" id="select3" name="FK_TratRespel">
                                @foreach($residuos as $residuo)
                                <option value="{{$residuo->ID_Respel}}">{{$residuo->SedeName}} - {{$residuo->RespelName}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')
@section('htmlheader_title')
    Nueva Cotizacion
@endsection
@section('contentheader_title')
    Nueva Cotizacion
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-16 col-md-offset-0">
            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" action="/cotizacion" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="box-body">

                                    <div class="col-md-6">
                                        <label for="selectsede">Sede del Cliente</label>
                                        <select class="form-control" id="selectsede" name="FK_CotiSede" required="true">
                                            @foreach($sedes as $sede)
                                                <option value="{{$sede->ID_Sede}}">{{$sede->SedeName}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="CotizacionStatus">Status de cotizacion</label>
                                        <select class="form-control" id="CotizacionStatus" name="CotiStatus" disabled >
                                            <option>Pendiente</option>
                                            <option>Aprobada</option>
                                            <option>Aprobada Parcial</option>
                                            <option>Rechazada</option>
                                        </select>
                                    </div>
                                 
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Registrar</button>
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
@endsection

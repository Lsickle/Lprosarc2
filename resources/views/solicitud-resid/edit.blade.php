@extends('layouts.app')
@section('htmlheader_title')
Solicitude de Residuo
@endsection
@section('contentheader_title')
Editar Solicitud de Residuo
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
                            @component('layouts.partials.modal')
                                {{$SolRes->ID_SolRes}}
                            @endcomponent
                            <div class="box-header with-border">
                                <h3 class="box-title">Editar registro</h3>
                                @if($SolRes->SolResDelete == 0)
                                    <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$SolRes->ID_SolRes}}'  class='btn btn-danger' style="float: right;">Eliminar</a>
                                    <form action='/solicitud-residuo/{{$SolRes->ID_SolRes}}' method='POST'>
                                        @method('DELETE')
                                        @csrf
                                        <input type="submit" id="Eliminar{{$SolRes->ID_SolRes}}" style="display: none;">
                                    </form>
                                @else
                                    <form action='/solicitud-residuo/{{$SolRes->ID_SolRes}}' method='POST' style="float: right;">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" class='btn btn-success btn-block' value="Añadir">
                                    </form>
                                @endif
                            </div>
                                <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" action="/solicitud-residuo/{{$SolRes->ID_SolRes}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="box-body">
                                    <div class="col-md-6"> 
                                        <input hidden value="{{$SolRes->SolResRespel}}" name="SolResRespel">
                                        <label for="SolicitudResiduo">Respel</label>										
                                        <select id="SolicitudResiduo" multiple="multiple" name="SolResRespel" class="form-control"  style="width: 100%">
                                            @foreach ($Respels as $Respel)
                                            <option value="{{$Respel->ID_Respel}}">{{$Respel->RespelName}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6"> 
                                        <label for="soliresidinputext">Solicitud de servicio</label>										
                                        <select id="soliresidinputext" name="SolResSolSer" class="form-control" required>
                                            <option value="{{$SolRes->SolResSolSer}}">Seleccione...</option>
                                            @foreach ($SolSers as $SolSer)
                                            <option value="{{$SolSer->ID_SolSer}}">({{$SolSer->CliShortname}}) y ({{$SolSer->GenerName}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="soliresidinputext1">Kg Enviado</label>
                                        <input type="number" class="form-control" id="soliresidinputext1" placeholder="46586" name="SolResKgEnviado" max="99999999" value="{{$SolRes->SolResKgEnviado}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="soliresidinputext2">Kg recibidos</label>
                                        <input type="number" class="form-control" id="soliresidinputext2" placeholder="787698" name="SolResKgRecibido" max="99999999"value="{{$SolRes->SolResKgRecibido}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="soliresidinputext3">Kg conciliados</label>
                                        <input type="number" class="form-control" id="soliresidinputext3" placeholder="789678" name="SolResKgConciliado" max="99999999" value="{{$SolRes->SolResKgConciliado}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="soliresidinputext4">Kg Tratado</label>
                                        <input type="number" class="form-control" id="soliresidinputext4" placeholder="100098" name="SolResKgTratado"  max="99999999" value="{{$SolRes->SolResKgTratado}}">
                                    </div>
                                </div>
                                <input hidden type="text" name="updated_by" value="{{Auth::user()->email}}">
                                <div class="col-md-8">
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Registrar</button>
                                    </div>
                                </div>
                            </form>
                            <!-- /.box-body -->
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
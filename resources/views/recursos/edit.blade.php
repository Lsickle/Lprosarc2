@extends('layouts.app')

@section('htmlheader_title','Recursos')

@section('contentheader_title', 'Crear un nuevo Recursos')
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
                            <div class="box-header">
                                @component('layouts.partials.modalrecurso')
                                    {{$SolRes->ID_SolRes}}
                                @endcomponent
                            <h3 class="box-title">Datos de la persona</h3>
                            @if($Recs->RecDelete == 0)
                                <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$SolRes->ID_SolRes}}'  class='btn btn-danger' style="float: right;">Eliminar</a>
                                <form action='/recurso/{{$SolRes->SolResSlug}}' method='POST'>
                                    @method('DELETE')
                                    @csrf
                                    <input  type="submit" id="Eliminar{{$SolRes->ID_SolRes}}" style="display: none;">
                                </form>
                            @else
                                <form action='/recurso/{{$SolRes->SolResSlug}}' method='POST' style="float: right;">
                                @method('DELETE')
                                @csrf
                                <input type="submit" class='btn btn-success btn-block' value="Añadir">
                                </form>
                            @endif

                            </div>
                            <form role="form" action="/recurso/{{$SolRes->SolResSlug}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="col-md-12">
                                    <label for="SolSer">Solicitud Servicio</label>
                                    <select class="form-control" id="SolSer" name="FK_RecSolRes" required>
                                        <option value="">Seleccione...</option>
                                        @foreach ($SolResiduos as $SolResiduo)
                                            <option value="{{$SolResiduo->ID_SolRes}}">{{$SolResiduo->FK_SolResSolSer}} , {{$SolResiduo->RespelName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                        <label for="nombre">Nombre del Cliente (recurso)</label>
                                        <select class="form-control" id="nombre" name="RecName" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($Clientes as $Cliente)
                                                <option value="{{$Cliente->CliShortname}}">{{$Cliente->CliShortname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input hidden value="0" name="number">
                                <div class="col-md-8">
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Registrar</button>
                                    </div>
                                </div>
                            </form>
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
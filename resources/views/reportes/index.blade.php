@extends('layouts.app')
@section('htmlheader_title','Reportes')
{{-- @endsection --}}
@section('contentheader_title', 'Reportes')
{{-- @endsection --}}
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-16 col-md-offset-0">
            <div class="box">
                <div class="box-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <h3 class="box-title">reporte de cantidades</h3>
                                <a style="margin-right: 0px;" href="recurso/create" class="btn btn-primary pull-right">Buscar</a>
                                
                                <li style="margin-right: 5px;" class="btn btn-default pull-right dropdown ">
                                    <a class="nav-link dropdown-toggle py-0 px-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">Fechas</a>
                                
                                    <ul class="dropdown-menu">
                                
                                        {{-- <li role="separator" class="divider"></li> --}}
                                        <table>
                                            <tr>
                                                <td>
                                                    <h6 class="dropdown-header">Rangos Predefinidos.</h6>
                                                    <li><a class="dropdown-item px-3" href="#">Agosto</a></li>
                                                    <li><a class="dropdown-item px-3" href="#">Septiembre</a></li>
                                                    <li><a class="dropdown-item px-3" href="#">Octubre</a></li>
                                                    <li><a class="dropdown-item px-3 active" href="#">Noviembre</a></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li><a class="dropdown-item px-3" href="#">Ultimo Año </a></li>
                                                    <li><a class="dropdown-item px-3" href="#">Ultimo mes</a></li>
                                                    <li><a class="dropdown-item px-3" href="#">Ultimo Semana</a></li>
                                                </td>
                                            </tr>
                                        </table>
                                    </ul>
                                </li>
                            </div>
                        </div>
                        <div class="row">
                            <form class="form">
                                <div class="col-md-6" style="margin-top:1em">
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="inlineFormInputGroupDate1" placeholder="Desde" describedby="inputGroupPrepend" required>
                                        <span class="input-group-addon" id="basic-addon2"><i class="fas fa-calendar-day"></i> Desde</span>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top:1em">
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="inlineFormInputGroupDate1" placeholder="Hasta" describedby="inputGroupPrepend" required>
                                        <span class="input-group-addon" id="basic-addon2"><i class="fas fa-calendar-day"></i> Hasta</span>
                                    </div>
                                </div>
                                {{-- <button type="submit" class="btn btn-block btn-primary">Buscar</button> --}}
                            </form>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top:1em">
                                <select class="form-control select" id="Cliente" name="Cliente" required>
                                    <option value="">Cliente</option>
                                    @foreach ($clientes as $cliente)
                                    <option value="ID_Trat">{{$cliente->CliName}}</option>
                                    @endforeach
                                    <option value="">Todos</option>
                                </select>
                            </div>
                            <div class="col-md-6" style="margin-top:1em">
                                <select class="form-control select" id="Generador" name="Generador" required>
                                    <option value="">Generador</option>
                                    @foreach ($generadores as $generador)
                                    <option value="ID_Trat">{{$generador->GenerName}}</option>
                                    @endforeach
                                    <option value="">Todos</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="margin-top:1em">
                                <select class="form-control select" id="Tratamiento" name="Tratamiento" required>
                                    <option value="">Tratamiento</option>
                                    @foreach ($tratamientos as $tratamiento)
                                    <option value="ID_Trat">{{$tratamiento->TratName}}</option>
                                    @endforeach
                                    <option value="ALL">Todos</option>
                                </select>
                            </div>
                            <div class="col-md-6" style="margin-top:1em">
                                <select class="form-control select" id="Residuo" name="Residuo" required>
                                    <option value="">Residuo</option>
                                    @foreach ($residuos as $residuo)
                                    <option value="ID_Trat">{{$residuo->RespelName}}</option>
                                    @endforeach
                                    <option value="">Todos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <table id="RecursosTable" class="table table-compact table-bordered table-striped">
                        <thead>
                            <tr>
                                @if (in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
                                <th>ID_SolRes</th>
                                @endif
                                <th>Solicitud de Servicio</th>
                                <th>Cantidad Kg</th>
                                <th>Cantidad Unid</th>
                            </tr>
                        </thead>
                        <tbody id="readyTable">
                            @foreach ($residuosconciliados as $residuoconciliado)
                                <tr>
                                    @if (in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
                                    <td>{{$residuoconciliado->ID_SolRes}}</td>
                                    @endif
                                    <td>{{$residuoconciliado->SolicitudServicio->ID_SolSer}} <br> ({{$residuoconciliado->SolicitudServicio->SolSerStatus}}) </td>
                                    <td>{{$residuoconciliado->SolResKgConciliado}}</td>
                                    <td>{{$residuoconciliado->SolResCantiUnidadConciliada}}</td>
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
@section('scripts')
<script type="text/javascript">
    function SelectCliente(){
		$('#Cliente').select2({
			placeholder: "Clientes...",
			allowClear: true,
			tags: true,
			width: 'resolve',
			width: '100%',
			theme: "classic"
		});
	}
    function SelectGenerador(){
		$('#Generador').select2({
			placeholder: "Generadores...",
			allowClear: true,
			tags: true,
			width: 'resolve',
			width: '100%',
			theme: "classic"
		});
	}
    function SelectTratamiento(){
		$('#Tratamiento').select2({
			placeholder: "Tratamientos...",
			allowClear: true,
			tags: true,
			width: 'resolve',
			width: '100%',
			theme: "classic"
		});
	}
    function SelectResiduo(){
		$('#Residuo').select2({
			placeholder: "Residuos...",
			allowClear: true,
			tags: true,
			width: 'resolve',
			width: '100%',
			theme: "classic"
		});
	}
    $(document).ready(function() {
        SelectCliente();
        SelectGenerador();
        SelectTratamiento();
        SelectResiduo();
    });
</script>
@endsection
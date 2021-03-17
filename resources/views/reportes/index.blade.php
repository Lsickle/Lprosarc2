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
                                    <td>
                                        <h6 class="dropdown-header">Personalizar.</h6>
                                        <form class="form">
                                            <li>
                                                <a class="dropdown-item px-3" href="#">
                                                    <label class="my-0" for="inlineFormInputGroupDate1">Desde</label>
                                                    <div class="input-group">
                                                        <input type="date" class="form-control" id="inlineFormInputGroupDate1" placeholder="Desde" describedby="inputGroupPrepend" required>
                                                        <span class="input-group-addon" id="basic-addon2"><i class="fas fa-calendar-day"></i></span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item px-3" href="#">
                                                    <label class="my-0" for="inlineFormInputGroupDate2">Hasta</label>
                                                    <div class="input-group">
                                                        <input type="date" class="form-control" id="inlineFormInputGroupDate1" placeholder="Desde" describedby="inputGroupPrepend" required>
                                                        <span class="input-group-addon" id="basic-addon2"><i class="fas fa-calendar-day"></i></span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item px-3" href="#">
                                                    <button type="submit" class="btn btn-block btn-primary">Buscar</button>
                                                </a>
                                            </li>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </ul>
                    </li>
                    <!-- Single button -->
                    {{-- <div class="btn-group">
                        <select class="form-control select" id="Cliente" name="Cliente" required>
                            <option value="">Cliente</option>
                            <option value="">Todos</option>
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </div>
                    <!-- Single button -->
                    <div class="btn-group">
                        <select class="form-control select" id="Generador" name="Generador" required>
                            <option value="">Generador</option>
                            <option value="">Todos</option>
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </div>
                    <!-- Single button -->
                    <div class="btn-group">
                        <select class="form-control select" id="Tratamiento" name="Tratamiento" required>
                            <option value="">RMs</option>
                            <option value="">Todos</option>
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </div>
                    <!-- Single button -->
                    <div class="btn-group">
                        <select class="form-control select" id="Residuo" name="Residuo" required>
                            <option value="">Residuo</option>
                            <option value="">Todos</option>
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </div>
                </div> --}}
                <div class="box-body">
                    <table id="RecursosTable" class="table table-compact table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Solicitud de Servicio</th>
                                <th>Ver Recursos</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody id="readyTable">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
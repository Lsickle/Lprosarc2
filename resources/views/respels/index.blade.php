@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::LangDeclar.declarmenu') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">{{ trans('adminlte_lang::LangRespel.Respellist') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="RespelTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nombre</th>
                {{-- <th>Descripcion</th> --}}
                <th>Clasificacion 4741</th>
                <th>Peligrosidad</th>
                <th>Estado</th>
                <th>Hoja de Seguridad</th>
                <th>Tarj de Emergencia</th>
                {{-- <th>Auditable</th> --}}
                <th>Estado</th>
                <th>Generado por</th>
                {{-- <th>Creado el</th> --}}
                <th>Actualizado el</th>
                <th>Ver Más...</th>
                <th>Edicion</th>
              </tr>
            </thead>
            <tbody hidden onload="renderTable()" id="readyTable">
              {{-- <h1 id="loadingTable">LOADING...</h1> --}}
              <div class="fingerprint-spinner" id="loadingTable">
                <div class="spinner-ring"><b style="font-size: 1.8rem;">L</b></div>
                <div class="spinner-ring"><b style="font-size: 1.8rem;">o</b></div>
                <div class="spinner-ring"><b style="font-size: 1.8rem;">a</b></div>
                <div class="spinner-ring"><b style="font-size: 1.8rem;">d</b></div>
                <div class="spinner-ring"><b style="font-size: 1.8rem;">i</b></div>
                <div class="spinner-ring"><b style="font-size: 1.8rem;">n</b></div>
                <div class="spinner-ring"><b style="font-size: 1.8rem;">g</b></div>
                <div class="spinner-ring"><b style="font-size: 1.8rem;">.</b></div>
                <div class="spinner-ring"><b style="font-size: 1.8rem;">.</b></div>
              </div>
              {{-- <div class="row">
                <div class="card text-center" style="width: 18rem; margin-top:3rem;">
                  <img class="card-img-top rounded-circle mx-auto d-block" src="images/{{$trainer->avatar}}" onerror="this.src='images/default.jpg';" alt="" style="margin:2rem; background-color:#EFEFEF; width:8rem;height:8rem;">
                  <div class="card-body">
                    <h5 class="card-title">{{$cliente->CliShortname}}</h5>
                    <p class="card-text" style="overflow-y: scroll; max-height:3rem; min-height:3rem;">{{$cliente->CliNit}}</p>
                    <a href="/clientes/{{$cliente->CliShortname}}" class="btn btn-primary">Ver mas...</a>
                  </div>
                </div>
              </div> --}}
              @foreach($Respels as $respel)
              <tr>
                <td>{{$respel->RespelName}}</td>
                {{-- <td>{{$respel->RespelDescrip}}</td> --}}
                <td>{{$respel->RespelClasf4741}}</td>
                <td>{{$respel->RespelIgrosidad}}</td>
                <td>{{$respel->RespelEstado}}</td>
                <td>{{$respel->RespelHojaSeguridad}}</td>
                <td>{{$respel->RespelTarj}}</td>
                <td>{{$respel->RespelStatus}}</td>
                {{-- @if($respel->DeclarAuditable==1)
                <td>Si</td>
                @else
                <td>NO</td>
                @endif --}}
                <td>{{$respel->GSedeName}}</td>
                {{-- <td>{{$respel->created_at}}</td> --}}
                <td>{{$respel->updated_at}}</td>
                <td></td>
                <td></td>
                {{-- <td>{{$respel->RespelSlug}}</td> --}}
              </tr>
              @endforeach
            </tbody>
            {{-- <tfoot>
            <tr>
              <th>Nombre</th>
              <th>Descripcion</th>
              <th>Clasificacion 4741</th>
              <th>Peligrosidad</th>
              <th>Estado</th>
              <th>Hoja de Seguridad</th>
              <th>Tarj de Emergencia</th>
              <th>Auditable</th>
              <th>Generado por</th>
              <th>Creado el</th>
              <th>Actualizado el</th>
              <th>edicion</th>
            </tr>
            </tfoot> --}}
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</div>
@endsection
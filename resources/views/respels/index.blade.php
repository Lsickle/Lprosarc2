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
          <a href="respels/create" class="btn btn-primary" style="float: right;">Crear</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="RespelTable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nombre</th>
                {{-- <th>Descripcion</th> --}}
                <th>Clasificacion 4741 Y</th>
                <th>Clasificacion 4741 A</th>
                <th>Peligrosidad</th>
                <th>Estado del residuo</th>
                <th>Hoja de Seguridad</th>
                <th>Tarj de Emergencia</th>
                {{-- <th>Auditable</th> --}}
                <th>Estado</th>
                <th>Generado por</th>
                {{-- <th>Creado el</th> --}}
                {{-- <th>Actualizado el</th> --}}
                <th>Ver Más...</th>
                <th>Editar</th>
<<<<<<< HEAD
                <th>Borrar</th>
=======
                {{-- <th>Borrar</th> --}}
>>>>>>> final
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
              @foreach($Respels as $respel)
<<<<<<< HEAD
              @component('layouts.partials.modal')
                    {{$respel->ID_Respel}}
                @endcomponent
=======
              {{-- @component('layouts.partials.modal')
                    {{$respel->ID_Respel}}
                @endcomponent --}}
>>>>>>> final
              <tr>
                <td>{{$respel->RespelName}}</td>
                {{-- <td>{{$respel->RespelDescrip}}</td> --}}
                <td>{{$respel->YRespelClasf4741}}</td>
                <td>{{$respel->ARespelClasf4741}}</td>
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
                <td>{{$respel->CliName}}</td>
                {{-- <td>{{$respel->created_at}}</td> --}}
                {{-- <td>{{$respel->updated_at}}</td> --}}
                <td></td>
                <td>{{$respel->RespelSlug}}</td>
<<<<<<< HEAD
                <td>@if($respel->RespelDelete == 0)
=======
                
                {{-- <td>@if($respel->RespelDelete == 0)
>>>>>>> final
                    <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$respel->ID_Respel}}' class='btn btn-danger btn-block'>Borrar</a>
                    <form action='/respels/{{$respel->RespelSlug}}' method='POST'>
                        @method('DELETE')
                        @csrf
                        <input  type="submit" id="Eliminar{{$respel->ID_Respel}}" style="display: none;">
                    </form>
                  @else
                    <form action='/respels/{{$respel->RespelSlug}}' method='POST'>
                      @method('DELETE')
                      @csrf
                      <input type="submit" class='btn btn-success btn-block' value="Añadir">
                    </form>
                  @endif
<<<<<<< HEAD
              </td>

                {{-- <td>{{$respel->RespelSlug}}</td> --}}
=======
              </td> --}}

>>>>>>> final
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
              <th>Editar</th>
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
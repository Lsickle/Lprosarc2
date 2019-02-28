@extends('layouts.app')

@section('htmlheader_title','Asistencia')

@section('contentheader_title', 'Asistencia')

@section('main-content')
  <div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-16 col-md-offset-0">
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Asistencia del personal</h3>
            <h1>{{date('Y-m-d',strtotime(date('Y-m-d')."-1 days"))}}</h1>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="AssistancesTable1" class="table table-compact table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Documento</th>
                  <th>Entrada</th>
                  <th>Salida</th>
                  <th>Revision</th>
                </tr>
              </thead>
              <tbody  hidden onload="renderTable()" id="readyTable">
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
                   @foreach($personal as $persona)
                    <?php $Llegada = 0; $Salida = 1;?>
                    @foreach($Asistencias as $Asistencia)
                       @if($persona->ID_Pers == $Asistencia->FK_AsisPers)
                          <?php $Llegada = 1; $id=$Asistencia->ID_Asis; $Salida = 0;?>
                          @if($Asistencia->AsisSalida != null)
                            <?php $Salida = 1; $Llegada = 1;?>
                          @endif
                       @endif
                    @endforeach
                    {{$Llegada."  ".$Salida."<br>"}}
                      @if($Llegada == 1 AND $Salida == 1)
                      @else
                        @if($Llegada == 0 AND $Salida == 1)
                            <tr>
                              <td>{{$persona->PersFirstName." ".$persona->PersLastName}}</td>
                              <td>{{$persona->PersDocNumber}}</td>
                              <td>
                                <form id="readyform" action="/asistencia" method="POST">
                                  @csrf
                                  <input type="hidden"  value="{{$persona->ID_Pers}}" name='AsisPers'>
                                  <input type='submit' id='readyform' class='btn btn-block btn-success' value='Llego'>
                                </form>
                              </td>
                              <td>
                                <input type='submit' id='readyform' class='btn btn-block btn-success disabled' value='Salio'>
                              </td>
                              <td>{{$Llegada.' Y '.$Salida}}</td>
                            <tr>
                        @elseif($Llegada == 1 AND $Salida == 0)
                            <tr>
                              <td>{{$persona->PersFirstName." ".$persona->PersLastName}}</td>
                              <td>{{$persona->PersDocNumber}}</td>
                              <td>
                                <input type='submit' id='readyform' class='btn btn-block btn-success disabled' value='Entro'>
                              </td>
                              <td>
                                <form id="readyform" action="/asistencia/{{$id}}" method="POST">
                                  @method('PUT')
                                  @csrf
                                  <input type="hidden"  value="{{$id}}" name='AsisPers'>
                                  <input type='submit' id='readyform' class='btn btn-block btn-success' value='Sefue'>
                                </form>
                              </td>
                              <td>{{$Llegada.' Y '.$Salida}}</td>
                            </tr>
                        @endif
                      @endif
                   @endforeach
                     
                        
                      
                    
              {{--   @else
                @foreach($Asistencias as $Asistencia) --}}
                 {{--  @foreach($personal as $persona) --}}
                     {{--  @if($Asistencia->FK_AsisPers == $Asistencia->ID_Pers)
                      @else
                        <tr>
                           <td>{{$Asistencia->PersFirstName." ".$Asistencia->PersLastName}}</td>
                           <td>{{$Asistencia->PersDocNumber}}</td>
                           <td>
                             <form id="readyform" action="/asistencia" method="POST">
                               @csrf
                               <input type="hidden"  value="{{$Asistencia->ID_Pers}}" name='AsisPers'>
                               <input type='submit' id='readyform' class='btn btn-block btn-success' value='Llego'>
                             </form>
                           </td>
                           <td>
                             <input type='submit' id='readyform' class='btn btn-block btn-success disabled' value='Salio'>
                           </td>
                        <tr>
                      @endif --}}
                    {{-- @endforeach --}}
                 {{--  @endforeach
                @endif --}}
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>
@endsection
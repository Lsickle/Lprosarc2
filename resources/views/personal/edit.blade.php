@extends('layouts.app')

@section('htmlheader_title','Personal')

@section('contentheader_title', 'Edicion de Personal')

@section('main-content')
	<div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-16 col-md-offset-0">
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
                @component('layouts.partials.modal')
                    {{$Persona->ID_Pers}}
                @endcomponent
            <h3 class="box-title">Datos de la persona</h3>
            @if($Persona->PersDelete == 0)
              <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Persona->ID_Pers}}'  class='btn btn-danger' style="float: right;">Eliminar</a>
              <form action='/personal/{{$Persona->PersSlug}}' method='POST'>
                  @method('DELETE')
                  @csrf
                  <input  type="submit" id="Eliminar{{$Persona->ID_Pers}}" style="display: none;">
              </form>
            @else
              <form action='/personal/{{$Persona->PersSlug}}' method='POST' style="float: right;">
                @method('DELETE')
                @csrf
                <input type="submit" class='btn btn-success btn-block' value="Añadir">
              </form>
            @endif
          </div>
          <!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="/personal/{{$Persona->PersSlug}}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                {{-- <h1 id="loadingTable">LOADING...</h1> --}}
                  @include('layouts.partials.spinner')
                <div class="box-body" hidden onload="renderTable()" id="readyTable">
                  <div class="tab-pane" id="addRowWizz">
                    <div id="smartwizard">
                      <ul>
                        <li><a href="#step-1"><b>Paso 1</b><br /><small>Datos de Contacto</small></a></li>
                        <li><a href="#step-2"><b>Paso 2</b><br /><small>Requerimientos-Fotos</small></a></li>
                      </ul>
                      <div>
                        <div id="step-1" class="">
                            <div class="col-xs-6">
                              <label for="PersDocType">Tipo de Documento</label>
                              <select name="PersDocType" id="PersDocType" class="form-control">
                                  <option value="{{$Persona->PersDocType}}">Seleccione...</option>
                                  <option value="CC">Cedula de Ciudadanía</option>
                                  <option value="CE">Cedula Extranjera</option>
                                  <option value="RUT">Rut</option>
                              </select>
                            </div>
                            <div class="col-xs-6">
                              <label for="PersDocNumber">Número del Documento</label>
                              <input minlength="7" maxlength="12" required="true" name="PersDocNumber" autofocus="true" type="text" class="form-control" id="PersDocNumber" value="{{$Persona->PersDocNumber}}">
                            </div>
                            <div class="col-xs-6">
                              <label for="PersFirstName">Primer Nombre</label>
                              <input  required="true" name="PersFirstName" autofocus="true" type="text" class="form-control" id="PersFirstName" value="{{$Persona->PersFirstName}}">
                            </div>
                            <div class="col-xs-6">
                              <label for="PersSecondName">Segundo Nombre</label>
                              <input name="PersSecondName" autofocus="true" type="text" class="form-control" id="PersSecondName" value="{{$Persona->PersSecondName}}">
                            </div>
                            <div class="col-xs-6">
                              <label for="PersLastName">Apellidos</label>
                              <input  required="true" name="PersLastName" autofocus="true" type="text" class="form-control" id="PersLastName" value="{{$Persona->PersLastName}}">
                            </div>
                            <div class="col-xs-6">
                              <label for="PersCellphone">Número de Celular</label>
                              <input name="PersCellphone" autofocus="true" type="text" class="form-control" id="PersCellphone" value="{{$Persona->PersCellphone}}">
                            </div>
                            <div class="col-xs-6">
                              <label for="PersAddress">Dirección</label>
                              <input name="PersAddress" autofocus="true" type="text" class="form-control" id="PersAddress" value="{{$Persona->PersAddress}}">
                            </div>
                            <div class="col-xs-6">
                              <label for="PersType">Tipo de Persona</label>
                              <select name="PersType" id="PersType" class="form-control">
                                  <option value="{{$Persona->PersType}}">Seleccione...</option>
                                  <option value="1">Interna</option>
                                  <option value="0">Externa</option>
                              </select>
                            </div>
                            <div class="form-group" style="margin-left: 1em; margin-right: 1em;">
                              <label for="FK_PersCargo">Cargo del Personal</label>
                              <select name="FK_PersCargo" id="FK_PersCargo" class="form-control">
                                  <option value="{{$Persona->FK_PersCargo}}">Seleccione...</option>
                                  @foreach($Cargos as $Cargo)
                                    <option value="{{$Cargo->ID_Carg}}">{{$Cargo->CargName}} de {{$Cargo->AreaName}}</option>
                                  @endforeach
                              </select>
                            </div>
                        </div>
                        <div id="step-2" class="">
                          <div class="col-xs-6">
                            <label for="PersBirthday">Fecha de Nacimiento</label>
                            <input name="PersBirthday" autofocus="true" type="text" class="form-control" id="PersBirthday" value="{{$Persona->PersBirthday}}">
                          </div>
                          <div class="col-xs-6">
                            <label for="PersPhoneNumber">Número de Telefono</label>
                            <input name="PersPhoneNumber" autofocus="true" type="text" class="form-control" id="PersPhoneNumber" value="{{$Persona->PersPhoneNumber}}">
                          </div>
                          <div class="col-xs-6">
                            <label for="PersEPS">EPS</label>
                            <input name="PersEPS" autofocus="true" type="text" class="form-control" id="PersEPS" value="{{$Persona->PersEPS}}">
                          </div>
                          <div class="col-xs-6">
                            <label for="PersARL">ARL</label>
                            <input name="PersARL" autofocus="true" type="text" class="form-control" id="PersARL" value="{{$Persona->PersARL}}">
                          </div>
                          <div class="form-group" style="margin-left: 1em; margin-right: 1em;">
                            <label for="PersLibreta">Número de Libreta</label>
                            <input name="PersLibreta" autofocus="true" type="text" class="form-control" id="PersLibreta" value="{{$Persona->PersLibreta}}">
                          </div>
                          <div class="col-xs-6">
                            <label for="PersBank">Banco</label>
                            <input name="PersBank" autofocus="true" type="text" class="form-control" id="PersBank" value="{{$Persona->PersBank}}">
                          </div>
                          <div class="col-xs-6">
                            <label for="PersBankAccaunt">Número de Cuenta</label>
                            <input name="PersBankAccaunt" autofocus="true" type="text" class="form-control" id="PersBankAccaunt" value="{{$Persona->PersBankAccaunt}}">
                          </div>
                          <div class="col-xs-6">
                            <label for="PersIngreso">Fecha de Entrada</label>
                            <input name="PersIngreso" autofocus="true" type="text" class="form-control" id="PersIngreso" value="{{$Persona->PersIngreso}}">
                          </div>
                          <div class="col-xs-6">
                            <label for="PersSalida">Fecha de Salida</label>
                            <input name="PersSalida" autofocus="true" type="text" class="form-control" id="PersSalida" value="{{$Persona->PersSalida}}">
                          </div>
                          <div class="form-group" style="margin-left: 1em; margin-right: 1em;">
                            <label for="PersPase">Número del Pase</label>
                            <input name="PersPase" autofocus="true" type="text" class="form-control" id="PersPase" value="{{$Persona->PersPase}}">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <input hidden type="text" name="updated_by" value="{{Auth::user()->email}}">
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary pull-right" style="margin-right:5em">Actualizar</button>
                </div>
              </form>
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>
@endsection
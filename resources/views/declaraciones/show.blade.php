@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  
  {{-- seccion de prueba --}}
  <div class="row">
    <div class="col-md-3">
      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
          <h3 class="profile-username text-center">{{$declarationData->DeclarName}}</h3>
          <p class="text-muted text-center">{{$declarationData->DeclarTipo}}</p>
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>sedes</b> <a class="pull-right">1,322</a>
            </li>
            <li class="list-group-item">
              <b>Following</b> <a class="pull-right">543</a>
            </li>
            <li class="list-group-item">
              <b>Friends</b> <a class="pull-right">13,287</a>
            </li>
          </ul>
          <a href="/Generadores/{{$declarationData->DeclarSlug}}/edit" class="btn btn-success btn-block"><b>Editar</b></a>
          <br>
          {{--             <form action="/sclientes/create" class="form-group" method="POST">
            @csrf
            <input type="text" name="CliSlug" value="{{$generadors->GenerSlug}}" hidden="true">
            <button type="submit" class="btn btn-primary btn-block">Agregar Sede</button>
          </form> --}}
          <form action="/Generadores/{{$declarationData->ID_Declar}}" class="form-group" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-block">Borrar</button>
          </form>
          
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <!-- About Me Box -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">About Me</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
          <p class="text-muted">
            B.S. in Computer Science from the University of Tennessee at Knoxville
          </p>
          <hr>
          <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>
          <p class="text-muted">Malibu, California</p>
          <hr>
          <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
          <p>
            <span class="label label-danger">UI Design</span>
            <span class="label label-success">Coding</span>
            <span class="label label-info">Javascript</span>
            <span class="label label-warning">PHP</span>
            <span class="label label-primary">Node.js</span>
          </p>
          <hr>
          <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li><a href="#ClienteFicha" data-toggle="tab">Cliente</a></li>
          <li><a href="#activity" data-toggle="tab">Generador</a></li>
          <li class="active"><a href="#Residuos" data-toggle="tab">Residuos</a></li>
          <li><a href="#settings" data-toggle="tab">Hojas de seguridad</a></li>
          <li><a href="#settings" data-toggle="tab">Tarjeta de emergencia</a></li>
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="ClienteFicha">
            <!-- Ficha del cliente -->
            <div class="card">
              <div class="card-header">
                <ul class="nav nav-tabs card-header-pills">
                  <li class="active">
                    <a href="#" data-toggle="tab">Sede Principal</a>
                  </li>
                  <li>
                    <a href="#" data-toggle="tab">Sede de Declaracion</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <h1 class="card-title">{{$declarationData->CliName}}</h1>
                <h3 class="card-title">{{$declarationData->GSedeName}}</h3>
                <p class="card-text">{{$declarationData->GSedeAddress}}</p>
                <a href="/clientes" class="btn btn-primary">ir al listado de clientes</a>
              </div>
            </div>
            <!-- /.Ficha del cliente -->
            
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="Residuos">
            <div class="row">
              <div class="col-md-12 col-md-offset-0">
                <!-- /.box -->
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">{{ trans('adminlte_lang::LangRespel.Respellist') }}</h3>
                  </div>
                  <div>
                    <button class="btn btn-primary" id="addRow">Nuevo Residuo</button>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="RespelTable" class="table table-bordered table-striped" style="white-space:nowrap; width:100%">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Descripcion</th>
                          <th>Clasificacion 4741</th>
                          <th>Peligrosidad</th>
                          <th>Estado</th>
                          <th>edicion</th>
                          <th>Tarj de Emergencia</th>
                          <th>Auditable</th>
                          <th>Generado por</th>
                          <th>Creado el</th>
                          <th>Actualizado el</th>
                          <th>Hoja de Seguridad</th>
                        </tr>
                      </thead>
                      <tbody>
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
                          <td>{{$respel->RespelDescrip}}</td>
                          <td>{{$respel->RespelClasf4741}}</td>
                          <td>{{$respel->RespelIgrosidad}}</td>
                          <td>{{$respel->RespelEstado}}</td>
                          <td>{{$respel->RespelSlug}}</td>
                          <td>{{$respel->RespelTarj}}</td>
                          @if($respel->DeclarAuditable==1)
                          <td>Si</td>
                          @else
                          <td>NO</td>
                          @endif
                          <td>{{$respel->GSedeName}}</td>
                          <td>{{$respel->created_at}}</td>
                          <td>{{$respel->updated_at}}</td>
                          <td>{{$respel->RespelHojaSeguridad}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Clasificacion 4741</th>
                        <th>Peligrosidad</th>
                        <th>Estado</th>
                        <th>edicion</th>
                        <th>Tarj de Emergencia</th>
                        <th>Auditable</th>
                        <th>Generado por</th>
                        <th>Creado el</th>
                        <th>Actualizado el</th>
                        <th>Hoja de Seguridad</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="settings">
            <form class="form-horizontal">
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputName" placeholder="Name">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputName" placeholder="Name">
                </div>
              </div>
              <div class="form-group">
                <label for="inputExperience" class="col-sm-2 control-label">Experience</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label for="inputSkills" class="col-sm-2 control-label">Skills</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-danger">Submit</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  @endsection
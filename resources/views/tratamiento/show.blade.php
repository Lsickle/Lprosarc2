@extends('layouts.app')
@if(Auth::user()->UsRol == "Programador"||Auth::user()->UsRol == "JefeOperacion"||Auth::user()->UsRol == "admin")
@section('htmlheader_title')
Respel-Tratamiento
@endsection

@section('contentheader_title')
  Tratamiento
@endsection

@section('main-content')

{{-- @component('layouts.partials.modal')
{{$tratamiento->ID_Respel}}
@endcomponent --}}

<div class="container-fluid spark-screen">
    <!-- row -->
    <div class="row">
      <!-- col md3 -->
      <div class="col-md-3">
        <!-- box -->
        <div class="box box-primary">
          <!-- box body -->
          <div class="box-body box-profile">
            {{-- <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> --}}
            <h3 class="profile-username text-center">{{$tratamiento->TratName}}</h3>
            <p class="text-muted text-center">@if($tratamiento->TratTipo=='1')
                <td>Tratamiento Interno</td>
                @else
                <td>Tratamiento Externo</td>
                @endif
            </p>
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Registrado</b> <p class="pull-right" style="color:blue;">{{$tratamiento->created_at->diffForHumans()}}</p>
              </li>
            </ul>
            <a method='get' href='/Tratamientos/{{$tratamiento->ID_Trat}}/edit' target='_blank' class='btn btn-warning btn-block'><i class='fas fa-edit'></i> Editar</a>

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box body -->
      </div>
      <!-- /.col md3 -->
      <!-- col md9 -->
      <div class="col-md-9">
        <!-- box -->
        <div class="box">
          <!-- box header -->
          <div class="box-header with-border">
            <h3 class="box-title">Detalles de Tratamiento</h3>
          </div>
          <!-- /.box header -->
          <!-- box body -->
          <div class="box-body">
            <!-- nav-tabs-custom -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link" href="#Proveedorpane" data-toggle="tab">Proveedor</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="#Pretratamientospane" data-toggle="tab">Pretratamientos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#Requerimientospane" data-toggle="tab">Requerimientos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#Tarifaspane" data-toggle="tab">Tarifas</a>
                </li>
              </ul>
              <!-- nav-content -->
              <div class="tab-content" style="min-height:40vh;">
                
                <!-- tab-pane fade -->
                <div class="tab-pane fade " id="Proveedorpane">

                </div>
                <!-- tab-pane fade -->
                <!-- tab-pane fade -->
                <div class="tab-pane fade in active" id="Pretratamientospane">
                  <div class="form-horizontal">
                    
                  </div>
                </div>
                <!-- /.tab-pane fade -->
                <!-- /.tab-pane fade -->
                <div class="tab-pane fade" id="Requerimientospane">

                </div>
                <!-- /.tab-pane fade -->
                <!-- tab-pane fade -->
                <div class="tab-pane fade" id="tarifaspane">
                  <div class="form-horizontal">

                  </div>
                </div>
                <!-- /.tab-pane fade -->
              </div>
              <!-- /.tab-content -->
            </div>
            <div class="row">
               <input class="btn btn-success  pull-right" type="submit" value="Actualizar" style="margin-right:3em" />
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.box body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col md9 -->
    </div>
    <!-- /.row -->
</div>
@endsection
@endif
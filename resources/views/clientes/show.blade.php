@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection
@section('contentheader_title', '')


@section('main-content')
	<div class="container-fluid spark-screen">

          <!-- /.box -->
          <div class="row">
              <div class="col-md-8" style="margin-left: 15%;">
          <!-- About Me Box -->
          <div class="box box-primary">
              <div class="box-body box-profile">
                  @if (Auth::user()->UsRol === 'Administrador' || Auth::user()->UsRol === 'Programador' || Auth::user()->UsRol === 'Cliente')
                <a href="/clientes/{{$cliente->CliSlug}}/edit" class="btn btn-success pull-right"><b>Editar</b></a>
                @endif
                @if (Auth::user()->UsRol === 'Administrador' || Auth::user()->UsRol === 'Programador')
                @component('layouts.partials.modal')
                {{$cliente->ID_Cli}}
                @endcomponent
                  @if($cliente->CliDelete == 0)
                    <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$cliente->ID_Cli}}'  class='btn btn-danger pull-left'>Eliminar</a>
                    <form action='/clientes/{{$cliente->CliSlug}}' method='POST'>
                        @method('DELETE')
                        @csrf
                        <input  type="submit" id="Eliminar{{$cliente->ID_Cli}}" style="display: none;">
                    </form>
                  @else
                    <form action='/clientes/{{$cliente->CliSlug}}' method='POST'>
                      @method('DELETE')
                      @csrf
                      <input type="submit" class='btn btn-success pull-left' value="Añadir">
                    </form>
                  @endif
                @endif
                <h3 class="profile-username text-center">{{$cliente->CliShortname}}</h3>
                <ul class="list-group list-group-unbordered">
                  <li class="list-group-item">
                    <b>Nombre</b> <a class="pull-right">{{$cliente->CliName}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Nombre corto</b> <a class="pull-right">{{$cliente->CliShortname}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>NIT</b> <a class="pull-right">{{$cliente->CliNit}}</a>
                  </li>
                </ul>
              </div>
              <!-- /.box-body -->
            </div>
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
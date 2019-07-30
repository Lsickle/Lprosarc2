@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::LangTratamiento.pretratupdate') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::LangTratamiento.pretratMenu') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">{{ trans('adminlte_lang::LangTratamiento.pretratupdate') }}</h3>
          @component('layouts.partials.modal')
              @slot('slug')
                {{$pretratamiento->ID_PreTrat}}
              @endslot
              @slot('textModal')
                el Pretratamiento <b>{{$pretratamiento->PreTratName}}</b>
              @endslot
            @endcomponent
            @if($pretratamiento->PreTratDelete == 0)
              @if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones) || in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
              <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$pretratamiento->ID_PreTrat}}' class='btn btn-danger pull-right'><i class="fas fa-trash-alt"></i><b> {{ trans('adminlte_lang::message.delete') }}</b></a>
              <form action='/pretratamiento/{{$pretratamiento->ID_PreTrat}}' method='POST'  class="pull-right">
                @method('DELETE')
                @csrf
                <input type="submit" id="Eliminar{{$pretratamiento->ID_PreTrat}}" style="display: none;">
              </form>
              @endif
            @else
              @if(in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || in_array(Auth::user()->UsRol2, Permisos::PROGRAMADOR))
                <form action='/pretratamiento/{{$pretratamiento->ID_PreTrat}}' method='POST' class="pull-right">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class='btn btn-success btn-block pull-right'>
                    <i class="fas fa-plus-square"></i><b> {{ trans('adminlte_lang::message.add') }}</b>
                  </button>
                </form>
              @endif
            @endif
        </div>
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            
            <!-- general form elements -->
            <div class="box box-primary">
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="/pretratamiento/{{$pretratamiento->ID_PreTrat}}" method="POST" enctype="multipart/form-data" id="edittratamientoForm">
                @csrf
                @method('PUT')
                <div class="panel-body" id="pretratamientosPanel" onload="attachPopover()">
                        {{-- /*lista de pretratamientos*/ --}}
                        {{-- se itera sobre los pretratamientos existentes --}}
                        <hr class="col-md-10 col-md-offset-1 align-self-center" id="pretratsparator0" />
                        <input id="ID_Propo0" class="form-control" type="hidden" name="ID_PreTrat" value="{{$pretratamiento->ID_PreTrat}}">
                        <div class="col-md-6" id="pretratname0">
                          <label for="input[]">{{ trans('adminlte_lang::LangTratamiento.pretratname') }} </label>
                          <div class="input-group">
                            <input maxlength="60" id="input[]" class="form-control" type="text" name="PreTratName" value="{{$pretratamiento->PreTratName}}" required>
                            <a data-placement="auto" data-trigger="hover" data-html="true" onclick="EliminarPreTrat(0)" class="input-group-addon" style=" color: red;" data-toggle="popover" title="{{ trans('adminlte_lang::LangTratamiento.pretratname') }}" data-content="{{ trans('adminlte_lang::LangTratamiento.popoverdescript1') }}"><i class="fas fa-backspace"></i></a>
                          </div><br>
                        </div>
                        <div class="col-md-6" id="pretratdescription0">
                          <label for="inputdescript[]">{{ trans('adminlte_lang::LangTratamiento.pretratdescript') }} </label>
                          <div class="input-group">
                            <input maxlength="250" id="inputdescript[]" class="form-control" type="text" name="PreTratDescription" value="{{$pretratamiento->PreTratDescription}}">
                            <a data-placement="auto" data-trigger="hover" data-html="true" class="input-group-addon" data-toggle="popover" title="{{ trans('adminlte_lang::LangTratamiento.popovertittle2') }}" data-content="<p style='width: 50%'>{{ trans('adminlte_lang::LangTratamiento.popoverdescript2') }}</p>"><i class="fas fa-info-circle"></i></a>
                          </div>
                        </div>
                      </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-success" style="margin-left: 2rem;"><i class="fas fa-check"></i> {{ trans('adminlte_lang::message.update') }}</button>
                  <a class="btn btn-default btn-close pull-right" style="margin-right: 2rem;" href="{{ route('tratamiento.index') }}"><i class="fas fa-backspace" color="red"></i> {{ trans('adminlte_lang::LangTratamiento.cancel') }}</a>
                </div>
              </form>
            </div>
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

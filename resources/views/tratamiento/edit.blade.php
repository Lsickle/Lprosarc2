@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::LangTratamiento.tratnew') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::LangTratamiento.tratMenu') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-md-16 col-md-offset-0">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">{{ trans('adminlte_lang::LangTratamiento.tratnew') }}</h3>
          <div class="box-tools pull-right">
            <button onclick="AgregarPreTrat()" class="btn btn-primary pull-right"> <i class="fa fa-plus"></i> {{ trans('adminlte_lang::LangTratamiento.pretratadd') }}</button>
          </div>
        </div>
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="/tratamiento/{{$tratamiento->ID_Trat}}" method="POST" enctype="multipart/form-data" id="edittratamientoForm">
                @csrf
                @method('PUT')
                <div class="box-body" id="boxbodypretrat">
                  <div class="col-md-6">
                    <label for="select2sedes">{{ trans('adminlte_lang::LangTratamiento.manager') }}</label>
                    <select class="form-control select" id="select2sedes" name="FK_TratProv" required="true">
                      @foreach($sedes as $sede)
                      <option value="{{$sede->ID_Sede}}" {{ $sede->ID_Sede === $SelectedSede->ID_Sede ? 'selected' : '' }}>{{$sede->SedeName}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="input1">{{ trans('adminlte_lang::LangTratamiento.tratname') }}</label>
                    <input id="input1" class="form-control" type="text" name="TratName" value="{{$tratamiento->TratName}}">
                  </div>
                  <div class="col-md-12">
                    <div class="panel panel-default" style="margin-top: 2%;">
                      <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('adminlte_lang::LangTratamiento.pretrat') }}s</h3>
                      </div>
                      <div class="panel-body" id="pretratamientosPanel" onload="attachPopover()">
                        {{-- /*lista de pretratamientos*/ --}}
                        {{-- se inicializa la variable contador para control de inputs --}}
                        @php
                        $contador = 1;
                        @endphp
                        {{-- se itera sobre los pretratamientos existentes --}}
                        @foreach($tratamiento->pretratamientos as $pretratamiento)
                        @if($pretratamiento->PreTratDelete == 0)
                        <hr class="col-md-10 col-md-offset-1 align-self-center" id="pretratsparator{{$contador}}" />
                        <input id="ID_Propo{{$contador}}" class="form-control" type="hidden" name="ID_PreTrat[]" value="{{$pretratamiento->ID_PreTrat}}">
                        <div class="col-md-6" id="pretratname{{$contador}}">
                          <label for="input[]">{{ trans('adminlte_lang::LangTratamiento.pretratname') }} </label>
                          <div class="input-group">
                            <input id="input[]" class="form-control" type="text" name="PreTratName[]" value="{{$pretratamiento->PreTratName}}" required>
                            <a data-placement="auto" data-trigger="hover" data-html="true" onclick="EliminarPreTrat({{$contador}})" class="input-group-addon" style=" color: red;" data-toggle="popover" title="{{ trans('adminlte_lang::LangTratamiento.pretratname') }}" data-content="{{ trans('adminlte_lang::LangTratamiento.popoverdescript1') }}"><i class="fas fa-backspace"></i></a>
                          </div><br>
                        </div>
                        <div class="col-md-6" id="pretratdescription{{$contador}}">
                          <label for="inputdescript[]">{{ trans('adminlte_lang::LangTratamiento.pretratdescript') }} </label>
                          <div class="input-group">
                            <input id="inputdescript[]" class="form-control" type="text" name="PreTratDescription[]" value="{{$pretratamiento->PreTratDescription}}">
                            <a data-placement="auto" data-trigger="hover" data-html="true" class="input-group-addon" data-toggle="popover" title="{{ trans('adminlte_lang::LangTratamiento.popovertittle2') }}" data-content="<p style='width: 50%'>{{ trans('adminlte_lang::LangTratamiento.popoverdescript2') }}</p>"><i class="fas fa-info-circle"></i></a>
                          </div>
                        </div>
                        @php
                        $contador = $contador+1;
                        @endphp
                        @endif
                        @endforeach
                      </div>
                    </div>
                    <!-- /.box -->
                  </div>
                  <!-- /.col -->
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

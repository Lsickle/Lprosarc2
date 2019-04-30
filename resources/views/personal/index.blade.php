@extends('layouts.app')

@section('htmlheader_title')
{{ trans('adminlte_lang::message.personalhtmlheader_title') }}
@endsection

@section('contentheader_title')
@if(Auth::user()->UsRol == trans('adminlte_lang::message.Cliente'))
	{{ trans('adminlte_lang::message.personaltitleindex') }}
@else
	{{ trans('adminlte_lang::message.personaltitleindex2') }}
@endif
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
    <div class="row">
      <div class="col-md-16 col-md-offset-0">
        <!-- /.box -->
        <div class="box">
          <div class="box-header">
            @if(Auth::user()->UsRol == trans('adminlte_lang::message.Cliente'))
            	<a href="personal/create" class="btn btn-primary" style="float: right;">{{ trans('adminlte_lang::message.Cliente') }}</a>
            @endif
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="PersonalsTable" class="table table-compact table-bordered table-striped">
              <thead>
                <tr>
                  <th>{{ trans('adminlte_lang::message.persdocument') }}</th>
                  <th>{{ trans('adminlte_lang::message.persname') }}</th>
                  <th>{{ trans('adminlte_lang::message.emailaddress') }}</th>
                  <th>{{ trans('adminlte_lang::message.mobile') }}</th>
                  <th>{{ trans('adminlte_lang::message.cargoname') }}</th>
                  <th>{{ trans('adminlte_lang::message.areaname') }}</th>
                  <th>{{ trans('adminlte_lang::message.clientmenu') }}</th>
                  @if(Auth::user()->UsRol <> trans('adminlte_lang::message.JefeLogistica') || Auth::user()->UsRol <> trans('adminlte_lang::message.AuxiliarLogistica') || Auth::user()->UsRol <> trans('adminlte_lang::message.AsistenteLogistica'))
                    <th>{{ trans('adminlte_lang::message.see') }}</th>
                  @endif
                </tr>
              </thead>
              <tbody  hidden onload="renderTable()" id="readyTable">
                {{-- <h1 id="loadingTable">LOADING...</h1> --}}
                @include('layouts.partials.spinner')
                @foreach($Personals as $Personal)
                <tr @if($Personal->PersDelete <> 1)
                      style="color: red;" 
                    @endif
                >
                  <td>{{$Personal->PersDocType." ".$Personal->PersDocNumber}}</td>
                  <td>{{$Personal->PersFirstName." ".$Personal->PersSecondName." ".$Personal->PersLastName}}</td>
                  <td>{{$Personal->PersEmail}}</td>
                  <td>{{$Personal->PersCellphone}}</td>
                  <td>{{$Personal->CargName}}</td>
                  <td>{{$Personal->AreaName}}</td>
                  <td>{{$Personal->CliShortname}}</td>
                  @if(Auth::user()->UsRol <> trans('adminlte_lang::message.JefeLogistica') || Auth::user()->UsRol <> trans('adminlte_lang::message.AuxiliarLogistica') || Auth::user()->UsRol <> trans('adminlte_lang::message.AsistenteLogistica'))
                    <td><a method='get' href='/personal/{{$Personal->PersSlug}}' class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.see') }}</a></td>
                  @endif
                </tr>
                @endforeach
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
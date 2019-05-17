@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.clientcliente') }}
@endsection
@section('contentheader_title', '')

@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
		<!-- About Me Box -->
			<div class="box box-info">
				<div class="box-body box-profile">
                    <a href="/contactos/{{$Cliente->CliSlug}}/edit" class="btn btn-warning pull-right"><b>{{ trans('adminlte_lang::message.edit') }}</b></a>
                    @component('layouts.partials.modal')
                            {{$Cliente->ID_Cli}}
                        @endcomponent
                        @if($Cliente->CliDelete == 0)
                            <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Cliente->ID_Cli}}' class='btn btn-danger pull-left'><b>{{ trans('adminlte_lang::message.delete') }}</b></a>
                            <form action='/contactos/{{$Cliente->CliSlug}}' method='POST'  class="col-12 pull-right">
                                @method('DELETE')
                                @csrf
                                <input type="submit" id="Eliminar{{$Cliente->ID_Cli}}" style="display: none;">
                            </form>
                        @else
                            <form action='/contactos/{{$Cliente->CliSlug}}' method='POST' class="pull-right">
                                @method('DELETE')
                                @csrf
                                <input type="submit" class='btn btn-success btn-block' value="{{ trans('adminlte_lang::message.add') }}">
                            </form>
                        @endif
                    <h3 class="profile-username text-center">{{$Cliente->CliShortname}}</h3>
					
					{{-- <ul class="list-group list-group-unbordered"> --}}
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientcategoría') }}</b> <a class="pull-right">{{$Cliente->CliCategoria}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clirazonsoc') }}</b> <a class="pull-right">{{$Cliente->CliName}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b> <a class="pull-right">{{$Cliente->CliShortname}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientNIT') }}</b> <a class="pull-right">{{$Cliente->CliNit}}</a>
						</li>
					{{-- </ul> --}}
				</div>
				<div class="box-body box-profile">
                        <h3 class="profile-username text-center">{{ trans('adminlte_lang::message.sclientsede') }}</h3>
                    {{-- <ul class="list-group list-group-unbordered"> --}}
                        <li class="list-group-item">
                            <b>{{ trans('adminlte_lang::message.sclientnamesede') }}</b> <a class="pull-right">{{$Sede->SedeName}}</a>
                        </li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.phone') }}</b> <a class="pull-right">{{$Sede->SedePhone1}} - {{$Sede->SedeExt1}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.phone') }} 2</b> <a class="pull-right">{{$Sede->SedePhone2}} - {{$Sede->SedeExt2}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.email') }}</b> <a class="pull-right">{{$Sede->SedeEmail}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.mobile') }}</b> <a class="pull-right">{{$Sede->SedeCelular}}</a>
						</li>
					{{-- </ul> --}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
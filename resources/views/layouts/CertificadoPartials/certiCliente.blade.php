<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-body box-profile">
			<div class="col-md-12 col-xs-12">
				@component('layouts.partials.modal')
					@slot('slug')
						{{$certificado->cliente->ID_Cli}}
					@endslot
					@slot('textModal')
						el transportador <b>{{$certificado->cliente->CliShortname}}</b>
					@endslot
				@endcomponent
			</div>
			<h3 class="profile-username text-center">{{$certificado->cliente->CliShortname}}</h3>
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.clientcategoría') }}</b> <a class="pull-right">{{$certificado->cliente->CliCategoria}}</a>
			</li>
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.clirazonsoc') }}</b> <a class="pull-right">{{$certificado->cliente->CliName}}</a>
			</li>
			{{-- <li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b> <a class="pull-right">{{$certificado->cliente->CliShortname}}</a>
			</li> --}}
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.clientNIT') }}</b> <a class="pull-right">{{$certificado->cliente->CliNit}}</a>
			</li>
		</div>
	   	@foreach($certificado->cliente->sedes as $cliSede)
	   	@if($cliSede->ID_Sede == $certificado->sedegenerador->generadors->FK_GenerCli)
		<div class="box-body box-profile">
			<h3 class="profile-username text-center">{{ trans('adminlte_lang::message.sclientsede') }}</h3>
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.sclientnamesede') }}</b> <a class="pull-right">{{$cliSede->SedeName}}</a>
			</li>
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.address') }}</b>
				<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.adddress') }}')"><i class="far fa-copy"></i></a>
				<a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.adddress') }}" title="{{ trans('adminlte_lang::message.address') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$cliSede->SedeAddress}} ({{$cliSede->Municipios->MunName}} - {{$cliSede->Municipios->Departamento->DepartName}})</p>">{{$cliSede->SedeAddress}} ({{$cliSede->Municipios->MunName}} - {{$cliSede->Municipios->Departamento->DepartName}})</a>
			</li>
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.phone') }}</b> <a class="pull-right">{{$cliSede->SedePhone1}} - {{$cliSede->SedeExt1}}</a>
			</li>
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.phone') }} 2</b> <a class="pull-right">{{$cliSede->SedePhone2}} - {{$cliSede->SedeExt2}}</a>
			</li>
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.email') }}</b>
				<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.emailaddress') }}')"><i class="far fa-copy"></i></a>
				<a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.emailaddress') }}" title="{{ trans('adminlte_lang::message.emailaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$cliSede->SedeEmail}}</p>">{{$cliSede->SedeEmail}}</a>
			</li>
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.mobile') }}</b> <a class="pull-right">{{$cliSede->SedeCelular}}</a>
			</li>
		</div>
	</div>
	@endif
	@endforeach
</div>
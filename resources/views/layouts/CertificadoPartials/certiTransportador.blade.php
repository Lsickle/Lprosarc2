@switch($certificado->SolicitudServicio->SolSerTipo)

	@case('Cliente')
	@case('Interno')

	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body box-profile">
				<div class="col-md-12 col-xs-12">
					@component('layouts.partials.modal')
					@slot('slug')
					{{$certificado->transportador->ID_Cli}}
					@endslot
					@slot('textModal')
					el transportador <b>{{$certificado->transportador->CliShortname}}</b>
					@endslot
					@endcomponent
				</div>
				<h3 class="profile-username text-center">{{$certificado->transportador->CliShortname}}</h3>
				<li class="list-group-item">
					<b>{{ trans('adminlte_lang::message.clientcategoría') }}</b> <a class="pull-right">{{$certificado->transportador->CliCategoria}}</a>
				</li>
				<li class="list-group-item">
					<b>{{ trans('adminlte_lang::message.clirazonsoc') }}</b> <a class="pull-right">{{$certificado->transportador->CliName}}</a>
				</li>
				{{-- <li class="list-group-item">
						<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b> <a class="pull-right">{{$certificado->transportador->CliShortname}}</a>
				</li> --}}
				<li class="list-group-item">
					<b>{{ trans('adminlte_lang::message.clientNIT') }}</b> <a class="pull-right">{{$certificado->transportador->CliNit}}</a>
				</li>
			</div>
	
			<div class="box-body box-profile">
				<h3 class="profile-username text-center">{{ trans('adminlte_lang::message.sclientsede') }}</h3>
				<li class="list-group-item">
					<b>{{ trans('adminlte_lang::message.sclientnamesede') }}</b> <a class="pull-right">{{$certificado->transportador->sedes[0]->SedeName}}</a>
				</li>
				<li class="list-group-item">
					<b>{{ trans('adminlte_lang::message.address') }}</b>
					<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.adddress') }}')"><i class="far fa-copy"></i></a>
					<a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.adddress') }}" title="{{ trans('adminlte_lang::message.address') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$certificado->transportador->sedes[0]->SedeAddress}} ({{$certificado->transportador->sedes[0]->Municipios->MunName}} - {{$certificado->transportador->sedes[0]->Municipios->Departamento->DepartName}})</p>">{{$certificado->transportador->sedes[0]->SedeAddress}} ({{$certificado->transportador->sedes[0]->Municipios->MunName}} - {{$certificado->transportador->sedes[0]->Municipios->Departamento->DepartName}})</a>
				</li>
				<li class="list-group-item">
					<b>{{ trans('adminlte_lang::message.phone') }}</b> <a class="pull-right">{{$certificado->transportador->sedes[0]->SedePhone1}} - {{$certificado->transportador->sedes[0]->SedeExt1}}</a>
				</li>
				<li class="list-group-item">
					<b>{{ trans('adminlte_lang::message.phone') }} 2</b> <a class="pull-right">{{$certificado->transportador->sedes[0]->SedePhone2}} - {{$certificado->transportador->sedes[0]->SedeExt2}}</a>
				</li>
				<li class="list-group-item">
					<b>{{ trans('adminlte_lang::message.email') }}</b>
					<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.emailaddress') }}')"><i class="far fa-copy"></i></a>
					<a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.emailaddress') }}" title="{{ trans('adminlte_lang::message.emailaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$certificado->transportador->sedes[0]->SedeEmail}}</p>">{{$certificado->transportador->sedes[0]->SedeEmail}}</a>
				</li>
				<li class="list-group-item">
					<b>{{ trans('adminlte_lang::message.mobile') }}</b> <a class="pull-right">{{$certificado->transportador->sedes[0]->SedeCelular}}</a>
				</li>
			</div>
		</div>
	</div>

		@break
		
	@case('Generador')
	@case('Externo')
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body box-profile">
				<div class="col-md-12 col-xs-12">
					@component('layouts.partials.modal')
					@slot('slug')
					{{$certificado->transportador->ID_Cli}}
					@endslot
					@slot('textModal')
					el transportador <b>{{$certificado->transportador->CliShortname}}</b>
					@endslot
					@endcomponent
				</div>
				<h3 class="profile-username text-center">{{$certificado->SolicitudServicio->SolSerNameTrans}}</h3>
				<li class="list-group-item">
					<b>{{ trans('adminlte_lang::message.clientcategoría') }}</b> <a class="pull-right">Transportador Externo / Generador</a>
				</li>
				<li class="list-group-item">
					<b>{{ trans('adminlte_lang::message.clirazonsoc') }}</b> <a class="pull-right">{{$certificado->SolicitudServicio->SolSerNameTrans}}</a>
				</li>
				{{-- <li class="list-group-item">
						<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b> <a class="pull-right">{{$certificado->transportador->CliShortname}}</a>
				</li> --}}
				<li class="list-group-item">
					<b>{{ trans('adminlte_lang::message.clientNIT') }}</b> <a class="pull-right">{{$certificado->SolicitudServicio->SolSerNitTrans}}</a>
				</li>
			</div>
	
			<div class="box-body box-profile">
				<h3 class="profile-username text-center">{{ trans('adminlte_lang::message.sclientsede') }}</h3>
				<li class="list-group-item">
					<b>{{ trans('adminlte_lang::message.address') }}</b>
					<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.adddress') }}')"><i class="far fa-copy"></i></a>
					<a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.adddress') }}" title="{{ trans('adminlte_lang::message.address') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$certificado->SolicitudServicio->SolSerAdressTrans}} ({{$certificado->SolicitudServicio->municipio->MunName}} - {{$certificado->SolicitudServicio->municipio->Departamento->DepartName}})</p>">{{$certificado->SolicitudServicio->SolSerAdressTrans}} ({{$certificado->SolicitudServicio->municipio->MunName}} - {{$certificado->SolicitudServicio->municipio->Departamento->DepartName}})</a>
				</li>
			</div>
		</div>
	</div>
	
		@break
		
@endswitch
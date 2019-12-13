<div class="col-md-12">
	<div class="box box-primary">
		<div class="box-body box-profile">
			<div class="col-md-12 col-xs-12">
				@component('layouts.partials.modal')
					@slot('slug')
						{{$manifiesto->gestor->ID_Cli}}
					@endslot
					@slot('textModal')
						el transportador <b>{{$manifiesto->gestor->CliShortname}}</b>
					@endslot
				@endcomponent
			</div>
			<h3 class="profile-username text-center">{{$manifiesto->gestor->CliShortname}}</h3>
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.clientcategoría') }}</b> <a class="pull-right">{{$manifiesto->gestor->CliCategoria}}</a>
			</li>
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.clirazonsoc') }}</b> <a class="pull-right">{{$manifiesto->gestor->CliName}}</a>
			</li>
			{{-- <li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b> <a class="pull-right">{{$manifiesto->gestor->CliShortname}}</a>
			</li> --}}
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.clientNIT') }}</b> <a class="pull-right">{{$manifiesto->gestor->CliNit}}</a>
			</li>
		</div>
		<div class="box-body box-profile">
			<h3 class="profile-username text-center">{{ trans('adminlte_lang::message.sclientsede') }}</h3>
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.sclientnamesede') }}</b> <a class="pull-right">{{$manifiesto->gestor->sedes[0]->SedeName}}</a>
			</li>
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.address') }}</b>
				<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.adddress') }}')"><i class="far fa-copy"></i></a>
				<a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.adddress') }}" title="{{ trans('adminlte_lang::message.address') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$manifiesto->gestor->sedes[0]->SedeAddress}} ({{$manifiesto->gestor->sedes[0]->Municipios->MunName}} - {{$manifiesto->gestor->sedes[0]->Municipios->Departamento->DepartName}})</p>">{{$manifiesto->gestor->sedes[0]->SedeAddress}} ({{$manifiesto->gestor->sedes[0]->Municipios->MunName}} - {{$manifiesto->gestor->sedes[0]->Municipios->Departamento->DepartName}})</a>
			</li>
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.phone') }}</b> <a class="pull-right">{{$manifiesto->gestor->sedes[0]->SedePhone1}} - {{$manifiesto->gestor->sedes[0]->SedeExt1}}</a>
			</li>
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.phone') }} 2</b> <a class="pull-right">{{$manifiesto->gestor->sedes[0]->SedePhone2}} - {{$manifiesto->gestor->sedes[0]->SedeExt2}}</a>
			</li>
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.email') }}</b>
				<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('{{ trans('adminlte_lang::message.emailaddress') }}')"><i class="far fa-copy"></i></a>
				<a href="#" class="pull-right textpopover" id="{{ trans('adminlte_lang::message.emailaddress') }}" title="{{ trans('adminlte_lang::message.emailaddress') }}" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$manifiesto->gestor->sedes[0]->SedeEmail}}</p>">{{$manifiesto->gestor->sedes[0]->SedeEmail}}</a>
			</li>
			<li class="list-group-item">
				<b>{{ trans('adminlte_lang::message.mobile') }}</b> <a class="pull-right">{{$manifiesto->gestor->sedes[0]->SedeCelular}}</a>
			</li>
			<h3 class="profile-username text-center">Tratamiento</h3>
			<li class="list-group-item">
				<b>Nombre del tratamiento</b> <a class="pull-right">{{$manifiesto->tratamiento->TratName}}</a>
			</li>
		</div>
	</div>
</div>
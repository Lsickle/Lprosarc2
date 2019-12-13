<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body box-profile">
					<div class="col-md-12 col-xs-12">
						{{-- @if (in_array(Auth::user()->UsRol, Permisos::CLIENTE) ||in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
							<a href="/generadores/{{$certificado->sedegenerador->generadors->GenerSlug}}/edit" class="btn btn-warning pull-right"> <i class="fas fa-edit"></i> <b>{{ trans('adminlte_lang::message.edit') }}</b></a>
						@endif --}}
						@component('layouts.partials.modal')
							@slot('slug')
								{{$certificado->sedegenerador->generadors->GenerSlug}}
							@endslot
							@slot('textModal')
								el generador <b>{{$certificado->sedegenerador->generadors->GenerName}}</b>
							@endslot
						@endcomponent
						{{-- @if($certificado->sedegenerador->generadors->GenerDelete == 0)
							@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) ||in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
								<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$certificado->sedegenerador->generadors->GenerSlug}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i><b> {{ trans('adminlte_lang::message.delete') }}</b></a>
								<form action='/generadores/{{$certificado->sedegenerador->generadors->GenerSlug}}' method='POST'  class="col-12 pull-right">
									@method('DELETE')
									@csrf
									<input type="submit" id="Eliminar{{$certificado->sedegenerador->generadors->GenerSlug}}" style="display: none;">
								</form>
							@endif
						@else
							@if (in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) || in_array(Auth::user()->UsRol2, Permisos::PROGRAMADOR))
								<form action='/generadores/{{$certificado->sedegenerador->generadors->GenerSlug}}' method='POST' class="pull-left">
									@method('DELETE')
									@csrf
									<button type="submit" class='btn btn-success btn-block'>
										<i class="fas fa-plus-square"></i><b> {{ trans('adminlte_lang::message.add') }}</b>
									</button>
								</form>
							@endif
						@endif --}}
					</div>
					<h3 class="profile-username text-center textolargo">{{$certificado->sedegenerador->generadors->GenerName}}</h3>
					<ul class="list-group list-group-unbordered">
						{{-- @if (in_array(Auth::user()->UsRol, Permisos::TODOPROSARC) || in_array(Auth::user()->UsRol2, Permisos::TODOPROSARC))
							<li class="list-group-item">
								<b>Generador</b> 
								<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clientcliente') }}" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$certificado->sedegenerador->generadors->GenerName}}</p>">{{$certificado->sedegenerador->generadors->GenerName}}</a>
							</li>
						@endif --}}
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clirazonsoc') }}</b> 
							<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clirazonsoc') }}" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$certificado->sedegenerador->generadors->GenerName}}</p>">{{$certificado->sedegenerador->generadors->GenerName}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.sclientsede') }}</b> 
							<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.sclientsede') }}" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$certificado->sedegenerador->GSedeName}}</p>">{{$certificado->sedegenerador->GSedeName}}</a>
						</li>
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientNIT') }}</b> 
							<a href="#" class="pull-right">{{$certificado->sedegenerador->generadors->GenerNit}}</a>
						</li>
						{{-- <li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.clientnombrecorto') }}</b> 
							<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.clientnombrecorto') }}" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$certificado->sedegenerador->generadors->GenerShortname}}</p>">{{$certificado->sedegenerador->generadors->GenerShortname}}</a>
						</li> --}}
						<li class="list-group-item">
							<b>{{ trans('adminlte_lang::message.genercode') }}</b> 
							<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.genercode') }}" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$certificado->sedegenerador->generadors->GenerCode}}</p>">{{$certificado->sedegenerador->generadors->GenerCode}}</a>
						</li>
						{{-- @if (in_array(Auth::user()->UsRol, Permisos::TODOPROSARC) ||in_array(Auth::user()->UsRol2, Permisos::TODOPROSARC)) --}}
						<h4 class="text-center"><i>Datos de la Sede del Generador</i></h4>
						<div style='overflow-y:auto; max-height:300px;'>
								<li class="list-group-item col-md-12 col-xs-12">
									<div class="col-md-6 col-xs-6">
										<b class="textolargo" style="{{in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) && $certificado->sedegenerador->GSedeDelete == 1 ? 'color:red;': ''}}">{{$certificado->sedegenerador->GSedeName}}</b> 
										<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('SGeneraddress')"><i class="far fa-copy"></i></a>
									</div>
									<div>
										<p href="#" class="pull-right textpopoveraddress" id="SGeneraddress" title="<b>{{ trans('adminlte_lang::message.address') }}</b>" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$certificado->sedegenerador->GSedeAddress}} ({{$certificado->sedegenerador->municipio->MunName}}, {{$certificado->sedegenerador->municipio->Departamento->DepartName}})</p>">{{$certificado->sedegenerador->GSedeAddress}} ({{$certificado->sedegenerador->municipio->MunName}}, {{$certificado->sedegenerador->municipio->Departamento->DepartName}})</p>
									</div>
								</li>
								<li  class="list-group-item col-md-12 col-xs-12">
									<div class="col-md-6 col-xs-6">
										<b class="textolargo" style="{{in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) && $certificado->sedegenerador->GSedeDelete == 1 ? 'color:red;': ''}}">Teléfono local 1</b> 
										<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('GSedePhone1')"><i class="far fa-copy"></i></a>
									</div>
									<div>
										<p href="#" class="pull-right textpopoveraddress" id="GSedePhone1" title="<b>Teléfono local 1</b>" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$certificado->sedegenerador->GSedePhone1}}</p>">{{$certificado->sedegenerador->GSedePhone1}}</p>
									</div>
								</li>
								<li  class="list-group-item col-md-12 col-xs-12">
									<div class="col-md-6 col-xs-6">
										<b class="textolargo" style="{{in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) && $certificado->sedegenerador->GSedeDelete == 1 ? 'color:red;': ''}}">Teléfono local 2</b> 
										<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('GSedePhone2')"><i class="far fa-copy"></i></a>
									</div>
									<div>
										<p href="#" class="pull-right textpopoveraddress" id="GSedePhone2" title="<b>Teléfono local 2</b>" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$certificado->sedegenerador->GSedePhone2}}</p>">{{$certificado->sedegenerador->GSedePhone2}}</p>
									</div>
								</li>
								<li  class="list-group-item col-md-12 col-xs-12">
									<div class="col-md-6 col-xs-6">
										<b class="textolargo" style="{{in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) && $certificado->sedegenerador->GSedeDelete == 1 ? 'color:red;': ''}}">Correo Electrónico</b> 
										<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('GSedeEmail')"><i class="far fa-copy"></i></a>
									</div>
									<div>
										<p href="#" class="pull-right textpopoveraddress" id="GSedeEmail" title="<b>Correo Electrónico</b>" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$certificado->sedegenerador->GSedeEmail}}</p>">{{$certificado->sedegenerador->GSedeEmail}}</p>
									</div>
								</li>
								<li  class="list-group-item col-md-12 col-xs-12">
									<div class="col-md-6 col-xs-6">
										<b class="textolargo" style="{{in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR) && $certificado->sedegenerador->GSedeDelete == 1 ? 'color:red;': ''}}">Numero de Celular</b> 
										<a title="{{ trans('adminlte_lang::message.copy') }}" onclick="copiarAlPortapapeles('GSedeCelular')"><i class="far fa-copy"></i></a>
									</div>
									<div>
										<p href="#" class="pull-right textpopoveraddress" id="GSedeCelular" title="<b>Numero de Celular</b>" data-toggle="popover" data-trigger="hover" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$certificado->sedegenerador->GSedeCelular}}</p>">{{$certificado->sedegenerador->GSedeCelular}}</p>
									</div>
								</li>
						</div>
						{{-- @endif --}}
					</ul>
				</div>
			</div>
		</div>
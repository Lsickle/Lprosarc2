@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.personalhtmlheader_title') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.personaltitleshow') }}
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		{{-- seccion de prueba --}}
		@foreach($Personas as $Persona)
			<div class="row">
				<div class="col-md-8 col-md-offset-2 col-xs-12">
					<!-- Profile Image -->
					<div class="box box-info">
						<div class="box-body box-profile">
							@if($Persona->ID_Cli == $IDClienteSegunUsuario || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR))
								<a href="/personal/{{$Persona->PersSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{ trans('adminlte_lang::message.edit') }}</b></a>
								@if(Auth::user()->FK_UserPers <> $Persona->ID_Pers)
									@component('layouts.partials.modal')
										@slot('slug')
											{{$Persona->ID_Pers}}
										@endslot
										@slot('textModal')
											a <b>{{$Persona->PersFirstName."  ".$Persona->PersLastName}}</b>
										@endslot
									@endcomponent
									@if($Persona->PersDelete == 0)
									  <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Persona->ID_Pers}}'  class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i><b> {{ trans('adminlte_lang::message.delete') }}</b></a>
									  <form action='/personal/{{$Persona->PersSlug}}' method='POST'>
										  @method('DELETE')
										  @csrf
										  <input  type="submit" id="Eliminar{{$Persona->ID_Pers}}" style="display: none;">
									  </form>
									@else
									  <form action='/personal/{{$Persona->PersSlug}}' method='POST' class="pull-left">
										@method('DELETE')
										@csrf
										<button type="submit" class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.add') }}</button>
									  </form>
									@endif
								@endif
							@endif
							<div class="col-md-12">
								<h3 class="profile-username text-center">{{$Persona->PersFirstName."  ".$Persona->PersLastName}}</h3>
							</div>
							<p class="text-muted text-center">{{$Persona->SedeName}}</p>
							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<b>{{ trans('adminlte_lang::message.persdocument') }}</b> <a class="pull-right textpopover">{{$Persona->PersDocType." ".$Persona->PersDocNumber}}</a>
								</li>
								<li class="list-group-item">
									<b>{{ trans('adminlte_lang::message.address') }}</b> <a title="Copiar" onclick="copiarAlPortapapeles('addresscopy')"><i class="far fa-copy"></i></a>
									<a href="#" class="pull-right textpopover" title='{{ trans('adminlte_lang::message.address') }} ' data-toggle="popover" id="addresscopy" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Persona->PersAddress}}</p>">{{$Persona->PersAddress <> null ? $Persona->PersAddress : 'N/A'}}</a>
								</li>
								<li class="list-group-item">
									<b>{{ trans('adminlte_lang::message.personalcarg') }}</b> <a class="pull-right textpopover">{{$Persona->CargName}}</a>
								</li>
								<li class="list-group-item">
									<b>{{ trans('adminlte_lang::message.mobile') }}</b> <a class="pull-right textpopover">{{$Persona->PersCellphone}}</a>
								</li>
								<li class="list-group-item">
									<b>{{ trans('adminlte_lang::message.emailaddress') }}</b> <a title="Copiar" onclick="copiarAlPortapapeles('correocopy')"><i class="far fa-copy"></i></a>
									<a href="#" class="pull-right textpopover" title="{{ trans('adminlte_lang::message.emailaddress') }}" data-toggle="popover" id="correocopy" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Persona->PersEmail}}</p>">{{$Persona->PersEmail}}</a>
								</li>
							</ul>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
			</div>
		@endforeach
		<!-- /.row -->
	</div>
@endsection
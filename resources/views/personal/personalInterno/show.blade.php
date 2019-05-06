@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.personalhtmlheader_title') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.personaltitleshow') }}
@endsection
@section('main-content')
	<div class="container-fluid spark-screen">
		@foreach($Personas as $Persona)
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="box box-primary">
						<div class="box-body box-profile">
							<div class="col-md-12 col-xs-12">
								<a href="/personalInterno/{{$Persona->PersSlug}}/edit" class="btn btn-warning pull-right"><b>{{ trans('adminlte_lang::message.edit') }}</b></a>
								@if(Auth::user()->FK_UserPers <> $Persona->ID_Pers)
									@component('layouts.partials.modal')
									{{$Persona->ID_Pers}}
									@endcomponent
									@if($Persona->PersDelete == 0)
									  <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Persona->ID_Pers}}'  class='btn btn-danger pull-left'>{{ trans('adminlte_lang::message.delete') }}</a>
									  <form action='/personalInterno/{{$Persona->PersSlug}}' method='POST'>
									      @method('DELETE')
									      @csrf
									      <input  type="submit" id="Eliminar{{$Persona->ID_Pers}}" style="display: none;">
									  </form>
									@else
									  <form action='/personalInterno/{{$Persona->PersSlug}}' method='POST'>
									    @method('DELETE')
									    @csrf
									    <input type="submit" class='btn btn-success pull-left' value="{{ trans('adminlte_lang::message.add') }}">
									  </form>
									@endif
								@endif
							</div>
							<h3 class="profile-username text-center">{{$Persona->PersFirstName."  ".$Persona->PersLastName}}</h3>
							<p class="text-muted text-center">{{$Persona->SedeName}}</p>
							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<b>{{ trans('adminlte_lang::message.persdocument') }}</b> <a class="pull-right textpopover">{{$Persona->PersDocType." ".$Persona->PersDocNumber}}</a>
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
				<div class="col-md-6 col-xs-12">
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#activity" data-toggle="tab">{{ trans('adminlte_lang::message.persdataof').$Persona->PersFirstName}}</a></li>
						</ul>
						<div class="tab-content">
							<div class="active tab-pane" id="activity">
								<div class="post">
									<div class="row">
										<div class="col-md-6 col-xs-12">
											<label>{{ trans('adminlte_lang::message.persingreso') }}</label><h5><a>{{$Persona->PersIngreso <> null ? $Persona->PersIngreso : 'N/A'}}</a></h5>
										</div>
										<div class="col-md-6 col-xs-12">
											<label>{{ trans('adminlte_lang::message.perssalida') }}</label><h5><a>{{$Persona->PersSalida <> null ? $Persona->PersSalida : 'N/A'}}</a></h5>
										</div>
										<div class="col-md-6 col-xs-12">
											<label>{{ trans('adminlte_lang::message.address') }}</label> <a title="Copiar" onclick="copiarAlPortapapeles('addresscopy')"><i class="far fa-copy"></i></a>
											<h5><a href="#" class="textpopover" title='{{ trans('adminlte_lang::message.address') }} ' data-toggle="popover" id="addresscopy" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Persona->PersAddress}}</p>">{{$Persona->PersAddress <> null ? $Persona->PersAddress : 'N/A'}}</a></h5>
										</div>
										<div class="col-md-6 col-xs-12">
											<label>{{ trans('adminlte_lang::message.personalcarg') }}</label><h5><a>{{$Persona->CargName}}</a></h5>
										</div>
										<div class="col-md-6 col-xs-12">
											<label>{{ trans('adminlte_lang::message.phone') }}</label><h5><a>{{$Persona->PersPhoneNumber <> null ? $Persona->PersPhoneNumber : 'N/A' }}</a></h5>
										</div>
										<div class="col-md-6 col-xs-12">
											<label>{{ trans('adminlte_lang::message.persbirthday') }}</label><h5><a>{{$Persona->PersBirthday <> null ? $Persona->PersBirthday : 'N/A'}}</a></h5>
										</div>
										<div class="col-md-6 col-xs-12">
											<label>{{ trans('adminlte_lang::message.perseps') }}</label><h5><a>{{$Persona->PersEPS <> null ? $Persona->PersEPS : 'N/A'}}</a></h5>
										</div>
										<div class="col-md-6 col-xs-12">
											<label>{{ trans('adminlte_lang::message.persarl') }}</label><h5><a>{{$Persona->PersARL <> null ? $Persona->PersARL : 'N/A'}}</a></h5>
										</div>
										<div class="col-md-6 col-xs-12">
											<label>{{ trans('adminlte_lang::message.persbank') }}</label><h5><a>{{$Persona->PersBank <> null ? $Persona->PersBank : 'N/A'}}</a></h5>
										</div>
										<div class="col-md-6 col-xs-12">
											<label>{{ trans('adminlte_lang::message.persbankaccaunt') }}</label><h5><a>{{$Persona->PersBankAccaunt <> null ? $Persona->PersBankAccaunt : 'N/A'}}</a></h5>
										</div>
										<div class="col-md-6 col-xs-12">
											<label>{{ trans('adminlte_lang::message.perslibreta') }}</label><h5><a>{{$Persona->PersLibreta <> null ? $Persona->PersLibreta : 'N/A'}}</a></h5>
										</div>
										<div class="col-md-6 col-xs-12">
											<label>{{ trans('adminlte_lang::message.perspase') }}</label><h5><a>{{$Persona->PersPase <> null ? $Persona->PersPase : 'N/A'}}</a></h5>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
@endsection
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
				<div class="col-md-12" {{-- style="font-size: 2rem;" --}}>
					<!-- Profile Image -->
					<div class="box box-primary">
						<div class="box-body box-profile">
							@if($Persona->ID_Cli == $IDClienteSegunUsuario || Auth::user()->UsRol == trans('adminlte_lang::message.Programador'))
								<a href="/personal/{{$Persona->PersSlug}}/edit" class="btn btn-success pull-right"><b>{{ trans('adminlte_lang::message.edit') }}</b></a>
								@if(Auth::user()->FK_UserPers <> $Persona->ID_Pers)
									@component('layouts.partials.modal')
									{{$Persona->ID_Pers}}
									@endcomponent
									@if($Persona->PersDelete == 0)
									  <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Persona->ID_Pers}}'  class='btn btn-danger pull-left'>{{ trans('adminlte_lang::message.delete') }}</a>
									  <form action='/personal/{{$Persona->PersSlug}}' method='POST'>
									      @method('DELETE')
									      @csrf
									      <input  type="submit" id="Eliminar{{$Persona->ID_Pers}}" style="display: none;">
									  </form>
									@else
									  <form action='/personal/{{$Persona->PersSlug}}' method='POST'>
									    @method('DELETE')
									    @csrf
									    <input type="submit" class='btn btn-success pull-left' value="{{ trans('adminlte_lang::message.add') }}">
									  </form>
									@endif
								@endif
							@endif
							<h3 class="profile-username text-center">{{$Persona->PersFirstName."  ".$Persona->PersLastName}}</h3>
							<p class="text-muted text-center">{{$Persona->SedeName}}</p>
							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<b>{{ trans('adminlte_lang::message.persdocument') }}</b> <a class="pull-right textpopover">{{$Persona->PersDocType." ".$Persona->PersDocNumber}}</a>
								</li>
								<li class="list-group-item">
									<b>{{ trans('adminlte_lang::message.address') }}</b> <a href="#" class="pull-right textpopover" title="Dirección" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Persona->PersAddress}}</p>">{{$Persona->PersAddress}}</a>
								</li>
								<li class="list-group-item">
									<b>{{ trans('adminlte_lang::message.personalcarg') }}</b> <a class="pull-right textpopover">{{$Persona->CargName}}</a>
								</li>
								<li class="list-group-item">
									<b>{{ trans('adminlte_lang::message.mobile') }}</b> <a class="pull-right textpopover">{{$Persona->PersCellphone}}</a>
								</li>
								<li class="list-group-item">
									<b>{{ trans('adminlte_lang::message.emailaddress') }}</b> <a href="#" class="pull-right textpopover" title="Correo Electronico" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Persona->PersEmail}}</p>">{{$Persona->PersEmail}}</a>
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
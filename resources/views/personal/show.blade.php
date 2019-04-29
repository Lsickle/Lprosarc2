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
				@if(Auth::user()->UsRol == 'Cliente' && $Persona->ID_Cli <> 1)
					<div class="col-md-12" {{-- style="font-size: 2rem;" --}}>
				@else
					<div class="col-md-6">
				@endif
					<!-- Profile Image -->
					<div class="box box-primary">
						<div class="box-body box-profile">
							@if($Persona->ID_Cli == $IDClienteSegunUsuario || Auth::user()->UsRol == 'Programador')
								<a href="/personal/{{$Persona->PersSlug}}/edit" class="btn btn-success pull-right"><b>Editar</b></a>
								@if(Auth::user()->FK_UserPers <> $Persona->ID_Pers)
									@component('layouts.partials.modal')
									{{$Persona->ID_Pers}}
									@endcomponent
									@if($Persona->PersDelete == 0)
									  <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Persona->ID_Pers}}'  class='btn btn-danger pull-left'>Eliminar</a>
									  <form action='/personal/{{$Persona->PersSlug}}' method='POST'>
									      @method('DELETE')
									      @csrf
									      <input  type="submit" id="Eliminar{{$Persona->ID_Pers}}" style="display: none;">
									  </form>
									@else
									  <form action='/personal/{{$Persona->PersSlug}}' method='POST'>
									    @method('DELETE')
									    @csrf
									    <input type="submit" class='btn btn-success pull-left' value="Añadir">
									  </form>
									@endif
								@endif
							@endif
							<h3 class="profile-username text-center">{{$Persona->PersFirstName."  ".$Persona->PersLastName}}</h3>
							<p class="text-muted text-center">{{$Persona->SedeName}}</p>
							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<b>Documento</b> <a class="pull-right textpopover">{{$Persona->PersDocType." ".$Persona->PersDocNumber}}</a>
								</li>
							@if(Auth::user()->UsRol == 'Cliente' && $Persona->ID_Cli <> 1)
								<li class="list-group-item">
									<b>Dirección</b> <a href="#" class="pull-right textpopover" title="Dirección" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Persona->PersAddress}}</p>">{{$Persona->PersAddress}}</a>
								</li>
								<li class="list-group-item">
									<b>Cargo</b> <a class="pull-right textpopover">{{$Persona->CargName}}</a>
								</li>
							@endif
								<li class="list-group-item">
									<b>Telefono</b> <a class="pull-right textpopover">{{$Persona->PersCellphone}}</a>
								</li>
								<li class="list-group-item">
									<b>Correo Electronico</b> <a href="#" class="pull-right textpopover" title="Correo Electronico" data-toggle="popover" data-trigger="focus" data-html="true" data-placement="bottom" data-content="<p class='textolargo'>{{$Persona->PersEmail}}</p>">{{$Persona->PersEmail}}</a>
								</li>
							</ul>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
				<!-- /.col -->
				@if(Auth::user()->UsRol == 'Programador' || Auth::user()->UsRol == 'Administrador' && $Persona->ID_Cli == 1)
					<div class="col-md-6">
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#activity" data-toggle="tab">Datos de {{$Persona->PersFirstName}}</a></li>
							</ul>
							<div class="tab-content">
								<div class="active tab-pane" id="activity">
									<!-- Post -->
									<div class="post">
										<!-- /.user-block -->
										<div class="row">
											<div class="col-md-6">
												<label>Fecha de Ingreso</label><h5>{{$Persona->PersIngreso <> null ? $Persona->PersIngreso : 'N/A'}}</h5>
											</div>
											<div class="col-md-6">
												<label>Fecha de Salida</label><h5>{{$Persona->PersSalida <> null ? $Persona->PersSalida : 'N/A'}}</h5>
											</div>
											<div class="col-md-6">
												<label>Dirección</label><h5>{{$Persona->PersAddress <> null ? $Persona->PersAddress : 'N/A'}}</h5>
											</div>
											<div class="col-md-6">
												<label>Cargo</label><h5>{{$Persona->CargName}}</h5>
											</div>
											<div class="col-md-6">
												<label>Teléfono Local</label><h5>{{$Persona->PersPhoneNumber <> null ? $Persona->PersPhoneNumber : 'N/A' }}</h5>
											</div>
											<div class="col-md-6">
												<label>Fecha de Nacimiento</label><h5>{{$Persona->PersBirthday <> null ? $Persona->PersBirthday : 'N/A'}}</h5>
											</div>
											<div class="col-md-6">
												<label>EPS</label><h5>{{$Persona->PersEPS <> null ? $Persona->PersEPS : 'N/A'}}</h5>
											</div>
											<div class="col-md-6">
												<label>ARL</label><h5>{{$Persona->PersARL <> null ? $Persona->PersARL : 'N/A'}}</h5>
											</div>
											<div class="col-md-6">
												<label>Banco</label><h5>{{$Persona->PersBank <> null ? $Persona->PersBank : 'N/A'}}</h5>
											</div>
											<div class="col-md-6">
												<label>Numero de Cuenta</label><h5>{{$Persona->PersBankAccaunt <> null ? $Persona->PersBankAccaunt : 'N/A'}}</h5>
											</div>
											<div class="col-md-6">
												<label>Numero Libreta Militar</label><h5>{{$Persona->PersLibreta <> null ? $Persona->PersLibreta : 'N/A'}}</h5>
											</div>
											<div class="col-md-6">
												<label>Numero Licencia de Conducir</label><h5>{{$Persona->PersPase <> null ? $Persona->PersPase : 'N/A'}}</h5>
											</div>
										</div>
									</div>
									<!-- /.post -->
								</div>
							</div>
							<!-- /.tab-content -->
						</div>
						<!-- /.nav-tabs-custom -->
					</div>
				@endif
				<!-- /.col -->
			</div>
		@endforeach
		<!-- /.row -->
	</div>
@endsection
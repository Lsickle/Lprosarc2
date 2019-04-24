@extends('layouts.app')
@section('htmlheader_title','Personal')
@section('contentheader_title', '')
@section('main-content')
	<div class="container-fluid spark-screen">
		{{-- seccion de prueba --}}
		@foreach($Personas as $Persona)
			<div class="row">
				@if(Auth::user()->UsRol == 'Cliente')
					<div class="col-md-8" style="margin-left: 15%;">
				@else
					<div class="col-md-6">
				@endif
					<!-- Profile Image -->
					<div class="box box-primary">
						<div class="box-body box-profile">
							<a href="/personal/{{$Persona->PersSlug}}/edit" class="btn btn-success pull-right"><b>Editar</b></a>
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
							<img class="profile-user-img img-responsive img-circle" src="/img/robot400x400.gif" alt="User profile picture">
							<h3 class="profile-username text-center">{{$Persona->PersFirstName."  ".$Persona->PersLastName}}</h3>
							<p class="text-muted text-center">{{$Persona->CargName}}</p>
							<ul class="list-group list-group-unbordered">
								<li class="list-group-item">
									<b>Documento</b> <a class="pull-right">{{$Persona->PersDocType." ".$Persona->PersDocNumber}}</a>
								</li>
								<li class="list-group-item">
									<b>Telefono</b> <a class="pull-right">{{$Persona->PersCellphone}}</a>
								</li>
								<li class="list-group-item">
									<b>Correo Electronico</b> <a class="pull-right">{{$Persona->PersEmail}}</a>
								</li>
							@if(Auth::user()->UsRol == 'Cliente')
								<li class="list-group-item">
									<b>Dirección</b> <a class="pull-right">{{$Persona->PersAddress <> null ? $Persona->PersAddress : 'No se encontró registro'}}</a>
								</li>
							@endif
							</ul>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
				<!-- /.col -->
				@if(Auth::user()->UsRol == 'Programador' || Auth::user()->UsRol == 'Administrador')
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
												<label>Fecha de Ingreso</label><h5>{{$Persona->PersIngreso <> null ? $Persona->PersIngreso : 'No se encontró registro'}}</h5>
											</div>
											<div class="col-md-6">
												<label>Fecha de Salida</label><h5>{{$Persona->PersSalida <> null ? $Persona->PersSalida : 'No se encontró registro'}}</h5>
											</div>
											<div class="col-md-6">
												<label>Dirección</label><h5>{{$Persona->PersAddress <> null ? $Persona->PersAddress : 'No se encontró registro'}}</h5>
											</div>
											<div class="col-md-6">
												<label>Teléfono Local</label><h5>{{$Persona->PersPhoneNumber <> null ? $Persona->PersPhoneNumber : 'No se encontró registro' }}</h5>
											</div>
											<div class="col-md-6">
												<label>EPS</label><h5>{{$Persona->PersEPS <> null ? $Persona->PersEPS : 'No se encontró registro'}}</h5>
											</div>
											<div class="col-md-6">
												<label>ARL</label><h5>{{$Persona->PersARL <> null ? $Persona->PersARL : 'No se encontró registro'}}</h5>
											</div>
											<div class="col-md-6">
												<label>Banco</label><h5>{{$Persona->PersBank <> null ? $Persona->PersBank : 'No se encontró registro'}}</h5>
											</div>
											<div class="col-md-6">
												<label>Numero de Cuenta</label><h5>{{$Persona->PersBankAccaunt <> null ? $Persona->PersBankAccaunt : 'No se encontró registro'}}</h5>
											</div>
											<div class="col-md-6">
												<label>Numero Libreta Militar</label><h5>{{$Persona->PersLibreta <> null ? $Persona->PersLibreta : 'No se encontró registro'}}</h5>
											</div>
											<div class="col-md-6">
												<label>Numero Licencia de Conducir</label><h5>{{$Persona->PersPase <> null ? $Persona->PersPase : 'No se encontró registro'}}</h5>
											</div>
											<div class="col-md-6">
												<label>Fecha de Nacimiento</label><h5>{{$Persona->PersBirthday <> null ? $Persona->PersBirthday : 'No se encontró registro'}}</h5>
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
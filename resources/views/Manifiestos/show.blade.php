@extends('layouts.app')
@section('htmlheader_title')
	Manifiesto
@endsection
@section('contentheader_title')
	<span style="background-image: linear-gradient(40deg, #FF856D, #CC0000); padding-right:30vw; position:relative; overflow:hidden;">
		Manifiesto
	  <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
	</span>
@endsection
@section('main-content')
@component('layouts.partials.modal')
	@slot('slug')

	@endslot
	@slot('textModal')
		El manifiesto <b>N° </b>
	@endslot
@endcomponent
<div class="container-fluid spark-screen">
	<!-- form start -->
		{{-- <input hidden type="text" name="updated_by" value="{{Auth::user()->email}}"> --}}
			<!-- col md3 -->
			<div class="col-md-3">
				<!-- box -->
				<div class="box box-primary">
					<!-- box body -->
					<div class="box-body box-profile">
						{{-- <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> --}}
						<h3 class="profile-username text-center">Nombre del generador</h3>
						<p class="text-muted text-center">Tratamiento</p>
						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Servicio #</b> <a class="pull-right">xxxx</a>
							</li>
							<li class="list-group-item">
								<b>certificado #</b> <a class="pull-right">xxxx</a>
							</li>
							
							<li class="list-group-item">
								<label>Observaciones</label>
								<textarea style="resize: vertical;" maxlength="250" name="RespelStatusDescription" id="taid" class="form-control" rows ="5">observaciones de la base de datos</textarea>
							</li>
							<li class="list-group-item">
								<b>Firma HSEQ</b> <a class="pull-right"><i class='fas fa-signature'></i></a>
							</li>
							<li class="list-group-item">
								<b>Firma JO</b> <a class="pull-right"><i class='fas fa-signature'></i></a>
							</li>
							<li class="list-group-item">
								<b>Firma JL</b> <a class="pull-right"><i class='fas fa-signature'></i></a>
							</li>
							<li class="list-group-item">
								<b>Firma DP</b> <a class="pull-right"><i class='fas fa-signature'></i></a>
							</li>
							<li class="list-group-item" style="display: block; overflow: auto";>
								<div class="col-md-12 form-group">
									<label>documento</label>
									<div class="input-group">
										<input type="text" class="form-control" value="Ver Documento" disabled>
										<div class="input-group-btn">
											<a method='get' href='/img/HojaSeguridad/' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
										</div>
									</div>	
								</div>
							</li>
							<li class="list-group-item" style="display: block; overflow: auto";>
								<div class="col-md-12 form-group">
									<label>Anexos</label>
									<div class="input-group">
										<input type="text" class="form-control" value="Ver Documento" disabled>
										<div class="input-group-btn">
											<a method='get' href='/img/HojaSeguridad/' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
										</div>
									</div>	
								</div>
							</li>
							
						</ul>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box body -->
			</div>
			<!-- /.col md3 -->
			<!-- col md9 -->
			<div class="col-md-9">
				<!-- box -->
				<div class="box">
					<!-- box header -->
					<div class="box-header with-border">
						<h3 class="box-title">Información para generar Manifiesto</h3>
						<div class="box-tools pull-right">
							{{-- @if(in_array(Auth::user()->UsRol, Permisos::JefeOperaciones)||in_array(Auth::user()->UsRol2, Permisos::JefeOperaciones))
								@switch()
									@case('Revisado')
									@case('Evaluado')
									@case('Cotizado')
									@case('Aprobado')
									@case('Vencido')
										<a method='get' style="margin-right: 1em;" href='/clientToRp/{{$Respels->RespelSlug}}' data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Copiar información del residuo</b>" data-content="<p style='width: 50%'>Haga click en este boton para copiar la información de este residuo y crear uno nuevo, el cual quedara disponible en la lista de residuos comunes para que otros clientes puedan utilizarlo </p>" class='btn btn-primary'><i class='fas fa-lg fa-copy'></i> Firmar</a>
										@break
									@case('Falta TDE')
									@case('Pendiente')
									@case('Incompleto')
									@case('Rechazado')
										<a disabled method='get' style="margin-right: 1em;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Copiar información del residuo</b>" data-content="<p style='width: 50%'>Este residuo aun no cumple con las condiciones para incluirlo en la lista de residuos comunes </p>" class='btn btn-default'><i class='fas fa-lg fa-copy'></i> Firmar</a>
										@break
									@default
										<a disabled method='get' style="margin-right: 1em;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Copiar información del residuo</b>" data-content="<p style='width: 50%'>Este residuo aun no cumple con las condiciones para incluirlo en la lsta de residuos comunes </p>" class='btn btn-default'><i class='fas fa-lg fa-copy'></i> Firmar</a>
								@endswitch
							@endif --}}
							
							<a disabled method='get' style="margin-right: 1em;" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Copiar información del residuo</b>" data-content="<p style='width: 50%'>Este residuo aun no cumple con las condiciones para incluirlo en la lsta de residuos comunes </p>" class='btn btn-default'><i class='fas fa-lg fa-copy'></i> Editar</a>
						</div>
					</div>

					<!-- /.box header -->
					<!-- box body -->
					<div class="box-body">
						<!-- nav-tabs-custom -->
						<div class="nav-tabs-custom" style="box-shadow:3px 3px 5px grey; margin-bottom: 0px;">
							<ul class="nav nav-tabs">
								<li class="nav-item">
									<a class="nav-link" href="#Generadorpane" data-toggle="tab">Generador</a>
								</li>
								<li class="nav-item active">
									<a class="nav-link" href="#Residuospane" data-toggle="tab">Residuos</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#Transportadorpane" data-toggle="tab">Transportador</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#Clientepane" data-toggle="tab">Cliente</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#Gestorpane" data-toggle="tab">Gestor-Tratamiento</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#Anexospane" data-toggle="tab">Anexos</a>
								</li>
							</ul>
							<!-- nav-content -->
							<div class="tab-content" style="display: block; overflow: auto;">
								<!-- tab-pane fade -->
								<div class="tab-pane fade" id="Generadorpane">
									{{-- @include('layouts.respel-cliente.respel-residuo') --}}
								</div>
								<!-- /.tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade in active" id="Residuospane">
									{{-- @include('layouts.respel-comercial.respel-tratamiento') --}}
								</div>
								<!-- tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade" id="Transportadorpane">
									{{-- @include('layouts.respel-comercial.respel-pretrat') --}}
								</div>
								<!-- tab-pane fade -->
								<!-- /.tab-pane fade -->
								<div class="tab-pane fade" id="Clientepane">
									{{-- @include('layouts.respel-comercial.respel-requerimiento') --}}
								</div>
								<!-- /.tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade" id="Gestorpane">
									{{-- @include('layouts.respel-comercial.respel-tarifas') --}}
								</div>
								<div class="tab-pane fade" id="Anexospane">
									{{-- @include('layouts.respel-comercial.respel-tarifas') --}}
								</div>

								<div id="modalrango"></div>
								<!-- /.tab-pane fade -->
							</div>
							<!-- /.tab-content -->
						</div>
					</div>
					<!-- /.box body -->
					<div class="box-footer">

					</div>
					<!-- /.nav-tabs-custom -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col md9 -->
		<!-- /.row -->
</div>
@endsection
@section('NewScript')
@endsection
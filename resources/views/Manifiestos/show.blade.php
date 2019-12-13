@extends('layouts.app')
@section('htmlheader_title')
	Manifiesto
@endsection
@section('contentheader_title')
	<span style="background-image: linear-gradient(40deg, #F1B378, #D66841); padding-right:30vw; position:relative; overflow:hidden;">
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
						<h3 class="profile-username text-center">{{$manifiesto->sedegenerador->generadors->GenerName}}</h3>
						<p class="text-muted text-center">{{$manifiesto->tratamiento->TratName}}</p>
						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Servicio #</b> <a class="pull-right">{{$manifiesto->FK_ManifSolser}}</a>
							</li>
							<li class="list-group-item">
								<b>manifiesto #</b> <a class="pull-right">{{$manifiesto->ID_Manif}}</a>
							</li>
							
							<li class="list-group-item">
								<label>Observaciones</label>
								<textarea style="resize: vertical;" maxlength="250" name="RespelStatusDescription" id="taid" class="form-control" rows ="5">{{$manifiesto->ManifObservacion}}</textarea>
							</li>
							<li class="list-group-item">
								<b>Firma HSEQ</b> <a class="pull-right">@if($manifiesto->ManifAuthHseq === 1)<i class='fas fa-signature'></i>@endif</a>
							</li>
							{{-- <li class="list-group-item">
								<b>Firma JO</b> <a class="pull-right">{{ $manifiesto->ManifAuthJo === 1 ? "<i class='fas fa-signature'></i>" : "" }}</a>
							</li> --}}
							<li class="list-group-item">
								<b>Firma JL</b> <a class="pull-right">@if($manifiesto->ManifAuthJl === 1)<i class='fas fa-signature'></i>@endif</a>
							</li>
							<li class="list-group-item">
								<b>Firma DP</b> <a class="pull-right">@if($manifiesto->ManifAuthDp === 1)<i class='fas fa-signature'></i>@endif</a>
							</li>
							<li class="list-group-item" style="display: block; overflow: auto";>
								<div class="col-md-12 form-group">
									<label>documento</label>
									<div class="input-group">
										<input type="text" class="form-control" value="Ver Documento" disabled>
										<div class="input-group-btn">
											@if($manifiesto->ManifSrc == 'ManifiestoDefault.pdf')
											<a class='btn btn-default'><i class='fas fa-file-pdf fa-lg'></i></a>
											@else
											<a method='get' href='/img/Manifiestos/{{$manifiesto->ManifSrc}}' target='_blank' class='btn btn-success'><i class='fas fa-file-pdf fa-lg'></i></a>
											@endif
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
							@if (in_array(Auth::user()->UsRol, Permisos::EDITMANIFCERT) ||in_array(Auth::user()->UsRol, Permisos::EDITMANIFCERT))
								<a href="/manifiestos/{{$manifiesto->ManifSlug}}/edit" class="btn btn-warning pull-right"> <i class="fas fa-edit"></i> <b>{{ trans('adminlte_lang::message.edit') }}</b></a>
							@endif
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
									@include('layouts.ManifiestoPartials.manifGenerador')
								</div>
								<!-- /.tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade in active" id="Residuospane">
									@include('layouts.ManifiestoPartials.manifResiduos')
								</div>
								<!-- tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade" id="Transportadorpane">
									@include('layouts.ManifiestoPartials.manifTransportador')
								</div>
								<!-- tab-pane fade -->
								<!-- /.tab-pane fade -->
								<div class="tab-pane fade" id="Clientepane">
									@include('layouts.ManifiestoPartials.manifCliente')
								</div>
								<!-- /.tab-pane fade -->
								<!-- tab-pane fade -->
								<div class="tab-pane fade" id="Gestorpane">
									@include('layouts.ManifiestoPartials.manifGestorTratamiento')
								</div>
								<div class="tab-pane fade" id="Anexospane">
									{{-- @include('layouts.ManifiestoPartials.respel-tarifas') --}}
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
@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solser') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.solser') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-12" >
						@if(($SolSer->SolSerStatus <> 'Pendiente' && $SolSer->SolSerStatus <> 'Aprobado' && $SolSer->SolSerStatus <> 'Aceptado') && (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE)))
							<h4 class="col-md-6">{{trans('adminlte_lang::message.solrestitleclientepart1')}} <b>{{trans('adminlte_lang::message.update')}}</b> {{trans('adminlte_lang::message.o')}} <b>{{trans('adminlte_lang::message.delete')}}</b> {{trans('adminlte_lang::message.solrestitleclientepart2')}}
								@switch($SolSer->SolSerStatus)
									@case('Programado')
										{{trans('adminlte_lang::message.solresProgramador')}}
										@break
									@case('Completado')
										{{trans('adminlte_lang::message.solresCompletado')}}
										@break
									@case('No Conciliado')
										{{trans('adminlte_lang::message.solresNoConciliadotext')}}
										@break
									@case('Conciliado')
										{{trans('adminlte_lang::message.solresConciliadotext')}}
										@break
									@case('Tratado')
										{{trans('adminlte_lang::message.solresTratado')}}
										@break
									@case('Certificacion')
										{{trans('adminlte_lang::message.solresCertificado')}}
										@break
								@endswitch
							</h4>
						@endif
						@if(($SolSer->SolSerStatus === 'Pendiente' || $SolSer->SolSerStatus === 'Aprobado' || $SolSer->SolSerStatus === 'Aceptado') && (in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE)))
							<a href="/solicitud-residuo/{{$SolRes->SolResSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
						@endif
						@php
							switch ($SolRes->SolResTypeUnidad) {
								case 'Unidad':
									$TypeUnidad = 'Unidad(es)';
									break;
								case 'Litros':
									$TypeUnidad = 'Litro(s)';
									break;
								default:
									$TypeUnidad = 'Kilogramos';
									break;
							}
						@endphp
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 ">
						<div class="box box-info">
							<div class="col-md-12">
								<div class="col-md-12 border-gray">
									<center><h3><b>{{$Respel->RespelName}}</b></h3></center><br>
								</div>
								<div class="col-md-16">
									<div class="col-md-4 border-gray">
										<label>{{trans('adminlte_lang::message.solrestypeunity')}}</label><br>
										<a>{{$SolRes->SolResTypeUnidad === Null ? 'N/A' : $SolRes->SolResTypeUnidad}}</a>
									</div>
									<div class="col-md-4 border-gray">
										<label>{{trans('adminlte_lang::message.solrescantunity')}}</label><br>
										<a>{{$SolRes->SolResCantiUnidad === Null ? 'N/A' : $SolRes->SolResCantiUnidad}}</a>
									</div>
									<div class="col-md-4 border-gray">
										<label>{{trans('adminlte_lang::message.solresembalaje')}}</label><br>
										<a>{{$SolRes->SolResEmbalaje}}</a>
									</div>
								</div>
								<div class="col-md-4 border-gray" id="kgenviados">
									<label>{{trans('adminlte_lang::message.solresenviado')}}</label><br>
									<a>{{$SolRes->SolResKgEnviado}}</a>
								</div>
								
								<div class="col-md-4 border-gray" id="kgresividos">
									<label>{{trans('adminlte_lang::message.solresresivido')}}</label><br>
									<a>{{$SolRes->SolResKgRecibido  === Null ? 'N/A' : $SolRes->SolResKgRecibido}}</a>
								</div>

								@if(($SolRes->SolResTypeUnidad === 'Litros' || $SolRes->SolResTypeUnidad === 'Unidad'))
									<div class="col-md-4 border-gray" id="unidadrecibida">
										<label>{{$TypeUnidad}} Recibidos(a)</label><br>
										<a>{{$SolRes->SolResCantiUnidadRecibida  === Null ? 'N/A' : $SolRes->SolResCantiUnidadRecibida}}</a>
									</div>
								@endif
								<div class="col-md-4 border-gray" id="kgconciliados">
									<label>{{$TypeUnidad}} Conciliados(a)</label><br>
									@if($SolRes->SolResTypeUnidad === 'Litros' || $SolRes->SolResTypeUnidad === 'Unidad')
										<a>{{$SolRes->SolResCantiUnidadConciliada  === Null ? 'N/A' : $SolRes->SolResCantiUnidadConciliada}}</a>
									@else
										<a>{{$SolRes->SolResKgConciliado === Null ? 'N/A' : $SolRes->SolResKgConciliado}}</a>
									@endif
								</div>
								<div class="col-md-4 border-gray">
									<label>{{trans('adminlte_lang::message.solresalto')}}</label><br>
									<a>{{$SolRes->SolResAlto === Null ? 'N/A' : $SolRes->SolResAlto}}</a>
								</div>
								<div class="col-md-4 border-gray">
									<label>{{trans('adminlte_lang::message.solresancho')}}</label><br>
									<a>{{$SolRes->SolResAncho === Null ? 'N/A' : $SolRes->SolResAncho}}</a>
								</div>
								<div class="col-md-4 border-gray">
									<label>{{trans('adminlte_lang::message.solresProfundo')}}</label><br>
									<a>{{$SolRes->SolResProfundo === Null ? 'N/A' : $SolRes->SolResProfundo}}</a>
								</div>
							</div>
							<div class="col-md-12 border-gray">
								<center><h4>{{trans('adminlte_lang::message.requirements')}}</h4><center>
								<div class="col-md-2" style="text-align: center; margin-top: 20px;">
									<label data-trigger="hover" data-toggle="popover" title="<b>Foto-Descargue</b>" data-content="<p> Se requiere registro fotografico del proceso de descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>" for="SolResFotoDescargue_Pesaje">Foto Descargue
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" disabled="" class="fotoswitch" id="SolResFotoDescargue_Pesaje" name="SolResFotoDescargue_Pesaje" {{$SolRes->SolResFotoDescargue_Pesaje === 1 ? 'checked' : '' }} hidden="">
									</div>
									</label>
								</div>
								<div class="col-md-2" style="text-align: center; margin-top: 20px;">
									<label data-trigger="hover" data-toggle="popover" title="<b>Foto-Tratamiento</b>" data-content="<p> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>" for="SolResFotoTratamiento">Foto Tratamiento
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" disabled="" class="fotoswitch" id="SolResFotoTratamiento" name="SolResFotoTratamiento" {{$SolRes->SolResFotoTratamiento  === 1 ? 'checked' : '' }} hidden="">
									</div>
									</label>
								</div>
								<div class="col-md-2" style="text-align: center; margin-top: 20px;">
									<label data-trigger="hover" data-toggle="popover" title="<b>Video-Descargue</b>" data-content="<p> Se requiere video del proceso de Descargue de los residuos en las instalaciones de Prosarc S.A. ESP</p>" for="SolResVideoDescargue_Pesaje">Video Descargue
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" disabled="" class="videoswitch" id="SolResVideoDescargue_Pesaje" name="SolResVideoDescargue_Pesaje" {{$SolRes->SolResVideoDescargue_Pesaje  === 1 ? 'checked' : '' }} hidden="">
									</div>
									</label>
								</div>
								<div class="col-md-2" style="text-align: center; margin: 20px 0px 20px 0px; ">
									<label data-trigger="hover" data-toggle="popover" title="<b>Video-Tratamiento</b>" data-content="<p> Se requiere registro fotografico del Tratamiento de los residuos en las instalaciones de Prosarc S.A. ESP</p>" for="SolResVideoTratamiento">Video Tratamiento
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" disabled="" class="videoswitch" id="SolResVideoTratamiento" name="SolResVideoTratamiento" {{$SolRes->SolResVideoTratamiento  === 1 ? 'checked' : '' }} hidden="">
									</div>
									</label>
								</div>
								<div class="col-md-2" style="text-align: center; margin: 20px 0px 20px 0px; ">
									<label data-trigger="hover" data-toggle="popover" title="<b>Devolución de embalaje</b>" data-content="<p> Se requiere que los embalajes sean devueltos al cliente/generador</p>" for="SolResDevolucion">Devolución Embalaje
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" disabled="" class="embalajeswitch" id="SolResDevolucion" name="SolResDevolucion" {{$SolRes->SolResDevolucion  === 1 ? 'checked' : '' }} hidden="">
									</div>
									</label>
								</div>
								<div class="col-md-2" style="text-align: center; margin: 20px 0px 20px 0px; ">
									<label  data-trigger="hover" data-toggle="popover" title="<b>Tratamiento Auditable</b>" data-content="<p> Se requiere que el tratamiento del residuo sea auditado por personal del Cliente/Generador </p>" for="SolResAuditoria">Requiere auditoria
									<div style="width: 100%; height: 34px;">
										<input type="checkbox" disabled="" class="auditoriaswitch" id="SolResAuditoria" name="SolResAuditoria" {{$SolRes->SolResAuditoria  === 1 ? 'checked' : '' }} hidden="">
									</div>
									</label>
								</div>

							</div>
						</div>
					</div>
				</div>
				@if((in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1)) && ($SolRes->SolResVideoDescargue_Pesaje == 1 || $SolRes->SolResVideoTratamiento == 1 || $SolRes->SolResFotoDescargue_Pesaje == 1 || $SolRes->SolResFotoTratamiento == 1 || $SolRes->SolResFotoDescargue_Pesaje == 0))
				{{-- @if(1 == 1) --}}
					{{-- Modal Añadir Recurso  --}}
					<form role="form" action="/recurso/{{$SolRes->SolResSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator" id="addRecursoForm" class="form">
						@method('PUT')
						{{csrf_field()}}
						@csrf
						<div class="modal modal-default fade in" id="addRecurso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<div style="font-size: 5em; color: green; text-align: center; margin: auto;">
											<i class="fas fa-plus-circle"></i>
											<span style="font-size: 0.3em; color: black;"><p>Añadir <b class="categoriaRec"></b></p></span>
										</div>
									</div>
									<div class="modal-header">
										<div id="categoria">
										</div>
										<div class="col-md-12 form-group">
											<label for="tipo">Tipo</label><small class="help-block with-errors">*</small>
											<select class="form-control" id="tipo" name="RecTipo" required>
												
											</select>
										</div>
										<div class="col-md-12 form-group" id="archivo">
											<label for="recursoinputext">Archivos</label><small class="help-block with-errors">*</small>
											<input type="file" class="form-control" id="recursoinputext" name="RecSrc[]" multiple required>
										</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary pull-right">{{trans('adminlte_lang::message.save')}}</button>
									</div>
								</div>
							</div>
						</div>
					</form>   
					{{-- final del modal --}}
				@endif
				<div id="deleteRecurso">
				</div>
				<div class="row">
					{{-- @if(((($SolSer->SolSerStatus <> 'Pendiente' || $SolSer->SolSerStatus <> 'Aprobado' || $SolSer->SolSerStatus <> 'Aceptado') && (!in_array(Auth::user()->UsRol, Permisos::CLIENTE))) || (($SolSer->SolSerStatus === 'Tratado' || $SolSer->SolSerStatus === 'Certificacion') && (in_array(Auth::user()->UsRol, Permisos::CLIENTE)))) && ($Programacion->ProgVehEntrada !== Null)) --}}
					@if((($SolSer->SolSerStatus === 'Programado' || $SolSer->SolSerStatus === 'Completado' || $SolSer->SolSerStatus === 'Conciliado' || $SolSer->SolSerStatus === 'No Conciliado' || $SolSer->SolSerStatus === 'Tratado' || $SolSer->SolSerStatus === 'Notificado')) && ($SolRes->SolResFotoDescargue_Pesaje == 1 || $SolRes->SolResFotoDescargue_Pesaje == 0 || $SolRes->SolResFotoTratamiento == 1 ||  $SolRes->SolResVideoTratamiento == 1 ||  $SolRes->SolResVideoDescargue_Pesaje == 1 ))
						<tbody hidden onload="renderTable()" id="readyTable">
							<div class="col-md-12">
								<center><h3>{{trans('adminlte_lang::message.recursos')}}</h3></center>
								<div class="box box-warning">
									@if ($errors->any())
										<div class="alert alert-danger" role="alert">
											<ul>
												@foreach ($errors->all() as $error)
													<p>{{$error}}</p>
												@endforeach
											</ul>
										</div>
									@endif
									<div class="col-md-6" style="margin-bottom:15px;">
										<h4>
											{{trans('adminlte_lang::message.recursoFoto')}}
											@if(((in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1)) && ($SolSer->SolSerStatus === 'Programado' || $SolSer->SolSerStatus === 'Completado' || $SolSer->SolSerStatus === 'Conciliado' || $SolSer->SolSerStatus === 'No Conciliado'|| $SolSer->SolSerStatus === 'Tratado'|| $SolSer->SolSerStatus === 'Notificado')) && ($SolRes->SolResFotoDescargue_Pesaje == 1 || $SolRes->SolResFotoDescargue_Pesaje == 0 || $SolRes->SolResFotoTratamiento == 1))
												<a method='get' href='#' data-toggle='modal' data-target='#addRecurso' style="color:green" title="{{trans('adminlte_lang::message.recaddfoto')}}" id="addFoto"><i class="fas fa-plus-circle"></i></a>
											@endif
										</h4>
										@if (!isset($Fotos[0]->RecTipo))
											<img src="../../../img/defaultimage.png" height="300px" width="100%" max-width="1200px">
										@else
											<div style='overflow-y:auto; overflow-x:hidden; max-height:600px;'>
												@foreach ($Fotos as $Foto)
													<div class="col-md-12">
														<div style="background-image: url('../../../img/Recursos/{{$Foto->RecSrc}}/{{$Foto->RecRmSrc}}');  background-repeat: no-repeat; height: 300px; width:100%; max-width:500px; background-size:100% 300px; margin-bottom:15px;">
															<nav class="navbar navbar-inverse">
																<div class="container">
																	<ul class="nav nav-pills" style="padding-top: 2px; max-width:500px" max-width="500px">
																		<li role="presentation" class="navbar-brand" style="color:white;"><i>{{$Foto->RecTipo}}</i></li>
																		<li role="presentation"><a href="../../../img/Recursos/{{$Foto->RecSrc}}/{{$Foto->RecRmSrc}}" target="_blank" title="{{trans('adminlte_lang::message.recampliarfoto')}}" style="color:orange;"><label style="cursor:pointer;"><i class="fas fa-expand-arrows-alt"></label></i></a></li>
																		@if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1))
																			<li role="presentation"><a href="#" onclick="deleteRecursos(`{{$Foto->SolResSlug}}`, `{{$Foto->RecTipo}}`, `{{$Foto->RecCarte}}`, `{{$Foto->SlugRec}}`)" title="{{trans('adminlte_lang::message.recdeletefoto')}}"><label style="color:red; cursor:pointer;"><i class="fas fa-trash-alt"></i></label></a></li>
																		@endif
																		<li role="presentation"><a href="../../../img/Recursos/{{$Foto->RecSrc}}/{{$Foto->RecRmSrc}}" download="{{now().'_'.$Respel->RespelName.'_'.$Foto->RecTipo}}" title="{{trans('adminlte_lang::message.recdowloadfoto')}}"><label style="color:pink; cursor:pointer;"><i class="fas fa-download"></i></label></a></li>
																	</ul>
																</div>
															</nav>
														</div>
													</div>
												@endforeach
											</div>
										@endif
									</div>
									<div class="col-md-6" style="margin-bottom:15px;">
										<h4>
											{{trans('adminlte_lang::message.recursoVideo')}}
											@if(((in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1)) && ($SolSer->SolSerStatus === 'Programado' || $SolSer->SolSerStatus === 'Completado' || $SolSer->SolSerStatus === 'Conciliado' || $SolSer->SolSerStatus === 'No Conciliado' || $SolSer->SolSerStatus === 'Tratado' || $SolSer->SolSerStatus === 'Notificado')) && ($SolRes->SolResVideoDescargue_Pesaje == 1 || $SolRes->SolResVideoTratamiento == 1))
												<a method='get' href='#' data-toggle='modal' data-target='#addRecurso' style="color:green" title="{{trans('adminlte_lang::message.recdeletevideo')}}" id="addVideo"><i class="fas fa-plus-circle"></i></a>
											@endif
										</h4>
										@if (!isset($Videos[0]->RecTipo))
											<img src="../../../img/defaultvideo.jpg" height="auto" width="100%" max-width="1200">
										@else
										<div style='overflow-y:auto; overflow-x:hidden; max-height:600px;'>
											@foreach ($Videos as $Video)
												<div class="col-md-12" style="margin-bottom:10px;">
													<nav class="navbar navbar-inverse">
														<div class="container">
															<ul class="nav nav-pills">
																<li role="presentation" class="navbar-brand" style="color:white"><i>{{$Video->RecTipo}}</i></li>
																@if(in_array(Auth::user()->UsRol, Permisos::SolSer1) || in_array(Auth::user()->UsRol2, Permisos::SolSer1))
																	<li role="presentation"><a href="#" onclick="deleteRecursos(`{{$Video->SolResSlug}}`, `{{$Video->RecTipo}}`, `{{$Video->RecCarte}}`, `{{$Video->SlugRec}}`)" title="{{trans('adminlte_lang::message.recdeletevideo')}}"><label style="color:red; cursor:pointer;"><i class="fas fa-trash-alt"></i></label></a></li>
																@endif
																<li role="presentation"><a href="../../../img/Recursos/{{$Video->RecSrc}}/{{$Video->RecRmSrc}}" download="{{now().'_'.$Respel->RespelName.'_'.$Video->RecTipo}}" title="{{trans('adminlte_lang::message.recdowloadvideo')}}"><label style="color:pink; cursor:pointer;"><i class="fas fa-download"></i></label></a></li>
															</ul>
														</div>
													</nav>
													<div class="col-md-12">
														<video width="100%" height="auto" style="margin-top:-20px;" muted controls  src="../../../img/Recursos/{{$Video->RecSrc}}/{{$Video->RecRmSrc}}"></video>
													</div>
												</div>
												@endforeach
											</div>
										@endif
									</div>
								</div>
							</div>
						</tbody>
					@else
						@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE))
							<div class="col-md-12">
								<center>
									<h3 data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{trans('adminlte_lang::message.recursos')}}</b>" data-content="{{trans('adminlte_lang::message.recursostratamiento')}}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.recursos')}}</h3>
								</center>
								<div class="box box-warning">
									@if ($errors->any())
										<div class="alert alert-danger" role="alert">
											<ul>
												@foreach ($errors->all() as $error)
													<p>{{$error}}</p>
												@endforeach
											</ul>
										</div>
									@endif
									<div class="col-md-6" style="margin-bottom:15px;">
										<h4>
											{{trans('adminlte_lang::message.recursoFoto')}}
										</h4>
										@if (!isset($Fotos[0]->RecTipo))
											<img src="../../../img/defaultimage.png" height="300px" width="100%" max-width="1200px">
										@else
											<div style='overflow-y:auto; overflow-x:hidden; max-height:600px;'>
												@foreach ($Fotos as $Foto)
													<div class="col-md-12">
														<div style="background-image: url('../../../img/Recursos/{{$Foto->RecSrc}}/{{$Foto->RecRmSrc}}');  background-repeat: no-repeat; height: 300px; width:100%; max-width:500px; background-size:100% 300px; margin-bottom:15px;">
															<nav class="navbar navbar-inverse">
																<div class="container">
																	<ul class="nav nav-pills" style="padding-top: 2px; max-width:500px" max-width="500px">
																		<li role="presentation" class="navbar-brand" style="color:white;"><i>{{$Foto->RecTipo}}</i></li>
																		<li role="presentation"><a href="../../../img/Recursos/{{$Foto->RecSrc}}/{{$Foto->RecRmSrc}}" target="_blank" title="{{trans('adminlte_lang::message.recampliarfoto')}}" style="color:orange;"><label style="cursor:pointer;"><i class="fas fa-expand-arrows-alt"></label></i></a></li>
																		@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE))
																			<li role="presentation"><a href="../../../img/Recursos/{{$Foto->RecSrc}}/{{$Foto->RecRmSrc}}" download="{{now().'_'.$Respel->RespelName.'_'.$Foto->RecTipo}}" title="{{trans('adminlte_lang::message.recdowloadfoto')}}"><label style="color:pink; cursor:pointer;"><i class="fas fa-download"></i></label></a></li>
																		@endif
																	</ul>
																</div>
															</nav>
														</div>
													</div>
												@endforeach
											</div>
										@endif
									</div>
									<div class="col-md-6" style="margin-bottom:15px;">
										<h4>
											{{trans('adminlte_lang::message.recursoVideo')}}
										</h4>
										@if (!isset($Videos[0]->RecTipo))
											<img src="../../../img/defaultvideo.jpg" height="auto" width="100%" max-width="1200">
										@else
										<div style='overflow-y:auto; overflow-x:hidden; max-height:600px;'>
											@foreach ($Videos as $Video)
												<div class="col-md-12" style="margin-bottom:10px;">
													<nav class="navbar navbar-inverse">
														<div class="container">
															<ul class="nav nav-pills">
																<li role="presentation" class="navbar-brand" style="color:white"><i>{{$Video->RecTipo}}</i></li>
																@if(in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol2, Permisos::CLIENTE))
																	<li role="presentation"><a href="../../../img/Recursos/{{$Video->RecSrc}}/{{$Video->RecRmSrc}}" download="{{now().'_'.$Respel->RespelName.'_'.$Video->RecTipo}}" title="{{trans('adminlte_lang::message.recdowloadvideo')}}"><label style="color:pink; cursor:pointer;"><i class="fas fa-download"></i></label></a></li>
																@endif
															</ul>
														</div>
													</nav>
													<div class="col-md-12">
														<video width="100%" height="auto" style="margin-top:-20px;" muted controls src="../../../img/Recursos/{{$Video->RecSrc}}/{{$Video->RecRmSrc}}"></video>
													</div>
												</div>
												@endforeach
											</div>
										@endif
									</div>
								</div>
							</div>
						@endif
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@section('NewScript')
@if(in_array(Auth::user()->UsRol, Permisos::SolSer1)||in_array(Auth::user()->UsRol2, Permisos::SolSer1))
	<script>
		function Pesaje(){
			$("#tipo").append(`<option>Pesaje-Descargue</option>`);
		}
		function Tratamiento(){
			$("#tipo").append(`<option>Tratamiento</option>`);
		}
		function modalrecursos(){
			$('#addRecursoForm').validator('destroy');
			$('#addRecursoForm').validator('update');
			$("#categoria").empty();
			$("#tipo").empty();
			$("#recursoinputext").val('');
			$("#tipo").append(`<option value="">Seleccione...</option>
			`);
		}
	</script>
	<script>
		$("#addFoto").click(function(e){
			modalrecursos();
			$(".categoriaRec").html('Foto');
			$("#categoria").append(`
				<input type="text" hidden value="Foto" name="RecCarte">
			`);
			if('{{$SolRes->SolResFotoDescargue_Pesaje}}'  == 1 || '{{$SolRes->SolResFotoDescargue_Pesaje}}'  == 0){
				Pesaje();
			}
			if('{{$SolRes->SolResFotoTratamiento}}' == 1){
				Tratamiento();
			}		
			$('#recursoinputext').attr('accept', '.jpg,.jpeg,.png');
			$('#recursoinputext').attr('data-filessizemultiple', '5120');
		});

		$("#addVideo").click(function(e){
			modalrecursos();
			$(".categoriaRec").html('Video');
			$("#categoria").append(`
				<input type="text" hidden value="Video" name="RecCarte">
			`);
			if('{{$SolRes->SolResVideoDescargue_Pesaje}}' == 1){
				Pesaje();
			}
			if('{{$SolRes->SolResVideoTratamiento}}' == 1){
				Tratamiento();
			}
			$('#recursoinputext').attr('accept', '.mp4');
			$('#recursoinputext').attr('data-filessizemultiple', '10240');
		});
	</script>
	<script>
		function deleteRecursos(slug, tipo, categoria, value){
			$('#deleteRecurso').empty();
			$('#deleteRecurso').append(`
				@component('layouts.partials.modal')
					@slot('slug')
						`+slug+`
					@endslot
					@slot('textModal')
						`+categoria+` de `+tipo+`
					@endslot
				@endcomponent
				<form action='/recurso/`+slug+`' method='POST'>
					@method('DELETE')
					@csrf
					<input type="submit" id="Eliminar`+slug+`" style="display: none;">
					<input value="`+value+`" name="DeleteRec" style="display: none;">
				</form>
			`);
			$('#myModal'+slug).modal();
		}
	</script>
	{{-- @if ($errors->any())
		<script>
			$(document).ready(function() {
				$("#addRecurso").modal("show");
			});
		</script>
	@endif --}}
@endif
<script>
	if('{{in_array(Auth::user()->UsRol, Permisos::CLIENTE) || in_array(Auth::user()->UsRol, Permisos::PROGRAMADOR)}}'){
		if("{{$SolRes->SolResTypeUnidad === 'Litros' || $SolRes->SolResTypeUnidad === 'Unidad'}}"){
			$('#kgenviados').addClass('col-md-3');
			$('#kgconciliados').addClass('col-md-3');
			$('#kgresividos').addClass('col-md-3');
			$('#unidadrecibida').addClass('col-md-3');
		}else{
			$('#kgenviados').addClass('col-md-4');
			$('#kgconciliados').addClass('col-md-4');
			$('#kgresividos').addClass('col-md-4');
		}
	}else{
		if("{{$SolRes->SolResTypeUnidad === 'Litros' || $SolRes->SolResTypeUnidad === 'Unidad'}}"){
			$('#kgresividos').addClass('col-md-4');
			$('#kgenviados').addClass('col-md-4');
			$('#unidadrecibida').addClass('col-md-4');
			$('#kgconciliados').addClass('col-md-6');
			$('#kgtratado').addClass('col-md-6');
		}else{
			$('#kgresividos').addClass('col-md-3');
			$('#kgenviados').addClass('col-md-3');
			$('#kgconciliados').addClass('col-md-3');
			$('#kgtratado').addClass('col-md-3');
		}
	}
</script>
@endsection
@endsection
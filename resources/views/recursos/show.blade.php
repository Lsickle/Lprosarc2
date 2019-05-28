@extends('layouts.app')

@section('htmlheader_title','Recursos')

@section('contentheader_title', 'Ver todos los Recursos')
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header with-border">
                    {{-- <h3 class="box-title">Datos</h3>     --}}
                    <div class="col-md-12" >
                            @component('layouts.partials.modal')
                            {{$SolRes->SolResSlug}}
                        @endcomponent
                        <div style="display: flex; justify-content:space-between">
                            <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$SolRes->SolResSlug}}' class='btn btn-danger pull-left'><i class="fas fa-trash-alt"></i> <b>{{trans('adminlte_lang::message.delete')}}</b></a>
                            <a method='get' href='#' data-toggle='modal' data-target='#addRecurso'  class="btn btn-success"><i class="fas fa-plus-circle"></i><b> {{trans('adminlte_lang::message.add')}}</b></a>
                            <a href="/solicitud-servicio/{{$SolRes->SolResSlug}}/edit" class="btn btn-warning pull-right"><i class="fas fa-edit"></i><b> {{trans('adminlte_lang::message.edit')}}</b></a>
                        </div>
                        <form action='/solicitud-residuo/{{$SolRes->SolResSlug}}' method='POST'>
                            @method('DELETE')
                            @csrf
                            <input type="submit" id="Eliminar{{$SolRes->SolResSlug}}" style="display: none;">
                        </form>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="box box-info">
                            <div class="box-body">
                                <tbody  hidden onload="renderTable()" id="readyTable">
                                    @include('layouts.partials.spinner')
                                    <div class="col-md-12">
                                        <label for="tipo">Foto</label>
                                        <form role="form" action="/recurso/{{$SolRes->SolResSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator" >
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
                                                                <span style="font-size: 0.3em; color: black;"><p>Añadir nuevo Recurso</p></span>
                                                            </div>
                                                        </div>
                                                        <div class="modal-header">
                                                            <div class="col-md-12 form-group">
                                                                <label for="categoria">Categoría</label><small class="help-block with-errors">*</small>
                                                                <select class="form-control select" id="categoria" name="RecCarte" required>
                                                                    <option value="">Seleccione...</option>
                                                                    <option>Foto</option>
                                                                    <option>Video</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label for="tipo">Tipo</label><small class="help-block with-errors">*</small>
                                                                <select class="form-control select" id="tipo" name="RecTipo" required>
                                                                    <option value="">Seleccione...</option>
                                                                    {{-- <option>Cargue</option>
                                                                    <option>Descargue</option>
                                                                    <option>Reempacado</option>
                                                                    <option>Mezclado</option>
                                                                    <option>Destruccion</option> --}}
                                                                    <option>Pesaje</option>
                                                                    <option>Tratamiento</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12 form-group">
                                                                <label for="recursoinputext">Archivos</label><small class="help-block with-errors">*</small>
                                                                <input type="file" class="form-control" id="recursoinputext" name="RecSrc[]" accept=".jpg, .jpeg, .png, .mp4" multiple required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- @include('layouts.partials.modalañadirecurso') --}}
                                        </form>                    
                                    </div>
                                    {{-- @foreach ($Recursos as $Recurso)
                                        @if ($Recurso->RecTipo == 'Cargue' and $Recurso->RecCarte == 'Foto')
                                            <div class="col-md-12">
                                                <label>{{$Recurso->RecTipo}}</label>
                                                <div id="CargueRec">
                                                    @foreach ($Recursos as $Recurso)
                                                        @if ($Recurso->RecTipo == 'Cargue' and $Recurso->RecCarte == 'Foto')
                                                            <div>
                                                                <img src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200">
                                                                <form role="form" action="/recurso/{{$Recurso->ID_Rec}}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="bx-caption">
                                                                        <input hidden name="number" value="1">
                                                                        <button type="submit" class="btn btn-danger btn-block" value ="{{$Recurso->ID_Rec}}" name="DeleteRec">Eliminar</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    @endforeach  
                                                </div>
                                            </div>
                                            @break
                                        @endif
                                    @endforeach --}}
                            {{-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                  <div class="carousel-item active"> --}}
                            {{-- @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Descargue' and $Recurso->RecCarte == 'Foto')
                                <div class="col-md-12">
                                    <label>{{$Recurso->RecTipo}}</label>
                                    <div id="DescargueRec">
                                        @foreach ($Recursos as $Recurso)
                                            @if ($Recurso->RecTipo == 'Descargue' and $Recurso->RecCarte == 'Foto')
                                            <div>
                                                <img src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200">
                                                <form role="form" action="/recurso/{{$Recurso->ID_Rec}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="bx-caption">
                                                        <input hidden name="number" value="1">
                                                        <button type="submit" class="btn btn-danger btn-block" value ="{{$Recurso->ID_Rec}}" name="DeleteRec">Eliminar</button>
                                                    </div>
                                                </form>
                                            </div>
                                            @endif
                                        @endforeach  
                                    </div>
                                </div>
                                @break
                                @endif
                            @endforeach --}}
                            @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Pesaje' and $Recurso->RecCarte == 'Foto')
                                    <div class="col-md-12">
                                        <label>{{$Recurso->RecTipo}}</label>
                                        <div id="PesajeRec">
                                            @foreach ($Recursos as $Recurso)
                                                @if ($Recurso->RecTipo == 'Pesaje' and $Recurso->RecCarte == 'Foto')
                                                <div>
                                                    {{-- <img src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200"> --}}
                                                    <div style="background-image: url('../../../img/Recursos/{{$Recurso->RecSrc}}/{{$Recurso->RecRmSrc}}');  background-repeat: no-repeat; height: 500px; width:100%; max-width:1200;  background-size: cover;">
                                                        <nav class="navbar navbar-inverse">
                                                            <div class="container">
                                                                        <ul class="nav nav-pills">
                                                                            <li role="presentation"><a href="../../../img/Recursos/{{$Recurso->RecSrc}}/{{$Recurso->RecRmSrc}}" target="_blank">Home</a></li>
                                                                            <li role="presentation"><a href="#">Profile</a></li>
                                                                            <li role="presentation"><a href="#">Messages</a></li>
                                                                        </ul>
                                                                        {{-- hola --}}
                                                                    </div>
                                                                </nav>
                                                        {{-- <div style="display:flex; justify-content:space-between;"> --}}
                                                            {{-- <button type="submit" class="btn btn-danger" value ="{{$Recurso->ID_Rec}}" name="DeleteRec">Eliminar</button> --}}
                                                        {{-- </div> --}}
                                                    </div>
                                                    {{-- <img src="../../../img/Recursos/{{$Recurso->RecSrc}}/{{$Recurso->RecRmSrc}}" height="auto" width="100%" max-width="1200"> --}}
                                                    
                                                    <form role="form" action="/recurso/{{$Recurso->ID_Rec}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        {{-- <div class="bx-caption"> --}}
                                                            {{-- <input hidden name="number" value="1"> --}}
                                                        {{-- </div> --}}
                                                    </form>
                                                </div>
                                                @endif
                                            @endforeach  
                                        </div>
                                    </div>
                                    @break
                                @endif
                            @endforeach
                            {{-- @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Reempacado' and $Recurso->RecCarte == 'Foto')
                                <div class="col-md-12">
                                    <label>{{$Recurso->RecTipo}}</label>
                                    <div id="ReempacadoRec">
                                        @foreach ($Recursos as $Recurso)
                                            @if ($Recurso->RecTipo == 'Reempacado' and $Recurso->RecCarte == 'Foto')
                                            <div>
                                                <img src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200">
                                                <form role="form" action="/recurso/{{$Recurso->ID_Rec}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="bx-caption">
                                                    <input hidden name="number" value="1">
                                                        <button type="submit" class="btn btn-danger btn-block" value ="{{$Recurso->ID_Rec}}" name="DeleteRec">Eliminar</button>
                                                    </div>
                                                </form>
                                            </div> 
                                            @endif
                                        @endforeach  
                                    </div>
                                </div>
                                @break
                                @endif
                            @endforeach --}}
                            {{-- @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Mezclado' and $Recurso->RecCarte == 'Foto')
                                <div class="col-md-12">
                                    <label>{{$Recurso->RecTipo}}</label>
                                    <div id="MezcladoRec">
                                        @foreach ($Recursos as $Recurso)
                                            @if ($Recurso->RecTipo == 'Mezclado' and $Recurso->RecCarte == 'Foto')
                                            <div>
                                                <img src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200">
                                                <form role="form" action="/recurso/{{$Recurso->ID_Rec}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="bx-caption">
                                                    <input hidden name="number" value="1">
                                                        <button type="submit" class="btn btn-danger btn-block" value ="{{$Recurso->ID_Rec}}" name="DeleteRec">Eliminar</button>
                                                    </div>
                                                </form>
                                            </div>                                          
                                            @endif
                                        @endforeach  
                                    </div>
                                </div>
                                @break
                                @endif
                            @endforeach --}}
                            {{-- @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Destruccion' and $Recurso->RecCarte == 'Foto')
                                <div class="col-md-12">
                                    <label>{{$Recurso->RecTipo}}</label>
                                    <div id="DestruccionRec">
                                        @foreach ($Recursos as $Recurso)
                                            @if ($Recurso->RecTipo == 'Destruccion')
                                            <div>
                                                    <img src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200">
                                                    <form role="form" action="/recurso/{{$Recurso->ID_Rec}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="bx-caption">
                                                            <input hidden name="number" value="1">
                                                            <button type="submit" class="btn btn-danger btn-block" value ="{{$Recurso->ID_Rec}}" name="DeleteRec">Eliminar</button>
                                                        </div>
                                                    </form>
                                                </div>                                            @endif
                                        @endforeach  
                                    </div>
                                </div>
                                @break
                                @endif
                            @endforeach --}}
                                    </div>
                                </div>
                            </div>
                        {{-- </div> --}}
                            <div class="box-body">
                                <div class="col-md-12">
                                    <label for="tipo">Video</label>
                                </div>
                    {{-- @foreach ($Recursos as $Recurso)
                        @if ($Recurso->RecTipo == 'Cargue' and $Recurso->RecCarte == 'Video')
                        <div class="col-md-12">
                            <label>{{$Recurso->RecTipo}}</label>
                            <div id="CargueVideo">
                                @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Cargue' and $Recurso->RecCarte == 'Video')
                                    <form role="form" action="/recurso/{{$Recurso->ID_Rec}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <input hidden name="number" value="1">
                                        <video src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200" controls></video>
                                        <button type="submit" class="btn btn-danger btn-block" value ="{{$Recurso->ID_Rec}}" name="DeleteRec">Eliminar</button>
                                    </form>
                                    @endif
                                @endforeach  
                            </div>
                        </div>
                        @break
                        @endif
                    @endforeach
                    @foreach ($Recursos as $Recurso)
                        @if ($Recurso->RecTipo == 'Descargue' and $Recurso->RecCarte == 'Video')
                        <div class="col-md-12">
                            <label>{{$Recurso->RecTipo}}</label>
                            <div id="DescargueVideo">
                                @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Descargue' and $Recurso->RecCarte == 'Video')
                                <form role="form" action="/recurso/{{$Recurso->ID_Rec}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <input hidden name="number" value="1">
                                    <video src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200" controls></video>
                                    <button type="submit" class="btn btn-danger btn-block" value ="{{$Recurso->ID_Rec}}" name="DeleteRec">Eliminar</button>
                                </form>
                                @endif
                                @endforeach  
                            </div>
                        </div>
                        @break
                        @endif
                    @endforeach --}}
                    @foreach ($Recursos as $Recurso)
                        @if ($Recurso->RecTipo == 'Pesaje' and $Recurso->RecCarte == 'Video')
                        <div class="col-md-12">
                            <label>{{$Recurso->RecTipo}}</label>
                            <div id="PesajeVideo">
                                @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Pesaje' and $Recurso->RecCarte == 'Video')
                                <form role="form" action="/recurso/{{$Recurso->ID_Rec}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <input hidden name="number" value="1">
                                    <video src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200" controls></video>
                                    <button type="submit" class="btn btn-danger btn-block" value ="{{$Recurso->ID_Rec}}" name="DeleteRec">Eliminar</button>
                                </form>
                                @endif
                                @endforeach  
                            </div>
                        </div>
                        @break
                        @endif
                    @endforeach
                    {{-- @foreach ($Recursos as $Recurso)
                        @if ($Recurso->RecTipo == 'Reempacado' and $Recurso->RecCarte == 'Video')
                        <div class="col-md-12">
                            <label>{{$Recurso->RecTipo}}</label>
                            <div id="ReempacadoVideo">
                                @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Reempacado' and $Recurso->RecCarte == 'Video')
                                <form role="form" action="/recurso/{{$Recurso->ID_Rec}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <input hidden name="number" value="1">
                                    <video src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200" controls></video>
                                    <button type="submit" class="btn btn-danger btn-block" value ="{{$Recurso->ID_Rec}}" name="DeleteRec">Eliminar</button>
                                </form>
                                @endif
                                @endforeach  
                            </div>
                        </div>
                        @break
                        @endif
                    @endforeach
                    @foreach ($Recursos as $Recurso)
                        @if ($Recurso->RecTipo == 'Mezclado' and $Recurso->RecCarte == 'Video')
                        <div class="col-md-12">
                            <label>{{$Recurso->RecTipo}}</label>
                            <div id="MezcladoVideo">
                                @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Mezclado' and $Recurso->RecCarte == 'Video')
                                <form role="form" action="/recurso/{{$Recurso->ID_Rec}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <input hidden name="number" value="1">
                                    <video src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200" controls></video>
                                    <button type="submit" class="btn btn-danger btn-block" value ="{{$Recurso->ID_Rec}}" name="DeleteRec">Eliminar</button>
                                </form>
                                @endif
                                @endforeach  
                            </div>
                        </div>
                        @break
                        @endif
                    @endforeach
                    @foreach ($Recursos as $Recurso)
                        @if ($Recurso->RecTipo == 'Destruccion' and $Recurso->RecCarte == 'Video')
                        <div class="col-md-12">
                            <label>{{$Recurso->RecTipo}}</label>
                            <div id="DestruccionVideo">
                                @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Destruccion' and $Recurso->RecCarte == 'Video')
                                <form role="form" action="/recurso/{{$Recurso->ID_Rec}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <input hidden name="number" value="1">
                                    <video src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200" controls></video>
                                    <button type="submit" class="btn btn-danger btn-block" value ="{{$Recurso->ID_Rec}}" name="DeleteRec">Eliminar</button>
                                </form>
                                @endif
                                @endforeach  
                            </div>
                        </div>
                        @break
                        @endif
                    @endforeach --}}
                </div>
			</div>
		</div>
    </div>
            </tbody>
</div>
@endsection
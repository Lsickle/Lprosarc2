@extends('layouts.app')

@section('htmlheader_title','Recursos')

@section('contentheader_title', 'Ver todos los Recursos')
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
                    <h3 class="box-title">Datos</h3>                    
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
                    </div>
                </div>
                
				<div class="row">
                    <!-- left column -->
                    
					<div class="col-md-12">
                        <!-- general form elements -->
						<div class="box box-primary">
                            
                            <div class="box-body">
                                    <tbody  hidden onload="renderTable()" id="readyTable">
                                            @include('layouts.partials.spinner')
                                <div class="col-md-12">
                                    
                                    <label for="tipo">Foto</label>
                                    <a method='get' href='#' data-toggle='modal' data-target='#myModal'  class="btn btn-primary" style="float: right;">Añadir</a>
                                    <form role="form" action="/recurso/{{$SolRes->SolResSlug}}" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        {{csrf_field()}}
                                        @csrf
                                        @component('layouts.partials.modalañadirecurso')
                                        @endcomponent
                                    </form>                    
                                </div>
                            {{-- </div> --}}
                            @foreach ($Recursos as $Recurso)
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
                            @endforeach
                            @foreach ($Recursos as $Recurso)
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
                            @endforeach
                            @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Pesaje' and $Recurso->RecCarte == 'Foto')
                                <div class="col-md-12">
                                    <label>{{$Recurso->RecTipo}}</label>
                                    <div id="PesajeRec">
                                        @foreach ($Recursos as $Recurso)
                                            @if ($Recurso->RecTipo == 'Pesaje' and $Recurso->RecCarte == 'Foto')
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
                            @endforeach
                            @foreach ($Recursos as $Recurso)
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
                            @endforeach
                            @foreach ($Recursos as $Recurso)
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
                            @endforeach
                            @foreach ($Recursos as $Recurso)
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
                            @endforeach
                        </div>
                    </div>
                </div>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <label for="tipo">Video</label>
                    </div>
                    @foreach ($Recursos as $Recurso)
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
                    @endforeach
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
                    @foreach ($Recursos as $Recurso)
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
                    @endforeach
                    <!-- /.box -->
                </div>

                    <!-- /.box-body -->
				<!-- /.box -->
			</div>
			<!--/.col (right) -->
		</div>
		<!-- /.box-body -->
    </div>
            </tbody>
    
	<!-- /.box -->
</div>
@endsection
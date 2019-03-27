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
                                <div class="col-md-12">
                                    <label for="tipo">Foto</label>
                                    <a method='get' href='#' data-toggle='modal' data-target='#myModal'  class="btn btn-primary" style="float: right;">Añadir</a>
                                
                                    <form role="form" action="/recurso/{{$ResGeners->ID_SGenerRes}}" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        {{csrf_field()}}
                                        @csrf
                                            @component('layouts.partials.modalañadirecurso')
                                            @endcomponent
                                    </form>                    
                                </div>
                            </div>
                            @foreach ($Recursos as $Recurso)
                            @if ($Recurso->RecTipo == 'Cargue' and $Recurso->RecCarte == 'Foto')
                                <div class="col-md-12">
                                    <label>{{$Recurso->RecTipo}}</label>
                                    <div id="CargueRec">
                                        <iframe  width="100%" max-width="1200" height="auto" src="https://www.youtube.com/embed/N5olyi6xywU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                                         
                                        @foreach ($Recursos as $Recurso)
                                        @if ($Recurso->RecTipo == 'Cargue')
                                        <div>
                                            <img src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200">
                                            <div class="bx-caption">
                                                <button type="submit" class="btn btn-warning" value ="{{$Recurso->ID_Rec}}">Eliminar</button>
                                            </div>
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
                                        <iframe  width="100%" max-width="1200" height="auto" src="https://www.youtube.com/embed/N5olyi6xywU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                                         
                                        @foreach ($Recursos as $Recurso)
                                            @if ($Recurso->RecTipo == 'Descargue')
                                            <img src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200">
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
                                        <iframe  width="100%" max-width="1200" height="auto" src="https://www.youtube.com/embed/N5olyi6xywU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                                         
                                        @foreach ($Recursos as $Recurso)
                                            @if ($Recurso->RecTipo == 'Pesaje')
                                            <img src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200">
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
                                        <iframe  width="100%" max-width="1200" height="auto" src="https://www.youtube.com/embed/N5olyi6xywU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                                         
                                        @foreach ($Recursos as $Recurso)
                                            @if ($Recurso->RecTipo == 'Reempacado' and $Recurso->RecCarte == 'Foto')
                                            <img src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200">
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
                                        <iframe  width="100%" max-width="1200" height="auto" src="https://www.youtube.com/embed/N5olyi6xywU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                                         
                                        @foreach ($Recursos as $Recurso)
                                            @if ($Recurso->RecTipo == 'Mezclado')
                                            <img src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200">
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
                                        <iframe  width="100%" max-width="1200" height="auto" src="https://www.youtube.com/embed/N5olyi6xywU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                                         
                                        @foreach ($Recursos as $Recurso)
                                            @if ($Recurso->RecTipo == 'Destruccion')
                                            <img src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200">
                                            @endif
                                        @endforeach  
                                    </div>
                                </div>
                                @break
                                @endif
                            @endforeach
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
                                @if ($Recurso->RecTipo == 'Cargue')
                                    <iframe  width="100%" max-width="1200" height="auto" src="https://www.youtube.com/embed/N5olyi6xywU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                                         
                                    <iframe src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200"></iframe> 
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
                                @if ($Recurso->RecTipo == 'Descargue')
                                    <iframe  width="100%" max-width="1200" height="auto" src="https://www.youtube.com/embed/N5olyi6xywU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                                         
                                    <iframe src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200"></iframe> 
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
                                @if ($Recurso->RecTipo == 'Pesaje')
                                    <iframe  width="100%" max-width="1200" height="auto" src="https://www.youtube.com/embed/N5olyi6xywU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                                         
                                    <iframe src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200"></iframe> 
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
                                    <iframe  width="100%" max-width="1200" height="auto" src="https://www.youtube.com/embed/N5olyi6xywU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                                         
                                    <iframe src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200"></iframe> 
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
                                @if ($Recurso->RecTipo == 'Mezclado')
                                    <iframe  width="100%" max-width="1200" height="auto" src="https://www.youtube.com/embed/N5olyi6xywU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                                         
                                    <iframe src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200"></iframe> 
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
                                @if ($Recurso->RecTipo == 'Destruccion')
                                    <iframe  width="100%" max-width="1200" height="auto" src="https://www.youtube.com/embed/N5olyi6xywU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                                         
                                    <iframe src="{{ asset($Recurso->RecSrc . '/' . $Recurso->RecRmSrc) }}" height="auto" width="100%" max-width="1200"></iframe> 
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
	<!-- /.box -->
</div>
@endsection
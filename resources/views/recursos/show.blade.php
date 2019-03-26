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
                    {{-- <button><a href="/recurso/3/edit"> Añadir</a></button> --}}
                    
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
                                    <a href="modal" class="btn btn-primary" style="float: right;">Añadir</a>

                                </div>
                                {{-- @foreach ($Recursos as $Recurso) --}}

                                {{-- @component('layouts.partials.modal')
                                {{$Recurso->ID_Pers}}
                            @endcomponent
                        <h3 class="box-title">Datos de la persona</h3>
                          <a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Persona->ID_Pers}}'  class='btn btn-danger' style="float: right;">Eliminar</a>
                          <form action='/recurso/{{$Recurso->PersSlug}}' method='POST' enctype="multipart/form-data">
                    
                              @csrf
                              <input  type="submit" id="Eliminar{{$Persona->ID_Pers}}" style="display: none;">
                          </form>
                        
                                <div class="box-body"> --}}
                                    @foreach ($Recursos as $Recurso)
                                        @if ($Recurso->RecTipo == 'Cargue' and $Recurso->RecCarte == 'Foto')
                                        <div class="col-md-12">
                                            <label>{{$Recurso->RecTipo}}</label>
                                            <div id="slider">
                                                <div >
                                                    <iframe  width="100%" max-width="1200" height="auto" src="https://www.youtube.com/embed/N5olyi6xywU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>                                         
                                                </div> 
                                                @foreach ($Recursos as $Recurso)
                                                @if ($Recurso->RecTipo == 'Cargue')
                                                <div class="col-md-2">
                                                    <img src="{{ asset($Recurso->RecSrc) }}" height="auto" width="100%" max-width="1200">
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
                                            </div>
                                            @foreach ($Recursos as $Recurso)
                                                @if ($Recurso->RecTipo == 'Descargue')
                                                    <div class="col-md-2">
                                                        <img src="{{ asset($Recurso->RecSrc) }}" alt="" width="150" height="150" value="">  
                                                    </div>
                                                @endif
                                            @endforeach                                            
                                            @break
                                        @endif
                                    @endforeach
                                    @foreach ($Recursos as $Recurso)
                                        @if ($Recurso->RecTipo == 'Pesaje' and $Recurso->RecCarte == 'Foto')
                                            <div class="col-md-12">
                                                <label>{{$Recurso->RecTipo}}</label>
                                            </div>
                                            @foreach ($Recursos as $Recurso)
                                                @if ($Recurso->RecTipo == 'Pesaje')
                                                    <div class="col-md-2">
                                                        <img src="{{ asset($Recurso->RecSrc) }}" alt="" width="150" height="150" value="">  
                                                    </div>
                                                @endif
                                            @endforeach                                            
                                            @break
                                        @endif
                                    @endforeach
                                    @foreach ($Recursos as $Recurso)
                                        @if ($Recurso->RecTipo == 'Reempacado' and $Recurso->RecCarte == 'Foto')
                                            <div class="col-md-12">
                                                <label>{{$Recurso->RecTipo}}</label>
                                            </div>
                                            @foreach ($Recursos as $Recurso)
                                                @if ($Recurso->RecTipo == 'Reempacado')
                                                    <div class="col-md-2">
                                                        <img src="{{ asset($Recurso->RecSrc) }}" alt="" width="150" height="150" value="">  
                                                    </div>
                                                @endif
                                            @endforeach                                            
                                            @break
                                        @endif
                                    @endforeach
                                    @foreach ($Recursos as $Recurso)
                                        @if ($Recurso->RecTipo == 'Mezclado' and $Recurso->RecCarte == 'Foto')
                                            <div class="col-md-12">
                                                <label>{{$Recurso->RecTipo}}</label>
                                            </div>
                                            @foreach ($Recursos as $Recurso)
                                                @if ($Recurso->RecTipo == 'Mezclado')
                                                    <div class="col-md-2">
                                                        <img src="{{ asset($Recurso->RecSrc) }}" alt="" width="150" height="150" value="">  
                                                    </div>
                                                @endif
                                            @endforeach                                            
                                            @break
                                        @endif
                                    @endforeach
                                    @foreach ($Recursos as $Recurso)
                                        @if ($Recurso->RecTipo == 'Destruccion' and $Recurso->RecCarte == 'Foto')
                                            <div class="col-md-12">
                                                <label>{{$Recurso->RecTipo}}</label>
                                            </div>
                                            @foreach ($Recursos as $Recurso)
                                                @if ($Recurso->RecTipo == 'Destruccion')
                                                    <div class="col-md-2">
                                                        <img src="{{ asset($Recurso->RecSrc) }}" alt="" width="150" height="150" value="">  
                                                    </div>
                                                @endif
                                            @endforeach                                            
                                            @break
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                            {{-- @endforeach --}}
                        <div class="box-body">
                            <div class="col-md-12">
                                <label for="tipo">Video</label>
                            </div>
                            @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Cargue' and $Recurso->RecCarte == 'video')
                                    <div class="col-md-12">
                                        <label>{{$Recurso->RecTipo}}</label>
                                    </div>
                                    @foreach ($Recursos as $Recurso)
                                    <div class="col-md-2">
                                        <img src="{{ asset($Recurso->RecSrc) }}" alt="" width="150" height="150" value="">  
                                    </div>
                                    @endforeach
                                    @break
                                @endif
                            @endforeach
                            @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Descargue' and $Recurso->RecCarte == 'video')
                                    <div class="col-md-12">
                                        <label>{{$Recurso->RecTipo}}</label>
                                    </div>
                                    @foreach ($Recursos as $Recurso)
                                    <div class="col-md-2">
                                        <img src="{{ asset($Recurso->RecSrc) }}" alt="" width="150" height="150" value="">  
                                    </div>
                                    @endforeach
                                    @break
                                @endif
                            @endforeach
                            @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Pesaje' and $Recurso->RecCarte == 'video')
                                    <div class="col-md-12">
                                        <label>{{$Recurso->RecTipo}}</label>
                                    </div>
                                    @foreach ($Recursos as $Recurso)
                                    <div class="col-md-2">
                                        <img src="{{ asset($Recurso->RecSrc) }}" alt="" width="150" height="150" value="">  
                                    </div>
                                    @endforeach
                                    @break
                                @endif
                            @endforeach
                            @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Reempacado' and $Recurso->RecCarte == 'video')
                                    <div class="col-md-12">
                                        <label>{{$Recurso->RecTipo}}</label>
                                    </div>
                                    @foreach ($Recursos as $Recurso)
                                    <div class="col-md-2">
                                        <img src="{{ asset($Recurso->RecSrc) }}" alt="" width="150" height="150" value="">  
                                    </div>
                                    @endforeach
                                    @break
                                @endif
                            @endforeach
                            @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Mezclado' and $Recurso->RecCarte == 'video')
                                    <div class="col-md-12">
                                        <label>{{$Recurso->RecTipo}}</label>
                                    </div>
                                    @foreach ($Recursos as $Recurso)
                                    <div class="col-md-2">
                                        <img src="{{ asset($Recurso->RecSrc) }}" alt="" width="150" height="150" value="">  
                                    </div>
                                    @endforeach
                                    @break
                                @endif
                            @endforeach
                            @foreach ($Recursos as $Recurso)
                                @if ($Recurso->RecTipo == 'Destruccion' and $Recurso->RecCarte == 'video')
                                    <div class="col-md-12">
                                        <label>{{$Recurso->RecTipo}}</label>
                                    </div>
                                    @foreach ($Recursos as $Recurso)
                                    <div class="col-md-2">
                                        <img src="{{ asset($Recurso->RecSrc) }}" alt="" width="150" height="150" value="">  
                                    </div>
                                    @endforeach
                                    @break
                                @endif
                            @endforeach
                        </div>					
                        <!-- /.box -->
                    </div>
                    <!-- /.box-body -->
                </div>
				<!-- /.box -->
			</div>
			<!--/.col (right) -->
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</div>
@endsection
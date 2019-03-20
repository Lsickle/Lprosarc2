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
                                </div>
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <label for="tipo">Cargue</label>
                                    </div>
                                    {{-- @foreach ($Recursos as $Recurso) --}}
                                    <div class="col-md-2">
                                        <img src="../../../{{$Recursos->RecSrc}}" alt="" width="150" height="150" value="{{$Recursos->RecSrc}}">  
                                    </div>
                                    {{-- @endforeach --}}
                                </div>
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <label for="tipo">Descargue</label>
                                    </div>
                                    <div class="col-md-2">
                                        {{-- @foreach ($Recursos as $Recurso) --}}
                                    <img src="../../../{{$Recursos->RecSrc}}" alt="" width="150" height="150" value="{{$Recursos->RecSrc}}">  
                                    {{-- @endforeach --}}                                    
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <label for="tipo">Pesaje</label>
                                    </div>
                                    <div class="col-md-2">
                                        {{-- @foreach ($Recursos as $Recurso) --}}
                                    <img src="../../../{{$Recursos->RecSrc}}" alt="" width="150" height="150" value="{{$Recursos->RecSrc}}">  
                                    {{-- @endforeach --}}                                    
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <label for="tipo">Reempacado</label>
                                    </div>
                                    <div class="col-md-2">
                                        {{-- @foreach ($Recursos as $Recurso) --}}
                                    <img src="../../../{{$Recursos->RecSrc}}" alt="" width="150" height="150" value="{{$Recursos->RecSrc}}">  
                                    {{-- @endforeach --}}                                    
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <label for="tipo">Mezclado</label>
                                    </div>
                                    <div class="col-md-2">
                                        {{-- @foreach ($Recursos as $Recurso) --}}
                                    <img src="../../../{{$Recursos->RecSrc}}" alt="" width="150" height="150" value="{{$Recursos->RecSrc}}">  
                                    {{-- @endforeach --}}                                    
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <label for="tipo">Destruccion</label>
                                    </div>
                                    <div class="col-md-2">
                                        {{-- @foreach ($Recursos as $Recurso) --}}
                                    <img src="../../../{{$Recursos->RecSrc}}" alt="" width="150" height="150" value="{{$Recursos->RecSrc}}">  
                                    {{-- @endforeach --}}                                    
                                    </div>
                                </div>
                                
                                {{-- </div> --}}
                            </div>
                            {{-- @endforeach --}}
                            <div class="box-body">
                                    <div class="col-md-12">
                                        <label for="tipo">Video</label>
                                    </div>
                            <div class="col-md-6">
                                    
                            </div>



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
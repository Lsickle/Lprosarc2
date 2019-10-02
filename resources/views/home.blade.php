@extends('layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection
@section('title')
	{{ trans('adminlte_lang::message.home') }}
@endsection
@section('contentheader_title')
<div class="text-center"><h2> Bienvenido {{ Auth::user()->name }}</h4></div>
@endsection
@switch(Auth::user()->UsRol)
    @case('JefeLogistica')
		@include('layouts.homeroles.jefelogistica')
        @break

    @case('AsistenteLogistica')
		@include('layouts.homeroles.asistentelogistica')
        @break

	@default
         
@endswitch

<!-- Default box -->
{{-- <div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Home</h3>

		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				<i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-body">
		{{ trans('adminlte_lang::message.logged') }}. Comienza creandote una aplicacion increible!
	</div>
	<!-- /.box-body -->
</div> --}}
<!-- /.box -->
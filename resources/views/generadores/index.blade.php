@extends('layouts.app')
@section('htmlheader_title')
  {{ trans('adminlte_lang::message.genermenu') }}
@endsection
@section('contentheader_title')
  {{ trans('adminlte_lang::message.genermenu') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.generindex') }}</h3>
					@if(Auth::user()->UsRol === trans('adminlte_lang::message.Cliente') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
						<a href="/generadores/create" class="btn btn-primary pull-right" >{{ trans('adminlte_lang::message.create') }}</a>
					@endif
					@if ()
						
					@endif
						<a href="/Soy-Gener/{{Auth::user()->id}}" class="btn btn-success" >Soy Generador</a>
				</div>
			<!-- /.box-header -->
				<div class="box box-info">
				
					<div class="box-body">
						<table id="generadores" class="table table-bordered table-striped">
							<thead>
								<tr>
									@if(Auth::user()->UsRol !== trans('adminlte_lang::message.Cliente'))
										<th>{{ trans('adminlte_lang::message.clientcliente') }}</th>
									@endif
									<th>{{ trans('adminlte_lang::message.sclientsede') }}</th>
									<th>{{ trans('adminlte_lang::message.name') }}</th>
									<th>{{ trans('adminlte_lang::message.clientNIT') }}</th>
									<th>{{ trans('adminlte_lang::message.seemore') }}</th>
								</tr>
							</thead>
							<tbody  hidden onload="renderTable()" id="readyTable">
							@include('layouts.partials.spinner')
							@foreach($Generadors as $Gener)
								<tr @if($Gener->GenerDelete === 1)
									style="color: red;" 
								@endif
								>
									@if(Auth::user()->UsRol !== trans('adminlte_lang::message.Cliente'))
										<td>{{$Gener->CliShortname}}</td>
									@endif
									<td>{{$Gener->SedeName}}</td>
									<td>{{$Gener->GenerShortname}}</td>
									<td>{{$Gener->GenerNit}}</td>
									<td>
										<a method='get' href='/generadores/{{$Gener->GenerSlug}}' class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.see') }}</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
            <!-- /.box-body -->
          	</div>
          <!-- /.box -->
		</div>
	</div>
</div>
@endsection
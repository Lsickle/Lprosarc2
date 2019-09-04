@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.personalhtmlheader_title') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.personalhtmlheader_title') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">{{ trans('adminlte_lang::message.personaltitlelist') }}</h3>
					@if(in_array(Auth::user()->UsRol, Permisos::PersInter1) || in_array(Auth::user()->UsRol2, Permisos::PersInter1))
						<a href="personalInterno/create" class="btn btn-primary pull-right">{{ trans('adminlte_lang::message.create') }}</a>
					@endif
				</div>
				<div class="box box-info">
					<div class="box-body">
						<table id="PersonalsInternoTable" class="table table-compact table-bordered table-striped">
							<thead>
								<tr>
									@if(in_array(Auth::user()->UsRol, Permisos::PERSONAL) || in_array(Auth::user()->UsRol2, Permisos::PERSONAL))
									<th>{{ trans('adminlte_lang::message.persdocument') }}</th>
									@endif
									<th>{{ trans('adminlte_lang::message.persname') }}</th>
									<th>{{ trans('adminlte_lang::message.emailaddress') }}</th>
									<th>{{ trans('adminlte_lang::message.mobile') }}</th>
									<th>Cargo</th>
									<th>Área</th>
									@if(in_array(Auth::user()->UsRol, Permisos::PersInter1) || in_array(Auth::user()->UsRol2, Permisos::PersInter1))
									<th>{{ trans('adminlte_lang::message.see') }}</th>
									@endif

								</tr>
							</thead>
							<tbody id="readyTable">
								@foreach($Personals as $Personal)
								<tr style="{{$Personal->PersDelete === 1 ? 'color: red' : ''}}">
									@if(in_array(Auth::user()->UsRol, Permisos::PERSONAL) || in_array(Auth::user()->UsRol2, Permisos::PERSONAL))
									<td>{{$Personal->PersDocType." ".$Personal->PersDocNumber}}</td>
									@endif
									<td>{{$Personal->PersFirstName." ".$Personal->PersSecondName." ".$Personal->PersLastName}}</td>
									<td>{{$Personal->PersEmail}}</td>
									<td>{{$Personal->PersCellphone}}</td>
									<td>{{$Personal->CargName}}</td>
									<td>{{$Personal->AreaName}}</td>
									@if(in_array(Auth::user()->UsRol, Permisos::PersInter1) || in_array(Auth::user()->UsRol2, Permisos::PersInter1))
									<td><a method='get' href='/personalInterno/{{$Personal->PersSlug}}' class='btn btn-info btn-block' title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i></a></td>
									@endif
									
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
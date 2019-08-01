@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.contracttitle') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.contracttitle') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16">
			@component('layouts.partials.modal')
			@slot('slug')
			{{$Contrato->ContraSlug}}
			@endslot
			@slot('textModal')
			este contrato
			@endslot
			@endcomponent
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{trans('adminlte_lang::message.contractedit')}}</h3>
					@if($Contrato->ContraDelete == 0)
						<a method='get' href='#' data-toggle='modal' data-target='#myModal{{$Contrato->ContraSlug}}' class='btn btn-danger pull-right'><i class="fas fa-trash-alt"></i><b> {{ trans('adminlte_lang::message.delete') }}</b></a>
						<form action='/contratos/{{$Contrato->ContraSlug}}' method='POST'>
							@method('DELETE')
							@csrf
							<input  type="submit" id="Eliminar{{$Contrato->ContraSlug}}" style="display: none;">
						</form>
					@else
						<form action='/contratos/{{$Contrato->ContraSlug}}' method='POST' class="pull-right">
							@method('DELETE')
							@csrf
							<button type="submit" class='btn btn-success btn-block'>{{ trans('adminlte_lang::message.add') }}</button>
						</form>
					@endif
				</div>
				<div class="box box-info">
					<form role="form" action="/contratos/{{$Contrato->ContraSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator">
						@method('PUT')
						@csrf
						<div class="box-body">
							<div class="form-group col-md-6">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.contractclien') }}" data-content="{{ trans('adminlte_lang::message.contractcliendescript') }}" for="AreaSelect"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.contractclien')}}</label><small class="help-block with-errors">*</small>
								<select name="Fk_ContraCli" required id="Fk_ContraCli" class="form-control select">
									<option value="">{{trans('adminlte_lang::message.select')}}</option>
									@foreach($Clientes as $Cliente)
										<option value="{{$Cliente->CliSlug}}" {{$Cliente->ID_Cli == $Contrato->Fk_ContraCli ? 'selected' : ''}}>{{$Cliente->CliShortname}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-6">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.contractpdf') }}" data-content="{{ trans('adminlte_lang::message.contractpdfdescript') }}" for="CargoGrade"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.contractpdf')}}</label>
								<div class="input-group">
									<input type="file" name="ContraPdf" data-validate="true" data-filesize="5120" class="form-control" data-accept="pdf" accept=".pdf">
									<div class="input-group-btn">
										<a href="/img/Contratos/{{$Contrato->ContraPdf}}" class="btn btn-success" target="_blank"> <i class="fas fa-file-pdf fa-lg"></i> </a>
									</div>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.contractvigencia') }}" data-content="{{ trans('adminlte_lang::message.contractvigenciadescript') }}" for="NombreCargo"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.contractvigencia')}}</label><small class="help-block with-errors">*</small>
								<input required name="ContraVigencia" autofocus="true" type="date" class="form-control" id="ContraVigencia" value="{{$Contrato->ContraVigencia}}">
							</div>
							
							<div class="form-group col-md-6">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.contractnotify') }}" data-content="{{ trans('adminlte_lang::message.contractnotifydescript') }}" for="CargoSalary"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.contractnotify')}}</label>
								<div class="input-group">
									<input type="text" class="form-control number" maxlength="2" name="ContratoNumVigencia"value="{{$Contrato->ContratoNumVigencia}}">
									<input type="text" name="ContratoTypeVigencia" id="ContratoTypeVigencia" hidden="" value="{{$Contrato->COntratoTypeVigencia}}">
									<div class="input-group-btn">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="btndma">
											{{$Contrato->ContratoTypeVigencia}} <span class="caret"></span>
										</button>
										<ul class="dropdown-menu dropdown-menu-right">
											<li><a onclick="changedma('Día(s)')">Día(s)</a></li>
											<li><a onclick="changedma('Semana(s)')">Semana(s)</a></li>
											<li><a onclick="changedma('Mes(es)')">Mes(es)</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="box box-info">
							<div class="box-footer">
								<button type="submit" class="btn btn-success pull-right">{{trans('adminlte_lang::message.update')}}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('NewScript')
	<script type="text/javascript">
		function changedma(valor){
			$('#btndma').empty();
			$('#btndma').append(valor+` <span class="caret"></span>`);
			$('#ContratoTypeVigencia').val(valor);
		}
	</script>
@endsection
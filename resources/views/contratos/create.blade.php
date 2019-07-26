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
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{trans('adminlte_lang::message.contractcreate')}}</h3>
				</div>
				<div class="box box-info">
					<form role="form" action="/contratos" method="POST" enctype="multipart/form-data" data-toggle="validator">
						@csrf
						<div class="box-body">
							<div class="form-group col-md-6">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.contractclien') }}" data-content="{{ trans('adminlte_lang::message.contractcliendescript') }}" for="AreaSelect"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.contractclien')}}</label><small class="help-block with-errors">*</small>
								<select name="Fk_ContraCli" required id="Fk_ContraCli" class="form-control select">
									<option value="">{{trans('adminlte_lang::message.select')}}</option>
									@foreach($Clientes as $Cliente)
										<option value="{{$Cliente->CliSlug}}">{{$Cliente->CliShortname}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-6">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.contractpdf') }}" data-content="{{ trans('adminlte_lang::message.contractpdfdescript') }}" for="CargoGrade"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.contractpdf')}}</label>
								<input type="file" name="ContraPdf" data-validate="true" required data-filesize="5120" class="form-control" data-accept="pdf" accept=".pdf">
							</div>
							<div class="form-group col-md-6">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.contractvigencia') }}" data-content="{{ trans('adminlte_lang::message.contractvigenciadescript') }}" for="NombreCargo"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.contractvigencia')}}</label><small class="help-block with-errors">*</small>
								<input required name="ContraVigencia" autofocus="true" type="date" class="form-control" id="ContraVigencia">
							</div>
							
							<div class="form-group col-md-6">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.contractnotify') }}" data-content="{{ trans('adminlte_lang::message.contractnotifydescript') }}" for="CargoSalary"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{trans('adminlte_lang::message.contractnotify')}}</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ContratoNumVigencia">
									<input type="text" name="ContratoTypeVigencia" id="ContratoTypeVigencia" hidden="" value="Día(s)">
									<div class="input-group-btn">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="btndma">Día(s) <span class="caret"></span></button>
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
								<button type="submit" class="btn btn-success pull-right">{{trans('adminlte_lang::message.register')}}</button>
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
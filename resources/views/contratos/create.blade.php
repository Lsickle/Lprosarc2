@extends('layouts.app')
@section('htmlheader_title')
{{-- {{ trans('adminlte_lang::message.cargotitle') }} --}}
Contratos
@endsection
@section('contentheader_title')
{{-- {{ trans('adminlte_lang::message.cargotitle') }} --}}
Contratos
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{-- {{trans('adminlte_lang::message.createcargo')}} --}}Creación de Contratos</h3>
				</div>
				<div class="box box-info">
					<form role="form" action="/contratos" method="POST" enctype="multipart/form-data" data-toggle="validator">
						@csrf
						<div class="box-body">
							<div class="form-group col-md-6">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.cargoareatittle') }}" data-content="{{ trans('adminlte_lang::message.cargoareainfo') }}" for="AreaSelect"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{-- {{trans('adminlte_lang::message.inputarea')}} --}}Clientes</label><small class="help-block with-errors">*</small>
								<select name="CargArea" required id="AreaSelect" class="form-control select">
									<option value="">{{trans('adminlte_lang::message.select')}}</option>
									@foreach($Clientes as $Cliente)
										<option value="{{$Cliente->CliSlug}}">{{$Cliente->CliShortname}}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-6">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.cargogradetittle') }}" data-content="{{ trans('adminlte_lang::message.cargogradeinfo') }}" for="CargoGrade"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{-- {{trans('adminlte_lang::message.cargograde')}} --}}Contrato</label>
								<input type="file" name="" data-validate="true" required data-filesize="5120" class="form-control" data-accept="pdf" accept=".pdf">
							</div>
							<div class="form-group col-md-6">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.cargonametittle') }}" data-content="{{ trans('adminlte_lang::message.cargonameinfo') }}" for="NombreCargo"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{-- {{trans('adminlte_lang::message.cargoname')}} --}}Fecha de vencimiento</label><small class="help-block with-errors">*</small>
								<input required name="CargName" autofocus="true" type="date" class="form-control" id="NombreCargo">
							</div>
							
							<div class="form-group col-md-6">
								<label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" data-delay='{"show": 500}' title="{{ trans('adminlte_lang::message.cargosalarytittle') }}" data-content="{{ trans('adminlte_lang::message.cargosalaryinfo') }}" for="CargoSalary"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{-- {{trans('adminlte_lang::message.cargosalary')}} --}}¿Cuando notificar?</label>
								{{-- <div class="input-group"> --}}
									<button type="button" class="btn btn-default btn-block" id="daterange-btn">
										<span>
											<i class="fa fa-calendar"></i> Date range picker
										</span>
										<i class="fa fa-caret-down"></i>
									</button>
								{{-- </div> --}}
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
		$('#daterange-btn').daterangepicker(
		  {
		    ranges   : {
		      'Today'       : [moment(), moment()],
		      'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		      'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
		      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
		      'This Month'  : [moment().startOf('month'), moment().endOf('month')],
		      'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		    },
		    startDate: moment().subtract(29, 'days'),
		    endDate  : moment()
		  },
		  function (start, end) {
		    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
		  }
		)
	</script>
@endsection
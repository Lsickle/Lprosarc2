@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.clientmenu') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, rgb(255, 216, 111), rgb(252, 98, 98)); padding-right:30vw; position:relative; overflow:hidden;">
    {{ trans('adminlte_lang::message.clientmenu') }}
    <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-16 col-md-offset-0">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('adminlte_lang::message.clientindexboxtitle') }}</h3>
                </div>
                <div class="box box-info">
                    <div class="box-body">
                        <table id="clientesTable" class="table table-compact table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Registro</th>
                                    <th>{{ trans('adminlte_lang::message.clientNIT') }}</th>
                                    <th>{{ trans('adminlte_lang::message.clirazonsoc') }}</th>
                                    <th>Dirección</th>
                                    @if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARCMenosComercial))
                                    <th>Comercial Asignado</th>
                                    @endif
                                    <th>{{ trans('adminlte_lang::message.seemore') }}</th>
                                </tr>
                            </thead>
                            <tbody onload="renderTable()" id="readyTable">
                                @foreach($clientes as $cliente)
                                <tr style="{{$cliente->CliDelete === 1 ? 'color: red;' : ''}}">
                                    <td>{{$cliente->created_at}}</td>
                                    <td>{{$cliente->CliNit}}</td>
                                    <td>{{$cliente->CliName}}</td>
                                    <td>{{$cliente->sedes[0]->SedeAddress}}  {{$cliente->sedes[0]->SedeMapLocalidad !== 'No Definida' ? 'Localidad: '.$cliente->sedes[0]->SedeMapLocalidad : ''}}</td>
                                    @if(in_array(Auth::user()->UsRol, Permisos::TODOPROSARCMenosComercial))
                                    <td>
                                        @if(in_array(Auth::user()->UsRol, Permisos::AsigComercial) || in_array(Auth::user()->UsRol2, Permisos::AsigComercial))
                                        <a href="#" class="kg" onclick="changeComercial(`{{$cliente->CliSlug}}`, {{intval($cliente->CliComercial)}}, `{{$cliente->CliShortname}}`)"><i class="fas fa-marker"></i></a>
                                        @endif
                                        {{$cliente->PersFirstName <> null ? $cliente->PersFirstName.' '.$cliente->PersLastName : 'Sin Asignar'}}
                                    </td>
                                    @endif
                                    <td>
                                        <a method='get' href='/clientes/{{$cliente->CliSlug}}' class='btn btn-info btn-block' title="{{ trans('adminlte_lang::message.seemoredetails')}}"><i class="fas fa-search"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div id="divchangeComercial"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@if(in_array(Auth::user()->UsRol, Permisos::AsigComercial) || in_array(Auth::user()->UsRol2, Permisos::AsigComercial))
@section('NewScript')
<script>
    function changeComercial(slug, idPers, clishorname){
			var selected = idPers;
			var personal = [];
			var personals = <?php echo json_encode($personals);  ?>;

			$('#divchangeComercial').empty();
			$('#divchangeComercial').append(`
				<form role="form" action="/clientes/`+slug+`/changeComercial" method="POST" enctype="multipart/form-data" data-toggle="validator">
					@csrf
					<div class="modal modal-default fade in" id="changeComercial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<label style="font-size: 2rem;">Asignación de comercial</label>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
								</div>
								<div class="modal-body">
									<div class="form-group has-feedback">
										<label>Seleccione el comercial</label><small class="help-block with-errors">*</small>
										<select name="Comercial" id="Comercial" class="form-control" required>
											<option value="">Seleccione...</option>

										</select>
									</div>
									<div class="form-group has-feedback">
										<span data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Nombre Corto del Cliente</b>" data-content="el <b><i>Nombre Corto</i></b> es para facilitar el manejo interno de la informacion del cliente... en este campo solo debe escribir caracteres alfanumericos <b>(no se permiten espacios)</b>"><i style="color: Dodgerblue;" class="fas fa-info-circle fa-spin"></i></span>
									    <label for="modalCliShortname" class="control-label">Nombre Corto</label>
									    <small class="help-block with-errors">*</small>
									      <input type="text" pattern="^[_A-z0-9]{1,}$" data-pattern-error="solo se admiten letras y numeros" maxlength="15" class="form-control" placeholder="1000hz" required value="`+clishorname+`" name="CliShortname" id="modalCliShortname">
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-success pull-right">{{trans('adminlte_lang::message.save')}}</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			`);
			// Selects();
			personals.forEach(function(value, index) {
			    personal[index] = value;
				if (personal[index]['ID_Pers'] == idPers) {
					$('#Comercial').append(`<option selected value='`+personal[index]['ID_Pers']+`'> `+personal[index]['PersFirstName']+` `+personal[index]['PersLastName']+` </option>`);
			    }else{
			    	$('#Comercial').append(`<option value='`+personal[index]['ID_Pers']+`'> `+personal[index]['PersFirstName']+` `+personal[index]['PersLastName']+` </option>`);
			    }
			});
			popover();
			$('form').validator('update');
			$('#changeComercial').modal();
		}
</script>
@endsection
@endif

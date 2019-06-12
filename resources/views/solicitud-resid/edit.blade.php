@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solser') }}
@endsection
@section('contentheader_title')
{{ trans('adminlte_lang::message.solser') }}
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header with-border">
                    <h3 class="box-title">{{ trans('adminlte_lang::message.solresedit') }}</h3>
				</div>
                <div class="box box-info">
                    <form role="form" action="/solicitud-residuo/{{$SolRes->SolResSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator" id="Form">
                        @method('PUT')
                        @csrf
                        @if ($errors->any())
							<div class="alert alert-danger" role="alert">
								<ul>
									@foreach ($errors->all() as $error)
										<p>{{$error}}</p>
									@endforeach
								</ul>
							</div>
						@endif
                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserrespel') }}</b>" data-content="{{ trans('adminlte_lang::message.solserrespeldescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solserrespel') }}</label>
                                <small class="help-block with-errors">*</small>
                                <select name="FK_SolResSolSer" id="FK_SolResSolSer" disabled class="form-control" required>
                                    <option value="{{$Respel->RespelSlug}}" {{ $SolRes->FK_SolResSolSer == $Respel->ID_Respel ? 'selected' : '' }}>{{$Respel->RespelName}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsertypeunidad') }}</b>" data-content="{{ trans('adminlte_lang::message.solsertypeunidaddescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solsertypeunidad') }}</label>
                                <select name="SolResTypeUnidad" id="SolResTypeUnidad" class="form-control">
                                    <option value="" onclick="NoSolResCantiUnidad()">{{ trans('adminlte_lang::message.select') }}</option>
                                    <option value="99" {{$SolRes->SolResTypeUnidad  === "Unidad" ? 'selected' : '' }} onclick="SolResCantiUnidad()">{{ trans('adminlte_lang::message.solserunidad1') }}</option>
                                    <option value="98" {{$SolRes->SolResTypeUnidad  === "Litros" ? 'selected' : '' }} onclick="SolResCantiUnidad()">{{ trans('adminlte_lang::message.solserunidad2') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsercantidad') }}</b>" data-content="{{ trans('adminlte_lang::message.solsercantidaddescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solsercantidad') }} (Unidades)</label>
                                <small class="help-block with-errors"></small>
                                <input type="text" class="form-control numberKg" id="SolResCantiUnidad" name="SolResCantiUnidad" value="{{$SolRes->SolResCantiUnidad}}">
                            </div>
                            <div id="embalaje" class="form-group col-md-6">
                                <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserembaja') }}</b>" data-content="{{ trans('adminlte_lang::message.solserembajadescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solserembaja') }}</label>
                                <small class="help-block with-errors">*</small>
                                <select name="SolResEmbalaje" id="SolResEmbalaje" class="form-control" required>
                                    <option value="">{{ trans('adminlte_lang::message.select') }}</option>
                                    <option value="99" {{$SolRes->SolResEmbalaje  === "Bolsas" ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solserembaja1') }}</option>
                                    <option value="98" {{$SolRes->SolResEmbalaje  === "Canecas" ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solserembaja2') }}</option>
                                    <option value="97" {{$SolRes->SolResEmbalaje  === "Estibas" ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solserembaja3') }}</option>
                                    <option value="96" {{$SolRes->SolResEmbalaje  === "Garrafones" ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solserembaja4') }}</option>
                                    <option value="95" {{$SolRes->SolResEmbalaje  === "Cajas" ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solserembaja5') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsercantidadkg') }}</b>" data-content="{{ trans('adminlte_lang::message.solsercantidadkgdescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solsercantidadkg') }}</label>
                                <small class="help-block with-errors">*</small>
                                <input type="text" class="form-control numberKg" id="SolResKgEnviado" name="SolResKgEnviado" maxlength="20" value="{{$SolRes->SolResKgEnviado}}" required>
                            </div>

                            @if(Auth::user()->UsRol !== trans('adminlte_lang::message.Cliente'))
                                <div id="divSolResKgRecibido">
                                </div>
                                <div id="divSolResKgConciliado">
                                </div>
                                @if (Auth::user()->UsRol !== trans('adminlte_lang::message.JefeLogistica'))
                                    <div id="divSolResKgTratado">
                                    </div>
                                @endif 
                            @endif
                            <div class="form-group col-md-16" style="text-align: center;">
                                <div class="form-group col-md-12">
                                    <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserdimension') }}</b>" data-content="{{ trans('adminlte_lang::message.solserdimensiondescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solserdimension') }}</label>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="SolResAlto">{{ trans('adminlte_lang::message.solserdimension1') }}</label>
                                    <input type="text" class="form-control numberDimension" id="SolResAlto" name="SolResAlto" value="{{$SolRes->SolResAlto}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="SolResAncho">{{ trans('adminlte_lang::message.solserdimension2') }}</label>
                                    <input type="text" class="form-control numberDimension" id="SolResAncho" name="SolResAncho" value="{{$SolRes->SolResAncho}}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="SolResProfundo">{{ trans('adminlte_lang::message.solserdimension3') }}</label>
                                    <input type="text" class="form-control numberDimension" id="SolResProfundo" name="SolResProfundo" value="{{$SolRes->SolResProfundo}}">
                                </div>
                            </div>
                            <div class="form-group col-md-12" style="text-align: center;">
                                <div class="form-group col-md-12">
                                    <label>{{ trans('adminlte_lang::message.requirements') }}</label>
                                </div>
                                <div class="form-group col-md-6" style="border: 2px dashed #00c0ef">
                                    <div class="form-group col-md-12">
                                        <label>{{ trans('adminlte_lang::message.recursoFoto') }}</label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.requiredescarguephoto') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.requiredescarguephotodescrit') }}</p>">
                                            <label for="SolResFotoDescargue_Pesaje">{{ trans('adminlte_lang::message.requeredescargue') }}</label>
                                            <div style="width: 100%; height: 34px;">
                                                <input type="checkbox" class="fotoswitch" id="SolResFotoDescargue_Pesaje" onclick="Checkboxs()" data-name="SolResFotoDescargue_Pesaje1" {{$SolRes->SolResFotoDescargue_Pesaje  == 1 ? 'checked' : '' }}/>
                                                <input type="text" id="SolResFotoDescargue_Pesaje1" name="SolResFotoDescargue_Pesaje" hidden value="">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.requiretratamientophoto') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.requiretratamientophotodescrit') }}</p>">
                                            <label for="SolResFotoTratamiento">{{ trans('adminlte_lang::message.requeretratamiento') }}</label>
                                            <div style="width: 100%; height: 34px;">
                                                <input type="checkbox" class="fotoswitch" id="SolResFotoTratamiento" onclick="Checkboxs()" data-name="SolResFotoTratamiento1" {{$SolRes->SolResFotoTratamiento  == 1 ? 'checked' : '' }}/>
                                                <input type="text" id="SolResFotoTratamiento1" name="SolResFotoTratamiento" hidden value="">
                                            </div>
                                        </label>
                                    </div>
                                </div> 
                                <div class="form-group col-md-6" style="border: 2px dashed #00c0ef">
                                    <div class="form-group col-md-12">
                                        <label>{{ trans('adminlte_lang::message.recursoVideo') }}</label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.requiredescarguevideo') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.requiredescarguevideodescrit') }}</p>">
                                            <label for="SolResVideoDescargue_Pesaje">{{ trans('adminlte_lang::message.requeredescargue') }}</label>
                                            <div style="width: 100%; height: 34px;">
                                                <input type="checkbox" class="videoswitch" id="SolResVideoDescargue_Pesaje" onclick="Checkboxs()" data-name="SolResVideoDescargue_Pesaje1" {{$SolRes->SolResVideoDescargue_Pesaje  == 1 ? 'checked' : '' }}/>
                                                <input type="text" id="SolResVideoDescargue_Pesaje1" name="SolResVideoDescargue_Pesaje" hidden value="">
                                            </div>
                                        </label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.requiretratamientovideo') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.requiretratamientovideodescrit') }}</p>">
                                            <label for="SolResVideoTratamiento">{{ trans('adminlte_lang::message.requeretratamiento') }}</label>
                                            <div style="width: 100%; height: 34px;">
                                                <input type="checkbox" class="videoswitch" id="SolResVideoTratamiento" onclick="Checkboxs()" data-name="SolResVideoTratamiento1" {{$SolRes->SolResVideoTratamiento  == 1 ? 'checked' : '' }}>
                                                <input type="text" id="SolResVideoTratamiento1" name="SolResVideoTratamiento" hidden value="">
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box box-info">
                            <div class="box-footer">
                                <button type="submit" class="btn btn-warning pull-right">{{ trans('adminlte_lang::message.update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</div>
</div>
@section('NewScript')
@if (Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.SupervisorTurno') || Auth::user()->UsRol === trans('adminlte_lang::message.JefeLogistica'))
    <script>
        $(document).ready(function (){
            $("#divSolResKgRecibido").append(`
                <div class="form-group col-md-6">
                    <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.edit') }}</b>" data-content="{{ trans('adminlte_lang::message.solserembajadescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Resivido</label><small class="help-block with-errors">*</small>
                    <input type="number" class="form-control numberKg" id="SolResKgRecibido" min="0" maxlength="11" name="SolResKgRecibido" value="{{$SolRes->SolResKgRecibido}}" required>
                </div>
            `);
            $("#divSolResKgConciliado").append(`
                <div class="form-group col-md-6">
                    <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.delete') }}</b>" data-content="{{ trans('adminlte_lang::message.solserembajadescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Conciliado</label><small class="help-block with-errors">*</small>
                    <input type="number" class="form-control numberKg" id="SolResKgConciliado" max="{{$SolRes->SolResKgRecibido}}" min="0" maxlength="11" name="SolResKgConciliado" value="{{$SolRes->SolResKgConciliado}}" required>
                </div>
            `);
            $("#divSolResKgTratado").append(`
                <div class="form-group col-md-12">
                    <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.update') }}</b>" data-content="{{ trans('adminlte_lang::message.solserembajadescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>Tratado</label><small class="help-block with-errors">*</small>
                    <div class="input-group">
                        <input type="number" class="form-control numberKg" id="SolResKgTratado" max="{{$SolRes->SolResKgConciliado}}" min="0" maxlength="11" name="SolResKgTratado" value="{{$SolRes->SolResKgTratado}}" required>
                        <div class="input-group-btn">
                            <label for="ValorConciliado"><a title="Lo consiliado ya esta tratado" id="btn-consiliado" class="btn btn-success">Tratado</a><label>
                            <input type="submit" hidden name="ValorConciliado" id="ValorConciliado" value="{{$SolRes->SolResKgConciliado}}">
                        </div>
                    </div>
                </div>
            `);

            $('#SolResTypeUnidad').prop('disabled', true);
            $('#SolResCantiUnidad').prop('disabled', true);
            $('#SolResEmbalaje').prop('disabled', true);
            $('#SolResKgEnviado').prop('disabled', true);
            $('#SolResAlto').prop('disabled', true);
            $('#SolResAncho').prop('disabled', true);
            $('#SolResProfundo').prop('disabled', true);
            $('#Form').validator('validate');

            $('#SolResFotoDescargue_Pesaje').bootstrapSwitch('disabled', true);
            $('#SolResFotoTratamiento').bootstrapSwitch('disabled', true);
            $('#SolResVideoDescargue_Pesaje').bootstrapSwitch('disabled', true);
            $('#SolResVideoTratamiento').bootstrapSwitch('disabled', true);
        });
    </script>
    <script>
        
        switch('{{Auth::user()->UsRol}}'){
            case '{{trans("adminlte_lang::message.JefeLogistica")}}':
                $(document).ready(function (){
                    SolResKgRecibido();
                });
                if('{{$SolSer->SolSerStatus !== "Conciliado"}}'){
                    $(document).ready(function (){
                        SolResKgConciliado();
                    });
                }
                break;  

            case '{{trans("adminlte_lang::message.SupervisorTurno")}}':
                
                switch('{{$SolSer->SolSerStatus}}'){
                    case 'Conciliado':
                        $(document).ready(function (){
                            SolResKgRecibido();
                            SolResKgConciliado();
                            SolResKgTratado();
                            ValorConciliado();
                        });
                        break;
                    case 'Completado':
                        $(document).ready(function (){
                            SolResKgTratado();
                            ValorConciliado();
                            SolResKgConciliado();
                        });
                        break;
                    case 'Tratado':
                        $(document).ready(function (){
                            SolResKgRecibido();
                            SolResKgConciliado();
                        });
                        break;
                    default:
                        $(document).ready(function (){
                            SolResKgTratado();
                            SolResKgConciliado();
                            SolResKgRecibido();
                        });
                        break;
                }
                break;  

            default:
                $(document).ready(function (){
                    SolResKgRecibido();
                    SolResKgConciliado();
                    SolResKgTratado();
                    ValorConciliado();
                });
        }

        function ValorConciliado(){
            $('#btn-consiliado').attr('disabled', true);
            $('#ValorConciliado').prop('type', "text");
        }
        function SolResKgRecibido(){
            $('#SolResKgRecibido').prop('disabled', true);
        }

        function SolResKgTratado(){
            $('#SolResKgTratado').prop('disabled', true);
        }

        function SolResKgConciliado(){
            $('#SolResKgConciliado').prop('disabled', true);
        }
    </script>
@endif
@if (Auth::user()->UsRol === trans('adminlte_lang::message.Cliente'))

<script>
    $(document).ready(function (){
        numeroKg();
        numeroDimension();
    });
</script>
<script>
    function Checkboxs(){
        $('input[type="checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
            if(state == true){
                $("#"+this.dataset.name).val(1);
            }
            else{
                $("#"+this.dataset.name).val(0);
            }
        });
    }
    Checkboxs();

    function SolResCantiUnidad(){
        $('#SolResCantiUnidad').prop('required', true);
        $('#Form').validator('validate');
    }
    function NoSolResCantiUnidad(){
        $('#SolResCantiUnidad').prop('required', false);
        $('#Form').validator('validate');
    }
</script>
@endif
@endsection
@endsection
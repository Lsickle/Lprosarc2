@extends('layouts.app')
@section('htmlheader_title')
Solicitude de Residuo
@endsection
@section('contentheader_title')
Editar Solicitud de Residuo
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
		<div class="col-md-16 col-md-offset-0">
			<div class="box">
				<div class="box-header with-border">
                    <h3 class="box-title">Datos</h3>
				</div>
                <div class="box box-info">
                    <form role="form" action="/solicitud-residuo/{{$SolRes->SolResSlug}}" method="POST" enctype="multipart/form-data" data-toggle="validator" class="form">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group col-md-12">
                                <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserrespel') }}</b>" data-content="{{ trans('adminlte_lang::message.solserrespeldescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solserrespel') }}</label>
                                {{-- <button type="button" class="btn btn-box-tool" style="color: #f39c12;" data-toggle="collapse" data-target="#RespelData" title="Reducir/Ampliar"><i class="fas fa-arrows-alt-v"></i></button> --}}
                                <small class="help-block with-errors">*</small>
                                <select name="FK_SolResSolSer" id="FK_SolResSolSer" class="form-control" required>
                                    @if(Auth::user()->UsRol === trans('adminlte_lang::message.Administrador') || Auth::user()->UsRol === trans('adminlte_lang::message.Programador'))
                                        <option value="{{$Respel->ID_Respel}}" {{ $SolRes->FK_SolResSolSer == $Respel->ID_Respel ? 'selected' : '' }}>{{$Respel->RespelName}}</option>
                                    @else
                                        <option value="">{{ trans('adminlte_lang::message.select') }}</option>
                                        @foreach ($Respels as $Respel)
                                            <option value="{{$Respel->ID_Respel}}" {{ $RespelSgener->FK_Respel == $Respel->ID_Respel ? 'selected' : '' }}>{{$Respel->RespelName}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="collapse in">
                                <div class="form-group col-md-6">
                                    <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsertypeunidad') }}</b>" data-content="{{ trans('adminlte_lang::message.solsertypeunidaddescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solsertypeunidad') }}</label>
                                    <select name="SolResTypeUnidad" id="SolResTypeUnidad" class="form-control">
                                        <option value="">{{ trans('adminlte_lang::message.select') }}</option>
                                        <option value="99" {{$SolRes->SolResFotoDescargue_Pesaje  === "Unidad" ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solserunidad1') }}</option>
                                        <option value="98" {{$SolRes->SolResFotoDescargue_Pesaje  === "Litros" ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solserunidad2') }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsercantidad') }}</b>" data-content="{{ trans('adminlte_lang::message.solsercantidaddescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solsercantidad') }} (Unidades)</label>
                                    <input type="text" class="form-control numberKg" id="SolResCantiUnidad" name="SolResCantiUnidad" value="{{$SolRes->SolResCantiUnidad}}">
                                </div>
                                <div id="cantidadresiduos">

                                </div>
                                <div class="form-group col-md-6">
                                    <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solserembaja') }}</b>" data-content="{{ trans('adminlte_lang::message.solserembajadescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solserembaja') }}</label>
                                    <small class="help-block with-errors">*</small>
                                    <select name="SolResEmbalaje" id="SolResEmbalaje" class="form-control">
                                        <option value="">{{ trans('adminlte_lang::message.select') }}</option>
                                        <option value="99" {{$SolRes->SolResEmbalaje  === "Bolsas" ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solserembaja1') }}</option>
                                        <option value="98" {{$SolRes->SolResEmbalaje  === "Canecas" ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solserembaja2') }}</option>
                                        <option value="97" {{$SolRes->SolResEmbalaje  === "Estibas" ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solserembaja3') }}</option>
                                        <option value="96" {{$SolRes->SolResEmbalaje  === "Garrafones" ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solserembaja4') }}</option>
                                        <option value="95" {{$SolRes->SolResEmbalaje  === "Cajas" ? 'selected' : '' }}>{{ trans('adminlte_lang::message.solserembaja5') }}</option>
                                    </select>
                                </div>
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
                                        <input type="text" class="form-control numberDimension" id="SolResAncho" name="SolResAncho"  value="{{$SolRes->SolResAncho}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="SolResProfundo">{{ trans('adminlte_lang::message.solserdimension3') }}</label>
                                        <input type="text" class="form-control numberDimension" id="SolResProfundo" name="SolResProfundo" value="{{$SolRes->SolResProfundo}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-12" style="text-align: center;">
                                <div class="form-group col-md-12">
                                    <label>{{ trans('adminlte_lang::message.requirements') }}</label>
                                </div>
                                <div class="form-group col-md-6" style="border: 2px dashed #00c0ef">
                                    <div class="form-group col-md-12">
                                        <label>{{ trans('adminlte_lang::message.requirephotos') }}</label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{-- <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.requiredescarguephoto') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.requiredescarguephotodescrit') }}</p>"> --}}
                                            <label for="SolResFotoDescargue_Pesaje">{{ trans('adminlte_lang::message.requiredescarguephoto') }}</label>
                                            <div style="width: 100%; height: 34px;">
                                                <input type="checkbox" class="fotoswitch" id="SolResFotoDescargue_Pesaje" data-name="SolResFotoDescargue_Pesaje1`+id_div+" {{$SolRes->SolResFotoDescargue_Pesaje  == 1 ? 'checked' : '' }}/>
                                                {{-- <input type="text" id="SolResFotoDescargue_Pesaje1`+id_div+" name="SolResFotoDescargue_Pesaje[`+id_div+`][]" hidden value="0" {{$SolRes->SolResFotoTratamiento  == 1 ? 'checked' : '' }}> --}}
                                            </div>
                                        </label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{-- <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.requiretratamientophoto') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.requiretratamientophotodescrit') }}</p>"> --}}
                                            <label for="SolResFotoTratamiento">{{ trans('adminlte_lang::message.requiretratamientophoto') }}</label>
                                            <div style="width: 100%; height: 34px;">
                                                <input type="checkbox" class="fotoswitch" id="SolResFotoTratamiento" data-name="SolResFotoTratamiento1" {{$SolRes->SolResFotoTratamiento  == 1 ? 'checked' : '' }}/>
                                                {{-- <input type="text" id="SolResFotoTratamiento1`+id_div+" name="SolResFotoTratamiento[`+id_div+`][]" hidden value="0"> --}}
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6" style="border: 2px dashed #00c0ef">
                                    <div class="form-group col-md-12">
                                        <label>{{ trans('adminlte_lang::message.requirevideos') }}</label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{-- <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.requiredescarguevideo') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.requiredescarguevideodescrit') }}</p>"> --}}
                                            <label for="SolResVideoDescargue_Pesaje">{{ trans('adminlte_lang::message.requiredescarguevideo') }}</label>
                                            <div style="width: 100%; height: 34px;">
                                                <input type="checkbox" class="videoswitch" id="SolResVideoDescargue_Pesaje" data-name="SolResVideoDescargue_Pesaje1 {{$SolRes->SolResVideoDescargue_Pesaje  == 1 ? 'checked' : '' }} "/>
                                                {{-- <input type="text" id="SolResVideoDescargue_Pesaje1`+id_div+" name="SolResVideoDescargue_Pesaje" hidden value="0"> --}}
                                            </div>
                                        </label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        {{-- <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.requiretratamientovideo') }}</b>" data-content="<p style='width: 50%'> {{ trans('adminlte_lang::message.requiretratamientovideodescrit') }}</p>"> --}}
                                            <label for="SolResVideoTratamiento">{{ trans('adminlte_lang::message.requiretratamientovideo') }}</label>
                                            <div style="width: 100%; height: 34px;">
                                                <input type="checkbox" class="videoswitch" id="SolResVideoTratamiento" data-name="SolResVideoTratamiento1" {{$SolRes->SolResVideoTratamiento  == 1 ? 'checked' : '' }}>
                                                {{-- <input type="text" id="SolResVideoTratamiento1`+id_div+" name="SolResVideoTratamiento[`+id_div+`][]" hidden value="0"> --}}
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
@if (Auth::user()->UsRol === trans('adminlte_lang::message.Programador') || Auth::user()->UsRol === trans('adminlte_lang::message.Administrador'))

<script>
    $(document).ready(function (){
        $("#cantidadresiduos").append(`
            <div class="form-group col-md-6">
                <label>{{ trans('adminlte_lang::message.solsercantidadkg') }}</label>
                <small class="help-block with-errors">*</small>
                <input type="text" disabled class="form-control numberKg" id="SolResKgEnviado" name="SolResKgEnviado" value="{{$SolRes->SolResKgEnviado}}" required>
            </div>
            <div class="form-group col-md-6">
                <label>Tratado</label>
                <input type="text" class="form-control numberKg" id="SolResCantiUnidad" name="SolResCantiUnidad" value="{{$SolRes->SolResKgTratado}}">
            </div>
            <div class="form-group col-md-6">
                <label>Conciliado</label>
                <input type="text" class="form-control numberKg" id="SolResCantiUnidad" name="SolResCantiUnidad" value="{{$SolRes->SolResKgConciliado}}">
            </div>
            <div class="form-group col-md-6">
                <label>Resivido</label>
                <input type="text" class="form-control numberKg" id="SolResCantiUnidad" name="SolResCantiUnidad" value="{{$SolRes->SolResKgRecibido}}">
            </div>
        `);
        $('#FK_SolResSolSer').prop('disabled', true);
        $('#SolResTypeUnidad').prop('disabled', true);
        $('#SolResCantiUnidad').prop('disabled', true);
        $('#SolResEmbalaje').prop('disabled', true);

        $('#SolResVideoTratamiento').boostrapSwitch('disabled', true);
        // $('.SolResFotoTratamiento').prop('disabled', true);
        // $('.SolResVideoDescargue_Pesaje').prop('disabled', true);
        // $('.SolResVideoTratamiento').prop('disabled', true);
        // $('.form').validate('updated');

    });
</script>
@else
<script>
    $(document).ready(function(){
        $("#cantidadresiduos").append(`
            <div class="form-group col-md-6">
                <label data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>{{ trans('adminlte_lang::message.solsercantidadkg') }}</b>" data-content="{{ trans('adminlte_lang::message.solsercantidadkgdescrit') }}"><i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>{{ trans('adminlte_lang::message.solsercantidadkg') }}</label>
                <small class="help-block with-errors">*</small>
                <input type="text" class="form-control numberKg" id="SolResKgEnviado" name="SolResKgEnviado" value="{{$SolRes->SolResKgEnviado}}" required>
            </div>
        `);
    });
</script>

@endif

@endsection
@endsection
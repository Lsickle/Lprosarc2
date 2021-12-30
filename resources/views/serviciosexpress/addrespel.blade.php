@extends('layouts.app')
@section('htmlheader_title')
{{ trans('adminlte_lang::message.solsertitle') }}
@endsection
@section('contentheader_title')
<span style="background-image: linear-gradient(40deg, #d4fc79, #00C851); padding-right:30vw; position:relative; overflow:hidden;">
    Solicitudes Express
    <div style="background-color:#ecf0f5; position:absolute; height:145%; width:40vw; transform:rotate(30deg); right:-20vw; top:-45%;"></div>
</span>
@endsection
@section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-16 col-md-offset-0">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Agregar Residuos a Servicio</h3>
                </div>

                <form role="form" id="CreateSolSer" action="/serviciosexpress/{{$Solicitud->SolSerSlug}}/update-respel" method="POST" enctype="multipart/form-data">
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
                        <div class="col-md-12">

                            <div class="form-group col-md-6">
                                <label>Servicio</label>
                                <select id=""  class="form-control" disabled>
                                    <option value="{{$Solicitud->ID_SolSer}}">{{$Solicitud->ID_SolSer}}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Status</label>
                                <select id=""  class="form-control" disabled>
                                    <option value="{{$Solicitud->SolSerStatus}}">{{$Solicitud->SolSerStatus}}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Cliente</label>
                                <select id="FK_SolSerCliente" class="form-control" disabled>
                                    <option value="{{$Cliente->CliSlug}}">{{$Cliente->CliName.' ('.$Cliente->CliNit}})</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Sede</label>
                                <select id="SedeSlug" class="form-control" disabled>
                                    <option value="{{$Sede->SedeSlug}}">{{$Solicitud->SolSerCollectAddress == null ? 'N/A' : $Solicitud->SolSerCollectAddress}} <b>{{$Sede->FK_SedeMun == 169 ? "Localidad:".$Sede->SedeMapLocalidad : ""}}</b></option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <center>
                                    <label>Observaciones</label>
                                    <button type="button" class="btn btn-box-tool boton" style="color: black;" data-toggle="collapse" data-target=".Observaciones" onclick="AnimationMenusForm('.Observaciones')" title="Reducir/Ampliar"><i class="fa fa-plus"></i></button>
                                </center>
                                <div class="form-group col-md-12 collapse Observaciones" style="margin-bottom: 1em; padding-left:0; padding-right:0;">
                                    <small id="caracteresrestantes" class="help-block with-errors"></small>
                                    <textarea onchange="updatecaracteres()" id="textDescription" rows="5" style="resize: vertical;" maxlength="4000" class="form-control col-xs-12" name="SolSerDescript"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12" style="text-align: center;">
                            <hr style="border-color: green; border-width:2px;">
                            <b><a class="load"></a>RESIDUOS ADICIONALES<a class="load"></a></b>
                        </div>
                        <div id="Respels" class="col-md-12">
                            <input type="text" hidden name="SGenerador[0]" id="SGenerador">
                            <div id="DivRepel0" class="form-group col-md-16">
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" id="Submit2" class="btn btn-success pull-right">Actualizar</button>
                        {{-- <button type="submit" form="CreateSolSer" id="Submit" class="btn btn-success pull-right" style="display: none;">vamos</button> --}}
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection
@section('NewScript')
<script>
    function Switch(){
	$("#SolSerBascula").bootstrapSwitch();
	$("#SolSerCapacitacion").bootstrapSwitch();
	$("#SolSerMasPerson").bootstrapSwitch();
	$("#SolSerVehicExclusive").bootstrapSwitch();
	$("#SolSerPlatform").bootstrapSwitch();
	$("#SolSerDevolucion").bootstrapSwitch();
}
Switch();
$(document).ready(function(){
	var area = document.getElementById("textDescription");
	var message = document.getElementById("caracteresrestantes");
	var maxLength = 4000;
	$('#textDescription').keyup(function updatecaracteres() {
		message.innerHTML = (maxLength-area.value.length) + " caracteres restantes";
	});
})

function addNewRespel(id) {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
        });
        $.ajax({
            url: "{{url('/ClienteExpress-Residuos')}}/"+id,
            method: 'GET',
            data:{},
            beforeSend: function(){
                $(".load").append('<i class="fas fa-sync-alt fa-spin"></i>');
                // $("#FK_SolSerCliente").prop('disabled', true);
            },
            success: function(res){
                id_div = 0;
                ID_Gener =res.respels[0].GSedeSlug;
                contadorRespel[id_div] = 0;
                $("#SGenerador").val(ID_Gener);
                $("#DivRepel"+id_div).empty();
                $("#DivRepel"+id_div).append(`@include('serviciosexpress.layaoutsSolSer.OneRespel')`);
                numeroKg();
                popover();
                ChangeSelect();
                Selects();

                icon = $('button[data-target=".Respel'+id_div+'"]').find('svg');
                $(icon).removeClass('fa-plus');
                $(icon).addClass('fa-minus');

                var residuos = new Array();
                // $("#FK_SolResRg"+id_div+contadorRespel[id_div]).empty();
                $("#FK_SolResRg"+id_div+contadorRespel[id_div]).append(`<option onclick="HiddenRequeRespel(`+id_div+`,`+contadorRespel[id_div]+`)" value="">{{ trans('adminlte_lang::message.select') }}</option>`);
                for(var i = res.respels.length -1; i >= 0; i--){
                    if ($.inArray(res.respels[i].SlugSGenerRes, residuos) < 0) {
                        $("#FK_SolResRg"+id_div+contadorRespel[id_div]).append(`<option onclick="RequeRespel(`+id_div+`,`+contadorRespel[id_div]+`,'`+res.respels[i].RespelSlug+`')" value="${res.respels[i].SlugSGenerRes}">${res.respels[i].RespelName} (${res.respels[i].TratName})</option>`);
                        residuos.push(res.respels[i].SlugSGenerRes);
                    }
                }
            },
            complete: function(){
                $(".load").empty();
                console.log("residuos actualizados");
            }
        })

}

addNewRespel('{{$Cliente->CliSlug}}');

</script>
@include('serviciosexpress.layaoutsSolSer.functionsSolSerExpress')
@endsection

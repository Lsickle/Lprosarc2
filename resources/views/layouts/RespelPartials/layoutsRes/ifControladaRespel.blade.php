<div class="col-md-6 form-group has-feedback" style="text-align: center;">
    <label>Tipo de sustancia</label><br>
    <a class="btn btn-success" style="max-height: 2.4em;" id="Controlada`+id+`" onclick="AgregarControlada(`+id+`)"> Controlada</a>
    <a class="btn btn-default" style="max-height: 2.4em;" id="Masivo`+id+`" onclick="AgregarMasivo(`+id+`)">Uso masivo</a>
</div>
<div class="col-md-6 form-group has-feedback" id="sustanciaFormName0">
    @include('layouts.RespelPartials.layoutsRes.ControladaCreateName')
</div>
<div class="col-md-6 form-group has-feedback" id="sustanciaFormDoc0">
    @include('layouts.RespelPartials.layoutsRes.ControladaCreateDoc')
</div>
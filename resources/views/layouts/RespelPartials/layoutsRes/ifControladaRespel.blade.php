<div class="col-md-6 form-group" style="text-align: center;">
    <label>Tipo de sustancia</label><br>
    <a class="btn btn-success" id="Controlada`+id+`" onclick="AgregarControlada(`+id+`)"> Controlada</a>
    <a class="btn btn-default" id="Masivo`+id+`" onclick="AgregarMasivo(`+id+`)">Uso masivo</a>
</div>
<div class="col-md-6 form-group" id="sustanciaFormName0">
    @include('layouts.RespelPartials.layoutsRes.ControladaCreateName')
</div>

<div class="col-md-6 form-group" id="sustanciaFormDoc0">
    @include('layouts.RespelPartials.layoutsRes.ControladaCreateDoc')
</div>
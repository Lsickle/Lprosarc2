<div class="col-md-6 form-group has-feedback" id="sustanciaFormtype`+id+`" style="text-align: center;">
    <label style="margin-bottom: 0">Tipo de sustancia</label><br>
    <a class="btn btn-success" {{-- style="padding-top: 0; padding-bottom: 0;" --}} id="Controlada`+id+`" onclick="AgregarControlada(`+id+`)"> Controlada</a>
    <a class="btn btn-default" {{-- style="padding-top: 0; padding-bottom: 0;" --}} id="Masivo`+id+`" onclick="AgregarMasivo(`+id+`)">Uso masivo</a>
</div>
<div class="col-md-6 form-group has-feedback" id="sustanciaFormName`+id+`">
    @include('layouts.RespelPartials.layoutsRes.ControladaCreateName')
</div>
<div class="col-md-6 form-group has-feedback" id="sustanciaFormDoc`+id+`">
    @include('layouts.RespelPartials.layoutsRes.ControladaCreateDoc')
</div>
<div class="col-md-6 form-group" style="text-align: center;">
    <label>Tipo de sustancia</label><br>
    <a class="btn btn-success" id="Controlada`+id+`" onclick="AgregarControlada(`+id+`)">sustancia controlada</a>
    <a class="btn btn-default" id="Masivo`+id+`" onclick="AgregarMasivo(`+id+`)">sustancia de uso masivo</a>
</div>
<div class="col-md-6 form-group" id="sustanciaForm`+id+`">
    @include('layouts.RespelPartials.layoutsRes.ControladaCreate')
</div>
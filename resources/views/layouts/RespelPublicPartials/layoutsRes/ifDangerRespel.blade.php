<div class="col-md-6 form-group has-feedback" style="max-height: 2em; text-align: center;">
    <label>Tipo de clasificación</label><br>
    <a class="btn btn-success"  id="ClasifY`+id+`" onclick="AgregarY(`+id+`)">Y</a>
    <a class="btn btn-default"  id="ClasifA`+id+`" onclick="AgregarA(`+id+`)">A</a>
</div>
<div class="col-md-6 form-group has-feedback" id="Clasif`+id+`">
    @include('layouts.RespelPartials.layoutsRes.ClasificacionYCreate')
</div>

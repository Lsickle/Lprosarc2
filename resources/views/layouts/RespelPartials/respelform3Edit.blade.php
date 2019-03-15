<div class=" requirements-component form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Videos</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="">
        <label>
            @if ($Requerimientos->ReqVideoCargue == 1)
                <input type="checkbox" class="videoswitch" name="ReqVideoCargue" value="1" checked/> Cargue
            @else
                <input type="checkbox" class="videoswitch" name="ReqVideoCargue" value="1"/> Cargue
            @endif
        </label>
        </div>
        <div class="">
        <label>
            @if ($Requerimientos->ReqVideoDescargue == 1)
                <input type="checkbox" class="videoswitch" name="ReqVideoDescargue" value="1" checked/> Descargue
            @else
                <input type="checkbox" class="videoswitch" name="ReqVideoDescargue" value="1"/> Descargue
            @endif
        </label>
        </div>
        <div class="">
        <label>
            @if ($Requerimientos->ReqVideoPesaje == 1)
                <input type="checkbox" class="videoswitch" name="ReqVideoPesaje" value="1" checked/> Pesaje
            @else
                <input type="checkbox" class="videoswitch" name="ReqVideoPesaje" value="1"/> Pesaje
            @endif
        </label>
        </div>
        <div class="">
        <label>
            @if ($Requerimientos->ReqVideoReempacado == 1)
                <input type="checkbox" class="videoswitch" name="ReqVideoReempacado" value="1" checked/> Reempacado
            @else
                <input type="checkbox" class="videoswitch" name="ReqVideoReempacado" value="1"/> Reempacado
            @endif
        </label>
        </div>
        <div class="">
        <label>
            @if ($Requerimientos->ReqVideoMezclado == 1)
                <input type="checkbox" class="videoswitch" name="ReqVideoMezclado" value="1" checked/> Mezclado
            @else
                <input type="checkbox" class="videoswitch" name="ReqVideoMezclado" value="1"/> Mezclado
            @endif
        </label>
        </div>
        <div class="">
        <label>
            @if ($Requerimientos->ReqVideoDestruccion == 1)
                <input type="checkbox" class="videoswitch" name="ReqVideoDestruccion" value="1" checked/> Destruccion
            @else
                <input type="checkbox" class="videoswitch" name="ReqVideoDestruccion" value="1"/> Destruccion
            @endif
        </label>
        </div>
    </div>
</div>

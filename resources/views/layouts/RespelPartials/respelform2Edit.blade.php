<div class=" requirements-component form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Fotos</label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <div class="">
      <label>
          @if ($Requerimientos->ReqFotoCargue === 1)
          <input type="checkbox" class="fotoswitch" name="ReqFotoCargue" value="1" checked/> Cargue
          @else
          <input type="checkbox" class="fotoswitch" name="ReqFotoCargue" value="1"/> Cargue 
          @endif
      </label>
    </div>
    <div class="">
      <label>
          @if ($Requerimientos->ReqFotoDescargue === 1)   
          <input type="checkbox" class="fotoswitch" name="ReqFotoDescargue" value="1" checked/> Descargue
          @else         
          <input type="checkbox" class="fotoswitch" name="ReqFotoDescargue" value="1" /> Descargue
          @endif
      </label>
    </div>
    <div class="">
      <label>
          @if ($Requerimientos->ReqFotoPesaje === 1)   
          <input type="checkbox" class="fotoswitch" name="ReqFotoPesaje" value="1" checked/> Pesaje
          @else  
          <input type="checkbox" class="fotoswitch" name="ReqFotoPesaje" value="1"/> Pesaje
          @endif
      </label>
    </div>
    <div class="">
      <label>
          @if ($Requerimientos->ReqFotoReempacado === 1)   
          <input type="checkbox" class="fotoswitch" name="ReqFotoReempacado" value="1" checked/> Reempacado
          @else                       
          <input type="checkbox" class="fotoswitch" name="ReqFotoReempacado" value="1" /> Reempacado
          @endif
          </label>
    </div>
    <div class="">
      <label>
          @if ($Requerimientos->ReqFotoMezclado === 1)   
          <input type="checkbox" class="fotoswitch" name="ReqFotoMezclado" value="1" checked/> Mezclado
          @else                       
          <input type="checkbox" class="fotoswitch" name="ReqFotoMezclado" value="1" /> Mezclado
          @endif
      </label>
    </div>
    <div class="">
      <label>
          @if ($Requerimientos->ReqFotoDestruccion === 1)   
          <input type="checkbox" class="fotoswitch" name="ReqFotoDestruccion" value="1" checked/> Destruccion
          @else                       
          <input type="checkbox" class="fotoswitch" name="ReqFotoDestruccion" value="1" /> Destruccion
          @endif
      </label>
    </div>
  </div>
</div>
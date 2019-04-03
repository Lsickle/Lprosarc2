    
<div class=" requirements-component form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Adicionales</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="">
            <label>
                @if ($Requerimientos->ReqAuditoriaTipo == 'Presencial')
                    
                    <input class="AllowUncheck" type="radio" value="Presencial" name="ReqAuditoriaTipo" checked/> Auditoria Presencial
                @else
                    
                    <input class="AllowUncheck" type="radio" value="Presencial" name="ReqAuditoriaTipo"/> Auditoria Presencial
                @endif
            </label>
        </div>
        <div class="">
            <label>
                @if ($Requerimientos->ReqAuditoriaTipo == 'Virtual')
                    
                    <input class="AllowUncheck" type="radio" value="Virtual" name="ReqAuditoriaTipo" checked/> Auditoria Virtual
                @else
                    <input class="AllowUncheck" type="radio" value="Virtual" name="ReqAuditoriaTipo"/> Auditoria Virtual
                    
                @endif
            </label>
        </div>
            
        <div class="">
            <label>
                @if ($Requerimientos->ReqDevolucion == 1)
                    
                    <input type="checkbox" class="testswitch" name="ReqDevolucion" value="1" checked/> Devolucion de elementos
                @else
                    <input type="checkbox" class="testswitch" name="ReqDevolucion" value="1"/> Devolucion de elementos
                    
                @endif
            </label>
        </div>
        <div class="">
            <label>
                <input type="text" maxlength="64" class="" name="ReqDevolucionTipo" value="{{$Requerimientos->ReqDevolucionTipo}}" > tipo de elementos
            </label>
        </div>
            {{-- <div class="">
            <label>
                <input type="number" class="" min="1" pattern="^[0-9]+" name="ReqDevolucionCant"/> cantidad de elementos
            </label>
            </div> --}}
        <div class="">
            <label>
                @if ($Requerimientos->ReqDatosPersonal == 1)
                    <input type="checkbox" class="testswitch" name="ReqDatosPersonal" value="1" checked/> Datos del Personal 
                @else
                    <input type="checkbox" class="testswitch" name="ReqDatosPersonal" value="1"/> Datos del Personal 
                @endif
            </label>
        </div>
        <div class="">
            <label>
                @if ($Requerimientos->ReqPlanillas == 1)
                    <input type="checkbox" class="testswitch" name="ReqPlanillas" value="1" checked/> Planillas
                @else
                    <input type="checkbox" class="testswitch" name="ReqPlanillas" value="1"/> Planillas
                @endif
            </label>
        </div>
        <div class="">
            <label>
                @if ($Requerimientos->ReqAlistamiento == 1)
                    
                
                    <input type="checkbox" class="testswitch" name="ReqAlistamiento" value="1" checked/> Alistamiento de residuos
                @else
                    <input type="checkbox" class="testswitch" name="ReqAlistamiento" value="1"/> Alistamiento de residuos
                @endif
            </label>
        </div>
        <div class="">
            <label>
                @if ($Requerimientos->ReqCapacitacion == 1)
                    
                    <input type="checkbox" class="testswitch" name="ReqCapacitacion" value="1" checked/> personal con Capacitacion
                @else
                    <input type="checkbox" class="testswitch" name="ReqCapacitacion" value="1"/> personal con Capacitacion
                    
                @endif
            </label>
        </div>
        <div class="">
            <label>
                @if ($Requerimientos->ReqBascula == 1)
                    
                    <input type="checkbox" class="testswitch" name="ReqBascula" value="1" checked/> Bascula
                @else
                    
                    <input type="checkbox" class="testswitch" name="ReqBascula" value="1"/> Bascula
                @endif
            </label>
        </div>
        <div class="">
            <label>
                @if ($Requerimientos->ReqMasPerson == 1)
                    
                    <input type="checkbox" class="testswitch" name="ReqMasPerson" value="1" checked/> Mas Personal de cargue/descargue
                @else
                    
                    <input type="checkbox" class="testswitch" name="ReqMasPerson" value="1"/> Mas Personal de cargue/descargue
                @endif
            </label>
        </div>
        <div class="">
            <label>
                @if ($Requerimientos->ReqPlatform == 1)
                    
                    <input type="checkbox" class="testswitch" name="ReqPlatform" value="1" checked/> vehiculo con Plataforma
                @else
                    <input type="checkbox" class="testswitch" name="ReqPlatform" value="1"/> vehiculo con Plataforma
                    
                @endif
            </label>
        </div>
        <div class="">
            <label>
                @if ($Requerimientos->ReqCertiEspecial == 1)
                    
                    <input type="checkbox" class="testswitch" name="ReqCertiEspecial" value="1" checked/> Certificacion Especial
                @else
                    <input type="checkbox" class="testswitch" name="ReqCertiEspecial" value="1"/> Certificacion Especial
                    
                @endif
            </label>
        </div>
        <div class="col-md-12">
            <label for="Trata">Tratamiento</label>
            <select class="form-control" id="Trata" name="FK_ReqTrata" required="false">
                @if ($Requerimientos->FK_ReqTrata !== NULL)
                    <option value="{{$Requerimientos->FK_ReqTrata}}">{{$Tratamiento->TratName}}</option>
                @foreach ($Tratamientos as $Tratamiento)
                <option value="{{$Tratamiento->ID_Trat}}">{{$Tratamiento->TratName}}</option>
                @endforeach
                @else
                <option value="">Sleccione...</option>
                @foreach ($Tratamientos as $Tratamiento)
                <option value="{{$Tratamiento->ID_Trat}}">{{$Tratamiento->TratName}}</option>
                @endforeach
                @endif
                
            </select>
        </div>
        <div class="col-md-12">
            <label for="tarifa">Tarifa</label>
            <select class="form-control" id="tarifa" name="FK_ReqTarifa" required="false">
                @if ($Requerimientos->FK_ReqTarifa !== NULL)
                    <option value="{{$Requerimientos->FK_ReqTarifa}}">{{$Tarifa->ID_Tarifa}}</option>
                    @foreach ($Tarifas as $Tarifa)
                    <option value="{{$Tarifa->ID_Tarifa}}">{{$Tarifa->ID_Tarifa}}</option>
                    @endforeach
                @else
                    <option value="">Seleccione...</option>
                    @foreach ($Tarifas as $Tarifa)
                    <option value="{{$Tarifa->ID_Tarifa}}">{{$Tarifa->ID_Tarifa}}</option>
                    @endforeach
                @endif
                
            </select>
        </div>
    </div>
</div>

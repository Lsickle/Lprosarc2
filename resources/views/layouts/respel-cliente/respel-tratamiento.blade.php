@php
    if ($opcion['ofertado'] == 1) {
        $OpcionOfertada = 1;
    }else{
        $OpcionOfertada = 0;
    }
@endphp

<div id="tratamiento{{$contadorphp}}Container" class="panel panel-default" style="display: inline-block; overflow: hidden; width:100%; background-color:#FAFAFF;">
    <div class="col-md-10" style="margin-bottom: 0.25em;">
        <label>
        Tratamiento
        </label>
        <select disabled class="selecttrat" style="width:100%;">
            @foreach($opcion->tratamientos as $tratamiento)
                <option  {{ $opcion->FK_ReqTrata === $tratamiento->ID_Trat ? "selected" : "" }}>{{"$tratamiento->TratName"}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <div class="col-md-12">
            <label>  Ofertado</label>
            <input disabled {{$opcion['ofertado'] == 1 ? "checked=true" : ""}} type="radio" class="ofertaswitch"/>
        </div>
    </div>
</div>
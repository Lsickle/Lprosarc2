@foreach ($Respels as $Respel)
@endforeach
<div class="col-md-12">
        <label>Nombre</label>
        <input name="RespelName" type="text" class="form-control" placeholder="Nombre del Residuo" value="{{$Respel->RespelName}}" required>
    </div>
    <div class="col-md-12">
        <label>Descripcion</label>
        <input name="RespelDescrip" type="text" class="form-control" placeholder="Descripcion del Residuo" value="{{$Respel->RespelDescrip}}" required>
    </div>
    <div class="col-md-12">
        <label >Corriente de clasificacion Y</label>
        <select name="YRespelClasf4741" class="form-control">
            <optgroup label="Corriente de clasificacion Y segun Decreto Unico Ambiental del 2016">
                <option>Selecione...</option>
                <option value="Y1">Y1 Desechos clínicos resultantes de la atención médica prestada en hospitales, centros médicos y clínicas </option>
                <option value="Y2">Y2 Desechos resultantes de la producción y preparación de productos farmacéuticos</option>
                <option value="Y3">Y3 Desechos de medicamentos y productos farmacéuticos</option>
                <option value="Y4">Y4 Desechos resultantes de ¡a producción, la preparación y la utilización de biocidas y productos fitofarmacéuticos</option>
                <option value="Y5">Y5 Desechos resultantes de la fabricación, preparación y utilización de productos químicos para la preservación de la madera</option>
                <option value="Y6">Y6 Desechos resultantes de la producción, la preparación y la utilización de disolventes orgánicos</option>
                <option value="Y7">Y7 Desechos, que contengan cianuros, resultantes del tratamiento térmico y las operaciones de temple</option>
                <option value="Y8">Y8 Desechos de aceites minerales no aptos para el uso a que estaban destinados</option>
                <option value="Y9">Y9 Mezclas y emulsiones de desechos de aceite y agua o de hidrocarburos y agua</option>
                <option value="Y10">Y10 Sustancias y artículos de desecho que contengan, o estén contaminados por, bifeniíos policlorados (PCB), terfeniios policlorados (PCT) o bifeniíos polibromados (PBB)</option>
                <option value="Y11">Y11 Residuos alquitranados resultantes de la refinación, destilación o cualquier otro tratamiento pirolítico</option>
                <option value="Y12">Y12 Desechos resultantes de la producción, preparación y utilización de tintas, colorantes, pigmentos, pinturas, lacas o barnices</option>
                <option value="Y13">Y13 Desechos resultantes de la producción, preparación y utilización de resinas, látex, plastificantes o colas y adhesivos</option>
                <option value="Y14">Y14 Sustancias químicas de desecho, no identificadas o nuevas, resultantes de la investigación y el desarrollo o de las actividades de enseñanza y cuyos efectos en el ser humano o el medio ambiente no se conozcan</option>
                <option value="Y15">Y15 Desechos de carácter explosivo que no estén sometidos a una legislación diferente</option>
                <option value="Y16">Y16 Desechos resultantes de la producción; preparación y utilización de productos químicos y materiales para fines fotográficos</option>
                <option value="Y17">Y17 Desechos resultantes del tratamiento de superficie de metales y plásticos</option>
                <option value="Y18">Y18 Residuos resultantes de las operaciones de eliminación de desechos industriales</option>
                <option value="Y19">Y19 Metales carbonilos</option>
                <option value="Y20">Y20 Berilio, compuestos de berilio</option>
                <option value="Y21">Y21 Compuestos de cromo hexavalente</option>
                <option value="Y22">Y22 Compuestos de cobre</option>
                <option value="Y23">Y23 Compuestos de zinc</option>
                <option value="Y24">Y24 Arsénico, compuestos de arsénico</option>
                <option value="Y25">Y25 Selenio, compuestos de selenio</option>
                <option value="Y26">Y26 Cadmio, compuestos de cadmio</option>
                <option value="Y27">Y27 Antimonio, compuestos de antimonio</option>
                <option value="Y28">Y28 Telurio, compuestos de telurio</option>
                <option value="Y29">Y29 Mercurio, compuestos de mercurio</option>
                <option value="Y30">Y30 Talio, compuestos de talío</option>
                <option value="Y31">Y31 Plomo, compuestos de plomo</option>
                <option value="Y32">Y32 Compuestos inorgánicos de flúor, con exclusión del fluoruro calcico</option>
                <option value="Y33">Y33 Cianuros inorgánicos</option>
                <option value="Y34">Y34 Soluciones ácidas o ácidos en forma sólida</option>
                <option value="Y35">Y35 Soluciones básicas o bases en forma sólida</option>
                <option value="Y36">Y36 Asbesto (polvo y fibras)</option>
                <option value="Y37">Y37 Compuestos orgánicos de fósforo</option>
                <option value="Y38">Y38 Cianuros orgánicos</option>
                <option value="Y39">Y39 Fenoles, compuestos fenólicos, con inclusión de clorofenoles</option>
                <option value="Y40">Y40 Éteres</option>
                <option value="Y41">Y41 Solventes orgánicos halogenados</option>
                <option value="Y42">Y42 Disolventes orgánicos, con exclusión de disolventes halogenados</option>
                <option value="Y43">Y43 Cualquier sustancia del grupo de los dibenzofuranos policlorados</option>
                <option value="Y44">Y44 Cualquier sustancia del grupo de las dibenzoparadioxinas policloradas</option>
                <option value="Y45">Y45 Compuestos organohalogenados, que no sean las sustancias mencionadas en los campos anteriores (por ejemplo, Y39, Y41, Y42, Y43, Y44).</option>
            </optgroup>
        </select>
    </div>
    <div class="col-md-12">
        <label>Corriente de clasificacion A</label>
        <select name="ARespelClasf4741" class="form-control">
            <option>Selecione...</option>
            <optgroup label="A1
                Desechos metálicos o que contengan metales">
                <option value="A1010"><b>A1010</b>
                Desechos metálicos y desechos que contengan aleaciones de cualquiera de las sustancias siguientes: Antimonio, Arsénico, Berilio, Cadmio, Plomo, Mercurio, Selenio, Telurio, Talio, pero excluidos los desechos que figuran específicamente en la lista B.</option>
                <option value=" A1020"><b> A1020</b> Desechos que tengan como constitu
                    yentes o contaminantes, excluidos
                    los  desechos   de   metal   en   forma   masiva,   cualquiera   de   las   sustancias
                    siguientes:
                    Antimonio; compuestos de antimonio
                    -  Berilio;  compuestos  de  berilio
                    Cadmio; compuestos de cadmio
                    Plomo;  compuestos  de  plomo
                    Selenio; compuestos de selenio
                    Telurio; compuestos de telurio
                </option>
                <option value="A1030"><b>A1030 </b>Desechos  que  tengan  como
                    constituyentes  o  contaminantes
                    cualquiera de las sustancias siguientes:
                    Arsénico;     compuestos     de
                    arsénico     Mercurio;
                compuestos  de  mercurio  Talio;  compuestos  de  talio </option>
                <option value=" A1040"><b> A1040</b>Desechos que tengan como constituyentes:
                    - Carbonilos de metal
                    Compuestos de cromo
                hexavalente </option>
                <option value=" A1050"><b> A1050</b>Lodos galvánicos </option>
                <option value=" A1060"><b> A1060</b>Líquidos de desecho del decapaje de metales </option>
                <option value=" A1070"><b> A1070 </b> Residuos  de  lixiviación
                    del  tratamiento  del  zinc,  polvos  y  lodos  como  jarosita,
                hematites, etc.   </option>
                <option value="A1080"><b>A1080 </b>Residuos de desechos de zinc no inclui
                    dos en la lista B,
                    que contengan plomo y
                    cadmio en concentraciones tales que pres
                enten características del anexo III  del decreto 4741 de 2005 </option>
                <option value=" A1090"><b> A1090</b>Cenizas de la incinerac
                ión de cables de cobre recubiertos   </option>
                <option value="A1100"><b>A1100  </b> Polvos  y  residuos  de  lo
                    s  sistemas  de  depuración  de  gases  de
                las fundiciones de cobre   </option>
                <option value=" A1110"><b> A1110</b>  Soluciones   electrolíti
                    cas   usadas   de   las   operaciones   de
                    refinación y extracción el
                ectrolítica del cobre   </option>
                <option value="A1120"><b>A1120 </b>Lodos  residuales,  excluidos  los  fangos  anódicos,  de  los
                    sistemas  de  depuración  electrolítica
                    de  las  operaciones  de  refinación  y
                extracción electrolítica del cobre   </option>
                <option value=" A1130"><b> A1130</b>Soluciones de ácidos para
                    grabar usadas que contengan
                cobre disuelto   </option>
                <option value=" A1140"><b> A1140 </b> Desechos  de  catalizadores  de  cloruro  cúprico  y  cianuro  de
                cobre   </option>
                <option value=" A1150"><b> A1150 </b>Cenizas  de  metales  precio
                    sos  procedentes  de  la  incineración  de
                circuitos impresos no incluidos en la lista B </option>
                <option value=" A1160"><b> A1160 </b>Acumuladores de plomo de
                desecho, enteros o triturados   </option>
                <option value=" A1170"><b> A1170</b>Acumuladores  de  desecho  sin  se
                    leccionar  excluidas  mezclas  de
                    acumuladores sólo de la
                    lista B. Los acumuladores
                    de desecho no incluidos
                    en la lista B que contengan constituyent
                    es del anexo I en tal grado que los
                conviertan en peligrosos   </option>
                <option value=" A1180"><b> A1180 </b>Montajes eléctricos y elec
                    trónicos de desecho o restos de éstos
                    4
                    que
                    contengan componentes como acumuladores
                    y otras baterías incluidos en la
                    lista A, interruptores de mercurio, vidr
                    ios de tubos de rayos catódicos y otros
                    vidrios    activados    y    capacitadores    de    PCB,    o    contaminados    con
                    constituyentes  del  anexo  I  (por  ejemplo,
                    cadmio,  mercurio,  plomo,  bifenilo
                    policlorado) en tal grado que posean alguna
                    de las características del anexo
                III (véase la entrada correspondiente en la lista BB1110) </option>
            </optgroup>
            <optgroup label="A2
                Desechos que contengan princi
                palmente constituyentes inorgánicos, que puedan
                contener
                metales o materia o
                rgánica">
                <option value="A2010"><b>A2010 </b>Desechos de vidrio de tubos de rayos catódicos y otros vidrios activados </option>
                <option value=" A2020"><b> A2020 </b>Desechos de compuestos i
                    norgánicos de flúor en forma de líquidos
                o lodos, pero excluidos los desechos de ese tipo especificados en la lista B   </option>
                <option value=" A2030"><b> A2030</b>Desechos de catalizadores
                    , pero excluidos los desechos de este
                tipo especificados en la lista B   </option>
                <option value="A2040"><b>A2040 </b> Yeso de desecho procedente de procesos
                    de la industria química, si contiene constituyentes del anexo I en tal grado que presenten una característica
                peligrosa del anexo III (véase la entrada correspondiente en la lista B B2080)  </option>
                <option value=" A2050"><b> A2050</b>Desechos de amianto (polvo y fibras) </option>
                <option value=" A2060"><b> A2060</b>Cenizas volantes de centrales
                    eléctricas de carbón que contengan sustancias
                    del
                    anexo I en concentraciones tales que pres
                    enten características del anexo III
                (véase ia entrada correspondiente en la lista B B2050)   </option>
            </optgroup>
            <optgroup label="  A3
                Desechos  que  contengan  principalmente
                constituyentes  orgánicos,  que  puedan
                contener
                metales y materia inorgánica" >
                <option value="A3010"><b>A3010  </b> Desechos resultantes de la produ
                    cción o el tratamiento de coque de petróleo y
                asfalto    </option>
                <option value="A3020"><b>A3020 </b> Aceites minerales de desecho no apt
                os para el uso al que estaban destinados   </option>
                <option value=" A3030"><b> A3030</b>Desechos que contengan, est
                    én integrados o estén contaminados
                por lodos de compuestos antidetonantes con plomo   </option>
                <option value=" A3040"><b> A3040</b>Desechos de líquidos té
                rmicos (transferencia de calor)   </option>
                <option value=" A3050"><b> A3050</b> Desechos  resultantes  de  la
                    producción,  preparación  y  utilización
                    de  resinas,  látex,  plastificantes  o
                    colas/adhesivos  excepto  los  desechos
                    especificados en la lista B (véase el
                    apartado correspondiente en la lista B
                B4020)   </option>
                <option value=" A3060"><b> A3060</b>Nitrocelulosa de desecho </option>
                <option value=" A3070"><b> A3070</b>Desechos de fenoles, compuestos fenólicos, incluido el clorofenol en
                forma de líquido o de lodo   </option>
                <option value=" A3080"><b> A3080</b>Desechos de éteres except
                o los especificados en la lista B   </option>
                <option value="A3090"><b>A3090 </b>Desechos de cuero en forma de polvo
                    , cenizas, Iodos y harinas que contengan
                    compuestos    de    plomo    hexavalente    o    bi
                    ocidas    (véase    el    apartado
                correspondiente en la lista B B3100)   </option>
                <option value=" A3100"><b> A3100</b>Raeduras y otros desechos del cuero o de cuero regenerado que no
                    sirvan para la fabricación de artículos de cuero, que contengan compuestos de
                    cromo hexavalente o biocidas (véase el
                    apartado correspondiente en la lista B
                B3090)   </option>
                <option value=" A3110"><b> A3110</b>Desechos del curtido de pieles que contengan compuestos de cromo
                    hexavalente   o   biocidas   o   sustancias
                    infecciosas   (véase   el   apartado
                correspondiente en la lista B B3110)   </option>
                <option value=" A3120"><b> A3120 </b>Pelusas    -    fragmentos    ligeros    resultantes    del
                desmenuzamiento </option>
                <option value="A3130"><b>A3130 </b> Desec
                    hos  de  compuestos  de  fósforo
                orgánicos   </option>
                <option value=" A3140"><b> A3140</b>Desechos  de  disolventes
                    orgánicos  no  halogenados  pero  con
                exclusión de los desechos especificados en la lista B   </option>
                <option value=" A3150"><b> A3150 </b> Desechos de disolventes orgánicos halogenados </option>
                <option value=" A3160"><b> A3160 </b>Desechos resultantes de residuos
                    no acuosos de destilación halogenados o no
                    halogenados   derivados   de   operaciones   de   recuper
                    ación   de   disolventes
                orgánicos   </option>
                <option value="A3170"><b>A3170 </b>Desechos resultantes de la
                    producción de hidrocarburos halogenados
                    alifáticos  (tales  como  clorometano,  dicloroetano,  clor
                    uro  de  vinilo,  cloruro  de
                alilo y epicloridrina)   </option>
                <option value="A3180"><b>A3180 </b> Desechos,  sustancias  y  artíc
                    ulos  que  contienen,  consisten  o  están
                    contaminados   con   bifenilo   policlorado   (PCB),   terf
                    enilo   policlorado   (PCT),
                    naftaleno  policlorado  (PCN)  o  bifenilo
                    polibromado  (PBB),  o  cualquier  otro
                    compuesto  polibromado  análogo,  con  una
                    concentración  de  igual  o  superior  a
                50 mg/kg </option>
                <option value="A3190"><b>A3190 </b> Desechos   de   residuos   alqu
                    itranados   (con   exclusión   de   los
                    cementos  asfálticos)  resultantes  de  la
                    refinación,  destilación  o  cualquier
                    otro tratamiento pirolítico
                de materiales orgánicos   </option>
                <option value=" A3200"><b> A3200 </b>Material bituminoso (desechos
                    de asfalto) con cont
                    enido de alquitrán
                    resultantes  de  la  construcción  y  e!  m
                    antenimiento  de  carreteras  (obsérvese  el
                artículo correspondiente B2130de la lista B)  </option>
            </optgroup>
            <optgroup label="A4
                Desechos que pueden contener consti
                tuyentes inorgánicos u orgánicos" >
                <option value="A4010"><b>A4010 </b> Desechos  resultantes  de  la
                    producción,  preparación  y  utilización
                    de   productos   farmacéuticos,   pero   con   exclusión   de   los   desechos
                especificados en la lista B   </option>
                <option value=" A4020"><b> A4020</b>Desechos clínicos y afines; es
                    decir desechos resultantes de prácticas
                    médicas,   de   enfermería,   dentales,   vete
                    rinarias   o   actividades   similares,   y
                    desechos generados en hospitales u otras
                    instalaciones durante actividades de
                investigación o el tratamiento de pacientes, o de proyectos de investigación   </option>
                <option value=" A4030"><b> A4030</b> Desechos resultantes de la pr
                    oducción, ¡a preparación y la utilización
                    de  biocidas  y  productos  fitofarmacéut
                    icos,  con  inclusión  de  desechos  de
                    plaguicidas y herbicidas que no responda
                    n a las especificac
                    iones, caducados
                    7
                    ,
                    en desuso
                    8
                o no aptos para el uso previsto originalmente.   </option>
                <option value="A4040"><b>A4040 </b> Desechos  resultantes  de  la
                    fabricación,  preparación  y  utilización
                    de productos químicos para la
                preservación de la madera </option>
                <option value="A4050"><b>A4050 </b>  Desechos  que  contienen,  c
                    onsisten  o  están  contaminados  con
                    algunos de los productos siguientes:
                    Cianuros  inorgánicos,  con  excepción  de  residuos  que  contienen  metales
                    preciosos, en forma sólida, con trazas de cianuros inorgánicos
                Cianuros orgánicos </option>
                <option value="A4060"><b>A4060  </b>Desechos de
                    mezclas y emulsiones de aceite y agua
                o de hidrocarburos y agua  </option>
                <option value="A4070"><b>A4070  </b>Desechos  resultantes  de  la  pr
                    oducción,  preparación  y  utilización  de
                    tintas,  colorantes,  pigmentos,  pinturas,
                    lacas  o  barnices,  con  exclusión  de  los
                    desechos especificados en la lista B (véase el apartado correspondiente de la
                lista B B4010)   </option>
                <option value=" A4080"><b> A4080 </b>Desechos de carácter explos
                    ivo (pero con exclusión de los desechos
                especificados en la lista B)   </option>
                <option value="A4090"><b>A4090  </b>Desechos de soluciones ácidas o bás
                    icas, distintas de las especificadas en el
                    apartado  correspondiente  de  la  lista  B  (v
                    éase  el  apartado  correspondiente  de
                la lista B B2120)   </option>
                <option value="A4100"><b>A4100 </b>Desechos resultantes de la utiliz
                    ación de dispositivos de control de ía
                    contaminación industrial pa
                    ra la depuración de los gas
                    es industriales, pero con
                exclusión de los desechos especificados en la lista B   </option>
                <option value="A4110"><b>A4110  </b> Desechos  que  contienen,  c
                    onsisten  o,  están  contaminados  con
                    algunos de los productos siguientes:
                    -  -                    Cualquier  sustancia  de!  grupo  de  los  dibenzofuranos
                    policlorados
                    - -          Cualqu
                ier sustancia del grupo de las dibenzodioxinas policloradas    </option>
                <option value="A4120"><b>A4120  </b>Desechos que contienen, consis
                ten o están contaminados con peróxidos   </option>
                <option value="A4130"><b>A4130  </b>Envases  y  contenedores  de
                    desechos  que  contienen  sustancias
                    incluidas en el anexo I, en concentraci
                    ones suficientes como para mostrar las
                características peligrosas del anexo III   </option>
                <option value="A4140"><b>A4140  </b>   Desechos  consis
                    tentes  o  que  contienen
                    productos  químicos  que  no
                    responden   a   las   especificaciones   o   caducados
                    10
                    correspondientes   a   las
                    categorías del anexo I, y que muestran las ca
                racterísticas peligrosas del anexo III  </option>
                <option value=" A4150"><b> A4150 </b>Sustancias químicas de desecho, no i
                    dentificadas o nuevas, resultantes de ia
                    investigación y el desarrollo o de las actividades de enseñanza y cuyos efectos
                en el ser humano o el medio ambiente no se conozcan   </option>
                <option value=" A4160"><b> A4160 </b> Carbono  activado  consumido  no
                    incluido en ¡a ¡ista B (véase el
                correspondiente apartado de la lista B B2060).   </option>
            </optgroup>
        </select>
    </div>
    <div class="col-md-12">
        <label>Peligrosidad del residuo</label>
        <select name="RespelIgrosidad" class="form-control" value="{{$Respel->RespelIgrosidad}}">
            <optgroup label="Seleccion el tipo de Peligrosidad del residuo">
                <option>Selecione...</option>
                <option>Inflamable</option>
                <option>Toxico</option>
                <option>Biologico</option>
                <option>corrosivo</option>
                <option>reactivo</option>
                <option>explosivo</option>
                <option>infeccioso </option>
                <option>radiactivo</option>
                <option>Otro</option>
            </optgroup>
        </select>
    </div>
    <div class="col-md-12">
        <label>Estado del residuo</label>
        <select name="RespelEstado" class="form-control" value="{{$Respel->RespelEstado}}">
            <optgroup label="Seleccione el estado físico del residuo">
                <option>Selecione...</option>
                <option value="Liquido">Liquido</option>
                <option value="Solido">Solido</option>
                <option value="Gaseoso">Gaseoso</option>
                <option value="Mezcla">Mezcla</option>
            </optgroup>
        </select>
    </div>
    <div class="col-md-12">
        <label>Sede</label>
        <select name="FK_RespelGenerSede" class="form-control">
            <optgroup label="Seleccione la sede de la que proviene">
                <option>Selecione...</option>
                @foreach ($GSedes as $GSede)	
            <option value="{{$GSede->ID_GSede}}">{{$GSede->GSedeName}}</option>
                @endforeach
            </optgroup>
        </select>
    </div>
    <div class="col-md-12">
        <label>Hoja de seguridad</label>
        <input name="RespelHojaSeguridad" type="file" class="form-control" value="{{$Respel->RespelHojaSeguridad}}">
    </div>
    <div class="col-md-12">
        <label>Tarjeta De Emergencia</label>
        <input name="RespelTarj" type="file" class="form-control" value="{{$Respel->RespelTarj}}">
    </div>
    @if(Auth::user()->UsRol=='Programador'||Auth::user()->UsRol=='admin'||Auth::user()->UsRol=='JefeOperacion')
    <div class="col-md-12">
        <label>Estado de aprobación</label>
        <select name="RespelStatus" class="form-control" value="{{$Respel->RespelStatus}}">
            <optgroup label="Estado de aprobación por parte de Prosarc">
                <option>Selecione...</option>
                <option value="Aprobado">Aprobado</option>
                <option value="Negado">Negado</option>
                <option value="Pendiente">Pendiente</option>
                <option value="Incompleto">Incompleto</option>
            </optgroup>
        </select>
    </div>
    @endif()

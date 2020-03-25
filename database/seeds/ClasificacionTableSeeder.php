<?php

use Illuminate\Database\Seeder;
use App\Clasificacion;

class ClasificacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'N/A';
        $clasification->ClasfDescription = 'sin clasificación asignada';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y1';
        $clasification->ClasfDescription = 'Desechos clínicos resultantes de la atención médica prestada en hospitales, centros médicos y clínicas';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y2';
        $clasification->ClasfDescription = 'Desechos resultantes de la producción y preparación de productos farmacéuticos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y3';
        $clasification->ClasfDescription = 'Desechos de medicamentos y productos farmacéuticos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y4';
        $clasification->ClasfDescription = 'Desechos resultantes de la producción, la preparación y la utilización de biocidas y productos fitofarmacéuticos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y5';
        $clasification->ClasfDescription = 'Desechos resultantes de la fabricación, preparación y utilización de productos químicos para la preservación de la madera';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y6';
        $clasification->ClasfDescription = 'Desechos resultantes de la producción, la preparación y la utilización de disolventes orgánicos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y7';
        $clasification->ClasfDescription = 'Desechos, que contengan cianuros, resultantes del tratamiento térmico y las operaciones de temple';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y8';
        $clasification->ClasfDescription = 'Desechos de aceites minerales no aptos para el uso a que estaban destinados';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y9';
        $clasification->ClasfDescription = 'Mezclas y emulsiones de desechos de aceite y agua o de hidrocarburos y agua';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y10';
        $clasification->ClasfDescription = 'Sustancias y artículos de desecho que contengan, o estén contaminados por, bifenilos policlorados (PCB), terfenilos policlorados (PCT) o bifenilos polibromados (PBB';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y11';
        $clasification->ClasfDescription = 'Residuos alquitranados resultantes de la refinación, destilación o cualquier otro tratamiento pirolítico';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y12';
        $clasification->ClasfDescription = 'Desechos resultantes de la producción, preparación y utilización de tintas, colorantes, pigmentos, pinturas, lacas o barnices';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y13';
        $clasification->ClasfDescription = 'Desechos resultantes de la producción, preparación y utilización de resinas, látex, plastificantes o colas y adhesivos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y14';
        $clasification->ClasfDescription = 'Sustancias químicas de desecho, no identificadas o nuevas, resultantes de la investigación y el desarrollo o de las actividades de enseñanza y cuyos efectos en el ser humano o el medio ambiente no se conozcan';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y15';
        $clasification->ClasfDescription = 'Desechos de carácter explosivo que no estén sometidos a una legislación diferente';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y16';
        $clasification->ClasfDescription = 'Desechos resultantes de la producción; preparación y utilización de productos químicos y materiales para fines fotográficos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y17';
        $clasification->ClasfDescription = 'Desechos resultantes del tratamiento de superficie de metales y plásticos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y18';
        $clasification->ClasfDescription = 'Residuos resultantes de las operaciones de eliminación de desechos industriales';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y19';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Metales carbonilos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y20';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Berilio, compuestos de berilio';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y21';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Compuestos de cromo hexavalente';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y22';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Compuestos de cobre';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y23';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Compuestos de zinc';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y24';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Arsénico, compuestos de arsénico';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y25';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Selenio, compuestos de selenio';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y26';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Cadmio, compuestos de cadmio';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y27';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Antimonio, compuestos de antimonio';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y28';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Telurio, compuestos de telurio';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y29';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Mercurio, compuestos de mercurio';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y30';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Talio, compuestos de talío';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y31';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Plomo, compuestos de plomo';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y32';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Compuestos inorgánicos de flúor, con exclusión del fluoruro calcico';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y33';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Cianuros inorgánicos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y34';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Soluciones ácidas o ácidos en forma sólida';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y35';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Soluciones básicas o bases en forma sólida';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y36';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Asbesto (polvo y fibras)';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y37';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Compuestos orgánicos de fósforo';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y38';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Cianuros orgánicos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y39';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Fenoles, compuestos fenólicos, con inclusión de clorofenoles';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y40';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Éteres';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y41';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Solventes orgánicos halogenados';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y42';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Disolventes orgánicos, con exclusión de disolventes halogenados';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y43';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Cualquier sustancia del grupo de los dibenzofuranos policlorados';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y44';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Cualquier sustancia del grupo de las dibenzoparadioxinas policloradas';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'Y45';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes: Compuestos organohalogenados, que no sean las sustancias mencionadas en los campos anteriores (por ejemplo, Y39, Y41, Y42, Y43, Y44)';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1010';
        $clasification->ClasfDescription = 'Desechos metálicos y desechos que contengan aleaciones de cualquiera de las sustancias siguientes: Antimonio Arsénico Berilio Cadmio Mercurio Selenio Telurio Taliopero excluidos los desechos que figuran específicamente en la lista B. anexa en el decreto 4741';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1020';
        $clasification->ClasfDescription = 'Desechos  que  tengan  como  constituyentes  o  contaminantes,  excluidos  los desechos de metal en forma masiva, cualquiera de las sustancias siguientes: Antimonio; compuestos de antimonio Berilio;    compuestos    de    berilio Cadmio;   compuestos   de   cadmio Plomo;    compuestos    de    plomo Selenio;   compuestos   de   selenio Telurio; compuestos de telurio';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1030';
        $clasification->ClasfDescription = 'Desechos  que  tengan  como  constituyentes  o  contaminantes  cualquiera  de las sustancias siguientes: Arsénico; compuestos de arsénico Mercurio; compuestos  de  mercurio  Talio;  compuestos  de  talio ';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1040';
        $clasification->ClasfDescription = 'Desechos que tengan como constituyentes:  Carbonilos de metal; Compuestos de cromo hexavalente';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1050';
        $clasification->ClasfDescription = 'Lodos galvánicos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1060';
        $clasification->ClasfDescription = 'Líquidos de desecho del decapaje de metales';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1070';
        $clasification->ClasfDescription = 'Residuos de lixiviación del tratamiento del zinc, polvos y lodos como jarosita, hematites, etc.';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1080';
        $clasification->ClasfDescription = 'Residuos de desechos de zinc no incluidos en la lista B anexa en el decreto 4741, que contengan plomo y cadmio en concentraciones tales que presenten características del anexo III del decreto 4741 de 2005';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1090';
        $clasification->ClasfDescription = 'Cenizas de la incineración de cables de cobre recubiertos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1100';
        $clasification->ClasfDescription = 'Polvos y residuos de los sistemas de depuración de gases de las fundiciones de cobre';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1110';
        $clasification->ClasfDescription = 'Soluciones electrolíticas usadas de las operaciones de refinación y extracción electrolítica del cobre';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1120';
        $clasification->ClasfDescription = 'Lodos residuales, excluidos los fangos anódicos, de los sistemas de depuración electrolítica de las operaciones de refinación y extracción electrolítica del cobre';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1130';
        $clasification->ClasfDescription = 'Soluciones de ácidos para grabar usadas que contengan cobre disuelto';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1140';
        $clasification->ClasfDescription = 'Desechos de catalizadores de cloruro cúprico y cianuro de cobre';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1150';
        $clasification->ClasfDescription = 'Cenizas de metales preciosos procedentes de la incineración de circuitos impresos no incluidos en la lista B';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1160';
        $clasification->ClasfDescription = 'Acumuladores de plomo de desecho, enteros o triturados';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1170';
        $clasification->ClasfDescription = 'Acumuladores de desecho sin seleccionar excluidas mezclas de acumuladores sólo de la lista B. Los acumuladores de desecho no incluidos en la lista B que contengan constituyentes del anexo I en tal grado que los conviertan en peligrosos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A1180';
        $clasification->ClasfDescription = 'Montajes eléctricos y electrónicos de desecho o restos de éstos que contengan componentes como acumuladores y otras baterías incluidos en la lista A, interruptores de mercurio, vidrios de tubos de rayos catódicos y otros vidrios activados y capacitadores de PCB, o contaminados con constituyentes del anexo I (por ejemplo, cadmio, mercurio, plomo, bifenilopoliclorado) en tal grado que posean alguna de las características del anexoIII (véase la entrada correspondiente en la lista B B1110)';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A2010';
        $clasification->ClasfDescription = 'Desechos de vidrio de tubos de rayos catódicos y otros vidrios activados';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A2020';
        $clasification->ClasfDescription = 'Desechos de compuestos inorgánicos de flúor en forma de líquidos o lodos, pero excluidos los desechos de ese tipo especificados en la lista B';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A2030';
        $clasification->ClasfDescription = 'Desechos de catalizadores, pero excluidos los desechos de este tipo especificados en la lista B';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A2040';
        $clasification->ClasfDescription = 'Yeso de desecho procedente de procesos de la industria química, si contiene constituyentes del anexo I en tal grado que presenten una característica peligrosa del anexo III (véase la entrada correspondiente en la lista B B2080)';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A2050';
        $clasification->ClasfDescription = 'Desechos de amianto (polvo y fibras)';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A2060';
        $clasification->ClasfDescription = 'Cenizas volantes de centrales eléctricas de carbón que contengan sustancias del anexo I en concentraciones tales que presenten características del anexo III(véase ia entrada correspondiente en la lista B B2050)';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3010';
        $clasification->ClasfDescription = 'Desechos resultantes de la producción o el tratamiento de coque de petróleo y asfalto';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3020';
        $clasification->ClasfDescription = 'Aceites minerales de desecho no aptos para el uso al que estaban destinados';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3030';
        $clasification->ClasfDescription = 'Desechos que contengan, estén integrados o estén contaminados por lodos de compuestos antidetonantes con plomo';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3040';
        $clasification->ClasfDescription = 'Desechos de líquidos térmicos (transferencia de calor)';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3050';
        $clasification->ClasfDescription = 'Desechos resultantes de la producción, preparación y utilización de resinas, látex, plastificantes o colas/adhesivos excepto los desechos especificados en la lista B (véase el apartado correspondiente en la lista B B4020)';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3060';
        $clasification->ClasfDescription = 'Nitrocelulosa de desecho';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3070';
        $clasification->ClasfDescription = 'Desechos de fenoles, compuestos fenólicos, incluido el clorofenol en forma de líquido o de lodo';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3080';
        $clasification->ClasfDescription = 'Desechos de éteres excepto los especificados en la lista B';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3090';
        $clasification->ClasfDescription = 'Desechos de cuero en forma de polvo, cenizas, Iodos y harinas que contengan compuestos de plomo hexavalente o biocidas (véase el apartado correspondiente en la lista B B3100)';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3100';
        $clasification->ClasfDescription = 'Raeduras y otros desechos del cuero o de cuero regenerado que no sirvan para la fabricación de artículos de cuero, que contengan compuestos de cromo hexavalente o biocidas (véase el apartado correspondiente en la lista B B3090)';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3110';
        $clasification->ClasfDescription = 'Desechos del curtido de pieles que contengan compuestos de cromohexavalente o biocidas o sustancias infecciosas (véase el apartado correspondiente en la lista B B3110)';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3120';
        $clasification->ClasfDescription = 'Pelusas - fragmentos ligeros resultantes del desmenuzamiento';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3130';
        $clasification->ClasfDescription = 'Desechos de compuestos de fósforo orgánicos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3140';
        $clasification->ClasfDescription = 'Desechos de disolventes orgánicos no halogenados pero con exclusión de los desechos especificados en la lista B';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3150';
        $clasification->ClasfDescription = 'Desechos de disolventes orgánicos halogenados';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3160';
        $clasification->ClasfDescription = 'Desechos resultantes de residuos no acuosos de destilación halogenados o no halogenados derivados de operaciones de recuperación de disolventes orgánicos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3170';
        $clasification->ClasfDescription = 'Desechos resultantes de la producción de hidrocarburos halogenados alifáticos (tales como clorometano, dicloroetano, cloruro de vinilo, cloruro dealilo y epicloridrina)';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3180';
        $clasification->ClasfDescription = 'Desechos, sustancias y artículos que contienen, consisten o están contaminados con bifenilo policlorado (PCB), terfenilo policlorado (PCT),naftaleno policlorado (PCN) o bifenilopolibromado (PBB), o cualquier otro compuesto polibromado análogo, con una concentración de igual o superior a 50mg/kg';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3190';
        $clasification->ClasfDescription = 'Desechos de residuos alquitranados (con exclusión de los cementos asfálticos) resultantes de la refinación, destilación o cualquier otro tratamiento pirolítico de materiales orgánicos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A3200';
        $clasification->ClasfDescription = 'Material bituminoso (desechos de asfalto) con contenido de alquitrán resultantes de la construcción y e! mantenimiento de carreteras (obsérvese el artículo correspondiente B2130 de la lista B)';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A4010';
        $clasification->ClasfDescription = 'Desechos resultantes de la producción, preparación y utilización de productos farmacéuticos, pero con exclusión de los desechos especificados en la lista B';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A4020';
        $clasification->ClasfDescription = 'Desechos clínicos y afines; es decir desechos resultantes de prácticas médicas, de enfermería, dentales, veterinarias o actividades similares, y desechos generados en hospitales u otras instalaciones durante actividades de investigación o el tratamiento de pacientes, o de proyectos de investigación';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A4030';
        $clasification->ClasfDescription = 'Desechos resultantes de la producción, ¡a preparación y la utilización de biocidas y productos fitofarmacéuticos, con inclusión de desechos de plaguicidas y herbicidas que no respondan a las especificaciones, caducados,en desuso o no aptos para el uso previsto originalmente.';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A4040';
        $clasification->ClasfDescription = 'Desechos resultantes de la fabricación, preparación y utilización de productos químicos para la preservación de la madera';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A4050';
        $clasification->ClasfDescription = 'Desechos que contienen, consisten o están contaminados con algunos de los productos siguientes: Cianuros inorgánicos, con excepción de residuos que contienen metales preciosos, en forma sólida, con trazas de cianuros inorgánicos Cianuros orgánicos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A4060';
        $clasification->ClasfDescription = 'Desechos de mezclas y emulsiones de aceite y agua o de hidrocarburos y agua';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A4070';
        $clasification->ClasfDescription = 'Desechos resultantes de la producción, preparación y utilización de tintas, colorantes, pigmentos, pinturas, lacas o barnices, con exclusión de los desechos especificados en la lista B (véase el apartado correspondiente de la lista B B4010)';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A4080';
        $clasification->ClasfDescription = 'Desechos de carácter explosivo (pero con exclusión de los desechos especificados en la lista B)';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A4090';
        $clasification->ClasfDescription = 'Desechos de soluciones ácidas o básicas, distintas de las especificadas en el apartado correspondiente de la lista B (véase el apartado correspondiente de la lista B B2120)';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A4100';
        $clasification->ClasfDescription = 'Desechos resultantes de la utilización de dispositivos de control de la contaminación industrial para la depuración de los gases industriales, pero con exclusión de los desechos especificados en la lista B';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A4110';
        $clasification->ClasfDescription = 'Desechos que contienen, consisten o, están contaminados con algunos de los productos siguientes: Cualquier sustancia del grupo de los dibenzofuranos policlorados Cualquier sustancia del grupo de las dibenzodioxinas policloradas';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A4120';
        $clasification->ClasfDescription = 'Desechos que contienen, consisten o están contaminados con peróxidos';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A4130';
        $clasification->ClasfDescription = 'Envases y contenedores de desechos que contienen sustancias incluidas en el anexo I, en concentraciones suficientes como para mostrar las características peligrosas del anexo III';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A4140';
        $clasification->ClasfDescription = 'Desechos consistentes o que contienen productos químicos que no responden a las especificaciones o caducados correspondientes a las categorías del anexo I, y que muestran las características peligrosas del anexo III';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A4150';
        $clasification->ClasfDescription = 'Sustancias químicas de desecho, no identificadas o nuevas, resultantes de la investigación y el desarrollo o de las actividades de enseñanza y cuyos efectos en el ser humano o el medio ambiente no se conozcan';
        $clasification->save();

        $clasification = new Clasificacion();
        $clasification->ClasfCode = 'A4160';
        $clasification->ClasfDescription = 'Carbono activado consumido no incluido en la lista B (véase el correspondiente apartado de la lista B B2060).';
        $clasification->save();


    }
}

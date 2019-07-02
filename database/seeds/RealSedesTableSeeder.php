<?php

use Illuminate\Database\Seeder;
use App\Sede;

class RealSedesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$sede = new Sede();
		$sede->SedeName = 'Planta';
		$sede->SedeAddress = 'KM 6 VÍA LA MESA SUB ESTACIÓN BALSILLAS';
		$sede->SedeEmail = 'logistica@prosarc.com.com';
		$sede->FK_SedeCli = '1';
		$sede->FK_SedeMun = '584';
		$sede->SedeSlug = hash('sha256', rand().time().$sede->SedeAddress);
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'Bogotá';
		$sede->SedeAddress = 'Cll 120# 7-62 Ed cei3 ofi 610';
		$sede->SedeEmail = 'servicomercial@prosarc.com.co';
		$sede->FK_SedeCli = '1';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = hash('sha256', rand().time().$sede->SedeAddress);
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ECOCAPITAL INTERNACIONAL S.A ESP. (principal)';
		$sede->SedeAddress = 'Calle 14C No 123-52';
		$sede->SedeEmail = 'ECOCAPITALINTERNACIONALS.AESP._ppal@gmail.com';
		$sede->FK_SedeCli = '2';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-22169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ENCAJES S.A (principal)';
		$sede->SedeAddress = 'CALLE 17A 69B-06';
		$sede->SedeEmail = 'ENCAJESS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '3';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-33169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'DRAGON OIL SERVICES (principal)';
		$sede->SedeAddress = 'KM 19 VIA BOGOTA – MADRID PARQUE INDUSTRIAL SAN JORGE';
		$sede->SedeEmail = 'DRAGONOILSERVICES_ppal@gmail.com';
		$sede->FK_SedeCli = '4';
		$sede->FK_SedeMun = '584';
		$sede->SedeSlug = 'sede-44584';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CI. SUNSHINE BOUQUET COLOMBIA S.A.S (principal)';
		$sede->SedeAddress = 'BOUQUETERA SUNSHINE BOUQUET - KM. 4 VÍA SUBA - COTA VEREDA LAS MERCEDES FINCA TUNA BAJA';
		$sede->SedeEmail = 'CI.SUNSHINEBOUQUETCOLOMBIAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '5';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-55169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CMA INGENIERIA Y CONSTRUCTORES S.A.S (principal)';
		$sede->SedeAddress = 'CL 14 C # 123 -  70';
		$sede->SedeEmail = 'CMAINGENIERIAYCONSTRUCTORESS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '6';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-66169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'SMITH & NEPHEW COLOMBIA S.A.S (principal)';
		$sede->SedeAddress = 'CALLE 63 # 74B-42 BODEGA 12';
		$sede->SedeEmail = 'SMITH&NEPHEWCOLOMBIAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '7';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-77169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'DARPLAS SAS (principal)';
		$sede->SedeAddress = 'CALLE 17 No 65B 74';
		$sede->SedeEmail = 'DARPLASSAS_ppal@gmail.com';
		$sede->FK_SedeCli = '8';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-88169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'LABORATORIOS CHALVER DE COLOMBIA S.A (principal)';
		$sede->SedeAddress = 'CRA.106 NO.15-25 MANZ.6 LOTE 28 Y 29';
		$sede->SedeEmail = 'LABORATORIOSCHALVERDECOLOMBIAS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '9';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-99169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'MEDTRONIC COLOMBIA (principal)';
		$sede->SedeAddress = 'CALLE 116 # 7 – 15 EDIF CUSEZAR PISO 1101';
		$sede->SedeEmail = 'MEDTRONICCOLOMBIA_ppal@gmail.com';
		$sede->FK_SedeCli = '10';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-1010169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CREATIVE COLORS S.A (principal)';
		$sede->SedeAddress = 'CRA 106 NO 15 - 25 BODEGA 26 MANZANA 7 ZONA FRANCA DE FONTIBÓN';
		$sede->SedeEmail = 'CREATIVECOLORSS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '11';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-1111169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'INSTITUTO GEOGRÁFICO AGUSTÍN CODAZZI (principal)';
		$sede->SedeAddress = 'CARRERA 30 # 48-51';
		$sede->SedeEmail = 'INSTITUTOGEOGRÁFICOAGUSTÍNCODAZZI_ppal@gmail.com';
		$sede->FK_SedeCli = '12';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-1212169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CERESCOS SAS (principal)';
		$sede->SedeAddress = 'CALLE 19 # 68A - 98 SEDE ACONDICIONAMIENTO';
		$sede->SedeEmail = 'CERESCOSSAS_ppal@gmail.com';
		$sede->FK_SedeCli = '13';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-1313169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'INTERNATIONAL FLAVORS AND FRAGRANCES COLOMBIA S.A.S. (principal)';
		$sede->SedeAddress = 'CRA 98 # 25G – 10 BODEGA 14';
		$sede->SedeEmail = 'INTERNATIONALFLAVORSANDFRAGRANCESCOLOMBIAS.A.S._ppal@gmail.com';
		$sede->FK_SedeCli = '14';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-1414169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'JOHNSON & JOHNSON DE COLOMBIA S.A. (principal)';
		$sede->SedeAddress = 'CALLE 20 N° 68C – 57';
		$sede->SedeEmail = 'JOHNSON&JOHNSONDECOLOMBIAS.A._ppal@gmail.com';
		$sede->FK_SedeCli = '15';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-1515169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ENERGIZER DE COLOMBIA S.A. (principal)';
		$sede->SedeAddress = 'CALLE 22ª No 68-69';
		$sede->SedeEmail = 'ENERGIZERDECOLOMBIAS.A._ppal@gmail.com';
		$sede->FK_SedeCli = '16';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-1616169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'HUNTSMAN COLOMBIA LTDA (principal)';
		$sede->SedeAddress = 'CALLE 20A # 43A-50 INT 5';
		$sede->SedeEmail = 'HUNTSMANCOLOMBIALTDA_ppal@gmail.com';
		$sede->FK_SedeCli = '17';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-1717169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'PEPSICO ALIMENTOS COLOMBIA LTDA (principal)';
		$sede->SedeAddress = 'CRA 69 # 19 - 75   ZONA INDUSTRIAL MONTEVIDEO';
		$sede->SedeEmail = 'PEPSICOALIMENTOSCOLOMBIALTDA_ppal@gmail.com';
		$sede->FK_SedeCli = '18';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-1818169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'PROQUIFAR S.A (principal)';
		$sede->SedeAddress = 'CALLE 19A # 69B-74';
		$sede->SedeEmail = 'PROQUIFARS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '19';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-1919169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'LABORATORIOS INDUSTRIALES LPS (principal)';
		$sede->SedeAddress = 'CARRERA 19 N 65-47';
		$sede->SedeEmail = 'LABORATORIOSINDUSTRIALESLPS_ppal@gmail.com';
		$sede->FK_SedeCli = '20';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-2020169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'HOSPITAL CENTRAL DE LA POLICIA NACIONAL-HOCEN (principal)';
		$sede->SedeAddress = 'CARRERA 59 #26-21 FRENTE A LA ESTACION DEL CAN';
		$sede->SedeEmail = 'HOSPITALCENTRALDELAPOLICIANACIONAL-HOCEN_ppal@gmail.com';
		$sede->FK_SedeCli = '21';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-2121169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'BRENNTAG COLOMBIA S.A (principal)';
		$sede->SedeAddress = 'KM 19 CARRETERA TRONCAL DE OCCIDENTE';
		$sede->SedeEmail = 'BRENNTAGCOLOMBIAS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '22';
		$sede->FK_SedeMun = '584';
		$sede->SedeSlug = 'sede-2222584';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'PRODUCTOS QUÍMICOS PANAMERICANOS S.A (principal)';
		$sede->SedeAddress = 'CRA 61 N° 45A- 94 SUR';
		$sede->SedeEmail = 'PRODUCTOSQUÍMICOSPANAMERICANOSS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '23';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-2323169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ELI LILLY INTERAMERICA INC (principal)';
		$sede->SedeAddress = 'TRANSVERSAL 18 No 96 41 PISO 6';
		$sede->SedeEmail = 'ELILILLYINTERAMERICAINC_ppal@gmail.com';
		$sede->FK_SedeCli = '24';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-2424169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CHALLENGER SAS (principal)';
		$sede->SedeAddress = 'DIAGONAL 25 G No 94 - 55';
		$sede->SedeEmail = 'CHALLENGERSAS_ppal@gmail.com';
		$sede->FK_SedeCli = '25';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-2525169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'QUIMIA S.A.S (principal)';
		$sede->SedeAddress = 'CALLE 25 C BIS A # 101 B - 21';
		$sede->SedeEmail = 'QUIMIAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '26';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-2626169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'GREIF COLOMBIA S.A.S (principal)';
		$sede->SedeAddress = 'AUTOPISTA MEDELLÍN KM 1.5 BODEGAS 5 Y 6 PARQUE INDUSTRIAL LA FLORIDA';
		$sede->SedeEmail = 'GREIFCOLOMBIAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '27';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-2727169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'SERVEX COLOMBIA S.A.S (principal)';
		$sede->SedeAddress = 'CARRERA 42 A No 17 a 98';
		$sede->SedeEmail = 'SERVEXCOLOMBIAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '28';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-2828169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'BIOMÉRIEUX COLOMBIA SAS (principal)';
		$sede->SedeAddress = 'CALLE 22 # 56-40 CENTRO LOGÍSTICO SUPPLA. BODEGA BIOMÉRIEUX COLOMBIA';
		$sede->SedeEmail = 'BIOMÉRIEUXCOLOMBIASAS_ppal@gmail.com';
		$sede->FK_SedeCli = '29';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-2929169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'LABORATORIO HOMEOPÁTICO ALEMÁN (principal)';
		$sede->SedeAddress = 'CALLE 75 Nº 20C-55';
		$sede->SedeEmail = 'LABORATORIOHOMEOPÁTICOALEMÁN_ppal@gmail.com';
		$sede->FK_SedeCli = '30';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-3030169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'PEPSICO ALIMENTOS ZONA FRANCA (principal)';
		$sede->SedeAddress = 'VEREDA LA FLORIDA KM 3 VÍA FUNZA – SIBERIA';
		$sede->SedeEmail = 'PEPSICOALIMENTOSZONAFRANCA_ppal@gmail.com';
		$sede->FK_SedeCli = '31';
		$sede->FK_SedeMun = '557';
		$sede->SedeSlug = 'sede-3131557';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'PRODUCTOS ROCHE S.A (principal)';
		$sede->SedeAddress = 'CARRERA 44 N° 20-21';
		$sede->SedeEmail = 'PRODUCTOSROCHES.A_ppal@gmail.com';
		$sede->FK_SedeCli = '32';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-3232169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CONGRUPO S.A. (principal)';
		$sede->SedeAddress = 'VEREDA VUELTA GRANDE 150M ADELANTE GLORIETA SIBERIA VÍA COTA';
		$sede->SedeEmail = 'CONGRUPOS.A._ppal@gmail.com';
		$sede->FK_SedeCli = '33';
		$sede->FK_SedeMun = '551';
		$sede->SedeSlug = 'sede-3333551';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'KYROVET LABORATORIES S.A (principal)';
		$sede->SedeAddress = 'CARRERA 65B NO. 17-59';
		$sede->SedeEmail = 'KYROVETLABORATORIESS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '34';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-3434169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ALIMENTOS CARNICOS S.A.S (principal)';
		$sede->SedeAddress = 'AV CLL 17 # 129 - 11';
		$sede->SedeEmail = 'ALIMENTOSCARNICOSS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '35';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-3535169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'LABORATORIOS PHITOTHER S.A.S (principal)';
		$sede->SedeAddress = 'CARRERA 53 D NO. 4A-67  BARRIO GALAN- PUENTE ARANDA';
		$sede->SedeEmail = 'LABORATORIOSPHITOTHERS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '36';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-3636169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CAJA DE COMPENSACION FAMILIAR CAFAM (principal)';
		$sede->SedeAddress = 'CENTRO VACACIONAL CAFAM MELGAR';
		$sede->SedeEmail = 'CAJADECOMPENSACIONFAMILIARCAFAM_ppal@gmail.com';
		$sede->FK_SedeCli = '37';
		$sede->FK_SedeMun = '1050';
		$sede->SedeSlug = 'sede-37371050';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'NACIONAL DE TRENZADOS S.A. (principal)';
		$sede->SedeAddress = 'PARQUE INDUSTRIAL GALICIA VIA SIBERIA- FUNZA KM 3.5';
		$sede->SedeEmail = 'NACIONALDETRENZADOSS.A._ppal@gmail.com';
		$sede->FK_SedeCli = '38';
		$sede->FK_SedeMun = '557';
		$sede->SedeSlug = 'sede-3838557';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CEMEX COLOMBIA S.A. (principal)';
		$sede->SedeAddress = 'CARRERA 65B # 18B - 02';
		$sede->SedeEmail = 'CEMEXCOLOMBIAS.A._ppal@gmail.com';
		$sede->FK_SedeCli = '39';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-3939169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'QUIMEXCOL ZONA FRANCA SAS (principal)';
		$sede->SedeAddress = 'KM 1.5 VÍA BRICEÑO - ZIPAQUIRÁ';
		$sede->SedeEmail = 'QUIMEXCOLZONAFRANCASAS_ppal@gmail.com';
		$sede->FK_SedeCli = '40';
		$sede->FK_SedeMun = '624';
		$sede->SedeSlug = 'sede-4040624';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'SUMMIT AGRO COLOMBIA S.A.S (principal)';
		$sede->SedeAddress = 'CARRERA 127 No. 22 G - 15 CENTRO DE DISTRIBUCIÓN NO. 8-9-10 PARQUE INDUSTRIAL EL DORADO';
		$sede->SedeEmail = 'SUMMITAGROCOLOMBIAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '41';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-4141169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'FRAYCO S.A.S (principal)';
		$sede->SedeAddress = 'AV. 68 # 13-41';
		$sede->SedeEmail = 'FRAYCOS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '42';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-4242169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'FUNDACION UNIVERSITARIA DE CIENCIAS DE LA SALUD (FUCS) (principal)';
		$sede->SedeAddress = 'CRA 54 No. 67A-80';
		$sede->SedeEmail = 'FUNDACIONUNIVERSITARIADECIENCIASDELASALUD(FUCS)_ppal@gmail.com';
		$sede->FK_SedeCli = '43';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-4343169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'COPROPIEDAD ZONA FRANCA PERMANENTE INTEXZONA (principal)';
		$sede->SedeAddress = 'KM 1 VÍA SIBERIA FUNZA';
		$sede->SedeEmail = 'COPROPIEDADZONAFRANCAPERMANENTEINTEXZONA_ppal@gmail.com';
		$sede->FK_SedeCli = '44';
		$sede->FK_SedeMun = '557';
		$sede->SedeSlug = 'sede-4444557';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'AGQ PRODYCON COLOMBIA S.A.S (principal)';
		$sede->SedeAddress = 'CALLE 153 A # 7 H -72';
		$sede->SedeEmail = 'AGQPRODYCONCOLOMBIAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '45';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-4545169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'SKF LATIN AMERICAN LTDA (principal)';
		$sede->SedeAddress = 'KM 3.5 VÍA SIBERIA CENTRO EMPRESARIAL METROPOLITANO, BODEGA 18, MÓDULO 3';
		$sede->SedeEmail = 'SKFLATINAMERICANLTDA_ppal@gmail.com';
		$sede->FK_SedeCli = '46';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-4646169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'AMERICAN EMBASSY BOGOTA (principal)';
		$sede->SedeAddress = 'CRA 45 No 24 B 27';
		$sede->SedeEmail = 'AMERICANEMBASSYBOGOTA_ppal@gmail.com';
		$sede->FK_SedeCli = '47';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-4747169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'LINDE COLOMBIA S.A. (principal)';
		$sede->SedeAddress = 'KM 6,5 VIA SOACHA MONDOÑEDO – PLANTA VIDRIO ANDINO';
		$sede->SedeEmail = 'LINDECOLOMBIAS.A._ppal@gmail.com';
		$sede->FK_SedeCli = '48';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-4848169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'FUNDICOM S.A.S (principal)';
		$sede->SedeAddress = 'CALLE 3 # 11 – 68';
		$sede->SedeEmail = 'FUNDICOMS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '49';
		$sede->FK_SedeMun = '584';
		$sede->SedeSlug = 'sede-4949584';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'C.I INTERAMERICAN CONMINAS S.A.S (principal)';
		$sede->SedeAddress = 'VEREDA RASGATA - TAUSA - CUNDINAMARCA';
		$sede->SedeEmail = 'C.IINTERAMERICANCONMINASS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '50';
		$sede->FK_SedeMun = '618';
		$sede->SedeSlug = 'sede-5050618';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'TECSER LABORATORIOS S.A (principal)';
		$sede->SedeAddress = 'CLL 23 B  # 104 B – 43';
		$sede->SedeEmail = 'TECSERLABORATORIOSS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '51';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-5151169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'IRON MOUNTAIN (principal)';
		$sede->SedeAddress = 'CALLE 21 # 69 B - 57';
		$sede->SedeEmail = 'IRONMOUNTAIN_ppal@gmail.com';
		$sede->FK_SedeCli = '52';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-5252169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'TEO FARMS S.A.S (principal)';
		$sede->SedeAddress = 'VEREDA LA TRINIDAD – VEREDA SANTA ANA';
		$sede->SedeEmail = 'TEOFARMSS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '53';
		$sede->FK_SedeMun = '566';
		$sede->SedeSlug = 'sede-5353566';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'INSTITUTO NACIONAL DE VIGILANCIA DE MEDICAMENTOS Y ALIMENTOS – INVIMA (principal)';
		$sede->SedeAddress = 'AV CALLE 26 #51-20';
		$sede->SedeEmail = 'INSTITUTONACIONALDEVIGILANCIADEMEDICAMENTOSYALIMENTOS–INVIMA_ppal@gmail.com';
		$sede->FK_SedeCli = '54';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-5454169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ECORESIDUOS NACIONALES S.A.S ESP (principal)';
		$sede->SedeAddress = 'PARQUE AGROINDUSTRIAL DE LA SABANA';
		$sede->SedeEmail = 'ECORESIDUOSNACIONALESS.A.SESP_ppal@gmail.com';
		$sede->FK_SedeCli = '55';
		$sede->FK_SedeMun = '584';
		$sede->SedeSlug = 'sede-5555584';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'LABORATORIOS ALCON COLOMBIA S.A. (principal)';
		$sede->SedeAddress = 'CARRERA 69 B No 20-06 Bodega 14 Zona Industrial Montevideo';
		$sede->SedeEmail = 'LABORATORIOSALCONCOLOMBIAS.A._ppal@gmail.com';
		$sede->FK_SedeCli = '56';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-5656169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'POLYUPROTEC (principal)';
		$sede->SedeAddress = 'CR 123 14-11';
		$sede->SedeEmail = 'POLYUPROTEC_ppal@gmail.com';
		$sede->FK_SedeCli = '57';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-5757169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ASCENSORES SCHINDLER DE COLOMBIA SAS (principal)';
		$sede->SedeAddress = 'AVENIDA CALLE 127 NO. 46 – 25';
		$sede->SedeEmail = 'ASCENSORESSCHINDLERDECOLOMBIASAS_ppal@gmail.com';
		$sede->FK_SedeCli = '58';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-5858169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CASA MOBLESA Y CIA SAS (principal)';
		$sede->SedeAddress = 'CR 86 A 69 B 59';
		$sede->SedeEmail = 'CASAMOBLESAYCIASAS_ppal@gmail.com';
		$sede->FK_SedeCli = '59';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-5959169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'TEXAS OILTECH LABORATORIES (principal)';
		$sede->SedeAddress = 'CALLE 15 CARRERA N°33-30';
		$sede->SedeEmail = 'TEXASOILTECHLABORATORIES_ppal@gmail.com';
		$sede->FK_SedeCli = '60';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-6060169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'PREMEX S.A (principal)';
		$sede->SedeAddress = 'CARRERA 70 NO. 99 - 20 ZONA INDUSTRIAL MORATO';
		$sede->SedeEmail = 'PREMEXS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '61';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-6161169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'PROCESS, INTELLIGENT BUSINESS & TECHNOLOGY S.A.S (principal)';
		$sede->SedeAddress = 'CLL 161 No 15 – 60';
		$sede->SedeEmail = 'PROCESS,INTELLIGENTBUSINESS&TECHNOLOGYS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '62';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-6262169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CLINICA MIOCARDIO S.A.S (principal)';
		$sede->SedeAddress = 'KR 45 A # 94 71';
		$sede->SedeEmail = 'CLINICAMIOCARDIOS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '63';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-6363169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'IMPROBELL LTDA (principal)';
		$sede->SedeAddress = 'CALLE 23G # 111 - 63/59';
		$sede->SedeEmail = 'IMPROBELLLTDA_ppal@gmail.com';
		$sede->FK_SedeCli = '64';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-6464169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'IBEROAMERICANA DE PLÁSTICOS S.A.S (principal)';
		$sede->SedeAddress = 'CARRERA 6 N° 19 -29';
		$sede->SedeEmail = 'IBEROAMERICANADEPLÁSTICOSS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '65';
		$sede->FK_SedeMun = '581';
		$sede->SedeSlug = 'sede-6565581';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'WASTE AND ENVIRONMENTAL SERVICES S.A.S (principal)';
		$sede->SedeAddress = 'KM 1,5 VARIANTE COTA- CHIA CAFA 57';
		$sede->SedeEmail = 'WASTEANDENVIRONMENTALSERVICESS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '66';
		$sede->FK_SedeMun = '551';
		$sede->SedeSlug = 'sede-6666551';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ALBATEQ S.A (principal)';
		$sede->SedeAddress = 'VEREDA BALSILLAS LOTE SANDINO 1 Y 2';
		$sede->SedeEmail = 'ALBATEQS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '67';
		$sede->FK_SedeMun = '584';
		$sede->SedeSlug = 'sede-6767584';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'AGROSER S.A (principal)';
		$sede->SedeAddress = 'VÍA AUTOPISTA BOGOTÁ - MEDELLÍN KM 9 - PARQUE INDUSTRIAL ALCALÁ BODEGA 3';
		$sede->SedeEmail = 'AGROSERS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '68';
		$sede->FK_SedeMun = '620';
		$sede->SedeSlug = 'sede-6868620';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'LABORATORIOS CHALVER DE COLOMBIA S.A (secundaria)';
		$sede->SedeAddress = 'AV. 68 No. 37B - 31 SUR';
		$sede->SedeEmail = 'LABORATORIOSCHALVERDECOLOMBIAS.A(secundaria)@gmail.com';
		$sede->FK_SedeCli = '9';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-699169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'BEL STAR S.A (principal)';
		$sede->SedeAddress = 'PLANTA TOCANCIPÁ: KM22 CARRETERA CENTRAL DEL NORTE VEREDA CANAVITA';
		$sede->SedeEmail = 'BELSTARS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '69';
		$sede->FK_SedeMun = '624';
		$sede->SedeSlug = 'sede-7069624';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CORPORACIÓN PUNTO AZUL (principal)';
		$sede->SedeAddress = 'AUTOPISTA MEDELLIN KM 2.5 ENTRADA VIA PARCELAS PARQUE INDUSTRIAL OIKOS CIEM BODEGA H-128';
		$sede->SedeEmail = 'CORPORACIÓNPUNTOAZUL_ppal@gmail.com';
		$sede->FK_SedeCli = '70';
		$sede->FK_SedeMun = '551';
		$sede->SedeSlug = 'sede-7170551';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'TECNOLOGIA PLASTICA TECNOSA S.A.S (principal)';
		$sede->SedeAddress = 'Vereda Santa Cruz Km 0+650 metros Via Madrid – Los Arboles – Puente Piedra. Parque Industrial Santa Cruz Bodega 3';
		$sede->SedeEmail = 'TECNOLOGIAPLASTICATECNOSAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '71';
		$sede->FK_SedeMun = '581';
		$sede->SedeSlug = 'sede-7271581';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'YANBAL DE COLOMBIA S.A.S (principal)';
		$sede->SedeAddress = 'AVENIDA 15 # 5-87';
		$sede->SedeEmail = 'YANBALDECOLOMBIAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '72';
		$sede->FK_SedeMun = '636';
		$sede->SedeSlug = 'sede-7372636';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'FIBERGLASS COLOMBIA S.A (principal)';
		$sede->SedeAddress = 'CALLE 3 # 3 49 ESTE';
		$sede->SedeEmail = 'FIBERGLASSCOLOMBIAS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '73';
		$sede->FK_SedeMun = '584';
		$sede->SedeSlug = 'sede-7473584';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CAPE COLOMBIA S.A.S. (principal)';
		$sede->SedeAddress = 'AEROPUERTO EL DORADO - PUENTE AEREO / PLATAFORMA INTERIOR';
		$sede->SedeEmail = 'CAPECOLOMBIAS.A.S._ppal@gmail.com';
		$sede->FK_SedeCli = '74';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-7574169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'PROQUINAL S.A (principal)';
		$sede->SedeAddress = 'CALLE 11A 34 - 50';
		$sede->SedeEmail = 'PROQUINALS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '75';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-7675169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CPL AROMAS COLOMBIA LTDA (principal)';
		$sede->SedeAddress = 'KM 7 AUT BOGOTÁ - MEDELLIN COSTADO OCCIDENTAL BODEGA 11A, CELTA TRADE PARK';
		$sede->SedeEmail = 'CPLAROMASCOLOMBIALTDA_ppal@gmail.com';
		$sede->FK_SedeCli = '76';
		$sede->FK_SedeMun = '557';
		$sede->SedeSlug = 'sede-7776557';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'RATAR S.A.S (principal)';
		$sede->SedeAddress = 'TRANSVERSAL 93 N° 53-48 BODEGA 60-65';
		$sede->SedeEmail = 'RATARS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '77';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-7877169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'SCANDINAVIA PHARMA (principal)';
		$sede->SedeAddress = 'KM 2,5 VÍA Bogotá D.C.-FUNZA TRONCAL OCCIDENTAL BOD. 10 PARQUE INDUSTRIAL SAN CARLOS II';
		$sede->SedeEmail = 'SCANDINAVIAPHARMA_ppal@gmail.com';
		$sede->FK_SedeCli = '78';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-7978169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CERESCOS SAS (secundaria)';
		$sede->SedeAddress = 'CARRERA 65A # 18A - 41 - SEDE FABRICACIÓN';
		$sede->SedeEmail = 'CERESCOSSAS(secundaria)@gmail.com';
		$sede->FK_SedeCli = '13';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-8013169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'FLEXOGRAFICAS (principal)';
		$sede->SedeAddress = 'CRA 69C # 22 - 80 SUR';
		$sede->SedeEmail = 'FLEXOGRAFICAS_ppal@gmail.com';
		$sede->FK_SedeCli = '79';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-8179169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'TUBULAR RUNNING & RENTAL SERVICES SAS (principal)';
		$sede->SedeAddress = 'PARQUE INDUSTRIAL PUERTO VALLARTA BODEGA 23';
		$sede->SedeEmail = 'TUBULARRUNNING&RENTALSERVICESSAS_ppal@gmail.com';
		$sede->FK_SedeCli = '80';
		$sede->FK_SedeMun = '584';
		$sede->SedeSlug = 'sede-8280584';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'COLECTA S.A (principal)';
		$sede->SedeAddress = 'VEREDA LOS MANZANOS FINCA SHADAY';
		$sede->SedeEmail = 'COLECTAS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '81';
		$sede->FK_SedeMun = '636';
		$sede->SedeSlug = 'sede-8381636';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'SYMRISE LTDA. (principal)';
		$sede->SedeAddress = 'CARRERA 58 Nº 9 - 54 PUENTE ARANDA';
		$sede->SedeEmail = 'SYMRISELTDA._ppal@gmail.com';
		$sede->FK_SedeCli = '82';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-8482169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'FLAMINGO OIL S.A (principal)';
		$sede->SedeAddress = 'CARRERA 2B # 16 A – 55';
		$sede->SedeEmail = 'FLAMINGOOILS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '83';
		$sede->FK_SedeMun = '557';
		$sede->SedeSlug = 'sede-8583557';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'SUMITOMO CORPORATION COLOMBIA S.A.S. (principal)';
		$sede->SedeAddress = 'CARRERA 127 No. 22 G - 15 CENTRO DE DISTRIBUCIÓN NO. 8-9-10 PARQUE INDUSTRIAL EL DORADO';
		$sede->SedeEmail = 'SUMITOMOCORPORATIONCOLOMBIAS.A.S._ppal@gmail.com';
		$sede->FK_SedeCli = '84';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-8684169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'BAGUT SAS (principal)';
		$sede->SedeAddress = 'CARRERA 78 N BIS B # 53-39 SUR';
		$sede->SedeEmail = 'BAGUTSAS_ppal@gmail.com';
		$sede->FK_SedeCli = '85';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-8785169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'EXPRESO ANDINO DE CARGA S.A (principal)';
		$sede->SedeAddress = 'CLL 14B No 116 – 05 BODEGA 1';
		$sede->SedeEmail = 'EXPRESOANDINODECARGAS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '86';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-8886169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'FRANA INTERNATIONAL S.A.S (principal)';
		$sede->SedeAddress = 'PARQUE IND. GRAN SABANA BODEGA 37';
		$sede->SedeEmail = 'FRANAINTERNATIONALS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '87';
		$sede->FK_SedeMun = '624';
		$sede->SedeSlug = 'sede-8987624';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'PINTURAS SUPER LTDA (principal)';
		$sede->SedeAddress = 'CARRETERA DE OCCIDENTE KM 13 VÍA MOSQUERA';
		$sede->SedeEmail = 'PINTURASSUPERLTDA_ppal@gmail.com';
		$sede->FK_SedeCli = '88';
		$sede->FK_SedeMun = '584';
		$sede->SedeSlug = 'sede-9088584';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'SOCIEDAD HOTELERA TEQUENDAMA (principal)';
		$sede->SedeAddress = 'CALLE 13 # 26-30';
		$sede->SedeEmail = 'SOCIEDADHOTELERATEQUENDAMA_ppal@gmail.com';
		$sede->FK_SedeCli = '89';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-9189169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'GAIA VITARE S.A.S (principal)';
		$sede->SedeAddress = 'CARRERA 123 # 14 – 21  FONTIBON';
		$sede->SedeEmail = 'GAIAVITARES.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '90';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-9290169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'STANTON S.A.S (principal)';
		$sede->SedeAddress = 'KM 25 VÍA SIBATÉ';
		$sede->SedeEmail = 'STANTONS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '91';
		$sede->FK_SedeMun = '608';
		$sede->SedeSlug = 'sede-9391608';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ORGANIZACIÓN TERPEL S.A (principal)';
		$sede->SedeAddress = 'CARRERA 50 # 21 – 05 (PLANTA PUENTE ARANDA - LABORATORIO MOBILSERV)';
		$sede->SedeEmail = 'ORGANIZACIÓNTERPELS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '92';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-9492169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'AMG DE COLOMBIA LTDA (principal)';
		$sede->SedeAddress = 'CALLE 164 NO. 19A-21';
		$sede->SedeEmail = 'AMGDECOLOMBIALTDA_ppal@gmail.com';
		$sede->FK_SedeCli = '93';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-9593169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'RITCHI S.A.S (principal)';
		$sede->SedeAddress = 'CLL 19  No  68 – 95';
		$sede->SedeEmail = 'RITCHIS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '94';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-9694169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'HILVERDA KOOIJ COLOMBIA SAS (principal)';
		$sede->SedeAddress = 'KM 2.3 VIA ROSAL, SUBACHOQUE';
		$sede->SedeEmail = 'HILVERDAKOOIJCOLOMBIASAS_ppal@gmail.com';
		$sede->FK_SedeCli = '95';
		$sede->FK_SedeMun = '554';
		$sede->SedeSlug = 'sede-9795554';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CEMEX COLOMBIA S.A. (secundaria)';
		$sede->SedeAddress = 'AUTOPISTA NORTE No. 235 - 95 COSTADO OCCIDENTAL';
		$sede->SedeEmail = 'CEMEXCOLOMBIAS.A.(secundaria)@gmail.com';
		$sede->FK_SedeCli = '39';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-9839169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'BAXALTA S.A (principal)';
		$sede->SedeAddress = 'CALLE 21 # 69B-74 ZONA INDUSTRIAL MONTEVIDEO';
		$sede->SedeEmail = 'BAXALTAS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '96';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-9996169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'WORLD MEDICAL S.A.S (principal)';
		$sede->SedeAddress = 'CRA 7 No 156 – 68 PISO 28';
		$sede->SedeEmail = 'WORLDMEDICALS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '97';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-10097169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'EXXONMOBIL DE COLOMBIA S.A (principal)';
		$sede->SedeAddress = 'CALLE 19 No 50 – 42';
		$sede->SedeEmail = 'EXXONMOBILDECOLOMBIAS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '98';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-10198169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'UNIDAD DE GESTIÓN AMBIENTAL LTDA (principal)';
		$sede->SedeAddress = 'CALLE 56 A No 72 a - 06';
		$sede->SedeEmail = 'UNIDADDEGESTIÓNAMBIENTALLTDA_ppal@gmail.com';
		$sede->FK_SedeCli = '99';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-10299169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'KHEMRA TECHNOLOGIES (principal)';
		$sede->SedeAddress = 'CALLE 4 B No 53 C 11';
		$sede->SedeEmail = 'KHEMRATECHNOLOGIES_ppal@gmail.com';
		$sede->FK_SedeCli = '100';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-103100169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'PFIZER S.A.S (principal)';
		$sede->SedeAddress = 'CRA. 69  19 A 51 BOD 1  ZONA IND. MONTEVIDEO';
		$sede->SedeEmail = 'PFIZERS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '101';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-104101169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'BAYER S.A (principal)';
		$sede->SedeAddress = 'KILÓMETRO 7 AUTOPISTA MEDELLÍN CELTA TRADE PARK BODEGA 134';
		$sede->SedeEmail = 'BAYERS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '102';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-105102169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CHALVER S.A (principal)';
		$sede->SedeAddress = 'CRA.106 NO.15-25 MANZ.6 LOTE 28 Y 29';
		$sede->SedeEmail = 'CHALVERS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '103';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-106103169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'NOVARTIS DE COLOMBIA (principal)';
		$sede->SedeAddress = 'AV CALLE 24 No 95 – 12 BODEGA 40 Y 42 CENTRO INDUSTRIAL POSTOS';
		$sede->SedeEmail = 'NOVARTISDECOLOMBIA_ppal@gmail.com';
		$sede->FK_SedeCli = '104';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-107104169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'TERUMO BCT COLOMBIA S.A (principal)';
		$sede->SedeAddress = 'CRA 15 # 88 – 64 OFICINA 701';
		$sede->SedeEmail = 'TERUMOBCTCOLOMBIAS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '105';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-108105169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'COASPHARMA S.A.S (principal)';
		$sede->SedeAddress = 'CALLE 12 A # 27 – 72';
		$sede->SedeEmail = 'COASPHARMAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '106';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-109106169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'YOURWAY TRANSPORT BIO SERVICES COLOMBIA S.A.S. (principal)';
		$sede->SedeAddress = 'Av calle 24 # 95-12 Bodega 11 Parque Industrial Portos';
		$sede->SedeEmail = 'YOURWAYTRANSPORTBIOSERVICESCOLOMBIAS.A.S._ppal@gmail.com';
		$sede->FK_SedeCli = '107';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-110107169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'PROEMPACK COLOMBIA S.A.S (principal)';
		$sede->SedeAddress = 'KM 2.5 VÍA BOGOTÁ SIBERIA PARQUE IND PORTOS SABANA 80, BOD 102';
		$sede->SedeEmail = 'PROEMPACKCOLOMBIAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '108';
		$sede->FK_SedeMun = '551';
		$sede->SedeSlug = 'sede-111108551';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'HOY FARMA S.A.S (principal)';
		$sede->SedeAddress = 'CALLE 64 J No 77 - 48';
		$sede->SedeEmail = 'HOYFARMAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '109';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-112109169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'COMPAÑÍA CALIFORNIA (principal)';
		$sede->SedeAddress = 'CALLE 17 NO. 34-64';
		$sede->SedeEmail = 'COMPAÑÍACALIFORNIA_ppal@gmail.com';
		$sede->FK_SedeCli = '110';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-113110169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'MEMPHIS PRODUCTS S.A. (principal)';
		$sede->SedeAddress = 'CALLE 17 NO. 34-64';
		$sede->SedeEmail = 'MEMPHISPRODUCTSS.A._ppal@gmail.com';
		$sede->FK_SedeCli = '111';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-114111169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CI. SUNSHINE BOUQUET COLOMBIA S.A.S (secundaria)';
		$sede->SedeAddress = 'KM. 4 VERADA LA CONEJERA, ENTRADA SAN JOSÉ - DIAGONAL CLUB Bogotá D.C.';
		$sede->SedeEmail = 'CI.SUNSHINEBOUQUETCOLOMBIAS.A.S(secundaria)@gmail.com';
		$sede->FK_SedeCli = '5';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-1155169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ECOLOGIA Y ENTORNO S.A.S ESP - ECOENTORNO (principal)';
		$sede->SedeAddress = 'KM 4 VIA LA MESA VEREDA BALSILLAS';
		$sede->SedeEmail = 'ECOLOGIAYENTORNOS.A.SESP-ECOENTORNO_ppal@gmail.com';
		$sede->FK_SedeCli = '112';
		$sede->FK_SedeMun = '584';
		$sede->SedeSlug = 'sede-116112584';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'LABORATORIO FDA (principal)';
		$sede->SedeAddress = 'CALLE 20A NO. 43A - 50 INTERIOR 6';
		$sede->SedeEmail = 'LABORATORIOFDA_ppal@gmail.com';
		$sede->FK_SedeCli = '113';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-117113169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ARBOFARMA S.A.S. (principal)';
		$sede->SedeAddress = 'CALLE 20A NO. 43A - 50 INTERIOR 6';
		$sede->SedeEmail = 'ARBOFARMAS.A.S._ppal@gmail.com';
		$sede->FK_SedeCli = '114';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-118114169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'FRACO S.A (principal)';
		$sede->SedeAddress = 'CALLE 14 No. 64-62';
		$sede->SedeEmail = 'FRACOS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '115';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-119115169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'BLU LOGISTICS (principal)';
		$sede->SedeAddress = 'PARQUE EMPRESARIAL LÓGIKA II KM 6,1 AUTOPISTA MEDELLÍN – CEDI TENJO';
		$sede->SedeEmail = 'BLULOGISTICS_ppal@gmail.com';
		$sede->FK_SedeCli = '116';
		$sede->FK_SedeMun = '620';
		$sede->SedeSlug = 'sede-120116620';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'DUFLO S.A.S (principal)';
		$sede->SedeAddress = 'AUTOPISTA MEDELLÍN KM 1.8 PARQUE INDUSTRIAL LAS AMERCIAS BODEGA 1';
		$sede->SedeEmail = 'DUFLOS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '117';
		$sede->FK_SedeMun = '551';
		$sede->SedeSlug = 'sede-121117551';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'RICH DE COLOMBIA S.A.S (principal)';
		$sede->SedeAddress = 'KM 1,5 VIA FUNZA SIBERIA';
		$sede->SedeEmail = 'RICHDECOLOMBIAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '118';
		$sede->FK_SedeMun = '557';
		$sede->SedeSlug = 'sede-122118557';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'DIVERSEY COLOMBIA S.A.S (principal)';
		$sede->SedeAddress = 'AUT, MEDELLIN KM 1.8 VÍA SIBERIA PARQ IND SOKO, BOD 17-18';
		$sede->SedeEmail = 'DIVERSEYCOLOMBIAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '119';
		$sede->FK_SedeMun = '551';
		$sede->SedeSlug = 'sede-123119551';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CLARIANT PLASTICS & COATINGS (COLOMBIA) SAS (principal)';
		$sede->SedeAddress = 'AUTOPISTA MEDELLIN KM 2.5: VIA PARCELAS KM 1: VEREDA SIBERIA';
		$sede->SedeEmail = 'CLARIANTPLASTICS&COATINGS(COLOMBIA)SAS_ppal@gmail.com';
		$sede->FK_SedeCli = '120';
		$sede->FK_SedeMun = '551';
		$sede->SedeSlug = 'sede-124120551';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CONSTRUCCENTER (principal)';
		$sede->SedeAddress = 'CARRERA 24 # 33 A – 60';
		$sede->SedeEmail = 'CONSTRUCCENTER_ppal@gmail.com';
		$sede->FK_SedeCli = '121';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-125121169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'INMEVAL S.A.S (principal)';
		$sede->SedeAddress = 'AV CRA 9 # 22 -18';
		$sede->SedeEmail = 'INMEVALS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '122';
		$sede->FK_SedeMun = '557';
		$sede->SedeSlug = 'sede-126122557';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ACME LEON PLASTICOS (principal)';
		$sede->SedeAddress = 'CALLE 27 Nº 7A01 EL HATO';
		$sede->SedeEmail = 'ACMELEONPLASTICOS_ppal@gmail.com';
		$sede->FK_SedeCli = '123';
		$sede->FK_SedeMun = '557';
		$sede->SedeSlug = 'sede-127123557';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'AGROINDUSTRIA DEL RIOFRIO SAS (principal)';
		$sede->SedeAddress = 'VEREDA FAGUA - FINCA EL RANCHO';
		$sede->SedeEmail = 'AGROINDUSTRIADELRIOFRIOSAS_ppal@gmail.com';
		$sede->FK_SedeCli = '124';
		$sede->FK_SedeMun = '530';
		$sede->SedeSlug = 'sede-128124530';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'POLLO OLYMPICO S.A (principal)';
		$sede->SedeAddress = 'CALLE 16 C # 78 G- 95';
		$sede->SedeEmail = 'POLLOOLYMPICOS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '125';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-129125169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'SERVIVIR SERVICIOS MEDICOS INTEGRALES (principal)';
		$sede->SedeAddress = 'CRA 71 C No 3A 26';
		$sede->SedeEmail = 'SERVIVIRSERVICIOSMEDICOSINTEGRALES_ppal@gmail.com';
		$sede->FK_SedeCli = '126';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-130126169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CLARIANT DE COLOMBIA S.A (principal)';
		$sede->SedeAddress = 'AUTOPISTA MEDELLIN KM 2.5: VIA PARCELAS KM 1: VEREDA SIBERIA';
		$sede->SedeEmail = 'CLARIANTDECOLOMBIAS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '127';
		$sede->FK_SedeMun = '551';
		$sede->SedeSlug = 'sede-131127551';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'FUMIGACIONES YOUNG LTDA (principal)';
		$sede->SedeAddress = 'CARRERA 20 NO 162 – 11';
		$sede->SedeEmail = 'FUMIGACIONESYOUNGLTDA_ppal@gmail.com';
		$sede->FK_SedeCli = '128';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-132128169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'GASEOSAS LUX S.A.S (principal)';
		$sede->SedeAddress = 'CALLE 5C # 53D-12';
		$sede->SedeEmail = 'GASEOSASLUXS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '129';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-133129169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'PRODUCTOS JACOBSEN (principal)';
		$sede->SedeAddress = 'CRA 65B No 12- 41';
		$sede->SedeEmail = 'PRODUCTOSJACOBSEN_ppal@gmail.com';
		$sede->FK_SedeCli = '130';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-134130169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ADMINISTRAMOS Y TRANSPORTAMOS S.A.S (principal)';
		$sede->SedeAddress = 'VEREDA EL VERGANZO TOCANCIPÁ - CENTRAL TERMOELÉCTRICA MARTÍN DE CORRAL';
		$sede->SedeEmail = 'ADMINISTRAMOSYTRANSPORTAMOSS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '131';
		$sede->FK_SedeMun = '624';
		$sede->SedeSlug = 'sede-135131624';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'DISTRIQUIMICOS ALDIR S.A.S (principal)';
		$sede->SedeAddress = 'AV CALLE 24 N° 95-12 BODEGA 21';
		$sede->SedeEmail = 'DISTRIQUIMICOSALDIRS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '132';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-136132169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'PRODESEG S.A (principal)';
		$sede->SedeAddress = 'AUT. MEDELLIN KM 2,5 VIA PARCELAS KM 1,3 PARQUE IND AEPI BG 2';
		$sede->SedeEmail = 'PRODESEGS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '133';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-137133169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CONTINENTAL DE FUMIGACIONES LTDA. (principal)';
		$sede->SedeAddress = 'CARRERA 31A No 25 A – 33';
		$sede->SedeEmail = 'CONTINENTALDEFUMIGACIONESLTDA._ppal@gmail.com';
		$sede->FK_SedeCli = '134';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-138134169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'FADIVET S.A.S (principal)';
		$sede->SedeAddress = 'CALLE 72A # 86-69 LOCAL 43';
		$sede->SedeEmail = 'FADIVETS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '135';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-139135169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ARCO PEST CONTROL LTDA (principal)';
		$sede->SedeAddress = 'CLL 66A No 76 49';
		$sede->SedeEmail = 'ARCOPESTCONTROLLTDA_ppal@gmail.com';
		$sede->FK_SedeCli = '136';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-140136169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'EXRO S.A.S. (principal)';
		$sede->SedeAddress = 'PLANTA DE TRATAMIENTO DE AGUA BELSTAR: KM 22 VEREDA CANAVITA TOCANCIPÁ';
		$sede->SedeEmail = 'EXROS.A.S._ppal@gmail.com';
		$sede->FK_SedeCli = '137';
		$sede->FK_SedeMun = '624';
		$sede->SedeSlug = 'sede-141137624';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'LINDE COLOMBIA S.A. (secundaria)';
		$sede->SedeAddress = 'KM 21 AUTOPISTA NORTE- TOCANCIPA';
		$sede->SedeEmail = 'LINDECOLOMBIAS.A.(secundaria)@gmail.com';
		$sede->FK_SedeCli = '48';
		$sede->FK_SedeMun = '624';
		$sede->SedeSlug = 'sede-14248624';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'EMBOPACK S.A.S (principal)';
		$sede->SedeAddress = 'CALLE 107 A # 8B – 20 BR SANTA ANA';
		$sede->SedeEmail = 'EMBOPACKS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '138';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-143138169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'PROCESADORA DE LECHE S.A (principal)';
		$sede->SedeAddress = 'CALLE  72 # 64 – 105';
		$sede->SedeEmail = 'PROCESADORADELECHES.A_ppal@gmail.com';
		$sede->FK_SedeCli = '139';
		$sede->FK_SedeMun = '12';
		$sede->SedeSlug = 'sede-14413912';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'COMPAÑÍA DE TRABAJOS URBANOS S.A (principal)';
		$sede->SedeAddress = 'KM 17 + 200 CARRETERA CENTRAL DEL NORTE (CRA7)';
		$sede->SedeEmail = 'COMPAÑÍADETRABAJOSURBANOSS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '140';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-145140169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'MEDINA RIVERA INGENIEROS ASOCIADOS S.A.S (principal)';
		$sede->SedeAddress = 'CALLE 182 A # 15 - 09 BARRIO SANTANDERCITO';
		$sede->SedeEmail = 'MEDINARIVERAINGENIEROSASOCIADOSS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '141';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-146141169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'DICO S.A (principal)';
		$sede->SedeAddress = 'KM 3, VIA MOSQUERA – MADRID PARQUE INDUSTRIAL SAN JORGE BG 67';
		$sede->SedeEmail = 'DICOS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '142';
		$sede->FK_SedeMun = '584';
		$sede->SedeSlug = 'sede-147142584';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'SACMA S.A.S (principal)';
		$sede->SedeAddress = 'CLL 70 BIS No 19-14';
		$sede->SedeEmail = 'SACMAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '143';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-148143169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ECOFLORA S.A.S (principal)';
		$sede->SedeAddress = 'CARRERA 3  No.  120 – 24';
		$sede->SedeEmail = 'ECOFLORAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '144';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-149144169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'QUIMITRONICA LTDA (principal)';
		$sede->SedeAddress = 'CALLE 25 B No 43 – 70';
		$sede->SedeEmail = 'QUIMITRONICALTDA_ppal@gmail.com';
		$sede->FK_SedeCli = '145';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-150145169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'LABORATORIOS FARPAG S.A.S (principal)';
		$sede->SedeAddress = 'CARRERA 67 # 10 - 55';
		$sede->SedeEmail = 'LABORATORIOSFARPAGS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '146';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-151146169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'UNIVERSIDAD CENTRAL (principal)';
		$sede->SedeAddress = 'CARRERA 4 No 20 – 41 LABORATORIO DE CIENCIAS SOCIALES';
		$sede->SedeEmail = 'UNIVERSIDADCENTRAL_ppal@gmail.com';
		$sede->FK_SedeCli = '147';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-152147169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'VULCATEC S.A.S (principal)';
		$sede->SedeAddress = 'CLL 15 # 27 – 49';
		$sede->SedeEmail = 'VULCATECS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '148';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-153148169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'FUMIGAR Y SERVICIOS LTDA. (principal)';
		$sede->SedeAddress = 'CLL 48B  No 72 L 10 SUR';
		$sede->SedeEmail = 'FUMIGARYSERVICIOSLTDA._ppal@gmail.com';
		$sede->FK_SedeCli = '149';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-154149169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'POLITÉCNICO GRANCOLOMBIANO (principal)';
		$sede->SedeAddress = 'CALLE 57 NO. 3-00  ESTE -  SEDE CAMPUS';
		$sede->SedeEmail = 'POLITÉCNICOGRANCOLOMBIANO_ppal@gmail.com';
		$sede->FK_SedeCli = '150';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-155150169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'HELBERT Y CIA S.A (principal)';
		$sede->SedeAddress = 'CALLE 80 KM 1.5 ENTRADA PARQUE LA FLORIDA, 1 KM AL FONDO PARQUE INDUSTRIAL TERRAPUERTO BODEGA 8';
		$sede->SedeEmail = 'HELBERTYCIAS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '151';
		$sede->FK_SedeMun = '551';
		$sede->SedeSlug = 'sede-156151551';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'LAMINADOS TYT (principal)';
		$sede->SedeAddress = 'CALLE 17 N° 68-51 ZONA INDUSTRIAL DE MONTEVIDEO';
		$sede->SedeEmail = 'LAMINADOSTYT_ppal@gmail.com';
		$sede->FK_SedeCli = '152';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-157152169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'POLYCELT S.A.S. (principal)';
		$sede->SedeAddress = 'CALLE 17 N° 68-51 ZONA INDUSTRIAL DE MONTEVIDEO';
		$sede->SedeEmail = 'POLYCELTS.A.S._ppal@gmail.com';
		$sede->FK_SedeCli = '153';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-158153169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'EDS ESSO VERBENAL (principal)';
		$sede->SedeAddress = 'AV K 9 186-83';
		$sede->SedeEmail = 'EDSESSOVERBENAL_ppal@gmail.com';
		$sede->FK_SedeCli = '154';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-159154169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'FRAYCO S.A.S (secundaria)';
		$sede->SedeAddress = 'CALLE 73 # 53 – 37';
		$sede->SedeEmail = 'FRAYCOS.A.S(secundaria)@gmail.com';
		$sede->FK_SedeCli = '42';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-16042169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'RS RECTIFICADORA DE MOTORES SABOGAL - BATERIAS Y REPUESTOS S.A.S (principal)';
		$sede->SedeAddress = 'AV CLL 1 # 25-89';
		$sede->SedeEmail = 'RSRECTIFICADORADEMOTORESSABOGAL-BATERIASYREPUESTOSS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '155';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-161155169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'CONSORCIO MALLA VIAL CUNDINAMARCA (principal)';
		$sede->SedeAddress = 'CALLE 74 #22-52';
		$sede->SedeEmail = 'CONSORCIOMALLAVIALCUNDINAMARCA_ppal@gmail.com';
		$sede->FK_SedeCli = '156';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-162156169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'FUMIGACIONES Y DISTRIBUCIONES ZETA S.A.S (principal)';
		$sede->SedeAddress = 'CALLE 4 SUR NO. 71D-29';
		$sede->SedeEmail = 'FUMIGACIONESYDISTRIBUCIONESZETAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '157';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-163157169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'POLYAROMAS LTDA (principal)';
		$sede->SedeAddress = 'CALLE 75 No 27- 27';
		$sede->SedeEmail = 'POLYAROMASLTDA_ppal@gmail.com';
		$sede->FK_SedeCli = '158';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-164158169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'INSTITUTO AMAZONICO DE INVESTIGACIONES CIENTIFICAS “SINCHI” (principal)';
		$sede->SedeAddress = 'CALLE 20 N° 5-44. PRIMER PISO';
		$sede->SedeEmail = 'INSTITUTOAMAZONICODEINVESTIGACIONESCIENTIFICAS“SINCHI”_ppal@gmail.com';
		$sede->FK_SedeCli = '159';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-165159169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'MINISTERIO DE SALUD Y PROTECCION SOCIAL (principal)';
		$sede->SedeAddress = 'AVENIDA CARACAS # 1- 91 SUR';
		$sede->SedeEmail = 'MINISTERIODESALUDYPROTECCIONSOCIAL_ppal@gmail.com';
		$sede->FK_SedeCli = '160';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-166160169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'COMPASS GROUP SERVICES COLOMBIA (principal)';
		$sede->SedeAddress = 'AUTOPISTA NORTE NO. 235 - 71 COSTADO OCCIDENTAL';
		$sede->SedeEmail = 'COMPASSGROUPSERVICESCOLOMBIA_ppal@gmail.com';
		$sede->FK_SedeCli = '161';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-167161169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'PRODUCTOS STAHL DE COLOMBIA S.A. (principal)';
		$sede->SedeAddress = 'CARRERA 56 NO 22-46';
		$sede->SedeEmail = 'PRODUCTOSSTAHLDECOLOMBIAS.A._ppal@gmail.com';
		$sede->FK_SedeCli = '162';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-168162169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'GRUPO QUIROMAR SAS (principal)';
		$sede->SedeAddress = 'AV CRA 50 N° 29B-19 SUR BARRIO SANTA RITA';
		$sede->SedeEmail = 'GRUPOQUIROMARSAS_ppal@gmail.com';
		$sede->FK_SedeCli = '163';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-169163169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'PROYECTOS AMBIENTALES S.A.S ESP (principal)';
		$sede->SedeAddress = 'KM 3 VIA AEROPUERTO PERALES';
		$sede->SedeEmail = 'PROYECTOSAMBIENTALESS.A.SESP_ppal@gmail.com';
		$sede->FK_SedeCli = '164';
		$sede->FK_SedeMun = '1026';
		$sede->SedeSlug = 'sede-1701641026';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ALMAVIVA S.A (principal)';
		$sede->SedeAddress = 'CALLE 65 BIS NO. 88-84 BODEGA 1';
		$sede->SedeEmail = 'ALMAVIVAS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '165';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-171165169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'BIOLOGICOS Y CONTAMINADOS (principal)';
		$sede->SedeAddress = 'CARRERA 14 # 5 – 14';
		$sede->SedeEmail = 'BIOLOGICOSYCONTAMINADOS_ppal@gmail.com';
		$sede->FK_SedeCli = '166';
		$sede->FK_SedeMun = '584';
		$sede->SedeSlug = 'sede-172166584';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'GRUPO KOPELLE LTDA. (principal)';
		$sede->SedeAddress = 'CALLE 64 NO 120-13 ENGATIVÁ';
		$sede->SedeEmail = 'GRUPOKOPELLELTDA._ppal@gmail.com';
		$sede->FK_SedeCli = '167';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-173167169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'IMEC S.A. ESP (principal)';
		$sede->SedeAddress = 'CARRERA 45 A # 15 – 40 SECTOR BUQUE';
		$sede->SedeEmail = 'IMECS.A.ESP_ppal@gmail.com';
		$sede->FK_SedeCli = '168';
		$sede->FK_SedeMun = '740';
		$sede->SedeSlug = 'sede-174168740';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'IPS FERNANDO KUAN MEDINA S.A.S (principal)';
		$sede->SedeAddress = 'CALLE 70 No 29 - 17';
		$sede->SedeEmail = 'IPSFERNANDOKUANMEDINAS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '169';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-175169169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'MACROMED S.A.S (principal)';
		$sede->SedeAddress = 'CR 56 N 5C-38';
		$sede->SedeEmail = 'MACROMEDS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '170';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-176170169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ASEI S.A.S (principal)';
		$sede->SedeAddress = 'CALLE 29 # 41 -35';
		$sede->SedeEmail = 'ASEIS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '171';
		$sede->FK_SedeMun = '65';
		$sede->SedeSlug = 'sede-17717165';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'EXIAGRICOLA JD LTDA (principal)';
		$sede->SedeAddress = 'CRA 13 No 13 - 41';
		$sede->SedeEmail = 'EXIAGRICOLAJDLTDA_ppal@gmail.com';
		$sede->FK_SedeCli = '172';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-178172169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'HANDLER S.A.S (principal)';
		$sede->SedeAddress = 'CARRERA 97 NO. 24C 23 MUELLE INDUSTRIAL 1 BODEGA 3';
		$sede->SedeEmail = 'HANDLERS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '173';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-179173169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'APOTECARIUM LTDA (principal)';
		$sede->SedeAddress = 'CALLE 12 Nº 79A-25 BODEGA 8-9 AGRUPACION INDUSTRIAL PARQUE VILLA ALSACIA';
		$sede->SedeEmail = 'APOTECARIUMLTDA_ppal@gmail.com';
		$sede->FK_SedeCli = '174';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-180174169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ENERGÍA INTEGRAL ANDINA S.A. (principal)';
		$sede->SedeAddress = 'CRA 19 B No 166 – 73';
		$sede->SedeEmail = 'ENERGÍAINTEGRALANDINAS.A._ppal@gmail.com';
		$sede->FK_SedeCli = '175';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-181175169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'HIDROPROTECCIÓN S.A (principal)';
		$sede->SedeAddress = 'KM 1,2 VIA LA ARGENTINA, PARQUE INDUSTRIAL EL DORADO BODEGA 44';
		$sede->SedeEmail = 'HIDROPROTECCIÓNS.A_ppal@gmail.com';
		$sede->FK_SedeCli = '176';
		$sede->FK_SedeMun = '557';
		$sede->SedeSlug = 'sede-182176557';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'ASEPSIS PRODUCTS DE COLOMBIA S.A.S. PROASEPSIS S.A.S. (principal)';
		$sede->SedeAddress = 'AVENIDA 63 No 74B 42 BODEGA 9 PARQUE EMPRESARIAL NORMANDIA';
		$sede->SedeEmail = 'ASEPSISPRODUCTSDECOLOMBIAS.A.S.PROASEPSISS.A.S._ppal@gmail.com';
		$sede->FK_SedeCli = '177';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-183177169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'LABORATORIO HOMEOPATICO LONDON (principal)';
		$sede->SedeAddress = 'AVENIDA CALLE 63 Nº 16A - 21';
		$sede->SedeEmail = 'LABORATORIOHOMEOPATICOLONDON_ppal@gmail.com';
		$sede->FK_SedeCli = '178';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-184178169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'UNISERVICE (principal)';
		$sede->SedeAddress = 'DIAGONAL 5H NO 47-93 BODEGA';
		$sede->SedeEmail = 'UNISERVICE_ppal@gmail.com';
		$sede->FK_SedeCli = '179';
		$sede->FK_SedeMun = '169';
		$sede->SedeSlug = 'sede-185179169';
		$sede->SedeDelete = 0;
		$sede->save();

		$sede = new Sede();
		$sede->SedeName = 'FLORVAL S.A.S (principal)';
		$sede->SedeAddress = 'KILÓMETRO 14 VÍA ZIPAQUIRÁ-UBATÉ';
		$sede->SedeEmail = 'FLORVALS.A.S_ppal@gmail.com';
		$sede->FK_SedeCli = '180';
		$sede->FK_SedeMun = '586';
		$sede->SedeSlug = 'sede-186180586';
		$sede->SedeDelete = 0;
		$sede->save();
    }
}

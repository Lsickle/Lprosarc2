@extends('layouts.app')
@section('htmlheader_title', 'Clasificacion A')
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">
				<!-- box -->
				<div class="box">
					<!-- box-header -->
					<div class="box-header">
					<h3 class="box-title">Clasificacion A, segun Decreto Número 4741</h3>
					</div>
					<!-- /.box-header -->
					<!-- box-body -->
					<div class="box-body">
					<table id="Clasificacion" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Código</th>
								<th>Descripción</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>A1010</td>
								<td>Desechos metálicos y desechos que contengan aleaciones de cualquiera de las sustancias siguientes: <ul>
								    <li>Antimonio</li>
								    <li>Arsénico</li>
								    <li>Berilio</li>
								    <li>Cadmio</li>
								    <li>Mercurio</li>
								    <li>Selenio</li>
								    <li>Telurio</li>
								    <li>Talio</li>
								</ul>pero excluidos los desechos que figuran específicamente en la lista B. anexa en el decreto 4741</td>
							</tr>
							<tr>
								<td>A1020</td>
								<td>Desechos que tengan como constituyentes o contaminantes, excluidos los desechos de metal en forma masiva, cualquiera de las sustancias siguientes:
								<ul>
								     <li>Antimonio; compuestos de antimonio</li>
								     <li>Berilio; compuestos de berilio</li>
								     <li>Cadmio; compuestos de cadmio</li>
								     <li>Plomo; compuestos de plomo</li>
								     <li>Selenio; compuestos de selenio</li>
								     <li>Telurio; compuestos de telurio</li>
								 </ul></td>
							</tr>
							<tr>
								<td>A1030</td>
								<td>Desechos que tengan como constituyentes o contaminantes cualquiera de las sustancias siguientes: 
									<ul>
									    <li>Arsénico; compuestos de arsénico</li>
									    <li>Mercurio; compuestos de mercurio</li>
									    <li>Talio; compuestos de talio</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>A1040</td>
								<td>Desechos que tengan como constituyentes:  Carbonilos de metal; Compuestos de cromo hexavalente</td>
							</tr>
							<tr>
								<td>A1050</td>
								<td>Lodos galvánicos</td>
							</tr>
							<tr>
								<td>A1060</td>
								<td>Líquidos de desecho del decapaje de metales</td>
							</tr>
							<tr>
								<td>A1070</td>
								<td>Residuos de lixiviación del tratamiento del zinc, polvos y lodos como jarosita, hematites, etc.</td>
							</tr>
							<tr>
								<td>A1080</td>
								<td>Residuos de desechos de zinc no incluidos en la lista B anexa en el decreto 4741, que contengan plomo y cadmio en concentraciones tales que presenten características del anexo III del decreto 4741 de 2005</td>
							</tr>
							<tr>
								<td>A1090</td>
								<td>Cenizas de la incineración de cables de cobre recubiertos</td>
							</tr>
							<tr>
								<td>A1100</td>
								<td>Polvos y residuos de los sistemas de depuración de gases de las fundiciones de cobre</td>
							</tr>
							<tr>
								<td>A1110</td>
								<td>Soluciones electrolíticas usadas de las operaciones de refinación y extracción electrolítica del cobre </td>
							</tr>
							<tr>
								<td>A1120</td>
								<td>Lodos residuales, excluidos los fangos anódicos, de los sistemas de depuración electrolítica de las operaciones de refinación y extracción electrolítica del cobre</td>
							</tr>
							<tr>
								<td>A1130</td>
								<td>Soluciones de ácidos para grabar usadas que contengan cobre disuelto</td>
							</tr>
							<tr>
								<td>A1140</td>
								<td>Desechos de catalizadores de cloruro cúprico y cianuro de cobre </td>
							</tr>
							<tr>
								<td>A1150</td>
								<td>Cenizas de metales preciosos procedentes de la incineración de circuitos impresos no incluidos en la lista B </td>
							</tr>
							<tr>
								<td>A1160</td>
								<td>Acumuladores de plomo de desecho, enteros o triturados </td>
							</tr>
							<tr>
								<td>A1170</td>
								<td>Acumuladores de desecho sin seleccionar excluidas mezclas de acumuladores sólo de la lista B. Los acumuladores de desecho no incluidos en la lista B que contengan constituyentes del anexo I en tal grado que losconviertan en peligrosos </td>
							</tr>
							<tr>
								<td>A1180</td>
								<td>Montajes eléctricos y electrónicos de desecho o restos de éstos que contengan componentes como acumuladores y otras baterías incluidos en la lista A, interruptores de mercurio, vidrios de tubos de rayos catódicos y otros vidrios activados y capacitadores de PCB, o contaminados con constituyentes del anexo I (por ejemplo, cadmio, mercurio, plomo, bifenilopoliclorado) en tal grado que posean alguna de las características del anexoIII (véase la entrada correspondiente en la lista B B1110)</td>
							</tr>
							<tr>
								<td>A2010</td>
								<td>Desechos de vidrio de tubos de rayos catódicos y otros vidrios activados</td>
							</tr>
							<tr>
								<td>A2020</td>
								<td>Desechos de compuestos inorgánicos de flúor en forma de líquidoso lodos, pero excluidos los desechos de ese tipo especificados en la lista B</td>
							</tr>
							<tr>
								<td>A2030</td>
								<td>Desechos de catalizadores, pero excluidos los desechos de este tipo especificados en la lista B</td>
							</tr>
							<tr>
								<td>A2040</td>
								<td>Yeso de desecho procedente de procesos de la industria química, si contiene constituyentes del anexo I en tal grado que presenten una característica peligrosa del anexo III (véase la entrada correspondiente en la lista B B2080)</td>
							</tr>
							<tr>
								<td>A2050</td>
								<td>Desechos de amianto (polvo y fibras)</td>
							</tr>
							<tr>
								<td>A2060</td>
								<td>Cenizas volantes de centrales eléctricas de carbón que contengan sustancias del anexo I en concentraciones tales que presenten características del anexo III(véase ia entrada correspondiente en la lista B B2050)</td>
							</tr>
							<tr>
								<td>A3010</td>
								<td>Desechos resultantes de la producción o el tratamiento de coque de petróleo y asfalto</td>
							</tr>
							<tr>
								<td>A3020</td>
								<td>Aceites minerales de desecho no aptos para el uso al que estaban destinados</td>
							</tr>
							<tr>
								<td>A3030</td>
								<td>Desechos que contengan, estén integrados o estén contaminados por lodos de compuestos antidetonantes con plomo</td>
							</tr>
							<tr>
								<td>A3040</td>
								<td>Desechos de líquidos térmicos (transferencia de calor)</td>
							</tr>
							<tr>
								<td>A3050</td>
								<td>Desechos resultantes de la producción, preparación y utilización de resinas, látex, plastificantes o colas/adhesivos excepto los desechos especificados en la lista B (véase el apartado correspondiente en la lista B B4020)</td>
							</tr>
							<tr>
								<td>A3060</td>
								<td>Nitrocelulosa de desecho</td>
							</tr>
							<tr>
								<td>A3070</td>
								<td>Desechos de fenoles, compuestos fenólicos, incluido el clorofenol enforma de líquido o de lodo</td>
							</tr>
							<tr>
								<td>A3080</td>
								<td>Desechos de éteres excepto los especificados en la lista B</td>
							</tr>
							<tr>
								<td>A3090</td>
								<td>Desechos de cuero en forma de polvo, cenizas, Iodos y harinas que contengan compuestos de plomo hexavalente o biocidas (véase el apartado correspondiente en la lista B B3100)</td>
							</tr>
							<tr>
								<td>A3100</td>
								<td>Raeduras y otros desechos del cuero o de cuero regenerado que no sirvan para la fabricación de artículos de cuero, que contengan compuestos de cromo hexavalente o biocidas (véase elapartado correspondiente en la lista B B3090)</td>
							</tr>
							<tr>
								<td>A3110</td>
								<td>Desechos del curtido de pieles que contengan compuestos de cromohexavalente o biocidas o sustancias infecciosas (véase el apartado correspondiente en la lista B B3110)</td>
							</tr>
							<tr>
								<td>A3120</td>
								<td>Pelusas - fragmentos ligeros resultantes del desmenuzamiento</td>
							</tr>
							<tr>
								<td>A3130</td>
								<td>Desechos de compuestos de fósforo orgánicos</td>
							</tr>
							<tr>
								<td>A3140</td>
								<td>Desechos de disolventes orgánicos no halogenados pero con exclusión de los desechos especificados en la lista B</td>
							</tr>
							<tr>
								<td>A3150</td>
								<td>Desechos de disolventes orgánicos halogenados</td>
							</tr>
							<tr>
								<td>A3160</td>
								<td>Desechos resultantes de residuos no acuosos de destilación halogenados o no halogenados derivados de operaciones de recuperación de disolventes orgánicos</td>
							</tr>
							<tr>
								<td>A3170</td>
								<td>Desechos resultantes de la producción de hidrocarburos halogenados alifáticos (tales como clorometano, dicloroetano, cloruro de vinilo, cloruro dealilo y epicloridrina)</td>
							</tr>
							<tr>
								<td>A3180</td>
								<td>Desechos, sustancias y artículos que contienen, consisten o están contaminados con bifenilo policlorado (PCB), terfenilo policlorado (PCT),naftaleno policlorado (PCN) o bifenilopolibromado (PBB), o cualquier otro compuesto polibromado análogo, con una concentración de igual o superior a50 mg/kg</td>
							</tr>
							<tr>
								<td>A3190</td>
								<td>Desechos de residuos alquitranados (con exclusión de los cementos asfálticos) resultantes de la refinación, destilación o cualquier otro tratamiento pirolíticode materiales orgánicos</td>
							</tr>
							<tr>
								<td>A3200</td>
								<td>Material bituminoso (desechosde asfalto) con contenido de alquitrán resultantes de la construcción y e! mantenimiento de carreteras (obsérvese elartículo correspondiente B2130 de la lista B)</td>
							</tr>
							<tr>
								<td>A4010</td>
								<td>Desechos resultantes de la producción, preparación y utilización de productos farmacéuticos, pero con exclusión de los desechos especificados en la lista B</td>
							</tr>
							<tr>
								<td>A4020</td>
								<td>Desechos clínicos y afines; es decir desechos resultantes de prácticas médicas, de enfermería, dentales, veterinarias o actividades similares, y desechos generados en hospitales u otras instalaciones durante actividades de investigación o el tratamiento de pacientes, o de proyectos de investigación</td>
							</tr>
							<tr>
								<td>A4030</td>
								<td>Desechos resultantes de la producción, ¡a preparación y la utilización de biocidas y productos fitofarmacéuticos, con inclusión de desechos de plaguicidas y herbicidas que no respondan a las especificaciones, caducados,en desuso o no aptos para el uso previsto originalmente.</td>
							</tr>
							<tr>
								<td>A4040</td>
								<td>Desechos resultantes de la fabricación, preparación y utilización de productos químicos para la preservación de la madera</td>
							</tr>
							<tr>
								<td>A4050</td>
								<td>Desechos que contienen, consisten o están contaminados con algunos de los productos siguientes: <ul>
								    <li>Cianuros inorgánicos, con excepción de residuos que contienen metales preciosos, en forma sólida, con trazas de cianuros inorgánicos</li>
								    <li>Cianuros orgánicos</li>
								</ul></td>
							</tr>
							<tr>
								<td>A4060</td>
								<td>Desechos de mezclas y emulsiones de aceite y agua o de hidrocarburos y agua</td>
							</tr>
							<tr>
								<td>A4070</td>
								<td>Desechos resultantes de la producción, preparación y utilización de tintas, colorantes, pigmentos, pinturas, lacas o barnices, con exclusión de los desechos especificados en la lista B (véase el apartado correspondiente de la lista B B4010)</td>
							</tr>
							<tr>
								<td>A4080</td>
								<td>Desechos de carácter explosivo (pero con exclusión de los desechos especificados en la lista B)</td>
							</tr>
							<tr>
								<td>A4090</td>
								<td>Desechos de soluciones ácidas o básicas, distintas de las especificadas en el apartado correspondiente de la lista B (véase el apartado correspondiente de la lista B B2120)</td>
							</tr>
							<tr>
								<td>A4100</td>
								<td>Desechos resultantes de la utilización de dispositivos de control de la contaminación industrial para la depuración de los gases industriales, pero con exclusión de los desechos especificados en la lista B</td>
							</tr>
							<tr>
								<td>A4110</td>
								<td>Desechos que contienen, consisten o, están contaminados con algunos de los productos siguientes: <ul>
								    <li>Cualquier sustancia del grupo de los dibenzofuranos policlorados</li>
								    <li>Cualquier sustancia del grupo de las dibenzodioxinas policloradas</li>
								</ul></td>
							</tr>
							<tr>
								<td>A4120</td>
								<td>Desechos que contienen, consisten o están contaminados con peróxidos</td>
							</tr>
							<tr>
								<td>A4130</td>
								<td>Envases y contenedores de desechos que contienen sustancias incluidas en el anexo I, en concentraciones suficientes como para mostrar las características peligrosas del anexo III</td>
							</tr>
							<tr>
								<td>A4140</td>
								<td>Desechos consistentes o que contienen productos químicos que no responden a las especificaciones o caducados correspondientes a las categorías del anexo I, y que muestran las características peligrosas del anexo III</td>
							</tr>
							<tr>
								<td>A4150</td>
								<td>Sustancias químicas de desecho, no identificadas o nuevas, resultantes de la investigación y el desarrollo o de las actividades de enseñanza y cuyos efectos en el ser humano o el medio ambiente no se conozcan</td>
							</tr>
							<tr>
								<td>A4160</td>
								<td>Carbono activado consumido no incluido en la lista B (véase el correspondiente apartado de la lista B B2060).</td>
							</tr>
						</tbody>
					</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		</div>
	</div>
@endsection
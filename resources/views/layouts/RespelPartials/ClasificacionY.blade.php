@extends('layouts.app')
@section('htmlheader_title', 'Clasificación Y')
@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-16 col-md-offset-0">
				<!-- box -->
				<div class="box">
					<!-- box-header -->
					<div class="box-header">
					<h3 class="box-title">Clasificación Y, según Decreto Número 4741</h3>
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
								<td>Y1</td>
								<td>Desechos clínicos resultantes de la atención médica prestada en hospitales, centros médicos y clínicas</td>
							</tr>
							<tr>
								<td>Y2</td>
								<td>Desechos resultantes de la producción y preparación de productos farmacéuticos</td>
							</tr>
							<tr>
								<td>Y3</td>
								<td>Desechos de medicamentos y productos farmacéuticos</td>
							</tr>
							<tr>
								<td>Y4</td>
								<td>Desechos resultantes de la producción, la preparación y la utilización de biocidas y productos fitofarmacéuticos</td>
							</tr>
							<tr>
								<td>Y5</td>
								<td>Desechos resultantes de la fabricación, preparación y utilización de productos químicos para la preservación de la madera</td>
							</tr>
							<tr>
								<td>Y6</td>
								<td>Desechos resultantes de la producción, la preparación y la utilización de disolventes orgánicos</td>
							</tr>
							<tr>
								<td>Y7</td>
								<td>Desechos, que contengan cianuros, resultantes del tratamiento térmico y las operaciones de temple</td>
							</tr>
							<tr>
								<td>Y8</td>
								<td>Desechos de aceites minerales no aptos para el uso a que estaban destinados</td>
							</tr>
							<tr>
								<td>Y9</td>
								<td>Mezclas y emulsiones de desechos de aceite y agua o de hidrocarburos y agua</td>
							</tr>
							<tr>
								<td>Y10</td>
								<td>Sustancias y artículos de desecho que contengan, o estén contaminados por, bifenilos policlorados (PCB), terfenilos policlorados (PCT) o bifenilos polibromados (PBB)</td>
							</tr>
							<tr>
								<td>Y11</td>
								<td>Residuos alquitranados resultantes de la refinación, destilación o cualquier otro tratamiento pirolítico</td>
							</tr>
							<tr>
								<td>Y12</td>
								<td>Desechos resultantes de la producción, preparación y utilización de tintas, colorantes, pigmentos, pinturas, lacas o barnices</td>
							</tr>
							<tr>
								<td>Y13</td>
								<td>Desechos resultantes de la producción, preparación y utilización de resinas, látex, plastificantes o colas y adhesivos</td>
							</tr>
							<tr>
								<td>Y14</td>
								<td>Sustancias químicas de desecho, no identificadas o nuevas, resultantes de la investigación y el desarrollo o de las actividades de enseñanza y cuyos efectos en el ser humano o el medio ambiente no se conozcan</td>
							</tr>
							<tr>
								<td>Y15</td>
								<td>Desechos de carácter explosivo que no estén sometidos a una legislación diferente</td>
							</tr>
							<tr>
								<td>Y16</td>
								<td>Desechos resultantes de la producción; preparación y utilización de productos químicos y materiales para fines fotográficos</td>
							</tr>
							<tr>
								<td>Y17</td>
								<td>Desechos resultantes del tratamiento de superficie de metales y plásticos</td>
							</tr>
							<tr>
								<td>Y18</td>
								<td>Residuos resultantes de las operaciones de eliminación de desechos industriales</td>
							</tr>
							<tr>
								<td>Y19</td>
								<td>Metales carbonilos</td>
							</tr>
							<tr>
								<td>Y20</td>
								<td>Berilio, compuestos de berilio</td>
							</tr>
							<tr>
								<td>Y21</td>
								<td>Compuestos de cromo hexavalente</td>
							</tr>
							<tr>
								<td>Y22</td>
								<td>Compuestos de cobre</td>
							</tr>
							<tr>
								<td>Y23</td>
								<td>Compuestos de zinc</td>
							</tr>
							<tr>
								<td>Y24</td>
								<td>Arsénico, compuestos de arsénico</td>
							</tr>
							<tr>
								<td>Y25</td>
								<td>Selenio, compuestos de selenio</td>
							</tr>
							<tr>
								<td>Y26</td>
								<td>Cadmio, compuestos de cadmio</td>
							</tr>
							<tr>
								<td>Y27</td>
								<td>Antimonio, compuestos de antimonio</td>
							</tr>
							<tr>
								<td>Y28</td>
								<td>Telurio, compuestos de telurio</td>
							</tr>
							<tr>
								<td>Y29</td>
								<td>Mercurio, compuestos de mercurio</td>
							</tr>
							<tr>
								<td>Y30</td>
								<td>Talio, compuestos de talío</td>
							</tr>
							<tr>
								<td>Y31</td>
								<td>Plomo, compuestos de plomo</td>
							</tr>
							<tr>
								<td>Y32</td>
								<td>Compuestos inorgánicos de flúor, con exclusión del fluoruro calcico</td>
							</tr>
							<tr>
								<td>Y33</td>
								<td>Cianuros inorgánicos</td>
							</tr>
							<tr>
								<td>Y34</td>
								<td>Soluciones ácidas o ácidos en forma sólida</td>
							</tr>
							<tr>
								<td>Y35</td>
								<td>Soluciones básicas o bases en forma sólida</td>
							</tr>
							<tr>
								<td>Y36</td>
								<td>Asbesto (polvo y fibras)</td>
							</tr>
							<tr>
								<td>Y37</td>
								<td>Compuestos orgánicos de fósforo</td>
							</tr>
							<tr>
								<td>Y38</td>
								<td>Cianuros orgánicos</td>
							</tr>
							<tr>
								<td>Y39</td>
								<td>Fenoles, compuestos fenólicos, con inclusión de clorofenoles</td>
							</tr>
							<tr>
								<td>Y40</td>
								<td>Éteres</td>
							</tr>
							<tr>
								<td>Y41</td>
								<td>Solventes orgánicos halogenados</td>
							</tr>
							<tr>
								<td>Y42</td>
								<td>Disolventes orgánicos, con exclusión de disolventes halogenados</td>
							</tr>
							<tr>
								<td>Y43</td>
								<td>Cualquier sustancia del grupo de los dibenzofuranos policlorados</td>
							</tr>
							<tr>
								<td>Y44</td>
								<td>Cualquier sustancia del grupo de las dibenzoparadioxinas policloradas</td>
							</tr>
							<tr>
								<td>Y45</td>
								<td>Compuestos organohalogenados, que no sean las sustancias mencionadas en los campos anteriores (por ejemplo, Y39, Y41, Y42, Y43, Y44).</td>
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
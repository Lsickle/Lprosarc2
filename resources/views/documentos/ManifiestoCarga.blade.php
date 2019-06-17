<!DOCTYPE html>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Manifiesto de Carga</title>
	<link rel="stylesheet" type="text/css" href="{{public_path()}}/css/manifiesto-carga-style.css">
</head>
<body>
	<header>
		<table id="header">
			<tr>
				<th id="header1" rowspan="2">
					<img src="{{public_path()}}/img/LogoProsarcCompleto.png" style="width: 20rem; height: 3.8rem;"><br>
					{{-- <img src="/img/LogoProsarcCompleto.png" style="width: 100%; height: 80%;"><br> --}}
					<small><b>NIT. 900.079.188-0</b></small>
				</th>
				<th id="textheader1">
					<div>
						<b>ENTREGA Y RECIBO DE MATERIAL</b>
					</div>
				</th>
				<th id="textheader3" colspan="4">
					<div>
						<b>FORMATO</b>
					</div>
				</th>
			</tr>
			<tr>
				<th id="textheader2">
					<b>TRANSPORTE - RECOLECCION</b>
				</th>
				<td id="textheader4">
					<div>FR-06</div>
				</td>
				<td id="textheader5">
					<div>REV.3</div>
				</td>
				<td id="textheader6" colspan="2">
					<div>Feb/2014</div>
				</td>
			</tr>
		</table>
	</header>
	<section>
		<div style="width: 15rem; float: left;">{{now()}}</div>
		<div style="width: 50rem; text-align: center; float: left;"><b>No. <span style="color: red;">{{ $id }}</span></b></div>
		<div style="width: 10rem; float: left;">
			Auditable
		</div>
		<table border="1px" style="margin-top: 15rem; border-collapse: collapse; width: 75rem;">
			<thead>
				<tr>
					<th>Unidades</th>
					<th>Descripcion del residuo</th>
					<th>Clasificación<br>(Decreto 4741)</th>
					<th>Cantidad (kg)</th>
					<th>Tipo de<br>peligrocidad</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>25</td>
					<td>Material primial no se que mas</td>
					<td>A4140</td>
					<td>1000</td>
					<td>N.A.</td>
				</tr>
			</tbody>
		</table>
	</section>
	<footer></footer>
</body>

</html>
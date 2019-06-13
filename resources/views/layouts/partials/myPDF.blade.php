<!DOCTYPE html>

<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Prueba PDF</title>
	<style>
		img{
			width: 5rem;
			height: 5rem;
		}
		table{border-collapse:collapse}
		td,th{border: 1px solid #000000}
		thead{
			background-color: #24292e;
			color: #fff;
		}
	</style>
</head>

<body>
	<img src="{{public_path()}}/img/LogoProsarc.png">

	<h1>Welcome to ñoño tiene café .com - {{ $title }}</h1>

	<table>
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

</body>

</html>
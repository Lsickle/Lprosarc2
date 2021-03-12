<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  {{-- <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'> --}}
  <title>Certificado E-0000001</title>

  <style>
    .invoice-box {
	  background-image: url('{{asset("img/75BigLogo.png")}}');
	  -webkit-background-size: contain; 
	  -moz-background-size: contain; 
	  -o-background-size: contain; 
	  background-size: contain; 
	  background-repeat: no-repeat;
      /* max-width: 800px; */
      /* margin: auto; */
      padding: 10px;
      /* border: 1px solid #eee; */
      box-shadow: 0 0 10px rgba(0, 0, 0, .15);
      font-size: 12px;
      line-height: 14px;
      font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      color: #222;
    }

    .invoice-box table {
      width: 100%;
      line-height: inherit;
      text-align: left;
    }

    .invoice-box table td {
      padding: 5px;
      vertical-align: top;
    }

    .invoice-box table tr td:nth-child(3) {
      text-align: right;
    }

    .invoice-box table tr.top table td {
      padding-bottom: 10px;
    }

    .invoice-box table tr.top table td.title {
      font-size: 45px;
      line-height: 45px;
      color: #999;
    }

    .invoice-box table tr.information table td {
      padding-bottom: 0px;
    }

    .invoice-box table tr.heading td {
      background: rgb(0, 56, 140);
      border-bottom: 1px rgb(0, 56, 140);
      font-weight: bold;
	  color: #ddd;
    }

    .invoice-box table tr.details td {
      padding-bottom: 0px;
    }

    .invoice-box table tr.item td {
      border-bottom: 1px solid rgb(198, 211, 255);
    }

    .invoice-box table tr.item.last td {
      border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(4) {
      border-top: 2px solid rgb(11, 24, 68);
      font-weight: bold;
      text-align: right;

    }

    @media only screen and (max-width: 600px) {
      .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
      }

      .invoice-box table tr.information table td {
        width: 100%;
        display: block;
        text-align: center;
      }
    }

    /** RTL **/
    .rtl {
      direction: rtl;
      font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
      text-align: right;
    }

    .rtl table tr td:nth-child(2) {
      text-align: left;
    }
  </style>
</head>

<body>
  <div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
      <tr class="top">
        <td colspan="4">
          <table>
            <tr>
              <td class="title">
                <img src="{{asset('img/logosinborde.png')}}" style="width:100%; max-width:300px;">
              </td>

              <td style="font-size: 16px; text-align: right;">
                <b>N°:</b> <b style="color:red;">E-0000001</b><br>
                Fecha: 01/01/2021<br>
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="details">
		<td colspan="4">
			<table style="text-align: center; font-size: 20px;">
				<tr>
					<td>
						<b> Certificado de Termodestrucción </b>
					</td>
				</tr>
			</table>
		</td>
        
      </tr>

      <tr class="information">
        <td colspan="4">
          <table>
            <tr>
              <td style="text-align: left; line-height: 14px;">
				<b style="color: grey;">GENERADOR:</b><br>
				<b>Hospital Engativa S.A.</b><br>
				801.801.801-9<br>
				Tv. 100a #80a-50 - Localidad:<b>Engativá</b><br>
				<b style="color: grey;">Contacto:</b><br>
				Nombre Apellido<br>
				correo@clienteexpress.com<br>
				301 23456789<br>
              </td>
			  <td style="text-align: right; line-height: 14px;">
					<b style="color: grey;">TRANSPORTADOR:</b><br>
					<b>Prosarc S.A. ESP</b><br>
					900.079.188-0<br>
					kilómetro 6, vía a la mesa, sub estación Balsillas<br>
					<b>Mosquera Cundinamarca</b><br>
					317 667 3032 – 317 667 3035<br>
				</td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="information">
        <td colspan="4">
          <table>
            <tr>      
              <td style="text-align: justify; font-size: 12px; line-height: 14px;">
				El <i>generador</i> entregó su(s) residuo(s) y/o desecho(s) a la planta Prosarc S.A. ESP. para TermoDestrucción durante el dia <b>01/02/2021</b>, de acuerdo con la siguiente información:
              </td>
            </tr>
          </table>
        </td>
      </tr>



      <tr class="heading">
        <td colspan="2">
			RESIDUO
        </td>

        <td style="text-align: center;">
			CORRIENTE
        </td>
		<td>
			PESO
		</td>
      </tr>

      <tr class="item">
        <td colspan="2">
			Residuos Hospitalarios con descripcion corta
        </td>

        <td style="text-align: center;">
          	A1010
        </td>

		<td>
			2.5 Kg. 
		</td>
      </tr>

	<tr class="item">
		<td colspan="2">
			Residuos Hospitalarios con nombre y descripcion un poco mas larga de lo común
		</td>
	
		<td style="text-align: center;">
			A1010
		</td>
	
		<td>
			2.5 Kg.
		</td>
	</tr>

      <tr class="item">
		<td colspan="2">
			Residuos Hospitalarios
		</td>
		
		<td style="text-align: center;">
			A1010
		</td>
		
		<td>
			0.5 Kg.
		</td>
      </tr>

		<tr class="item">
		<td colspan="2">
			Elementos de protección personal
		</td>
		
		<td style="text-align: center;">
			Y12
		</td>
		
		<td>
			1.5 Kg.
		</td>
      </tr>

      <tr class="item last">
		<td colspan="2">
			Residuos Hospitalarios
		</td>
		
		<td style="text-align: center;">
			A1010
		</td>
		
		<td>
			4.5 Kg.
		</td>
      </tr>

      <tr class="total">
        <td></td>
		<td></td>
		<td></td>

        <td>
          Total: 9.00 Kg.
        </td>
      </tr>
		<tr class="total">
			<td><b>Observaciones:</b></td>
			<td colspan="3">
				Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt a iusto vitae unde qui? Repellendus nulla optio illum, ex saepe tenetur provident omnis quidem voluptate fuga voluptatibus perferendis sint dolores.
			</td>
		</tr>
		<tr class="details">
			<td colspan="4">
				<table>
					<tr>
						<td style="text-align: justify; font-size: 10px; line-height: 10px;">
							Para este proceso se registraron temperaturas no menores a 850°C en la Cámara de combustión y 1.200°C en la cámara de post-combustión. Se utilizaron los sistemas de enfriamiento y Depuración de Gases, con los cuales se presentaron emisiones atmosféricas dentro de los estándares permisibles, quedando un residuo consistente en cenizas calcinadas y dispuestas en un relleno industrial autorizado y legalizado. <br><br>
							Todos los procesos anteriores se realizaron, ajustados al cumplimiento de las Resoluciones 058 de enero 21 de 2002, 0886 de julio 27 de 2004 y la 909 del 06 de junio de 2008 del MAVDT y a nuestra Licencia Ambiental, según Resolución No. 3077 de noviembre 7 de 2006, expedida por la CAR.
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<table>
					<tr>
						<td style="text-align: center; vertical-align: bottom;">
							<img src="{{asset('img/JhonGonzales2.png')}}" style="width: 80px;"><br>
							<b>Jefe de Logística</b>
						</td>
						<td style="text-align: center; vertical-align: bottom;">
							<img src="{{asset('img/DavidPizza2.png')}}" style="width: 80px;"><br>
							<b>Director Planta</b>
						</td>
						<td style="text-align: center; vertical-align: bottom;">
							<img src="{{asset('img/VictorVelasco2.png')}}" style="width: 80px;"><br>
							<b>Cliente</b>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table>
					<tr>
						<td style="text-align: left; font-size: 8px;">
							<img src="{{asset('img/QrCode.png')}}" style="width: 120px;"><br>
						</td>
					</tr>
				</table>
			</td>
			<td colspan="2" style="vertical-align: bottom;">
				<table>
					<tr>
						<td style="text-align: right; font-size: 8px; line-height: 10px;"> <b></b>
						<b>Planta de procesos</b>: kilómetro 6, vía a la mesa, sub estación Balsillas<br>
						<b>Mosquera Cundinamarca</b><br>
						<b>Telefax:</b> (571) 742 5395 – 7425417<br>
						<b>Celular:</b> 317 667 3032 – 317 667 3035<br>
						<br>
						<b>Sede administrativa y comercial:</b><br>
						Calle 120 A No 7 – 62/68 Of. 605<br>
						<b>Bogotá, D.C. - Colombia</b><br>
	
						</td>
					</tr>
				</table>
			</td>
		</tr>
    </table>
  </div>
</body>

</html>
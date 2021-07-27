<!doctype html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
  {{-- <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'> --}}
  <title>Comprobante RP-{{sprintf("%07s", $recibo->ID_Recibo)}}</title>

  <style>
	@page {
		margin: 90px 25px 260px 25px;
	}

	body{
		background-image: url('{{asset("img/WATERMARKV5.png")}}');
		-webkit-background-size: contain;
		-moz-background-size: contain;
		-o-background-size: contain;
		background-size: 600px;
		background-repeat: no-repeat;
		background-position: center;
	}
	header {
		position: fixed;
		top: -60px;
		left: 0px;
		right: 0px;
		height: auto;

		/** Extra personal styles **/
		background-color: #ffffff00;
		color: rgb(0, 0, 0);
		/* text-align: center; */
		/* line-height: 35px; */
	}

	footer {
		position: fixed;
		bottom: -60px;
		left: 0px;
		right: 0px;
		height: auto;

		/** Extra personal styles **/
		background-color: #ffffff00;
		color: rgb(0, 0, 0);
		/* text-align: center;
		line-height: 35px; */
	}
	.invoice-box {
      /* padding: 10px; */
      /* border: 1px solid #eee; */
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      font-size: 12px;
      line-height: 14px;
      font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      color: #000;
    }
	.main{

	}

    .invoice-box table {
      width: 100%;
      line-height: inherit;
      text-align: left;
    }

    .invoice-box table td {
      padding: 3px;
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
	<header>
		<div class="invoice-box header-footer">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="4">
						<table>
							<tr>
								<td class="title">
									<img src="{{asset('img/logoheaderTinyVersion.png')}}" style="width:100%; max-width:300px;">
								</td>

								<td style="font-size: 16px; text-align: right;">
									<b>N°:</b> <b style="color:red;">RP-{{sprintf("%07s", $recibo->ID_Recibo)}}</b><br>
									Fecha: {{date('d-m-Y', strtotime($recibo->created_at))}}<br>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</header>

	<footer>
		<div class="invoice-box header-footer">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="2">
						<table>
							<tr>
								<td style="text-align: left; font-size: 8px;">
									{{-- <img src="{{asset('img/QrCode.png')}}" style="width: 120px;"><br> --}}
									<img src="{{$qrCode->writeDataUri()}}"style="width: 120px;"  alt="" id="inputQrImg"><br>
								</td>
							</tr>
						</table>
					</td>
					<td colspan="2" style="vertical-align: bottom;">
						<table>
							<tr>
								<td style="text-align: right; font-size: 10px; line-height: 11px;"> <b></b>
									<b>Planta de procesos</b>: kilómetro 6, vía a la mesa<br>
									sub estación Balsillas <b>Mosquera Cundinamarca</b><br>
									<b>Telefax:</b> (571) 742 5395 – 7425417<br>
									<b>Celular:</b> 317 667 3032 – 317 667 3035<br>
									<br>
									<b>Sede administrativa y comercial:</b><br>
									Calle 120 A No 7 – 62/68 Of. 605 <b>Bogotá, D.C. - Colombia</b><br>
									<b>PBX-FAX</b> 629 9853 - 637 5112 <b>Servicio al cliente</b> 316 439 3895<br>
									<b>www.prosarc.com</b><br>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="4" style="text-align: center; font-size: 10px;">
						{{$recibo->ReciboSlug}}<br>
						Comprobante de pago generado y firmado digitalmente desde la aplicación <b>SisPRO</b> &copy; <?php echo date("Y");?> <br>
						¡Protejamos el medio ambiente; así aseguramos la vida y bienestar de nuestros hijos, nietos y generaciones futuras!
					</td>
				</tr>
			</table>
		</div>
	</footer>

	<!-- Wrap the content of your PDF inside a main tag -->
	<main>
		<p style="page-break-after: never;">
			<div class="invoice-box main">
				<table cellpadding="0">
					<tr class="details">
						<td colspan="4">
							<table style="text-align: center; font-size: 20px; line-height: 20px;"">
								<tr><td></td></tr>
								<tr>
									<td></td>
								</tr>

								<tr>
									<td></td>
								</tr>

								<tr>
									<td></td>
								</tr>

								<tr>
									<td></td>
								</tr>

								<tr>
									<td></td>
								</tr>

								<tr>
									<td>
										<b> Comprobante de Pago </b>
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
										<b style="color: grey;">Cliente:</b><br>
                                        <b>{{$Cliente->CliName}}</b><br>
                                        Nit:{{$Cliente->CliNit}}<br>
                                        Dirección:{{$sede->SedeAddress}}<b> {{ $sede->SedeMapLocalidad }}</b><br>
                                        <b style="color: grey;">CONTACTO:</b><br>
                                        Correo:{{$sede->SedeEmail}}<br>
                                        Tlf:{{$sede->SedeCelular}}<br>
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
									<td style="text-align: justify; font-size: 14px; line-height: 14px;">
										El <b><i>Cliente</i></b> pagó a <b>Prosarc S.A. ESP.</b> por su servicio de recoleccion y tratamiento de <b>TermoDestrucción</b> durante el dia <b>{{date('d-m-Y', strtotime($recibo->fecha_de_pago))}}</b>, de acuerdo con la siguiente información:
									</td>
								</tr>
							</table>
						</td>
					</tr>



					<tr class="heading">
						<td colspan="2">
                            Medio de Pago
						</td>

						<td style="text-align: center;">
							Referencia
						</td>
						<td>
							Monto
						</td>
					</tr>

					<tr class="item last">
                        <td colspan="2">
                            {{$recibo->medio_de_pago}}
                        </td>

                        <td style="text-align: center;">
                            {{$recibo->referencia}}
                        </td>

                        <td>
                            {{$recibo->monto}} $
                        </td>
                    </tr>

					<tr class="total">
						<td></td>
						<td></td>
						<td></td>

						<td>
							Total: {{$recibo->monto}} $
						</td>
					</tr>
					<tr class="total">
						<td><b>Observaciones:</b></td>
						<td colspan="3">
							{{$recibo->observacion}}
						</td>
					</tr>
					<tr class="details">
						<td colspan="4">
							<table>
								<tr>
									<td style="text-align: justify; font-size: 14px; line-height: 14px;">
										Este documento se emite únicamente como constancia de la recepción del dinero, correspondiente al pago por servicios de recolección y tratamiento y es verificable con la lectura del Código que contiene en la parte inferior. <br><br> <b>Este documento no tiene validez como factura ni como certificación del servicio prestado.</b>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="4" style="padding: 0px !important;">
							<table>
								<tr>
									<td style="text-align: center; vertical-align: bottom; padding: 0px !important;">
										<img src="{{asset('img/coordinadorSEv3.png')}}" style="width: 100px;"><br>
										<b>Coordinador <br> Servicios Express</b>
									</td>
                                    <td style="text-align: center; vertical-align: bottom; dding: 0px !important;">
                                    </td>
									<td style="text-align: center; vertical-align: bottom; dding: 0px !important;">
										<img src="{{asset('img/DavidPizza2.png')}}" style="width: 100px;"><br>
										<b>Asesor <br> Servicios Express</b>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</p>
	</main>

</body>

</html>

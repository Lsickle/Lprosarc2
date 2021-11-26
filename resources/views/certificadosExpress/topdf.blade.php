<!doctype html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
  {{-- <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'> --}}
  <title>Certificado E-{{sprintf("%07s", $certificado->ID_Cert)}}</title>

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
									<b>N°:</b> <b style="color:red;">E-{{sprintf("%07s", $certificado->ID_Cert)}}</b><br>
									Fecha: {{date('Y-m-d', strtotime(today()))}}<br>
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
						{{$certificado->CertSlug}}<br>
						Certificado generado y firmado digitalmente desde la aplicación <b>SisPRO</b> &copy; <?php echo date("Y");?> <br>
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
							<table style="text-align: center; font-size: 16px; line-height: 16px;"">
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
										<b>{{$certificado->sedegenerador->generadors->GenerName}}</b><br>
										{{$certificado->sedegenerador->generadors->GenerNit}}<br>
										{{$certificado->sedegenerador->GSedeAddress}}<b> {{ $certificado->sedegenerador->GSedeMapLocalidad !== 'No Definida' ? $certificado->sedegenerador->GSedeMapLocalidad : ''  }}</b><br>
										<b style="color: grey;">CONTACTO:</b><br>
										{{$certificado->sedegenerador->GSedeEmail}}<br>
										{{$certificado->sedegenerador->GSedeCelular}}<br>
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
										El <b><i>GENERADOR</i></b> entregó su(s) residuo(s) y/o desecho(s) a <b>Prosarc S.A. ESP.</b> para tratamiento de <b>TermoDestrucción</b> durante el dia <b>{{date('Y-m-d', strtotime($certificado->created_at))}}</b>, de acuerdo con la información del servicio <b>#{{$certificado->FK_CertSolser}}</b>:
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
					@php
					$totalKg = 0;
					@endphp
					@foreach($certificado->SolicitudServicio->SolicitudResiduo as $Residuo)
					@foreach ($certificado->certdato as $certdato)

					@if($Residuo->ID_SolRes == $certdato->FK_DatoCertSolRes)
					@if ($loop->parent->last)
					<tr class="item last">
					@else
					<tr class="item">
					@endif
						<td colspan="2">
							{{$Residuo->generespel->respels->RespelName}}
						</td>

						<td style="text-align: center;">
							@if($Residuo->generespel->respels->RespelIgrosidad == 'No peligroso')
							N/A
							@else
							{{$Residuo->generespel->respels->YRespelClasf4741}}{{$Residuo->generespel->respels->ARespelClasf4741}}
							@endif
						</td>

						<td>
                            @switch($Residuo->SolResTypeUnidad)
                                @case('Unidad')
                                {{$Residuo->SolResCantiUnidadConciliada === null ? 'N/A' : $Residuo->SolResCantiUnidadConciliada }} Unid. /
                                    @break
                                @case('Litros')
                                {{$Residuo->SolResCantiUnidadConciliada === null ? 'N/A' : $Residuo->SolResCantiUnidadConciliada }} Lt. /
                                    @break
                                @default
                            @endswitch
							{{$Residuo->SolResKgConciliado === null ? 'N/A' : $Residuo->SolResKgConciliado }} Kg.
						</td>
					</tr>
					@if($Residuo->SolResKgConciliado !== null)
					@php
					$totalKg = $totalKg+$Residuo->SolResKgConciliado;
					@endphp
					@endif
					@endif
					@endforeach
					@endforeach

					<tr class="total">
						<td></td>
						<td></td>
						<td></td>

						<td>
							Total: {{$totalKg}} Kg.
						</td>
					</tr>
					<tr class="total">
						<td><b>Observaciones:</b></td>
						<td colspan="3">
							{{$Solicitud->SolSerDescript}}
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
						<td colspan="4" style="padding: 0px !important;">
							<table>
								<tr>
									<td style="text-align: center; vertical-align: bottom; padding: 0px !important;">
										<img src="{{asset('img/coordinadorSEv3.png')}}" style="width: 100px;"><br>
										<b>Coordinador <br> Servicios Express</b>
									</td>
									<td style="text-align: center; vertical-align: bottom; dding: 0px !important;">
										<img src="{{asset('img/DavidPizza2.png')}}" style="width: 100px;"><br>
										<b>Director de Planta</b>
									</td>
									<td style="text-align: center; vertical-align: bottom; dding: 0px !important;">
										<img src="{{asset('storage/firmasClientes/'.$Solicitud->SolSerSlug.'.png')}}" style="width: 100px;"><br>
										{{-- <img src="{{asset($Solicitud->nombreDeFirma)}}" style="width: 100px;"><br> --}}
										<b>Cliente</b>
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

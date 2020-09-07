<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
<meta name=Generator content="Microsoft Word 15 (filtered)">
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
@font-face
	{font-family:Daytona;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:8.0pt;
	margin-left:0cm;
	line-height:107%;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;}
.MsoPapDefault
	{margin-bottom:8.0pt;
	line-height:107%;}
 /* Page Definitions */
 @page WordSection1
	{size:612.0pt 792.0pt;
	margin:36.0pt 36.0pt 36.0pt 36.0pt;}
div.WordSection1
	{page:WordSection1;}
-->
</style>

</head>

<body lang=ES-MX>

<div class=WordSection1>

<p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
line-height:normal'><span style='position:relative;z-index:251659264'><span
style='left:0px;position:absolute;left:2px;top:-73px;width:172px;height:52px'><img
width=172 height=52 src="DECLARACION%20DE%20RESIDUOS_archivos/image001.png"></span></span><b><span
style='font-size:10.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></b></p>

<br clear=ALL>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 align=left
 width=1351 style='border-collapse:collapse;margin-left:4.8pt;margin-right:
 4.8pt'>
 <tr style='height:19.5pt'>
  <td width=450 nowrap style='width:337.85pt;padding:0cm 3.5pt 0cm 3.5pt;
  height:19.5pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='font-size:10.0pt;font-family:"Arial",sans-serif'>SERVICIO<b>: #{{$SolicitudServicio->ID_SolSer}}&nbsp;</b></span></p>
  </td>
  <td width=450 style='width:337.85pt;padding:0cm 3.5pt 0cm 3.5pt;height:19.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:10.0pt;font-family:"Arial",sans-serif'>FECHA
  SOLICITUD<b>: {{date('Y-m-d',strtotime($SolicitudServicio->created_at))}}</b></span></p>
  </td>
  <td width=450 style='width:337.85pt;padding:0cm 3.5pt 0cm 3.5pt;height:19.5pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;text-align:right;
  line-height:normal'><span style='font-size:10.0pt;font-family:"Arial",sans-serif'>AUDITABLE:
  <b>{{$SolicitudServicio->SolResAuditoriaTipo}}</b></span></p>
  </td>
 </tr>
</table>

<p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif'>INFORMACION
DEL GENERADOR Y/O CLIENTE</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></b></p>

<table class=MsoTable15Grid2Accent3 border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr style='height:26.85pt'>
  <td width=340 style='width:255.05pt;border-top:solid windowtext 1.0pt;
  border-left:solid windowtext 1.0pt;border-bottom:none;border-right:none;
  background:white;padding:0cm 5.4pt 0cm 5.4pt;height:26.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b>EMPRESA</b></p>
  </td>
  <td width=340 style='width:255.05pt;border:none;border-top:solid windowtext 1.0pt;
  background:white;padding:0cm 5.4pt 0cm 5.4pt;height:26.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='color:black'>{{$Cliente->CliName}}</span></p>
  </td>
  <td width=340 style='width:255.05pt;border:none;border-top:solid windowtext 1.0pt;
  background:white;padding:0cm 5.4pt 0cm 5.4pt;height:26.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='color:black'>NIT</span></b></p>
  </td>
  <td width=340 style='width:255.05pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  background:white;padding:0cm 5.4pt 0cm 5.4pt;height:26.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='color:black'>{{$Cliente->CliNit}}</span></p>
  </td>
 </tr>
 <tr style='height:26.85pt'>
  <td width=340 style='width:255.05pt;border:none;border-left:solid windowtext 1.0pt;
  background:#EDEDED;padding:0cm 5.4pt 0cm 5.4pt;height:26.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='color:black'>CONTACTO</span></b></p>
  </td>
  <td width=340 style='width:255.05pt;border:none;background:#EDEDED;
  padding:0cm 5.4pt 0cm 5.4pt;height:26.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='color:black'>{{$SolicitudServicio->PersFirstName.' '.$SolicitudServicio->PersLastName}}</span></p>
  </td>
  <td width=340 style='width:255.05pt;border:none;background:#EDEDED;
  padding:0cm 5.4pt 0cm 5.4pt;height:26.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='color:black'>CARGO</span></b></p>
  </td>
  <td width=340 style='width:255.05pt;border:none;border-right:solid windowtext 1.0pt;
  background:#EDEDED;padding:0cm 5.4pt 0cm 5.4pt;height:26.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='color:black'>{{$SolicitudServicio->CargName}} / {{$SolicitudServicio->AreaName}}</span></p>
  </td>
 </tr>
 <tr style='height:26.85pt'>
  <td width=340 style='width:255.05pt;border:none;border-left:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:26.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b>Email</b></p>
  </td>
  <td width=340 style='width:255.05pt;border:none;padding:0cm 5.4pt 0cm 5.4pt;
  height:26.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'>{{$SolicitudServicio->PersEmail}}</p>
  </td>
  <td width=340 style='width:255.05pt;border:none;padding:0cm 5.4pt 0cm 5.4pt;
  height:26.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b>TELF./CELULAR</b></p>
  </td>
  <td width=340 style='width:255.05pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:26.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'>{{$SolicitudServicio->PersPhoneNumber}} /
  {{$SolicitudServicio->PersCellphone}}</p>
  </td>
 </tr>
 <tr style='height:26.85pt'>
  <td width=340 style='width:255.05pt;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:solid windowtext 1.0pt;border-right:none;background:#EDEDED;
  padding:0cm 5.4pt 0cm 5.4pt;height:26.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b><span
  style='color:black'>Dirección de recolección</span></b></p>
  </td>
  <td width=340 style='width:255.05pt;border:none;border-bottom:solid windowtext 1.0pt;
  background:#EDEDED;padding:0cm 5.4pt 0cm 5.4pt;height:26.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><span
  style='color:black'>{{$SolSerCollectAddress}}</span></p>
  </td>
  <td width=340 style='width:255.05pt;border:none;border-bottom:solid windowtext 1.0pt;
  background:#EDEDED;padding:0cm 5.4pt 0cm 5.4pt;height:26.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'><b>&nbsp;</b></p>
  </td>
  <td width=340 style='width:255.05pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  background:#EDEDED;padding:0cm 5.4pt 0cm 5.4pt;height:26.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;line-height:normal'>&nbsp;</p>
  </td>
 </tr>
</table>

<div align=center>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width="100%"
 style='width:100.0%;border-collapse:collapse;border:none'>
 <tr style='height:36.05pt'>
  <td width="100%" colspan=14 style='width:100.0%;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:none;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:36.05pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>LEA
  ATENTAMENTE LOS SIGUIENTES REQUERIMIENTO PARA EL DILIGENCIAMIENTO ADECUADO DE
  LA PRESENTE DECLARACION DE RESIDUOS, RECUERDE QUE USTED COMO GENERADOR SERA
  RESPONSABLE EN FORMA INTEGRAL DE LOS EFECTOS OCASIONADOS A LA SALUD O EL
  AMBIENTE DE UN RESIDUO PELIGROS NO DECLARADO (ARTICULO 13 DECRETO 4741 DE
  2005):</span></b></p>
  </td>
 </tr>
 <tr style='height:21.9pt'>
  <td width="100%" colspan=14 style='width:100.0%;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:none;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:21.9pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>a.
  El formato se debe diligenciar con todos los residuos a disponer, en caso de
  que algún residuo no está declarado NO podrá ser transportado o recibido en
  planta.</span></p>
  </td>
 </tr>
 <tr style='height:20.1pt'>
  <td width="100%" colspan=14 style='width:100.0%;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:none;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:20.1pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>b.
  Junto con la presente declaración se debe enviar la tarjeta de emergencia de
  los residuos peligrosos declarados de acuerdo con lo establecido en el artículo
  11 del Decreto 1609 de 2002</span></p>
  </td>
 </tr>
 <tr style='height:21.1pt'>
  <td width="100%" colspan=14 style='width:100.0%;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:none;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:21.1pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>c.
  Si alguna de las sustancias es controlada por la DNE se debe anexar el
  respectivo certificado de carencia donde se especifique dicha sustancia</span></p>
  </td>
 </tr>
 <tr style='height:20.65pt'>
  <td width="100%" colspan=14 style='width:100.0%;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 1.4pt 0cm 1.4pt;height:20.65pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>d.
  Los residuos que son transportados por PROSARC, o aquellos que lleguen
  directamente a la planta deben estar debidamente embalados y rotulados como
  lo establece el artículo 11 del Decreto 1609 de 2002</span></p>
  </td>
 </tr>
 <tr style='height:19.4pt'>
  <td width="100%" nowrap colspan=14 style='width:100.0%;border:solid windowtext 1.0pt;
  border-top:none;background:#D6DCE4;padding:0cm 1.4pt 0cm 1.4pt;height:19.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  color:black'>REQUERIMIENTOS</span></b></p>
  </td>
 </tr>
 <tr style='height:12.8pt'>
  <td width="19%" nowrap colspan=3 style='width:19.98%;border:none;border-left:
  solid windowtext 1.0pt;padding:0cm 1.4pt 0cm 1.4pt;height:12.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:8.0pt;font-family:"Daytona",sans-serif'>Ticket
  de Bascula</span></b></p>
  </td>
  <td width="20%" colspan=3 style='width:20.0%;border:none;padding:0cm 1.4pt 0cm 1.4pt;
  height:12.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:8.0pt;font-family:"Daytona",sans-serif'>Personal
  Capacitado</span></b></p>
  </td>
  <td width="23%" colspan=3 style='width:23.04%;border:none;padding:0cm 1.4pt 0cm 1.4pt;
  height:12.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:8.0pt;font-family:"Daytona",sans-serif'>Personal
  Adicional</span></b></p>
  </td>
  <td width="17%" colspan=3 style='width:17.0%;border:none;padding:0cm 1.4pt 0cm 1.4pt;
  height:12.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:8.0pt;font-family:"Daytona",sans-serif'>Vehículo
  Exclusivo</span></b></p>
  </td>
  <td width="19%" colspan=2 style='width:19.98%;border:none;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:12.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:8.0pt;font-family:"Daytona",sans-serif'>Vehículo
  con Plataforma</span></b></p>
  </td>
 </tr>
 <tr style='height:27.5pt'>
  <td width="19%" nowrap colspan=3 style='width:19.98%;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:none;padding:0cm 1.4pt 0cm 1.4pt;height:27.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif'><img
  width=88 height=37 id="Imagen 1"
  src="DECLARACION%20DE%20RESIDUOS_archivos/image002.png"></span></b></p>
  </td>
  <td width="20%" colspan=3 style='width:20.0%;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:27.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif'><img
  width=83 height=35 id="Imagen 8"
  src="DECLARACION%20DE%20RESIDUOS_archivos/image003.png"></span></b></p>
  </td>
  <td width="23%" colspan=3 style='width:23.04%;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:27.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif'><img
  width=85 height=35 id="Imagen 9"
  src="DECLARACION%20DE%20RESIDUOS_archivos/image004.png"></span></b></p>
  </td>
  <td width="17%" colspan=3 style='width:17.0%;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:27.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif'><img
  width=96 height=40 id="Imagen 10"
  src="DECLARACION%20DE%20RESIDUOS_archivos/image005.png"></span></b></p>
  </td>
  <td width="19%" colspan=2 style='width:19.98%;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:27.5pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif'><img
  width=82 height=34 id="Imagen 11"
  src="DECLARACION%20DE%20RESIDUOS_archivos/image006.png"></span></b></p>
  </td>
 </tr>
 <tr style='height:19.4pt'>
  <td width="100%" nowrap colspan=14 style='width:100.0%;border:solid windowtext 1.0pt;
  border-top:none;background:#D6DCE4;padding:0cm 1.4pt 0cm 1.4pt;height:19.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:10.0pt;font-family:"Arial",sans-serif;
  color:black'>RESIDUOS A ENTREGAR</span></b></p>
  </td>
 </tr>
 <tr style='height:22.8pt'>
  <td width="11%" nowrap style='width:11.78%;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>RESIDUO</span></b></p>
  </td>
  <td width="6%" style='width:6.58%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>CLASF</span></b></p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>�4741</span></b></p>
  </td>
  <td width="6%" colspan=2 style='width:6.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>CANT</span></b></p>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>KG</span></b></p>
  </td>
  <td width="7%" style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>ESTADO
  FISICO</span></b></p>
  </td>
  <td width="7%" colspan=2 style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>PELIGRO</span></b></p>
  </td>
  <td width="9%" style='width:9.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>EMBALAJE</span></b></p>
  </td>
  <td width="13%" style='width:13.14%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>TRATAMIENTO</span></b></p>
  </td>
  <td width="5%" style='width:5.24%;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>TARJ</span></b></p>
  </td>
  <td width="5%" style='width:5.26%;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:solid windowtext 1.0pt;border-right:none;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>HOJA</span></b></p>
  </td>
  <td width="10%" colspan=2 style='width:10.5%;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;border-right:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>GENERADOR</span></b></p>
  </td>
  <td width="15%" style='width:15.96%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><b><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>DIRECCION</span></b></p>
  </td>
 </tr>
 <tr style='height:22.8pt'>
  <td width="11%" nowrap style='width:11.78%;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>residuo
  nuevo test notification2</span></p>
  </td>
  <td width="6%" style='width:6.58%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>A1010</span></p>
  </td>
  <td width="6%" colspan=2 style='width:6.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>1200.00
  </span></p>
  </td>
  <td width="7%" style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>Liquido</span></p>
  </td>
  <td width="7%" colspan=2 style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>No
  peligroso</span></p>
  </td>
  <td width="9%" style='width:9.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>Cajas</span></p>
  </td>
  <td width="13%" style='width:13.14%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>TermoDestrucci�n</span></p>
  </td>
  <td width="5%" style='width:5.24%;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>SI</span></p>
  </td>
  <td width="5%" style='width:5.26%;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:solid windowtext 1.0pt;border-right:none;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>SI</span></p>
  </td>
  <td width="10%" colspan=2 style='width:10.5%;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;border-right:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>GenerClient
  C (planta de procesamiento)</span></p>
  </td>
  <td width="15%" style='width:15.96%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:7.0pt;font-family:"Arial",sans-serif'>9241
  Hintz Pine Smithamland, OH 01191 - Municipio:Bogot� D.C.</span></p>
  </td>
 </tr>
 <tr style='height:22.8pt'>
  <td width="11%" nowrap style='width:11.78%;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="6%" style='width:6.58%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="6%" colspan=2 style='width:6.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="7%" style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="7%" colspan=2 style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="9%" style='width:9.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="13%" style='width:13.14%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="5%" style='width:5.24%;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="5%" style='width:5.26%;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:solid windowtext 1.0pt;border-right:none;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="10%" colspan=2 style='width:10.5%;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;border-right:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="15%" style='width:15.96%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:22.8pt'>
  <td width="11%" nowrap style='width:11.78%;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="6%" style='width:6.58%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="6%" colspan=2 style='width:6.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="7%" style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="7%" colspan=2 style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="9%" style='width:9.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="13%" style='width:13.14%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="5%" style='width:5.24%;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="5%" style='width:5.26%;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:solid windowtext 1.0pt;border-right:none;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="10%" colspan=2 style='width:10.5%;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;border-right:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="15%" style='width:15.96%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:22.8pt'>
  <td width="11%" nowrap style='width:11.78%;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="6%" style='width:6.58%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="6%" colspan=2 style='width:6.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="7%" style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="7%" colspan=2 style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="9%" style='width:9.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="13%" style='width:13.14%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="5%" style='width:5.24%;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="5%" style='width:5.26%;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:solid windowtext 1.0pt;border-right:none;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="10%" colspan=2 style='width:10.5%;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;border-right:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="15%" style='width:15.96%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:22.8pt'>
  <td width="11%" nowrap style='width:11.78%;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="6%" style='width:6.58%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="6%" colspan=2 style='width:6.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="7%" style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="7%" colspan=2 style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="9%" style='width:9.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="13%" style='width:13.14%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="5%" style='width:5.24%;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="5%" style='width:5.26%;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:solid windowtext 1.0pt;border-right:none;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="10%" colspan=2 style='width:10.5%;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;border-right:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="15%" style='width:15.96%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:22.8pt'>
  <td width="11%" nowrap style='width:11.78%;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="6%" style='width:6.58%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="6%" colspan=2 style='width:6.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="7%" style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="7%" colspan=2 style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="9%" style='width:9.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="13%" style='width:13.14%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="5%" style='width:5.24%;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="5%" style='width:5.26%;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:solid windowtext 1.0pt;border-right:none;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="10%" colspan=2 style='width:10.5%;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;border-right:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="15%" style='width:15.96%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:22.8pt'>
  <td width="11%" nowrap style='width:11.78%;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="6%" style='width:6.58%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="6%" colspan=2 style='width:6.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="7%" style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="7%" colspan=2 style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="9%" style='width:9.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="13%" style='width:13.14%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="5%" style='width:5.24%;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="5%" style='width:5.26%;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:solid windowtext 1.0pt;border-right:none;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="10%" colspan=2 style='width:10.5%;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;border-right:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="15%" style='width:15.96%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:22.8pt'>
  <td width="11%" nowrap style='width:11.78%;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="6%" style='width:6.58%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="6%" colspan=2 style='width:6.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="7%" style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="7%" colspan=2 style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="9%" style='width:9.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="13%" style='width:13.14%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="5%" style='width:5.24%;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="5%" style='width:5.26%;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:solid windowtext 1.0pt;border-right:none;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="10%" colspan=2 style='width:10.5%;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;border-right:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="15%" style='width:15.96%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
 </tr>
 <tr style='height:22.8pt'>
  <td width="11%" nowrap style='width:11.78%;border:solid windowtext 1.0pt;
  border-top:none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="6%" style='width:6.58%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="6%" colspan=2 style='width:6.56%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="7%" style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="7%" colspan=2 style='width:7.88%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="9%" style='width:9.2%;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="13%" style='width:13.14%;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="5%" style='width:5.24%;border:none;border-bottom:solid windowtext 1.0pt;
  padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="5%" style='width:5.26%;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:solid windowtext 1.0pt;border-right:none;padding:0cm 1.4pt 0cm 1.4pt;
  height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="10%" colspan=2 style='width:10.5%;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;border-right:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
  <td width="15%" style='width:15.96%;border:solid windowtext 1.0pt;border-top:
  none;padding:0cm 1.4pt 0cm 1.4pt;height:22.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;text-align:center;
  line-height:normal'><span style='font-size:8.0pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>
  </td>
 </tr>
 <tr height=0>
  <td width=133 style='border:none'></td>
  <td width=43 style='border:none'></td>
  <td width=9 style='border:none'></td>
  <td width=29 style='border:none'></td>
  <td width=52 style='border:none'></td>
  <td width=47 style='border:none'></td>
  <td width=4 style='border:none'></td>
  <td width=58 style='border:none'></td>
  <td width=89 style='border:none'></td>
  <td width=33 style='border:none'></td>
  <td width=33 style='border:none'></td>
  <td width=42 style='border:none'></td>
  <td width=26 style='border:none'></td>
  <td width=108 style='border:none'></td>
 </tr>
</table>

</div>

<p class=MsoNormal>&nbsp;</p>

</div>

</body>

</html>

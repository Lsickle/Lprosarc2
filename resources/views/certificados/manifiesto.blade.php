<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
{{-- <meta name=Generator content="Microsoft Word 15 (filtered)"> --}}
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
@font-face
	{font-family:"Segoe UI";
	panose-1:2 11 5 2 4 2 4 2 2 3;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0cm;
	font-size:10.0pt;
	font-family:"Times New Roman",serif;}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{mso-style-link:"Encabezado Car";
	margin:0cm;
	font-size:10.0pt;
	font-family:"Times New Roman",serif;}
span.EncabezadoCar
	{mso-style-name:"Encabezado Car";
	mso-style-link:Encabezado;
	font-family:"Times New Roman",serif;}
.MsoChpDefault
	{font-family:"Calibri",sans-serif;}
.MsoPapDefault
	{margin-bottom:10.0pt;
	line-height:115%;}
 /* Page Definitions */
 @page WordSection1
	{size:612.0pt 792.0pt;
	margin:90.35pt 84.95pt 99.25pt 84.95pt;}
div.WordSection1
	{page:WordSection1;}
 /* List Definitions */
 ol
	{margin-bottom:0cm;}
ul
	{margin-bottom:0cm;}
-->
</style>

</head>

<body lang=ES-MX>

<div class=WordSection1>

<p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
style='font-size:12.0pt;font-family:"Arial",sans-serif'>PROSARC S.A ESP</span></b></p>

<p class=MsoNormal align=center style='margin-left:35.4pt;text-align:center;
text-indent:-35.4pt'><b><span lang=ES style='font-size:12.0pt;font-family:"Arial",sans-serif'>NIT
900.079.188-0</span></b></p>

<p class=MsoNormal align=center style='text-align:center'><span lang=ES
style='font-size:7.5pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
style='font-size:16.0pt;font-family:"Arial",sans-serif'>MANIFIESTA:</span></b></p>

<p class=MsoNormal><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif'>Que
el generador:</span></p>

<p class=MsoNormal><b><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif'>&nbsp;</span></b></p>

<div align=center>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=415 valign=top style='width:311.6pt;border:solid gray 0.5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
  7.5pt;font-family:"Arial",sans-serif'>Empresa:  <b>{{$certificado->sedegenerador->generadors->GenerName}}</b></span></p>
  </td>
  <td width=123 valign=top style='width:92.15pt;border:solid gray 0.5pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
  7.5pt;font-family:"Arial",sans-serif'>NIT:      <b>{{$certificado->sedegenerador->generadors->GenerNit}}</b></span></p>
  </td>
 </tr>
 <tr>
  <td width=415 valign=top style='width:311.6pt;border:solid gray 0.5pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
  7.5pt;font-family:"Arial",sans-serif'>Dirección: <b>{{$certificado->sedegenerador->GSedeAddress}} (Municipio:{{$certificado->sedegenerador->municipio->MunName}}) ({{$certificado->sedegenerador->GSedeName}})</b></span></p>
  </td>
  <td width=123 style='width:92.15pt;border-top:none;border-left:none;
  border-bottom:solid gray 0.5pt;border-right:solid gray 0.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif'>Ciudad:
  <b>{{$certificado->sedegenerador->municipio->Departamento->DepartName}}</b></span></p>
  </td>
 </tr>
</table>

</div>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
7.5pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
7.5pt;font-family:"Arial",sans-serif'>Por intermedio de la empresa
transportadora:</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
7.5pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>

<div align=center>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=415 valign=top style='width:311.6pt;border:solid gray 0.5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
  7.5pt;font-family:"Arial",sans-serif'>Empresa: <b>{{$certificado->transportador->ID_Cli == 1 ? $certificado->transportador->CliShortname : $certificado->transportador->CliName}} </b></span></p>
  </td>
  <td width=123 valign=top style='width:92.15pt;border:solid gray 0.5pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
  7.5pt;font-family:"Arial",sans-serif'>NIT: <b>{{$certificado->transportador->CliNit}}</b></span></p>
  </td>
 </tr>
 <tr>
  <td width=415 valign=top style='width:311.6pt;border:solid gray 0.5pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
  7.5pt;font-family:"Arial",sans-serif'>Dirección: <b>{{$certificado->transportador->sedes[0]->SedeAddress}} ({{$certificado->transportador->sedes[0]->Municipios->MunName}})</b></span></p>
  </td>
  <td width=123 valign=top style='width:92.15pt;border-top:none;border-left:
  none;border-bottom:solid gray 0.5pt;border-right:solid gray 0.5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
  7.5pt;font-family:"Arial",sans-serif'>Ciudad: <b>{{$certificado->transportador->sedes[0]->Municipios->Departamento->DepartName}}</b> </span></p>
  </td>
 </tr>
</table>

</div>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
7.5pt;font-family:"Arial",sans-serif'>&nbsp;</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
7.5pt;font-family:"Arial",sans-serif;color:#0D0D0D'>Entrego su(s) residuo(s)
y/o desecho(s), para tratamiento y disposición final de acuerdo con la siguiente
información:</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
7.5pt;font-family:"Arial",sans-serif;color:#0D0D0D'>&nbsp;</span></p>

<div align=center>

<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width=536
 style='width:401.7pt;border-collapse:collapse;border:none'>
 <tr>
  <td width=162 style='width:121.65pt;border:solid gray 0.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif;
  color:#0D0D0D'>Fecha de Recepción</span></p>
  </td>
  <td width=373 colspan=3 style='width:280.05pt;border:solid gray 0.5pt;
  border-left:none;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif;
  color:#0D0D0D'>@php
  if($certificado->recepcion != ""){
  $añorecepcion=date('Y', strtotime($certificado->recepcion));
  $mesrecepcion=date('m', strtotime($certificado->recepcion));
  $diarecepcion=date('d', strtotime($certificado->recepcion));
  $mesrecepciontexto = "";
  switch ($mesrecepcion) {
  case 1:
  $mesrecepciontexto = 'Enero';
  break;
  
  case 2:
  $mesrecepciontexto = 'Febrero';
  break;
  
  case 3:
  $mesrecepciontexto = 'Marzo';
  break;
  
  case 4:
  $mesrecepciontexto = 'Abril';
  break;
  
  case 5:
  $mesrecepciontexto = 'Mayo';
  break;
  
  case 6:
  $mesrecepciontexto = 'Junio';
  break;
  
  case 7:
  $mesrecepciontexto = 'Julio';
  break;
  
  case 8:
  $mesrecepciontexto = 'Agosto';
  break;
  
  case 9:
  $mesrecepciontexto = 'Setiembre';
  break;
  
  case 10:
  $mesrecepciontexto = 'Octubre';
  break;
  
  case 11:
  $mesrecepciontexto = 'Noviembre';
  break;
  
  case 12:
  $mesrecepciontexto = 'Diciembre';
  break;
  }
  }
  @endphp
  {{$diarecepcion}} de {{$mesrecepciontexto}} del {{$añorecepcion}}</span></p>
  </td>
 </tr>
 @php
$collection2 = collect([]);
@endphp
@foreach($certificado->SolicitudServicio->SolicitudResiduo as $Residuo)
@if($Residuo->requerimiento->FK_ReqTrata == $certificado->FK_CertTrat&&$Residuo->generespel->gener_sedes->ID_GSede == $certificado->FK_CertGenerSede)
@if($Residuo->SolResRM2 !== null && is_Array($Residuo->SolResRM2))
@foreach ($Residuo->SolResRM2 as $rm2 => $value2)
@php
$collection2 = $collection2->concat([$value2]);
@endphp
@endforeach
@else
@if (is_Array($Residuo->SolResRM))
@foreach ($Residuo->SolResRM as $rm => $value)
@php
$collection2 = $collection2->concat([$value]);
@endphp
@endforeach
@else
@php
$uniquestring = 'RM Invalido -> '.$Residuo->SolResRM;
@endphp
@endif
@endif
@endif
@endforeach
@php
if ($collection2->isNotEmpty()) {
$unicos = collect($collection2->unique());
$uniquestring = $unicos->values()->join(', ');
}
@endphp
 <tr>
  <td width=162 style='width:121.65pt;border:solid gray 0.5pt;border-top:none;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif;
  color:#0D0D0D'>Numero de Recibo de Materiales</span></p>
  </td>
  <td width=373 colspan=3 style='width:280.05pt;border-top:none;border-left:
  none;border-bottom:solid gray 0.5pt;border-right:solid gray 0.5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><b><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif;
  color:#0D0D0D'>{{$uniquestring}}</span></b></p>
  </td>
 </tr>
@php
$totalfilas=1;
@endphp
@foreach($certificado->SolicitudServicio->SolicitudResiduo as $Residuo)
@foreach ($certificado->certdato as $certdato)
@if($Residuo->ID_SolRes == $certdato->FK_DatoCertSolRes)
@php
$totalfilas=++$totalfilas;
@endphp
@endif
@endforeach
@endforeach
 <tr style='height:11.1pt'>
  <td width=162 rowspan={{$totalfilas}} style='width:121.65pt;border:solid gray 0.5pt;
  border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:11.1pt'>
  <p class=MsoNormal><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif;
  color:#0D0D0D'>Descripción del Material</span></p>
  </td>
  <td width=227 style='width:6.0cm;border-top:none;border-left:none;border-bottom:
  solid gray 0.5pt;border-right:solid gray 0.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.1pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
  style='font-size:7.5pt;font-family:"Arial",sans-serif;color:#0D0D0D'>DESCRIPCIÓN</span></b></p>
  </td>
  <td width=80 style='width:60.3pt;border-top:none;border-left:none;border-bottom:
  solid gray 0.5pt;border-right:solid gray 0.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.1pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
  style='font-size:7.5pt;font-family:"Arial",sans-serif;color:#0D0D0D'>CORRIENTE</span></b></p>
  </td>
  <td width=66 style='width:49.65pt;border-top:none;border-left:none;
  border-bottom:solid gray 0.5pt;border-right:solid gray 0.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.1pt'>
  <p class=MsoNormal align=center style='text-align:center'><b><span lang=ES
  style='font-size:7.5pt;font-family:"Arial",sans-serif;color:#0D0D0D'>PESO
  (kg)</span></b></p>
  </td>
 </tr>
 @php
$totalKg = 0;
@endphp
@foreach($certificado->SolicitudServicio->SolicitudResiduo as $Residuo)
@foreach ($certificado->certdato as $certdato)
@if($Residuo->ID_SolRes == $certdato->FK_DatoCertSolRes)
 <tr style='height:3.2pt'>
  <td width=227 style='width:6.0cm;border-top:none;border-left:none;border-bottom:
  solid gray 0.5pt;border-right:solid gray 0.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.2pt'>
  <p class=MsoNormal><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif'>{{$Residuo->generespel->respels->RespelName}}</span></p>
  </td>
  <td width=80 style='width:60.3pt;border-top:none;border-left:none;border-bottom:
  solid gray 0.5pt;border-right:solid gray 0.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.2pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=ES
  style='font-size:7.5pt;font-family:"Arial",sans-serif'>
  @if($Residuo->generespel->respels->RespelIgrosidad == 'No peligroso')
  N/A
  @else
  {{$Residuo->generespel->respels->YRespelClasf4741}}{{$Residuo->generespel->respels->ARespelClasf4741}}
  @endif
  </span></p>
  </td>
  <td width=66 style='width:49.65pt;border-top:none;border-left:none;
  border-bottom:solid gray 0.5pt;border-right:solid gray 0.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.2pt'>
  <p class=MsoNormal align=center style='text-align:center'><span lang=ES
  style='font-size:7.5pt;font-family:"Arial",sans-serif;color:black'>{{$Residuo->SolResKgConciliado === null ? 'N/A' : $Residuo->SolResKgConciliado }}</span></p>
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
 <tr>
  <td width=162 style='width:121.65pt;border:solid gray 0.5pt;border-top:none;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif;
  color:#0D0D0D'>Cantidad Total (kg)</span></p>
  </td>
  <td width=373 colspan=3 style='width:280.05pt;border-top:none;border-left:
  none;border-bottom:solid gray 0.5pt;border-right:solid gray 0.5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><b><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif;
  color:black'>{{$totalKg}}</span></b><b><span lang=ES style='font-size:7.5pt;
  font-family:"Arial",sans-serif;color:#0D0D0D'> kg</span></b></p>
  </td>
 </tr>
 <tr>
  <td width=162 style='width:121.65pt;border:solid gray 0.5pt;border-top:none;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif;
  color:#0D0D0D'>Mes del Tratamiento</span></p>
  </td>
  <td width=373 colspan=3 style='width:280.05pt;border-top:none;border-left:
  none;border-bottom:solid gray 0.5pt;border-right:solid gray 0.5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif;
  color:#0D0D0D'>@php
  if($certificado->recepcion != ""){
  $añorecepcion=date('Y', strtotime($certificado->recepcion));
  $mesrecepcion=date('m', strtotime($certificado->recepcion));
  $diarecepcion=date('d', strtotime($certificado->recepcion));
  $mesrecepciontexto = "";
  switch ($mesrecepcion) {
  case 1:
  $mesrecepciontexto = 'Enero';
  break;
  
  case 2:
  $mesrecepciontexto = 'Febrero';
  break;
  
  case 3:
  $mesrecepciontexto = 'Marzo';
  break;
  
  case 4:
  $mesrecepciontexto = 'Abril';
  break;
  
  case 5:
  $mesrecepciontexto = 'Mayo';
  break;
  
  case 6:
  $mesrecepciontexto = 'Junio';
  break;
  
  case 7:
  $mesrecepciontexto = 'Julio';
  break;
  
  case 8:
  $mesrecepciontexto = 'Agosto';
  break;
  
  case 9:
  $mesrecepciontexto = 'Setiembre';
  break;
  
  case 10:
  $mesrecepciontexto = 'Octubre';
  break;
  
  case 11:
  $mesrecepciontexto = 'Noviembre';
  break;
  
  case 12:
  $mesrecepciontexto = 'Diciembre';
  break;
  }
  }
  @endphp
  {{$mesrecepciontexto}} del {{$añorecepcion}}</span></p>
  </td>
 </tr>
 <tr>
  <td width=162 style='width:121.65pt;border:solid gray 0.5pt;border-top:none;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif;
  color:#0D0D0D'>Observaciones</span></p>
  </td>
  <td width=373 colspan=3 style='width:280.05pt;border-top:none;border-left:
  none;border-bottom:solid gray 0.5pt;border-right:solid gray 0.5pt;
  padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif;
  color:#0D0D0D'>Ninguna.</span></p>
  </td>
 </tr>
</table>

</div>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
7.5pt;font-family:"Arial",sans-serif;color:#0D0D0D'>&nbsp;</span></p>

<p class=MsoNormal style='text-align:justify'><span lang=ES style='font-size:
7.5pt;font-family:"Arial",sans-serif;color:#0D0D0D'>
El material será entregado al gestor (<b>NOMBRE DEL GESTOR</b>), empresa autorizada para el tratamiento <b>{{$certificado->tratamiento->TratName}}</b> de acuerdo con los requerimientos técnicos y ambientales establecidos.
</span></p>

<p class=MsoNormal style='text-align:justify'><b><span lang=ES
style='font-size:7.5pt;font-family:"Arial",sans-serif;color:#0D0D0D'>&nbsp;</span></b></p>
@php 
$añofirma=date('Y', strtotime(now()));
$mesfirma=date('m', strtotime(now()));
$diafirma=date('d', strtotime(now()));
$mesTexto = "";
switch ($mesfirma) {
    case 1:
    $mesTexto = 'Enero';
    break;

    case 2:
    $mesTexto = 'Febrero';
    break;

    case 3:
    $mesTexto = 'Marzo';
    break;

    case 4:
    $mesTexto = 'Abril';
    break;

    case 5:
    $mesTexto = 'Mayo';
    break;

    case 6:
    $mesTexto = 'Junio';
    break;

    case 7:
    $mesTexto = 'Julio';
    break;

    case 8:
    $mesTexto = 'Agosto';
    break;

    case 9:
    $mesTexto = 'Setiembre';
    break;

    case 10:
    $mesTexto = 'Octubre';
    break;

    case 11:
    $mesTexto = 'Noviembre';
    break;

    case 12:
    $mesTexto = 'Diciembre';
    break;
    }
@endphp
<p class=MsoNormal style='margin-left:35.4pt;text-align:justify;text-indent:
-35.4pt'><b><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif;
color:#0D0D0D'>Para constancia se firma en Mosquera, el día el día {{$diafirma}} de {{$mesTexto}} del {{$añofirma
}}.</span></b></p>

</div>

<div align=center>

<table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr style='height:8.1pt'>
  <td style='padding:0cm 5.4pt 0cm 5.4pt;height:8.1pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=ES><img width=125
  height=53 id="Imagen 6"
  src="/img//JhonGonzales2.png"></span></p>
  </td>
  <td style='padding:0cm 5.4pt 0cm 5.4pt;height:8.1pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
  style='font-size:7.5pt;font-family:"Arial",sans-serif'>&nbsp;</span></b></p>
  </td>
  <td style='padding:0cm 5.4pt 0cm 5.4pt;height:8.1pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=ES><img width=118
  height=76 id="Imagen 5"
  src="/img/VictorVelasco2.png"></span></p>
  </td>
 </tr>
 <tr>
  <td width=190 valign=top style='width:142.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><b><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif'>JOHN GONZALEZ
  </span></b></p>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
  style='font-size:7.5pt;font-family:"Arial",sans-serif'>Jefe de Logística</span></b></p>
  </td>
  <td width=190 valign=top style='width:142.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
  style='font-size:7.5pt;font-family:"Arial",sans-serif'>&nbsp;</span></b></p>
  </td>
  <td width=190 valign=top style='width:142.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal><b><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif'>VICTOR
  VELASCO</span></b></p>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
  style='font-size:7.5pt;font-family:"Arial",sans-serif'>Jefe de Operaciones</span></b></p>
  </td>
 </tr>
 <tr>
  <td width=190 valign=top style='width:142.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><span lang=ES><img width=120
  height=144 id="Imagen 4"
  src="/img/DavidPizza2.png"></span></p>
  </td>
  <td width=190 valign=top style='width:142.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
  style='font-size:7.5pt;font-family:"Arial",sans-serif'>&nbsp;</span></b></p>
  </td>
  <td width=190 valign=top style='width:142.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
  style='font-size:7.5pt;font-family:"Arial",sans-serif'>&nbsp;</span></b></p>
  </td>
 </tr>
 <tr>
  <td width=190 valign=top style='width:142.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
  style='font-size:7.5pt;font-family:"Arial",sans-serif'>Vo. Bo. </span></b></p>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
  style='font-size:7.5pt;font-family:"Arial",sans-serif'>DAVID PIZZA </span></b></p>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
  style='font-size:7.5pt;font-family:"Arial",sans-serif'>Director de Planta</span></b></p>
  </td>
  <td width=190 valign=top style='width:142.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
  style='font-size:7.5pt;font-family:"Arial",sans-serif'>&nbsp;</span></b></p>
  </td>
  <td width=190 valign=top style='width:142.4pt;padding:0cm 5.4pt 0cm 5.4pt'>
  <p class=MsoNormal style='text-align:justify'><b><span lang=ES
  style='font-size:7.5pt;font-family:"Arial",sans-serif'>&nbsp;</span></b></p>
  </td>
 </tr>
</table>


<p class=MsoNormal style='text-align:justify'><b><span lang=ES
style='font-size:7.5pt;font-family:"Arial",sans-serif;color:#0D0D0D'>&nbsp;</span></b></p>

<p class=MsoNormal style='text-align:justify'><b><span lang=ES
style='font-size:7.5pt;font-family:"Arial",sans-serif;color:#0D0D0D'>&nbsp;</span></b></p>

<p class=MsoNormal style='margin-left:35.4pt;text-align:left;text-indent:
-35.4pt'><span lang=ES style='font-size:7.5pt;font-family:"Arial",sans-serif;
color:#0D0D0D'>{{$certificado->CertSlug}}</span></p>

</div>

</body>

</html>

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
	// function para generar PDF del manifiesto de carga
	public function PdfManiCarg($id)
	{
		$data = ['id' => $id];
		$pdf = PDF::loadView('documentos.ManifiestoCarga', $data);
		return $pdf->download('Prueba.pdf');
	}
}

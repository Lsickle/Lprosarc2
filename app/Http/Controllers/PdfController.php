<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
	// function para generar PDF del manifiesto de carga
	public function PdfManiCarg($id1, $id2)
	{
		return $id1.' - '.$id2;
		$id = 'prueba.pdf';
		return view('documentos.ManifiestoCarga', compact('id'));
		$data = ['id' => 'Welcome to HDTuto.com'];
		$pdf = PDF::loadView('documentos.ManifiestoCarga', $data);
		return $pdf->download('Prueba.pdf');
	}
}

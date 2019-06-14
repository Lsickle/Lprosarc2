<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
	// function para generar PDF del manifiesto de carga
	public function PdfManiCarg($id)
	{
		$title = 'prueba.pdf';
		return view('documentos.ManifiestoCarga', compact('title'));
		$data = ['title' => 'Welcome to HDTuto.com'];
		$pdf = PDF::loadView('documentos.ManifiestoCarga', $data);
		return $pdf->download('Prueba.pdf');
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
	// function para generar PDF del manifiesto de carga
	public function PdfManiCarg(id)
	{
		$data = ['title' => 'Welcome to HDTuto.com'];
		$pdf = PDF::loadView('layouts.partials.myPDF', $data);
		$title = 'prueba.pdf';
		return view('layouts.partials.ManifiestoCarga', compact('title'));
		// return $pdf->download('Prueba.pdf');
	}
}

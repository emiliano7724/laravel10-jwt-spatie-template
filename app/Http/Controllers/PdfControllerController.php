<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PdfControllerController extends Controller
{
    public function index()
    {
        $pdf = PDF::loadView('pdf');

        $pdf->download('archivo.pdf');
        return $pdf->download('archivo.pdf');
    }
}

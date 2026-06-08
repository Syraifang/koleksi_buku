<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function cetakSertifikat()
    {
        $pdf = Pdf::loadView('pdf.sertifikat')->setPaper('a4', 'landscape');
        return $pdf->download('Sertifikat_Fikkia_Unair.pdf');
    }

    public function cetakUndangan()
    {
        $pdf = Pdf::loadView('pdf.undangan')->setPaper('a4', 'portrait');
        return $pdf->download('Undangan_Vokasi_Unair.pdf');
    }
}
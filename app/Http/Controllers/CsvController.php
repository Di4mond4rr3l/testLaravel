<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class CsvController extends Controller
{
    /**
     * Download the pdf version of the users' csv
     */
    public function csvPDF() {
        $data = User::all();
        $pdf = Pdf::loadView('csv', ['data' => $data]);
        return $pdf->download('csv.pdf');
      }
}

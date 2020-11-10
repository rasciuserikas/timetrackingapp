<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller {
    public function reportExport(Request $request) {
        $file_type = $request->request->get('exportValue');

        $from_date=$request->from_date;
        $to_date = $request->to_date;

        if (empty($from_date) && empty($to_date)) {
            return redirect()->route('entries.index')
                ->with('error', "No date range we're selected");
        }

        if ($file_type == 'pdf') {
            return Excel::download(new ReportExport($from_date,$to_date), 'report.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
        } elseif ($file_type == 'csv') {
            return Excel::download(new ReportExport($from_date,$to_date), 'report.csv', \Maatwebsite\Excel\Excel::CSV);
        } else {
            return Excel::download(new ReportExport($from_date,$to_date), 'report.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }
    }
}


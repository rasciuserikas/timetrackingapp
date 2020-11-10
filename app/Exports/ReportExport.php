<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExport implements FromView {
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    protected $from_date;
    protected $to_date;

    function __construct($from_date, $to_date) {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function view(): View
    {
        $entries = DB::table('timeentries')->where('user_id', Auth::user()->id)
            ->whereBetween('date', [$this->from_date, $this->to_date])
            ->select('title', 'comment', 'date', 'timespent')
            ->orderBy('date')->get();

        return view('entries.table', [
            'entries' => $entries
        ]);
    }
}

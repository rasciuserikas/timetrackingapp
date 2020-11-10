<?php

namespace App\Exports;

use App\Models\TimeEntry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromQuery, WithHeadings
{
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

    public function query() {
        $data = DB::table('timeentries')
            ->where('user_id', Auth::user()->id)
            ->whereBetween('date', [$this->from_date, $this->to_date])
            ->select('title', 'comment', 'date', 'timespent')
            ->orderBy('date');

        return $data;
    }

    public function headings(): array {
        return [
            'Title',
            'Comment',
            'Date',
            'Time spent in minutes'
        ];
    }
}

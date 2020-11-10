<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TimeEntry extends Model
{
    use HasFactory;

    protected $table = 'timeentries';
    public $timestamps = true;

//
//    protected $attributes = [
//        'user_id' => Auth::user()->id,
//    ];

    protected $fillable = [
        'user_id',
        'title',
        'comment',
        'date',
        'timespent'
    ];
}

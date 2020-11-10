<?php

namespace App\Http\Controllers;

use App\Models\TimeEntry;
use http\Exception;
use \Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index() {
        $entries = TimeEntry::where('user_id', Auth::user()->id)->latest()->paginate(5);

        return view('entries.index', compact('entries'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create() {
        return view('entries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $rules = [
            'title' => 'required',
            'timespent' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return redirect()->route('entries.index')->with('error', 'Validation error.');
        } else {
            $data = $request->input();

            try {
                $timeentry = new TimeEntry;
                $timeentry->title = $data['title'];
                $timeentry->timespent = $data['timespent'];
                $timeentry->comment = $data['comment'];
                $timeentry->date = $data['date'];
                $timeentry->user_id = Auth::user()->id;
                $timeentry->save();

                return redirect()->route('entries.index')
                    ->with('success', 'Time entry created successfully.');

            } catch(Exception $e){
                return redirect()->route('entries.index')->with('error', 'Exception error.');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimeEntry  $timeEntry
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(TimeEntry $timeEntry) {
        if ($timeEntry->getAttribute('user_id') === Auth::user()->id) {
            return view('entries.show', compact('timeEntry'));
        } else {
            return redirect()->route('entries.index')
                ->with("error", "You don't have permission to access");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimeEntry  $timeEntry
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeEntry $timeEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TimeEntry  $timeEntry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimeEntry $timeEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeEntry  $timeEntry
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeEntry $timeEntry)
    {
        //
    }
}

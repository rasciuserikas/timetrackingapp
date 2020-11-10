@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif

        <div class="card w-100">
            <div class="card-header d-flex align-items-center">
                {{ __('Time entries') }}
                <div class="button-wrap ml-auto">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('entries.create') }}" class="btn btn-dark">{{ __('Add new') }}</a>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#export">{{ __('Export report') }}</button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <ul class="list-group mb-3">
                    @foreach ($entries as $entry)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('entries.show', $entry->id) }}">{{ $entry->title }}</a>
{{--                            {{ route('entries.show', ['id' => $entry->id]) }}--}}
                            <span class="badge badge-dark badge-pill">{{ $entry->timespent }} {{ __('min') }}</span>
                        </li>
                    @endforeach
                </ul>

                {!! $entries->links("pagination::bootstrap-4") !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="export" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Export a new report') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('entries.export') }}" method="GET">
                    @csrf
                    <div class="modal-body">
                        <div class="export-type mb-4">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="exportValue" id="inlineRadio1" value="csv" checked>
                                <label class="form-check-label" for="inlineRadio1">{{ __('CSV') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="exportValue" id="inlineRadio2" value="pdf">
                                <label class="form-check-label" for="inlineRadio2">{{ __('PDF') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="exportValue" id="inlineRadio3" value="excel">
                                <label class="form-check-label" for="inlineRadio3">{{ __('Excel') }}</label>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="date">{{ __('Date from') }}</label>
                            <input type="date" name="from_date" min="1000-01-01" max="{{ date('Y-m-d') }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="date">{{ __('Date to') }}</label>
                            <input type="date" name="to_date" min="1000-01-01" max="{{ date('Y-m-d') }}" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Export') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card w-100">
            <div class="card-header d-flex align-items-center">
                {{ $timeEntry->title }}

                <div class="summary d-flex ml-auto align-items-center">
                    <div class="date">
                        {{ $timeEntry->date }}
                    </div>
                    <span class="ml-3 badge badge-dark badge-pill">{{ $timeEntry->timespent }} min</span>
                </div>
            </div>

            <div class="card-body">
                <p>{{ $timeEntry->comment }}</p>
            </div>
        </div>
    </div>
@endsection

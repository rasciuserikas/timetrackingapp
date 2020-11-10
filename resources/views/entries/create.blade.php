@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card w-100">
            <div class="card-header d-flex align-items-center">
                {{ __('Create a new time entry') }}
            </div>

            <div class="card-body">
                <form action="{{ route('entries.store') }}" method="GET">
                    @csrf
{{--                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">--}}

                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea class="form-control" name="comment"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" name="date" min="1000-01-01" max="{{ date('Y-m-d') }}" class="form-control" id="date">
                    </div>
                    <div class="form-group">
                        <label for="timespent">Time spent</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="timespent">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">minutes</span>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

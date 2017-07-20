
@extends('core.layout.index')

@section('partials')

@if (Session::has('info'))
@include('core.partials.info')
@endif

@if (Session::has('success'))
@include('core.partials.success')
@endif

@if (Session::has('error'))
@include('core.partials.error')
@endif

@if (Session::has('errors'))
@include('core.partials.errors')
@endif

@endsection

@section('body')
    <div class="padded-full">
        <ul class="list">
            <li><strong>Exam Name:</strong> {{ $exam->name }}</li>
            <li><strong>Subject:</strong> {{ $exam->subject->name }}</li>
            <li><strong>Subject:</strong> {{ $exam->teacher->name }}</li>
            <li><strong>Class:</strong> {{ $exam->stream->name }}</li>
            <li><strong>Period:</strong> {{ $exam->period }}, {{ $exam->year }}</li>
        </ul>
    </div>

    <div class="padded-full">
        <ul class="list">
            <li class="divider text-center"><p>All Grades</p></li>
        </ul>
    </div>
    @if($exam->status != 1)
        <form method="POST" action="{{ url('submit-grades', $exam->id) }}">
            {{ csrf_field() }}
            @foreach($grades as $key => $grade)
                <div class="padded-full">
                    <h5>{{$grade->student->name}}</h5>
                </div>
                <div class="padded-full">
                    <input type="text" name="grades[]" value="{{ old('grades[]') }}" autocomplete="off" placeholder="Enter marks here..." autofocus>
                </div>
            @endforeach
            <div class="padded-full">
                <button type="submit" class="btn fit-parent primary">Submit Marks</button>
            </div>
        </form>
    @else
        <div class="padded-full">
            <ul class="list">
                @foreach($grades as $key => $grade)
                    <li>
                        <strong>{{++$key}}) {{ $grade->student->name }}:</strong> {{ $grade->grade }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="padded-full">
        <a href="{{ url('teacher-exams') }}">
            <button class="btn fit-parent">Go Back</button>
        </a>
    </div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
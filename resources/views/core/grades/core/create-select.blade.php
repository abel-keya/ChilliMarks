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
        <li><strong>Assessment:</strong> {{ $assessment->exam->name}}, {{ $assessment->name }}</li>
        <li><strong>Subject:</strong> {{ $assessment->exam->subject->name }}</li>
        <li><strong>Teacher:</strong> {{ $assessment->exam->teacher->name }}</li>
        <li><strong>Period:</strong> {{ $assessment->exam->period }}, {{ $assessment->exam->year }}</li>
    </ul>
</div>
@if($students->count()>0)
<div class="padded-full">
    <ul class="list">
        <li class="divider text-center"><p>{{ $assessment->exam->stream->name }} Students</p></li>
    </ul>
</div>
<form method="POST" action="{{ url('create-select-grades', $assessment->id) }}">
    {{ csrf_field() }}
    <div class="padded-full">
        <ul class="list">
            @foreach($students as $student)
                <li class="padded-for-list">
                    <label class="checkbox">
                        <input type="checkbox" name="students[]" value="{{ $student->id }}">
                        {{ $student->name }} (Adm. No: {{ $student->admission->adm_no }})
                        <span></span>
                    </label>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="padded-full">
        <button type="submit" class="btn fit-parent primary">Create Grades</button>
    </div>
</form>
@else 
    <div class="padded-full">
        <p class="text-center">All students in the <strong>Stream {{ $assessment->exam->stream->name }}</strong> have grade records for this assessment.</p>
    </div>
@endif
<div class="padded-full">
    <a href="{{ url('view-assessment', $assessment->id) }}">
        <button class="btn fit-parent" style="margin-top: 10px;">Go Back</button>
    </a>
</div>

@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
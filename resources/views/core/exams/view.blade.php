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
        <li><strong>Subject:</strong> {{ $exam->subject }}</li>
        <li><strong>Teacher:</strong> {{ $exam->teacher->name }}</li>
        <li><strong>Class:</strong> {{ $exam->class }}</li>
        <li><strong>Period:</strong> {{ $exam->period }}</li>
        <li><strong>Year:</strong> {{ $exam->year }}</li>
    </ul>
</div>
<div class="padded-full">
    <a href="{{ url('edit-exam', $exam->id) }}">
        <button class="btn fit-parent primary">Edit Exam</button>
    </a>
</div>
<div class="padded-full">
    <a href="{{ url('confirm-exam', $exam->id) }}">
        <button class="btn fit-parent negative">Delete Exam</button>
    </a>
</div>
<div class="padded-full">
    <a href="{{ url('exams') }}">
        <button class="btn fit-parent">Go Back</button>
    </a>
</div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection

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
	        <li><strong>Teacher:</strong> {{ $exam->teacher->name }}</li>
	        <li><strong>Class:</strong> {{ $exam->stream->name }}</li>
	        <li><strong>Period:</strong> {{ $exam->period }}</li>
	        <li><strong>Year:</strong> {{ $exam->year }}</li>
	    </ul>
	</div>
	<div class="padded-full">
		<ul class="list" style="padding: 20px 0px 20px 0px;">
			<li class="divider text-center"><p>All Grades</p></li>
		</ul>
	</div>
    <div class="padded-full">
        <ul class="list">
        	@foreach($grades as $key => $grade)
            	<li>{{++$key}}) {{ $grade->student->name }}: @if($grade->status==0) <span style="color:green;">Pending</span> @else {{ $grade->grade }} @endif</li>
            @endforeach
        </ul>
    </div>
    <div class="padded-full">
    	<a href="{{ url('view-exam', $exam->id) }}">
    		<button class="btn fit-parent">Go Back</button>
    	</a>
    </div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
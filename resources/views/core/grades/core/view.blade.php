
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
	        <li><strong>Assessment:</strong> {{ $assessment->name }}, {{ $assessment->exam->name}}</li>
	        <li><strong>Subject:</strong> {{ $assessment->exam->subject->name }}</li>
	        <li><strong>Teacher:</strong> {{ $assessment->exam->teacher->name }}</li>
	        <li><strong>Period:</strong> {{ $assessment->exam->period }}, {{ $assessment->exam->year }}</li>
	        <li><strong>Out of:</strong> {{ $assessment->out_of }} marks</li>
	        <li><strong>Contribution:</strong> {{ $assessment->contribution }} %</li>
	    </ul>
	</div>
	@if($grades->count()>0)
		<div class="padded-full">
			<ul class="list">
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
	@endif
    <div class="padded-full">
    	<a href="{{ url('view-assessment', $assessment->id) }}">
    		<button class="btn fit-parent primary">Go Back</button>
    	</a>
    </div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
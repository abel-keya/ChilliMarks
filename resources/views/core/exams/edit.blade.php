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
<form method="POST" action="{{ url('update-exam', $exam->id) }}">
	{{ csrf_field() }}
	<div class="padded-full">
		<h5 class="pull-right">Exam</h5>
	</div>
	<div class="padded-full">
		<select name="name">
			<option disabled>Select an Exam</option>
		    <option value='Opening Term' @if($exam->name=='Opening Term') selected @endif>Opening Term</option>
		   	<option value='Mid Term' @if($exam->name=='Mid Term') selected @endif>Mid Term</option>
		   	<option value='End Term' @if($exam->name=='End Term') selected @endif>End Term</option>
		</select>
	</div>
	<div class="padded-full">
		<h5 class="pull-right">Subject</h5>
	</div>
	<div class="padded-full">
		<select name="subject_id">
			<option disabled>Select a Subject</option>
			@foreach($subjects as $subject)
		    	<option value='{{ $subject->id }}' 
		    		@if($subject->id==$exam->subject->id) selected @endif>
		    		{{$subject->name}}
		    	</option>
		    @endforeach
		</select>
	</div>
	<div class="padded-full">
		<h5 class="pull-right">Teacher</h5>
	</div>
	<div class="padded-full">
		<select name="teacher_id">
			<option disabled>Select a Teacher</option>
		    @foreach($teachers as $teacher)
		    	<option value='{{ $teacher->id }}' 
		    		@if($teacher->id==$exam->teacher->id) selected @endif>
		    		{{$teacher->name}}
		    	</option>
		    @endforeach
		</select>
	</div>
	<div class="padded-full">
		<h5 class="pull-right">Class</h5>
	</div>
	<div class="padded-full">
		<select name="stream_id">
			<option disabled>Select a Stream</option>
		    @foreach($streams as $stream)
		    	<option value='{{ $stream->id }}'>{{ $stream->name }}</option>
		    	<option value='{{ $stream->id }}' 
		    		@if($stream->id==$exam->stream->id) selected @endif>
		    		{{$stream->name}}
		    	</option>
		    @endforeach
		</select>
	</div>
	<div class="padded-full">
		<h5 class="pull-right">Term</h5>
	</div>
	<div class="padded-full">
		<select name="period">
			<option disabled>Select a Term</option>
		    <option value='Term 1' @if($exam->term=='Term 1') selected @endif>Term 1</option>
		   	<option value='Term 2' @if($exam->term=='Term 2') selected @endif>Term 2</option>
		   	<option value='Term 3' @if($exam->term=='Term 3') selected @endif>Term 3</option>
		</select>
	</div>
	<div class="padded-full">
		<h5 class="pull-right">Year</h5>
	</div>
	<div class="padded-full">
		<select name="year">
			<option disabled>Select a Year</option>
			@for($i=0; $i<=80; $i++) 
		   		<option value='{{1970 + $i}}' @if( (1970 + $i)== date('Y') ) selected @endif>{{1970 + $i}}</option>
		   	@endfor
		</select>
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Save Exam</button>
	</div>
</form>
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
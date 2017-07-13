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
<form method="POST" action="{{ url('create-exam') }}">
	{{ csrf_field() }}
	<div class="padded-full">
		<h5 class="pull-right">Exam</h5>
	</div>
	<div class="padded-full">
		<div class="padded-full">
		<select name="name">
			<option disabled selected>Select an Exam</option>
		    <option value='1'>Opening Term</option>
		   	<option value='2'>Mid Term</option>
		   	<option value='3'>End Term</option>
		</select>
	</div>
	</div>
	<div class="padded-full">
		<h5 class="pull-right">Subject</h5>
	</div>
	<div class="padded-full">
		<select name="subject_id">
			<option disabled selected>Select a Subject</option>
			@foreach($subjects as $subject)
		    	<option value='{{ $subject->id }}'>{{$subject->name}}</option>
		    @endforeach
		</select>
	</div>
	<div class="padded-full">
		<h5 class="pull-right">Teacher</h5>
	</div>
	<div class="padded-full">
		<select name="teacher_id">
			<option disabled selected>Select a Teacher</option>
		    @foreach($teachers as $teacher)
		    	<option value='{{ $teacher->id }}'>{{ $teacher->name }}</option>
		    @endforeach
		</select>
	</div>
	<div class="padded-full">
		<h5 class="pull-right">Class</h5>
	</div>
	<div class="padded-full">
		<select name="class_id">
			<option disabled selected>Select a Class</option>
		    @foreach($classes as $class)
		    	<option value='{{ $class->id }}'>{{ $class->name }}</option>
		    @endforeach
		</select>
	</div>
	<div class="padded-full">
		<h5 class="pull-right">Term</h5>
	</div>
	<div class="padded-full">
		<select name="period">
			<option disabled selected>Select a Term</option>
		    <option value='1'>Term 1</option>
		   	<option value='2'>Term 2</option>
		   	<option value='3'>Term 3</option>
		</select>
	</div>
	<div class="padded-full">
		<h5 class="pull-right">Year</h5>
	</div>
	<div class="padded-full">
		<select name="year">
			<option disabled selected>Select a Year</option> 
		   	<option value='2017'>2017</option>
		   	<option value='2018'>2018</option>
		   	<option value='2019'>2019</option>
		   	<option value='2020'>2020</option>
		   	<option value='2021'>2021</option>
		</select>
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Create Exam</button>
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
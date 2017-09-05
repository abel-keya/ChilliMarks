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
<form method="POST" action="{{ url('create-all-exams') }}">
	{{ csrf_field() }}
	<div class="padded-full">
	    <h5 class="pull-right">Exam Name</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="exam_name" value="{{ old('exam_name') }}" autocomplete="off" placeholder="Enter Exam Name" autofocus>
	</div>
	<div class="padded-full">
		<select name="period">
			<option disabled selected>Select a Term</option>
		    <option value='Term 1'>Term 1</option>
		   	<option value='Term 2'>Term 2</option>
		   	<option value='Term 3'>Term 3</option>
		</select>
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
		<button type="submit" class="btn fit-parent primary">Create Exams</button>
		<a href="{{ url('exams') }}">
			<button class="btn fit-parent" style="margin-top: 10px;">Go Back</button>
		</a>
	</div>
</form>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
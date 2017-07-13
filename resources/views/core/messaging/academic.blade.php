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
<form method="POST" action="{{ url('send-messages') }}">
	{{ csrf_field() }}
	<div class="padded-full">
		<h5 class="pull-right">Choose Class</h5>
	</div>
	<div class="padded-full">
		<select name="class_id">
			<option disabled selected>Select a Class</option>
			@foreach($classes as $class)
		    	<option value='{{ $class->id }}'>{{$class->name}} {{$class->year}}</option>
		    @endforeach
		</select>
	</div>
	<div class="padded-full">
		<select name="term">
			<option disabled selected>Select a Term</option>
		    <option value='1'>Term 1</option>
		</select>
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Send Academic SMS</button>
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
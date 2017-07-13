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
<form method="POST" action="{{ url('update-class') }}">
	{{ csrf_field() }}
	<div class="padded-full">
	    <h5 class="pull-right">Class Name</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="name" value="{{ $class->name }}" autocomplete="off" placeholder="Enter Class Name" autofocus>
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
		<button type="submit" class="btn fit-parent primary">Save Edit</button>
	</div>
</form>
<div class="padded-full">
	<a href="{{ url('classes') }}">
		<button class="btn fit-parent">Go Back</button>
	</a>
</div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
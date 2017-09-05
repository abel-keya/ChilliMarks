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
<form method="POST" action="{{ url('create-classification') }}">
	{{ csrf_field() }}
	<div class="padded-full">
		<h5 class="pull-right">Grade</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="grade" value="{{ old('grade') }}" autocomplete="off" placeholder="Enter Grade" autofocus>
	</div>
	<div class="padded-full">
		<h5 class="pull-right">Start Marks</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="start" value="{{ old('start') }}" autocomplete="off" placeholder="Enter Start Marks">
	</div>
	<div class="padded-full">
		<h5 class="pull-right">End Marks</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="end" value="{{ old('end') }}" autocomplete="off" placeholder="Enter End Marks">
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Create Classification</button>
	</div>
</form>
<div class="padded-full">
	<a href="{{ url('students') }}">
		<button class="btn fit-parent">Go Back</button>
	</a>
</div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
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
	<form method="POST" action="{{ url('edit-school') }}">
		{{ csrf_field() }}
		<div class="padded-full">
			<input type="text" name="name" value="{{ $school->name }}" placeholder="School Name" autofocus>
		</div>
		<div class="padded-full">
			<input type="text" name="address" value="{{ $school->address }}" placeholder="Address">
		</div>
		<div class="padded-full">
			<input type="text" name="phone" value="{{ $school->phone }}" placeholder="Phone">
		</div>
		<div class="padded-full">
			<button type="submit" class="btn fit-parent primary">Save Changes</button>
		</div>
	</form>
	<div class="padded-full">
	    <a href="{{ url('settings') }}"><button class="btn fit-parent">Go Back</button></a>
    </div>
@endsection

@section('partials-script')
	@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
		@include('core.partials.notify-script')
	@endif
@endsection
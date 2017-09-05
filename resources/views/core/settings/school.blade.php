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
		@if($school)
			<input type="hidden" name="school_id" value="{{$school->id}}" />
		@endif
		<div class="padded-full">
		    <h5 class="pull-right">School Name</h5>
		</div>
		<div class="padded-full">
			<input type="text" name="name" @if($school) value="{{ $school->name }}" @endif placeholder="School Name" autofocus>
		</div>
		<div class="padded-full">
		    <h5 class="pull-right">Address</h5>
		</div>
		<div class="padded-full">
			<input type="text" name="address" @if($school) value="{{ $school->address }}" @endif placeholder="Address">
		</div>
		<div class="padded-full">
		    <h5 class="pull-right">Phone</h5>
		</div>
		<div class="padded-full">
			<input type="text" name="phone" @if($school) value="{{ $school->phone }}" @endif placeholder="Phone">
		</div>
		<div class="padded-full">
		    <h5 class="pull-right">School Type</h5>
		</div>
		<div class="padded-full">
			<select name="school_type">
				<option disabled>Select a School Type</option>
			    <option value='kenyan_primary' @if($school->school_type=='kenyan_primary') selected @endif>Kenyan Primary</option>
			    <!-- <option value='kenyan_secondary' {{-- @if($school->school_type=='kenyan_secondary') selected @endif --}}>Kenyan Secondary</option>
			    <option value='kenyan_university' {{--@if($school->school_type=='kenyan_university') selected @endif --}}>Kenyan University</option> -->
			</select>
		</div>
		<div class="padded-full">
			<button type="submit" class="btn fit-parent primary">Save Settings</button>
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
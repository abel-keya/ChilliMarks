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
<form method="POST" action="{{ url('create-subject') }}">
	{{ csrf_field() }}
	<div class="padded-full">
	    <h5 class="pull-right">Subject Name</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="name" value="{{ old('name') }}" autocomplete="off" placeholder="Enter Subject Name" autofocus>
	</div>
	<div class="padded-full">
	    <h5 class="pull-right">Subject Abbreviation</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="abbr" value="{{ old('abbr') }}" autocomplete="off" placeholder="Enter Subject Abbreviation">
	</div>
	<div class="padded-full">
	    <h5 class="pull-right">Subject Code</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="code" value="{{ old('code') }}" autocomplete="off" placeholder="Enter Subject Code">
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Create Subject</button>
	</div>
</form>
<div class="padded-full">
	<a href="{{ url('subjects') }}">
		<button class="btn fit-parent">Go Back</button>
	</a>
</div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
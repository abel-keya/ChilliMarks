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
<form method="POST" action="{{ url('create-stream', $id) }}">
	{{ csrf_field() }}
	<div class="padded-full">
	    <h5 class="pull-right">Stream Name</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="name" value="{{ old('name') }}" autocomplete="off" placeholder="Enter Stream Name" autofocus>
	</div>
	<div class="padded-full">
	    <h5 class="pull-right">Stream Abbreviation</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="abbr" value="{{ old('abbr') }}" autocomplete="off" placeholder="Enter Stream Abbreviation" autofocus>
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Create Stream</button>
	</div>
</form>
<div class="padded-full">
	<a href="{{ url('view-class', $id) }}">
		<button class="btn fit-parent">Go Back</button>
	</a>
</div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
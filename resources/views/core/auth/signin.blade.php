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
	<form method="POST" action="{{ url('signin') }}">
		{{ csrf_field() }}
		<div class="padded-full">
		    <h5>Sign In below:</h5>
		</div>
		<div class="padded-full">
			<input type="text" name="phone" placeholder="Enter Phone No." autofocus>
		</div>
		<div class="padded-full">
			<input type="password" name="password" placeholder="Enter Password">
		</div>
		<div class="padded-full">
			<button type="submit" class="btn fit-parent primary">Sign In</button>
		</div>
	</form>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
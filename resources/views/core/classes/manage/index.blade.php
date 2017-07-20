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
	<div class="padded-full">
		<a href="{{ url('classes') }}">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">Classes & Streams</button>
	    </a>
	    <a href="{{ url('manage-streams') }}">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">Manage Streams</button>
	    </a>
	    <a href="{{ url('settings') }}">
			<button class="btn fit-parent" style="margin-top: 10px;">Go Back</button>
		</a>
	</div>
@endsection

@section('partials-script')
	@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
		@include('core.partials.notify-script')
	@endif
@endsection
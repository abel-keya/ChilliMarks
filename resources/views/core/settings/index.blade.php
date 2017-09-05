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
		<a href="{{ url('school') }}">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">School Settings</button>
	    </a>
	    <a href="{{ url('classes-settings') }}">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">Classes Settings</button>
	    </a>
	    <a href="{{ url('groups-settings') }}">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">Groups Settings</button>
	    </a>
	    <a href="{{ url('subjects') }}">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">Subject Settings</button>
	    </a>
	    @if($school->school_type=='kenyan_secondary')
		    <a href="{{ url('classifications') }}">
		        <button class="btn fit-parent primary" style="margin-top: 10px;">Classifications</button>
		    </a>
	    @endif
	    <a href="{{ url('backup-settings') }}">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">Backup Settings</button>
	    </a>
	    <a href="{{ url('about') }}">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">About ChilliMarks</button>
	    </a>
	</div>
@endsection

@section('partials-script')
	@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
		@include('core.partials.notify-script')
	@endif
@endsection
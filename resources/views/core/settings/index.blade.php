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
	        <button class="btn fit-parent primary" style="margin-top: 10px;">School settings</button>
	    </a>
	    <a href="{{ url('classes-settings') }}">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">Classes settings</button>
	    </a>
	    <a href="{{ url('about') }}">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">About ChilliApp</button>
	    </a>
	</div>
@endsection

@section('partials-script')
	@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
		@include('core.partials.notify-script')
	@endif
@endsection
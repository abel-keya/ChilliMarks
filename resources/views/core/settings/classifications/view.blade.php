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
		<ul class="list">
			<li><strong>Grade:</strong> {{ $classification->grade }}</li>
			<li><strong>Start:</strong> {{ $classification->start }}</li>
			<li><strong>End:</strong> {{ $classification->end }}</li>
		</ul>
	</div>
	<div class="padded-full">
		<a href="{{ url('edit-classification', $classification->id) }}">
			<button class="btn fit-parent primary" style="margin-top: 10px;">Edit Classification</button>
		</a>
		<a href="{{ url('confirm-classification', $classification->id) }}">
			<button class="btn fit-parent negative" style="margin-top: 10px;">Delete Classification</button>
		</a>
		<a href="{{ url('classifications') }}">
			<button class="btn fit-parent" style="margin-top: 10px;">Go Back</button>
		</a>
	</div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
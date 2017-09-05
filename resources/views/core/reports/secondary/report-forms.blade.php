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
<form method="POST" action="{{ url('secondary-report-form') }}">
	{{ csrf_field() }}
	<div class="padded-full">
		<select name="classesreport_id">
			<option disabled selected>Select a Report</option>
			@foreach($classesreports as $classesreport)
		    	<option value='{{ $classesreport->id }}'>Opening Term</option>
		    @endforeach
		</select>
	</div>
	<div class="padded-full">
		<select name="stream_id">
			<option disabled selected>Select a Stream</option>
		    @foreach($streams as $stream)
		    	<option value='{{ $stream->id }}'>{{ $stream->name }}</option>
		    @endforeach
		</select>
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Download Report</button>
	</div>
</form>
	<div class="padded-full">
		<a href="{{ url('reports') }}">
			<button class="btn fit-parent" style="margin-top: 10px;">Go Back</button>
		</a>
	</div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
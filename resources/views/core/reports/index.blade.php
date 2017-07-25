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
			<li><a href="{{ url('report-forms') }}">Report Forms</a></li>
			<li><a href="{{ url('stream-reports') }}">Stream Reports</a></li>
			<li><a href="{{ url('overall-class-reports') }}">Overall Class Reports</a></li>
			<li><a href="{{ url('group-reports') }}">Group Reports</a></li>
		</ul>
	</div>
@endsection

@section('partials-script')
	@if (Session::has('success'))
		@include('core.partials.notify-script')
	@endif
@endsection
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
			@if($school->school_type=='kenyan_primary')
				<li><a href="{{ url('stream-reports') }}">Stream Reports</a></li>
				<li><a href="{{ url('class-reports') }}">Class Reports</a></li>
				<li><a href="{{ url('report-forms') }}">Report Forms</a></li>
			@elseif($school->school_type=='kenyan_secondary')
				<li><a href="">Term Stream Reports</a></li>
				<li><a href="">Term Class Reports</a></li>
				<li><a href="">Exam Stream Reports</a></li>
				<li><a href="">Exam Class Reports</a></li>
				<li><a href="{{ url('secondary-report-forms') }}">Report Forms</a></li>
				<li><a href="">Overall Subject Analysis</a></li>
				<li><a href="">All Classes Analysis Term</a></li>
				<li><a href="">Stream Report Results</a></li>
				<li><a href="">Class Grade per subject distribution</a></li>
				<li><a href=""></a>Exam Grade Analysis</li>
				<li><a href="">All Subject Grade Analysis</a></li>
				<li><a href="{{ url('group-reports') }}">Group Reports</a></li>
			@endif
		</ul>
	</div>
@endsection

@section('partials-script')
	@if (Session::has('success'))
		@include('core.partials.notify-script')
	@endif
@endsection
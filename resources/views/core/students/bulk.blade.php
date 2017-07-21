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
		<a href="{{ url('import-students') }}">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">Import Students</button>
	    </a>
	    <a href="{{ url('student-bulk-delete') }}">
	        <button class="btn fit-parent primary" style="margin-top: 10px;">Delete many students</button>
	    </a>
	    <a href="{{ url('students') }}">
			<button class="btn fit-parent" style="margin-top: 10px;">Go Back</button>
		</a>
	</div>
@endsection

@section('partials-script')
	@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
		@include('core.partials.notify-script')
	@endif
@endsection
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
		<div class="padded-full text-justify">
				<p>Kindly, select a file from below: </p>
				<p>We recommend you upload students only belonging to one stream. Then assign a stream, thereafter upload the other classes. However, kindly first download the tempate and fill from student records from row 2.</p> 
				<p>Note that <strong>students with any missing records won't be imported</strong> and all validation rules will also apply.</p>
				<p>Type allowed: .xls or xlsx. Max size: 2MB.</p>
		</div>
		<div class="padded-full">
			<a href="{{ url('import-student-template ') }}">
				<button type="submit" class="btn fit-parent">Download Template</button>
			</a>
		</div>
		<form method="POST" action="{{ url('import-students') }}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="padded-full">
				<input type="file" name="import">
			</div>
			<div class="padded-full">
				<button type="submit" class="btn fit-parent primary">Import Students</button>
			</div>
		</form>
	<div class="padded-full">
	    <a href="{{ url('students') }}"><button class="btn fit-parent">Go Back</button></a>
    </div>
@endsection

@section('partials-script')
	@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
		@include('core.partials.notify-script')
	@endif
@endsection
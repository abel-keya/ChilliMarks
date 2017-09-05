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
		<div class="padded-full text-center">
			<h5 style="padding-top: 25px;"><strong>ChilliMarks Version: {{\Tremby\LaravelGitVersion\GitVersionHelper::getVersion() }}:</strong></h5>
			<p>Copyright © {{ $year }}. Chilli Marks</p>
			<p>Website: <a href="http://www.chillimarks.io" target="_blank">www.chillimarks.com</a></p>
			<p>ChilliMarks is released under the ChilliMarks license which can be found <a href="{{ url('license') }}">here</a>.</p>
		</div>
	</div>
@endsection

@section('partials-script')
	@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
		@include('core.partials.notify-script')
	@endif
@endsection
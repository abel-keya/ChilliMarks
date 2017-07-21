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
<form method="POST" action="{{ url('student-bulk-delete') }}">
	{{ csrf_field() }}
	<div class="padded-full">
	    <p class="text-center">Delete Bulk Students</p>
	</div>
	<div class="padded-full">
		<ul class="list">
			<li class="padded-for-list">
				<label class="radio">
					<input type="radio" name="bulk" value="streams" @if(old('bulk') == "streams") checked @endif>
						Students not assigned streams
					<span></span>
				</label>
			</li>
			<li class="padded-for-list">
				<label class="radio">
					<input type="radio" name="bulk" value="groups" @if(old('bulk') == "groups") checked @endif>
						Students not assigned groups
					<span></span>
				</label>
			</li>
		</ul>
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Delete</button>
	</div>
</form>
<div class="padded-full">
	<a href="{{ url('student-bulk-actions') }}">
		<button class="btn fit-parent">Go Back</button>
	</a>
</div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
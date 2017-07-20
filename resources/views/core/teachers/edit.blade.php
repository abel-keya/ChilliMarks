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
<form method="POST" action="{{ url('update-teacher', $teacher->id) }}">
	{{ csrf_field() }}
	<div class="padded-full">
	    <h5 class="pull-right">Name</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="name" value="{{ $teacher->name }}" autocomplete="off" placeholder="Enter Teacher Name" autofocus>
	</div>
	<div class="padded-full">
	    <h5 class="pull-right">Phone</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="phone" value="{{ $teacher->phone }}" autocomplete="off" placeholder="Enter Phone No.">
	</div>
	<div class="padded-full">
		<h5 class="pull-right">Year</h5>
	</div>
	<div class="padded-full">
		<select name="year">
			<option disabled>Select a Year</option>
			@for ($y = 0; $y < count($years); $y++)
				<option value='{{ $years[$y] }}' @if($teacher_year==$years[$y]) selected @endif>{{$years[$y]}}</option>
			@endfor
		</select>
	</div>
	<div class="padded-full">
		<ul class="list">
			<li class="">
				<label class="checkbox">
				<input type="checkbox" name="oldpassword" value="1" checked>
					Check to use old password
					<span></span>
				</label>
			</li>
		</ul>
	</div>
	<div class="padded-full">
	    <h5 class="pull-right">Password</h5>
	</div>
	<div class="padded-full">
		<input type="password" name="password" autocomplete="off">
	</div>
	<div class="padded-full">
	    <h5 class="pull-right">Re-type Password</h5>
	</div>
	<div class="padded-full">
		<input type="password" name="password_confirm" autocomplete="off">
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Update Teacher</button>
	</div>
</form>
<div class="padded-full">
	<a href="{{ url('teachers') }}">
		<button class="btn fit-parent">Go Back</button>
	</a>
</div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
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
<form method="POST" action="{{ url('create-teacher') }}">
	{{ csrf_field() }}
	<div class="padded-full">
	    <h5 class="pull-right">Name</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="name" value="{{ old('name') }}" autocomplete="off" placeholder="Enter Teacher Name" autofocus>
	</div>
	<div class="padded-full">
	    <h5 class="pull-right">Phone</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="phone" value="{{ old('phone') }}" autocomplete="off" placeholder="Enter Phone No.">
	</div>
	<div class="padded-full">
		<h5 class="pull-right">Year</h5>
	</div>
	<div class="padded-full">
		<select name="year">
			<option disabled>Select a Year</option>
			@for($i=0; $i<=80; $i++) 
		   		<option value='{{1970 + $i}}' @if( (1970 + $i)== date('Y') ) selected @endif>{{1970 + $i}}</option>
		   	@endfor
		</select>
	</div>
	<div class="padded-full">
		<ul class="list">
			<li class="">
				<label class="checkbox">
				<input type="checkbox" name="defaultpassword" value="1">
					Use default password: "password"
					<span></span>
				</label>
			</li>
		</ul>
	</div>
	<div class="padded-full">
	    <h5 class="pull-right">Password</h5>
	</div>
	<div class="padded-full">
		<input type="password" name="password" autocomplete="off" placeholder="Password">
	</div>
	<div class="padded-full">
	    <h5 class="pull-right">Re-type Password</h5>
	</div>
	<div class="padded-full">
		<input type="password" name="password_confirm" autocomplete="off" placeholder="Re-type Password">
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Create</button>
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
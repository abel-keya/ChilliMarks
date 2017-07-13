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
<form method="POST" action="{{ url('update-student', $student->id) }}">
	{{ csrf_field() }}
	<div class="padded-full">
	    <h5 class="pull-right">Admission No.</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="adm_no" value="{{ $student->adm_no }}" autocomplete="off" placeholder="Enter Student Adm. No." autofocus>
	</div>
	<div class="padded-full">
	    <h5 class="pull-right">Name</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="name" value="{{ $student->name }}" autocomplete="off" placeholder="Enter Student Name">
	</div>
	<div class="padded-full">
	    <h5 class="pull-right">Phone</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="phone" value="{{ $student->phone }}" autocomplete="off" placeholder="Enter Phone No.">
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
		<button type="submit" class="btn fit-parent primary">Edit Student</button>
	</div>
</form>
<div class="padded-full">
	<a href="{{ url('students') }}">
		<button class="btn fit-parent">Go Back</button>
	</a>
</div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
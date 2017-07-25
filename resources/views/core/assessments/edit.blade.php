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
<form method="POST" action="{{ url('update-assessment', $assessment->id) }}">
	{{ csrf_field() }}
	<div class="padded-full">
		<h5 class="pull-right">Assessment Name</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="assessment_name" value="{{ $assessment->name }}" autocomplete="off" placeholder="Enter Assessment Name" autofocus>
	</div>
	<div class="padded-full">
		<h5 class="pull-right">Out of Marks</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="out_of" value="{{ $assessment->out_of }}" autocomplete="off" placeholder="Enter Out of Marks">
	</div>
	<div class="padded-full">
		<h5 class="pull-right">Contribution (%) of Total</h5>
	</div>
	<div class="padded-full">
		<input type="text" name="contribution" value="{{ $assessment->contribution }}" autocomplete="off" placeholder="Enter Contribution Marks">
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Update Assessment</button>
	</div>
</form>
<div class="padded-full">
	<a href="{{ url('view-exam', $assessment->id) }}">
		<button class="btn fit-parent">Go Back</button>
	</a>
</div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
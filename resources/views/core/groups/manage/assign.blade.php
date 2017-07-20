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
<form method="POST" action="{{ url('assign-group', $id) }}">
	{{ csrf_field() }}
	<div class="padded-full">
	    <h5 class="pull-right">Select A Group</h5>
	</div>
	<div class="padded-full">
		<select name="group">
			<option disabled selected>Select a Group</option>
			@foreach($groups as $group)
				<option value="{{$group->id}}">{{ $group->name }}</option>
			@endforeach
		</select>
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Assign Group</button>
	</div>
</form>
<div class="padded-full">
	<a href="{{ url($back_url, $id) }}">
		<button class="btn fit-parent">Go Back</button>
	</a>
</div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
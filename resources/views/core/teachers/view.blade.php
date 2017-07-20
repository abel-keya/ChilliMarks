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
		<li><strong>Teacher Name:</strong> {{ $teacher->name }}</li>
		<li><strong>Phone:</strong> {{ $teacher->phone }}</li>
		<li><strong>Year:</strong> {{ $teacher->year }}</li>
		@if($teacher->streams->count()>0)
		<li>
			<strong>Streams:</strong> 
			@foreach($teacher->streams as $stream)
			{{$stream->name}}@if($teacher->streams->count()>1). @endif
			@endforeach 
		</li>
		@endif

		@if($teacher->groups->count()>0)
		<li>
			<strong>Groups:</strong> 
			@foreach($teacher->groups as $group)
			{{$group->name}}@if($teacher->groups->count()>1). @endif
			@endforeach 
		</li>
		@endif
	</ul>
</div>
<div class="padded-full">
	<a href="{{ url('edit-teacher', $teacher->id) }}">
		<button class="btn fit-parent primary">Edit Teacher</button>
	</a>
	<a href="{{ url('select-attach-group', $teacher->id) }}">
		<button class="btn fit-parent primary" style="margin-top: 10px;">Assign Group</button>
	</a>
	<a href="{{ url('select-detach-group', $teacher->id) }}">
		<button class="btn fit-parent primary" style="margin-top: 10px;">Detach Group</button>
	</a>
	<a href="{{ url('select-attach-stream', $teacher->id) }}">
		<button class="btn fit-parent primary" style="margin-top: 10px;">Assign Stream</button>
	</a>
	<a href="{{ url('select-detach-stream', $teacher->id) }}">
		<button class="btn fit-parent primary" style="margin-top: 10px;">Detach Stream</button>
	</a>
	<a href="{{ url('confirm-teacher', $teacher->id) }}">
		<button class="btn fit-parent negative" style="margin-top: 10px;">Delete Teacher</button>
	</a>
	<a href="{{ url('teachers') }}">
		<button class="btn fit-parent" style="margin-top: 10px;">Go Back</button>
	</a>
</div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
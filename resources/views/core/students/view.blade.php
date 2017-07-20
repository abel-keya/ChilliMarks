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
			<li><strong>Admission No:</strong> {{ $student->admission->adm_no }}</li>
			<li><strong>Student Name:</strong> {{ $student->name }}</li>
			<li><strong>Phone:</strong> {{ $student->phone }}</li>
			<li><strong>Year:</strong> {{ $student->year }}</li>
			@if($student->streams->count()>0)
			<li>
				<strong>Streams:</strong> 
				@foreach($student->streams as $stream)
                    {{$stream->name}}@if($student->streams->count()>1). @endif
                @endforeach 
			</li>
			@endif

			@if($student->groups->count()>0)
			<li>
				<strong>Groups:</strong> 
				@foreach($student->groups as $group)
                    {{$group->name}}@if($student->groups->count()>1). @endif
                @endforeach 
			</li>
			@endif
		</ul>
	</div>
	<div class="padded-full">
		<a href="{{ url('edit-student', $student->id) }}">
			<button class="btn fit-parent primary" style="margin-top: 10px;">Edit Student</button>
		</a>
		<a href="{{ url('select-attach-group', $student->id) }}">
			<button class="btn fit-parent primary" style="margin-top: 10px;">Assign Group</button>
		</a>
		<a href="{{ url('select-detach-group', $student->id) }}">
			<button class="btn fit-parent primary" style="margin-top: 10px;">Detach Group</button>
		</a>
		<a href="{{ url('select-attach-stream', $student->id) }}">
			<button class="btn fit-parent primary" style="margin-top: 10px;">Assign Stream</button>
		</a>
		<a href="{{ url('select-detach-stream', $student->id) }}">
			<button class="btn fit-parent primary" style="margin-top: 10px;">Detach Stream</button>
		</a>
		<a href="{{ url('confirm-student', $student->id) }}">
			<button class="btn fit-parent negative" style="margin-top: 10px;">Delete Student</button>
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
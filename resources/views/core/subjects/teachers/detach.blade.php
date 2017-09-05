@extends('core.layout.index')

@section('body')
    <div class="padded-full">
        <p class="text-center">Select a Subject to detach from the Teacher:</p>
    </div>
    <form method="POST" action="{{ url('detach-subject-teacher', $teacher->id) }}">
		{{ csrf_field() }}
		<div class="padded-full">
	        <select name="subject">
	            <option disabled>Select a Subject</option>
	            @foreach($teacher->subjects as $subject)
	                <option value='{{ $subject->id }}'>{{ $subject->name }}, {{ $subject->code }}</option>
	            @endforeach
	        </select>
	    </div>
	    <div class="padded-full">
	        <button type="submit" class="btn fit-parent negative">Yes, Detach Subject</button>
	    </div>
	</form>
	<div class="padded-full">
	    <a href="{{ url('view-teacher', $teacher->id) }}"><button class="btn fit-parent">No, Go Back</button></a>
    </div>
@endsection
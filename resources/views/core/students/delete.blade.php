@extends('core.layout.index')

@section('body')
    <div class="padded-full">
        <p class="text-center">Are you sure you want to delete this student <strong>{{ $student->name}}</strong>?</p>
    </div>
    <form method="POST" action="{{ url('delete-student', $student->id) }}">
		{{ csrf_field() }}
	    <div class="padded-full">
	        <button type="submit" class="btn fit-parent negative">Yes, Delete Student</button>
	    </div>
	</form>
	<div class="padded-full">
	    <a href="{{ url('students', $student->id) }}"><button class="btn fit-parent primary">No, Go Back</button></a>
    </div>
@endsection
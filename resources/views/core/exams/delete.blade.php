@extends('core.layout.index')

@section('body')
    <div class="padded-full">
        <p class="text-center">Are you sure you want to delete this exam <strong>{{ $exam->name}}</strong>?</p>
    </div>
    <form method="POST" action="{{ url('delete-exam', $exam->id) }}">
		{{ csrf_field() }}
	    <div class="padded-full">
	        <button type="submit" class="btn fit-parent negative">Yes, Delete Exam</button>
	    </div>
	</form>
	<div class="padded-full">
	    <a href="{{ url('exams', $exam->id) }}"><button class="btn fit-parent primary">No, Go Back</button></a>
    </div>
@endsection
@extends('core.layout.index')

@section('body')
    <div class="padded-full text-center">
        <p>
        	Are you sure you want to delete this assessment <strong>{{ $assessment->name}}</strong>?
        </p>
        <p>
        	<strong>Note:</strong> All associated grades will be deleted.
        </p>
    </div>
    <form method="POST" action="{{ url('delete-assessment', $assessment->id) }}">
		{{ csrf_field() }}
	    <div class="padded-full">
	        <button type="submit" class="btn fit-parent negative">Yes, Delete Assessment</button>
	    </div>
	</form>
	<div class="padded-full">
	    <a href="{{ url('view-exam', $assessment->exam->id) }}"><button class="btn fit-parent">No, Go Back</button></a>
    </div>
@endsection
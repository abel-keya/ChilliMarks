@extends('core.layout.index')

@section('body')
    <div class="padded-full">
        <p class="text-center">Are you sure you want to delete this class <strong>{{ $class->name}}</strong>?</p>
    </div>
    <form method="POST" action="{{ url('delete-class', $class->id) }}">
		{{ csrf_field() }}
	    <div class="padded-full">
	        <button type="submit" class="btn fit-parent negative">Yes, Delete Class</button>
	    </div>
	</form>
	<div class="padded-full">
	    <a href="{{ url('classses', $class->id) }}"><button class="btn fit-parent">No, Go Back</button></a>
    </div>
@endsection
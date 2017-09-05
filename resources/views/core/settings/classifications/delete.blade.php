@extends('core.layout.index')

@section('body')
    <div class="padded-full">
        <p class="text-center">Are you sure you want to delete this classification<br> <strong>{{ $classification->grade}}: {{ $classification->start}} - {{ $classification->end}}</strong>?</p>
    </div>
    <form method="POST" action="{{ url('delete-classification', $classification->id) }}">
		{{ csrf_field() }}
	    <div class="padded-full">
	        <button type="submit" class="btn fit-parent negative">Yes, Delete Classification</button>
	    </div>
	</form>
	<div class="padded-full">
	    <a href="{{ url('view-classification', $classification->id) }}"><button class="btn fit-parent primary">No, Go Back</button></a>
    </div>
@endsection
@extends('core.layout.index')

@section('body')
    <div class="padded-full">
        <p class="text-center">Are you sure you want to delete this stream <strong>{{ $stream->name}}</strong>?</p>
    </div>
    <form method="POST" action="{{ url('delete-stream', $stream->id) }}">
		{{ csrf_field() }}
	    <div class="padded-full">
	        <button type="submit" class="btn fit-parent negative">Yes, Delete Stream</button>
	    </div>
	</form>
	<div class="padded-full">
	    <a href="{{ url('view-stream', $stream->id) }}"><button class="btn fit-parent">No, Go Back</button></a>
    </div>
@endsection
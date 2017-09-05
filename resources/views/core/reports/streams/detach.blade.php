@extends('core.layout.index')

@section('body')
    <div class="padded-full">
        <p class="text-center">Are you sure you want to detach this stream report <strong>{{ $exam->name}}, {{ $exam->subject->name}}</strong>?</p>
    </div>
    <form method="POST" action="{{ url('detach-stream-report' . '/' . $sr_id . '/' . $id) }}">
		{{ csrf_field() }}
	    <div class="padded-full">
	        <button type="submit" class="btn fit-parent negative">Yes, Detach Stream</button>
	    </div>
	</form>
	<div class="padded-full">
	    <a href="{{ url('stream-reports') }}"><button class="btn fit-parent">No, Go Back</button></a>
    </div>
@endsection
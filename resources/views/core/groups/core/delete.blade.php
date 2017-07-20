@extends('core.layout.index')

@section('body')
    <div class="padded-full">
        <p class="text-center">Are you sure you want to delete this group: <strong>{{ $group->name}}</strong>?</p>
    </div>
    <form method="POST" action="{{ url('delete-group', $group->id) }}">
		{{ csrf_field() }}
	    <div class="padded-full">
	        <button type="submit" class="btn fit-parent negative">Yes, Delete Group</button>
	    </div>
	</form>
	<div class="padded-full">
	    <a href="{{ url('groups') }}"><button class="btn fit-parent">No, Go Back</button></a>
    </div>
@endsection
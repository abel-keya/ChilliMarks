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
            <li><strong>Group Name:</strong> {{ $group->name }}</li>
        </ul>
    </div>
    <div class="padded-full">
    	<a href="{{ url('edit-group', $group->id) }}">
    		<button class="btn fit-parent primary">Edit Group</button>
    	</a>
    </div>
    <div class="padded-full">
        <a href="{{ url('confirm-group', $group->id) }}">
            <button class="btn fit-parent negative">Delete Group</button>
        </a>
    </div>
    <div class="padded-full">
    	<a href="{{ url('groups') }}">
    		<button class="btn fit-parent">Go Back</button>
    	</a>
    </div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
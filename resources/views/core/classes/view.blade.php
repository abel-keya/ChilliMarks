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
            <li><strong>Class Name:</strong> {{ $class->name }}</li>
            <li><strong>Year:</strong> {{ $class->year }}</li>
        </ul>
    </div>
    <div class="padded-full">
    	<a href="{{ url('edit-class', $class->id) }}">
    		<button class="btn fit-parent primary">Edit Class</button>
    	</a>
    </div>
    <div class="padded-full">
        <a href="{{ url('confirm-class', $class->id) }}">
            <button class="btn fit-parent negative">Delete Class</button>
        </a>
    </div>
    <div class="padded-full">
    	<a href="{{ url('classes') }}">
    		<button class="btn fit-parent">Go Back</button>
    	</a>
    </div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
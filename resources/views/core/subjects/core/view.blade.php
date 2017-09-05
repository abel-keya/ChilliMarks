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
            <li><strong>Subject Name:</strong> {{ $subject->name }}</li>
            <li><strong>Subject Abbreviation:</strong> {{ $subject->abbr }}</li>
            <li><strong>Subject Code:</strong> {{ $subject->code }}</li>
        </ul>
    </div>
    <div class="padded-full">
    	<a href="{{ url('edit-subject', $subject->id) }}">
    		<button class="btn fit-parent primary" style="margin-top: 10px;">Edit Subject</button>
    	</a>
        <a href="{{ url('confirm-subject', $subject->id) }}">
            <button class="btn fit-parent negative" style="margin-top: 10px;">Delete Subject</button>
        </a>
        <a href="{{ url('subjects') }}">
            <button class="btn fit-parent" style="margin-top: 10px;">Go Back</button>
        </a>
    </div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
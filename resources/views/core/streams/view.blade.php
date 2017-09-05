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
            <li><strong>Stream Name:</strong> {{ $stream->name }}</li>
            <li><strong>Stream Abbreviation:</strong> {{ $stream->abbr }}</li>
        </ul>
    </div>
    <div class="padded-full">
    	<a href="{{ url('edit-stream', $stream->id) }}">
    		<button class="btn fit-parent primary" style="margin-top: 10px;">Edit Stream</button>
    	</a>
        <a href="{{ url('confirm-stream', $stream->id) }}">
            <button class="btn fit-parent negative" style="margin-top: 10px;">Delete Stream</button>
        </a>
        <a href="{{ url('view-class', $stream->classes->id) }}">
            <button class="btn fit-parent" style="margin-top: 10px;">Go Back</button>
        </a>
    </div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
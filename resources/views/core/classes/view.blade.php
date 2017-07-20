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
    @if($streams->count()>0)
    <div class="padded-full">
        <ul class="list" style="padding: 20px 0px 20px 0px;">
            <li class="divider text-center"><p>Streams</p></li>
        </ul>
    </div>
    @endif
    <div class="padded-full">
        <ul class="list">
            @foreach($streams as $stream)
                <li><a href="{{ url('view-stream', $stream->id) }}"><strong>Stream Name:</strong> {{ $stream->name }}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="padded-full">
        <a href="{{ url('create-stream', $class->id) }}">
            <button class="btn fit-parent primary">Add a Stream</button>
        </a>
        <a href="{{ url('edit-class', $class->id) }}">
            <button class="btn fit-parent primary" style="margin-top:10px;">Edit Class</button>
        </a>
        <a href="{{ url('confirm-class', $class->id) }}">
            <button class="btn fit-parent negative" style="margin-top:10px;">Delete Class</button>
        </a>
        <a href="{{ url('classes') }}">
            <button class="btn fit-parent" style="margin-top:10px;">Go Back</button>
        </a>
    </div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
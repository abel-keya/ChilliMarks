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
<form method="POST" action="{{ url('create-stream-report') }}">
    {{ csrf_field() }}
    <div class="padded-full">
        <h5 class="pull-right">Stream Report Name</h5>
    </div>
    <div class="padded-full">
        <input type="text" name="name" value="{{ old('name') }}" autocomplete="off" placeholder="Enter Stream Report Name" autofocus>
    </div>
    <div class="padded-full">
        <h5 class="text-center">Select Exams to be Considered:</h5>
    </div>
    <div class="padded-full">
        <ul class="list">
            @foreach($exams as $exam)
                <li class="padded-for-list">
                    <label class="checkbox">
                        <input type="checkbox" name="exams[]" value="{{ $exam->id }}">
                        {{ $exam->name }}, {{ $exam->subject->name }}, {{ $exam->stream->name }}, {{ $exam->period }}, {{ $exam->year }}
                        <span></span>
                    </label>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="padded-full">
        <button type="submit" class="btn fit-parent primary">Create Stream Report</button>
    </div>
</form>
<div class="padded-full">
    <a href="{{ url('stream-reports') }}">
        <button class="btn fit-parent" style="margin-top: 10px;">Go Back</button>
    </a>
</div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
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
<form method="POST" action="{{ url('update-grade', $grade->id) }}">
    {{ csrf_field() }}
    <div class="padded-full">
        <ul class="list">
            <li><strong>Name:</strong> {{ $grade->student->name }}, (Adm. No:{{ $grade->student->adm_no }})</li>
            <li><strong>Out of:</strong> {{ $grade->assessment->out_of }} marks</li>
        </ul>
    </div>
    <div class="padded-full">
        <h5 class="pull-right">marks</h5>
    </div>
    <div class="padded-full">
        <input type="text" name="marks" value="{{ $grade->marks}}" autocomplete="off" placeholder="Enter Marks" autofocus>
    </div>
    <div class="padded-full">
        <button type="submit" class="btn fit-parent primary">Update Grade</button>
    </div>
</form>
<div class="padded-full">
    <a href="{{ url('view-assessment', $grade->assessment->id) }}">
        <button class="btn fit-parent" style="margin-top: 10px;">Go Back</button>
    </a>
</div>

@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
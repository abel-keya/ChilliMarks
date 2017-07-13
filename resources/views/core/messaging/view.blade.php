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
        <li><strong>Message:</strong> {{ $message->name }}</li>
        <li><strong>Date:</strong> {{ $message->create_at }}</li>
        <li><strong>Status:</strong> {{ $message->status }}</li>
    </ul>
</div>
<div class="padded-full">
    <a href="{{ url('messages') }}">
        <button class="btn fit-parent primary">Go Back</button>
    </a>
</div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
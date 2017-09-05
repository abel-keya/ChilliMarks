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
            <li><strong>Stream Report:</strong> {{ $streamreport->name }}</li>
        </ul>
    </div>
    @if($streamreport->exams->count()>0)
    <div class="padded-full">
        <ul class="list">
            <li class="divider text-center"><p>Streams</p></li>
        </ul>
    </div>
    @endif
    <div class="padded-full">
        <ul class="list">
            @foreach($streamreport->exams as $exam)
                <li>
                    {{ $exam->name}}, {{ $exam->subject->name}}
                    <a href="{{ url('detach-stream-report'. '/'. $streamreport->id .'/' . $exam->id) }}" class="btn pull-right icon icon-close" style="margin:3px 3px 3px 3px;" title="Detach Stream Report"></a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="padded-full">
        <a href="{{ url('attach-stream-report', $streamreport) }}">
            <button class="btn fit-parent primary" style="margin-top:10px;">Attach to Stream Report</button>
        </a>
        <a href="{{ url('edit-stream-report', $streamreport->id) }}">
            <button class="btn fit-parent primary" style="margin-top:10px;">Edit Stream Report</button>
        </a>
        <a href="{{ url('confirm-stream-report', $streamreport->id) }}">
            <button class="btn fit-parent negative" style="margin-top:10px;">Delete Stream Report</button>
        </a>
        <a href="{{ url('stream-reports') }}">
            <button class="btn fit-parent" style="margin-top:10px;">Go Back</button>
        </a>
    </div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
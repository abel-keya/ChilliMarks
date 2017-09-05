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
            <li><strong>Class Report:</strong> {{ $classreport->name }} {{ $classreport->id }}</li>
        </ul>
    </div>
    @if($classreport->exams->count()>0)
    <div class="padded-full">
        <ul class="list">
            <li class="divider text-center"><p>Classes</p></li>
        </ul>
    </div>
    @endif
    <div class="padded-full">
        <ul class="list">
            @foreach($classreport->exams as $exam)
                <li>
                    {{ $exam->name}}, {{ $exam->subject->name}}
                    <a href="{{ url('detach-class-report'. '/'. $classreport->id .'/' . $exam->id) }}" class="btn pull-right icon icon-close" style="margin:3px 3px 3px 3px;" title="Detach Class Report"></a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="padded-full">
        <a href="{{ url('attach-class-report', $classreport) }}">
            <button class="btn fit-parent primary" style="margin-top:10px;">Attach to Class Report</button>
        </a>
        <a href="{{ url('edit-class-report', $classreport->id) }}">
            <button class="btn fit-parent primary" style="margin-top:10px;">Edit Class Report</button>
        </a>
        <a href="{{ url('confirm-class-report', $classreport->id) }}">
            <button class="btn fit-parent negative" style="margin-top:10px;">Delete Class Report</button>
        </a>
        <a href="{{ url('class-reports') }}">
            <button class="btn fit-parent" style="margin-top:10px;">Go Back</button>
        </a>
    </div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
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
        <li><strong>Assessment:</strong> {{ $assessment->exam->name}}, {{ $assessment->name }}</li>
        <li><strong>Subject:</strong> {{ $assessment->exam->subject->name }}</li>
        <li><strong>Teacher:</strong> {{ $assessment->teacher->name }}</li>
        <li><strong>Period:</strong> {{ $assessment->exam->period }}, {{ $assessment->exam->year }}</li>
        <li><strong>Out of:</strong> {{ $assessment->out_of }} marks</li>
        <li><strong>Contribution:</strong> {{ $assessment->contribution }} %</li>
    </ul>
</div>
@if($grades->count()>0)
<div class="padded-full">
    <ul class="list">
        <li class="divider text-center"><p>Assessment Grades</p></li>
    </ul>
</div>
<div class="padded-full">
    <ul class="list">
        @foreach($grades as $grade)
            <li>   
                <strong>{{ $grade->student->name }}</strong> (Adm. No. {{ $grade->student->admission->adm_no }}):
                    
                    @if($grade->status==0)
                        <span style="color:green;">Pending</span>
                    @else
                        {{ number_format((float)$grade->marks, 0, '.', '') }} marks
                    @endif
                    <a href="{{ url('confirm-grade', $grade->id) }}" class="btn pull-right icon icon-close" style="margin:3px 3px 3px 3px;" title="Delete Grade"></a>
                    <a href="{{ url('edit-grade', $grade->id) }}" class="btn pull-right icon icon-edit" style="margin:3px 3px 3px 3px;" title="Edit Grade"></a>
            </li>
        @endforeach
    </ul>
</div>
@endif
<div class="padded-full">
    <a href="{{ url('create-select-grades', $assessment->id) }}">
        <button class="btn fit-parent primary">Create Grade</button>
    </a>
    <a href="{{ url('edit-assessment', $assessment->id) }}">
        <button class="btn fit-parent primary" style="margin-top: 10px;">Edit Assessment</button>
    </a>
    <a href="{{ url('confirm-assessment', $assessment->id) }}">
        <button class="btn fit-parent negative" style="margin-top: 10px;">Delete Assessment</button>
    </a>
    <a href="{{ url('view-exam', $assessment->exam->id) }}">
        <button class="btn fit-parent" style="margin-top: 10px;">Go Back</button>
    </a>
</div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
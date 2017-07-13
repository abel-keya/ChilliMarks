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
<div class="content padded-full">
    <table class="table">
        <tr>
            <thead>
                <th>Features</th>
                <th>Standard</th>
                <th>Premium</th>
            </thead>
        </tr>
        <tbody>
            <tr>
                <td>Feature 1</td>
                <td>&#x2715;</td>
                <td>&#10003;</td>
            </tr>
            <tr>
                <td>Feature 2</td>
                <td>Limited</td>
                <td>Unlimited</td>
            </tr>
            <tr>
                <td>Feature 3</td>
                <td>&#x2715;</td>
                <td>&#10003;</td>
            </tr>
        </tbody>
    </table>
<div class="padded-full">
    <a href="{{ url('exams') }}">
        <button class="btn fit-parent">Go Back</button>
    </a>
</div>
@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
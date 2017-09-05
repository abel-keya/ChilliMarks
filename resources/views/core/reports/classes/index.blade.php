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
<form method="POST" action="{{ url('search-class-reports') }}">
	<div class="padded-full">
		{{ csrf_field() }}
		<input type="text" name="search" placeholder="Search Class Reports" autocomplete="off" autofocus/>
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Search</button>
	</div>
</form>
<div class="padded-full">
	<a href="{{ url('create-class-report') }}">
		<button class="btn fit-parent primary" style="margin-top: 10px;">New Class Report</button>
	</a>	
</div>
<div class="padded-full">
	<ul class="list">
		<li class="divider text-center"><p>All Class Reports</p></li>
	</ul>
</div>
<div class="padded-full">
	<ul class="list">
		@foreach($classreports as $classreport)
		<li class="padded-list">
			{{ $classreport->name }}
			<a href="{{ url('confirm-class-report', $classreport->id) }}" class="btn pull-right icon icon-close" style="margin:3px 3px 3px 3px;" title="Delete Class Report"></a>
            <a href="{{ url('edit-class-report', $classreport->id) }}" class="btn pull-right icon icon-edit" style="margin:3px 3px 3px 3px;" title="Edit Class Report"></a>
            <a href="{{ url('view-class-report', $classreport->id) }}" class="btn pull-right icon icon-more-horiz" style="margin:3px 3px 3px 3px;" title="View Class Report"></a>
            <a href="{{ url('download-class-report', $classreport->id) }}" class="btn pull-right icon icon-expand-more" style="margin:3px 3px 3px 3px;" title="Download Class Report"></a>
		</li>
		@endforeach
	</ul>
</div>

@endsection

@section('partials-script')
@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
@include('core.partials.notify-script')
@endif
@endsection
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
	<a href="{{ url('create-classification') }}">
		<button class="btn fit-parent primary">Create Classification</button>
	</a>
</div>
<div class="padded-full">
	<ul class="list">
		<li class="divider text-center"><p>All Classifications</p></li>
	</ul>
</div>
<div class="padded-full">
	<ul class="list">
		@foreach($classifications as $classification)
			<li href="{{ url('view-classification', $classification->id) }}">
				<strong>Grade {{ $classification->grade }} :</strong> 
				{{ $classification->start }}% - {{ $classification->end }}%

				<a href="{{ url('edit-classification', $classification->id) }}" class="btn pull-right icon icon-edit" style="margin:3px 3px 3px 3px;" title="Edit Classification"></a>

				<a href="{{ url('view-classification', $classification->id) }}" class="btn pull-right icon icon-more-horiz" style="margin:3px 3px 3px 3px;" title="View Classification"></a>
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
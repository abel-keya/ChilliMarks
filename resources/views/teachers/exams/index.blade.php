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
			@if(count($assessments)>0)
				@foreach($assessments->reverse() as $assessment)
					<li>
						<a href="{{ url('view-teacher-grades', $assessment->id) }}">{{ $assessment->name }}, {{ $assessment->exam->subject->name }} {{ $assessment->exam->stream->classes->name }} 
							@if($assessment->status==1) 
								<span style="color:green;"> (Submitted)</span> 
							@else 
								<span style="color:blue;"> (Pending)</span> 
							@endif
						</a>
					</li>
				@endforeach
			@else
				<li class="text-center">You don't have any assessments.</li>
			@endif
		</ul>
	</div>
@endsection

@section('partials-script')
	@if (Session::has('success'))
		@include('core.partials.notify-script')
	@endif
@endsection
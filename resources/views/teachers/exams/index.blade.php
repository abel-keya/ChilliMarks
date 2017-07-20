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
			@if(count($exams)>0)
				@foreach($exams->reverse() as $exam)
					<li>
						<a href="{{ url('view-teacher-grades', $exam->id) }}">{{ $exam->subject->name }} {{ $exam->stream->classes->name }} 
							@if($exam->status==1) 
								<span style="color:green;"> &#10003; submitted</span> 
							@else 
								<span style="color:blue;">&#x2715; pending</span> 
							@endif
						</a>
					</li>
				@endforeach
			@else
				<li class="text-center">You don't have any exams.</li>
			@endif
		</ul>
	</div>
@endsection

@section('partials-script')
	@if (Session::has('success'))
		@include('core.partials.notify-script')
	@endif
@endsection
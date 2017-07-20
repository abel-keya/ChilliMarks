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

<form method="POST" action="{{ url('search-groups')}}">
	<div class="padded-full">
		{{ csrf_field() }}
		<input type="text" name="search" placeholder="Search groups here..." autocomplete="off" autofocus/>
	</div>
	<div class="padded-full">
		<button type="submit" class="btn fit-parent primary">Search</button>
	</div>
</form>
<div class="padded-full">
	<a href="{{ url('create-group') }}">
		<button class="btn fit-parent primary" style="margin-top: 10px;">Add New Group</button>
	</a>	
</div>
<div class="padded-full">
	<ul class="list" style="padding: 20px 0px 20px 0px;">
		<li class="divider text-center"><p>All Groups</p></li>
	</ul>
</div>
<div class="padded-full">
	<ul class="list">
		@foreach($groups as $group)
			<li>
				<a class="padded-list" href="{{ url('view-group', $group->id) }}">{{ $group->name }}</a>
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
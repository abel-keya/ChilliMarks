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
		<div class="padded-full text-justify">
				<p>You can create and restore the backup of all your data that currently exists in the Chilli App.</p> 
				<p>Note that <strong>the backup file will be in the form of an .sql.gz compressed file.</strong></p>
		</div>
		<div class="padded-full">
			<a href="{{ url('create-backup') }}">
				<button type="submit" class="btn fit-parent primary">Create Backup</button>
			</a>
		</div>
		<div class="padded-full">
			<ul class="list">
				@foreach($files as $file)
					<li class="padded-list">
						{{$file->getFilename()}}, {{$file->getSize()}} Bytes

						<form method="POST" action="{{ url('delete-backup') }}">
							{{ csrf_field() }}
							<input type="hidden" name="name" value="{{ $file->getRealpath() }}">
							<button type="submit" class="btn pull-right icon icon-close" style="margin:3px 3px 3px 3px;" title="Delete Backup"></button>
						</form>
			            
			            <form method="POST" action="{{ url('restore-backup') }}">
			            	{{ csrf_field() }}
			            	<input type="hidden" name="name" value="{{ $file->getRealpath()}}">
							<button type="submit" class="btn pull-right icon icon-sync" style="margin:3px 3px 3px 3px;" title="Restore Backup"></button>
			            </form>

					</li>
				@endforeach
			</ul>
		</div>

	<div class="padded-full">
	    <a href="{{ url('settings') }}"><button class="btn fit-parent">Go Back</button></a>
    </div>
@endsection

@section('partials-script')
	@if(Session::has('errors') || Session::has('error') || Session::has('info') || Session::has('success'))
		@include('core.partials.notify-script')
	@endif
@endsection
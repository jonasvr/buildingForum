@extends('layouts.front')
@section('banner')
@guest
<div class="jumbotron">
	<div class="container">
		<h1>Join {{ config('app.name', 'Laravel') }}s</h1>
		<p>help and get help</p>
		<p>
			<a class="btn btn-info btn-lg">welkom</a>
		</p>
	</div>
</div>
@endguest
@endsection
@section('heading','Threads')
@section('content')
	@include('thread.partials.thread-list')
@endsection

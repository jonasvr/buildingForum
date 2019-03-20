@extends('layouts.front')
@section('heading')
Threads
@endsection
@section('content')
<div class="card bg-light">
	@include('thread.partials.thread-list')
</div>
@endsection

@extends('layouts.front')
@section('extraInfo')
@include('thread.partials.threadTopicList')
@endsection
@section('heading')
Threads
@endsection
@section('content')
<div class="card bg-light">
	@include('thread.partials.thread-list')
</div>
@endsection

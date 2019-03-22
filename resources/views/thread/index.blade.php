@extends('layouts.front')
@section('extraInfo')
@include('thread.partials.threadTopicList')
@endsection
@section('heading')
Threads  @auth
{{-- btn btn-primary btn-xs --}}
	<a href="{{route('threads.create')}}" class="text-info"> <i class="fas fa-plus fa-xs"></i></a>
	@endauth
@endsection
@section('content')
<div class="card border-0">
	@include('thread.partials.thread-list')
</div>
@endsection

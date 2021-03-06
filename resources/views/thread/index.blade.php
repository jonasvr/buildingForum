@extends('layouts.front')
@section('page-title','Threads')
@section('extraInfo')
<div class="col-md-3">
@include('thread.partials.functions.create-button')
@include('thread.partials.functions.search-input')
@include('thread.partials.threadTopicList')
</div>
@endsection
@section('content')
<div class="col-md-9">
	@include('thread.partials.thread-list')
</div>
@endsection

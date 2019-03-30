@extends('layouts.front')
@section('page-title','Users')
@section('extraInfo')
<div class=" col-md-3">

{{-- <div class="comment-page-header">
	<h4>Roles</h4>
</div> --}}
<ul class="list-group">
	@foreach($roles as $role)
	@if($role->users()->count())
	<a href="{{route('threads.index',['roles'=>$role->id])}}" class="list-group-item">
		<span class="badge badge-secondary float-right">{{$role->users()->count()}}</span>
		{{$role->name}}
	</a>
	@endif
	@endforeach
</ul>
</div>
@endsection
@section('content')
<div class=" col-md-9">
	<ul class="list-group list-group-flush">
		@foreach($users as $user)
		<li class="list-group-item">
			<div class="float-left">{{$user->name}}</div>
			<div class="float-right">
				@foreach($user->roles as $role)
				{{-- {{dd($role)}} --}}
				{{$role->name}}
			@endforeach</div>
		</li>
		@endforeach
	</ul>
</div>
@endsection

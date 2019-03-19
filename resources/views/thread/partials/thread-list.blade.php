<div class="card-body">
    @include('layouts.partials.success')
    @auth
	<a href="{{route('threads.create')}}" class="btn btn-primary mb-2 col-md-1"> <i class="fas fa-plus"></i></a>
	@endauth
@forelse($threads as $thread)
	<a href="{{route('threads.show',$thread->id)}}" class="list-group-item list-group-flush">
		<h4 class="list-group-item-heading">{{$thread->subject}}</h4>
		<p class="list-group-item-text">{{str_limit($thread->thread,100)}}</p>
	</a>
@empty
	<h5>No threads</h5>
@endforelse
</div>

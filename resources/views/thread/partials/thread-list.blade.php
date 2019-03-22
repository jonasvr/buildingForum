@include('layouts.partials.success')
@forelse($threads as $thread)

	<div class="card mb-2">
            <div class="card-header bg-info">
                <h3 class=" card-title "><a class="text-white" href="{{route('threads.show',$thread->id)}}"> {{$thread->subject}}</a></h3>
            </div>
            <div class="card-body">
                <p>{{str_limit($thread->thread,100) }}
                	</p>
                    <p class="text-sm">
                    Posted by <a href="{{route('user_profile',$thread->user->name)}}">{{$thread->user->name}}</a> {{$thread->created_at->diffForHumans()}}
                </p>
            </div>
        </div>

	{{-- <a href="{{route('threads.show',$thread->id)}}" class="list-group-item list-group-flush">
		<h4 class="list-group-item-heading">{{$thread->subject}}</h4>
		<p class="list-group-item-text">{!! strip_tags(str_limit($thread->thread,100)) !!}</p>
	</a> --}}
@empty
	<h5>No threads</h5>
@endforelse

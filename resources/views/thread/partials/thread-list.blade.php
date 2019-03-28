<div class="card border-0">
    @include('layouts.partials.success')
    @forelse($threads as $thread)
    <div class="card mb-2">
        <div class="card-header bg-info">
            <h3 class=" card-title "><a class="text-white" href="{{route('threads.show',$thread->id)}}"> {{$thread->subject}}</a></h3>
            <p>
                @foreach($thread->tags as $tag)
                <a class="text-white" href="{{route('threads.index',['tags'=>$tag->id])}}">
                    #{{$tag->name}}
                </a>
                @endforeach
            </p>
        </div>
        <div class="card-body">
            <p>{!! str_limit($thread->thread,100) !!}
            </p>
            <p class="text-sm">
                Posted by <a href="{{route('user_profile',$thread->user->name)}}">{{$thread->user->name}}</a> {{$thread->created_at->diffForHumans()}}
            </p>
        </div>
    </div>
    @empty
    <h5>No threads</h5>
    @endforelse
</div>
{!! $threads->links() !!}

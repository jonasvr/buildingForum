@extends('layouts.front')

@section('extraInfo')
    <div class="row mt-3">
    <img class="img-fluid" src="https://dummyimage.com/300x200/000/fff" alt="">
    </div>
        <h3>
            {{$user->name}}
        </h3>


@endsection

@section('content')
<div>

    <h3>{{$user->name}}'s latest Threads</h3>

    @forelse($threads as $thread)

        <h5>{{$thread->subject}}</h5>
        <a href="{{route('threads.show',$thread->id)}}" class="">
        <span class="">{{$thread->comments()->count()}} Comments</span>
        <hr>
    </a>

    @empty
        <h5>No threads yet</h5>

    @endforelse
    <br>

    <h3>{{$user->name}}'s latest Comments</h3>

    @forelse($comments as $comment)
        <h5>{{$user->name}} commented on <a href=" {{route('threads.show',$comment->commentable->id)}}">{{$comment->commentable->subject}}</a>  {{$comment->created_at->diffForHumans()}}</h5>
    @empty
    <h5>No comments yet</h5>
    @endforelse
</div>

@endsection

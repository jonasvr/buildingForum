@extends('layouts.front')
@section('heading','Thread')
@section('content')
<div class="card-body">
    @include('layouts.partials.success')
    <h4>{{$thread->subject}}</h4>
    <hr>
    <div class="thread-details">
        {!!$thread->thread!!}
    </div>
    <br>
    @if(auth()->user()->id == $thread->user_id)
    <div class="actions">
        <a href="{{route('threads.edit',$thread->id)}}" class="btn btn-info btn-xs"><i class="fas fa-pen"></i></a>
        {{--//delete form--}}
        <form action="{{route('threads.destroy',$thread->id)}}" method="POST" class="inline-it">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button class="btn btn-xs btn-danger" type="submit"><i class="fas fa-trash"></i></button>
        </form>
    </div>
    @endif
    {{-- Awnser/comment --}}
    @if($thread->comments !== null)
    <div class="comment-list">
        @foreach($thread->comments as $comment)
        <div class="row">
            <div class="col-md-9">
                <h4>{{$comment->body}}</h4>
            </div>
            <div class="col-md-3">
                @if(Auth::user()->id === $comment->user_id)
                <div class="actions float-right">
                    <a class="btn btn-info btn-xs fas fa-xs fa-pen" data-toggle="modal" href="#{{$comment->id}}" data-target="#comment{{$comment->id}}"></a>
                    {{--//delete form--}}
                    <form action="{{route('comments.destroy',$comment->id)}}" method="POST" class="inline-it">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-xs btn-danger fas fa-xs fa-trash" type="submit"></button>
                    </form>
                </div>
                @else
                <span class="font-weight-light float-right">{{$comment->user->name}}</span>
                @endif
            </div>
        </div>
        @include('thread.partials.comment-edit-model')
        {{-- reply to comment --}}
        @if($comment->comments !== null)
        @foreach($comment->comments as $reply)
        <div class="row mt-3">
            <div class="offset-md-2 col-md-7">
                <p>{{$reply->body}}</p>
            </div>
            <div class="col-md-3">
                @if(Auth::user()->id === $reply->user_id)
                <div class="actions float-right">
                    <a class="btn btn-info btn-xs fas fa-xs fa-pen" data-toggle="modal" href="#{{$reply->id}}" data-target="#reply{{$reply->id}}"></a>
                    {{--//delete form--}}
                    <form action="{{route('comments.destroy',$reply->id)}}" method="POST" class="inline-it">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-xs btn-danger fas fa-xs fa-trash" type="submit"></button>
                    </form>
                </div>
                @else
                <span class="font-weight-light float-right">{{$reply->user->name}}</span>
                @endif
            </div>
        </div>
        @include('thread.partials.reply-edit-model')
        @endforeach
        @endif
        <div style="margin-left: 50px" class="reply-form">
            <form action="{{route('replycomment.store',$comment->id)}}" method="post" role="form">
                {{csrf_field()}}
                <div class="input-group">
                    <input type="text" class="form-control" name="body" id="" placeholder="Create Reply...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Reply</button>
                    </div>
                </div>
            </form>
        </div>
        <hr>
        @endforeach
    </div>
    @endif
    <div class="comment-form">
        <form action="{{route('threadcomment.store',$thread->id)}}" method="post" role="form">
            {{csrf_field()}}
            <div class="input-group">
                <input type="text" class="form-control" name="body" id="" autocomplete="off" placeholder="Create Comment...">
                <button type="submit" class="btn btn-primary">Comment</button>
            </div>
        </div>
    </form>
</div>
</div>
@endsection

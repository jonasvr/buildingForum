@if($thread->comments !== null)
<div class="comment-list">
    @foreach($thread->comments as $comment)
    <div class="card border-light bg-light mt-3" >
        <div class="card-body">
            <div class="row">

                <div class="col-md-3">
                    <span class="font-weight-light">
                        <a class="font-weight-light text-primary" href="{{ route('user_profile', $comment->user->name) }}">
                            {{$comment->user->name}}
                        </a>
                    </span>
                    <div class="actions">

                        @cannot('update',$comment)
                        <button class="{{$comment->isLiked()?"liked":""}} btn btn-xs fas fa-sm fa-heart" onclick="likeIt({{$comment->id}},this)" data-toggle="tooltip" data-placement="top" title="like"></button>
                        @endcannot

                        @can('update',$comment)
                        <button class="{{$comment->isLiked()?"liked":""}} btn btn-xs fas fa-sm fa-heart" disabled="true" data-toggle="tooltip" data-placement="top" title="like"></button>
                        @endcan

                        <button class="btn btn-xs " id="{{$comment->id}}-count">{{$comment->likes()->count()}}</button>
                        @if(!empty($thread->solution))
                        @if($thread->solution == $comment->id)
                        <button disabled="true" class="marked btn btn-xs fas fa-xs fa-check"   data-toggle="tooltip" data-placement="top" title="Marked as solution"></button>
                        @endif
                        @else
                        @can('update',$thread)
                        <a class="btn btn-xs fas fa-xs fa-check toMark" href="#" onclick="markAsSolution('{{$thread->id}}','{{$comment->id}}',this)" data-toggle="tooltip" data-placement="top" title="Mark as solution"></a>
                        @endcan
                        @endif


                        @if(Auth::user()->can('update',$comment))
                        <br>

                        <a class="btn btn-info btn-xs fas fa-xs fa-pen" data-toggle="modal" href="#{{$comment->id}}" data-target="#comment{{$comment->id}}"></a>
                        {{--//delete form--}}
                        <form action="{{route('comments.destroy',$comment->id)}}" method="POST" class="inline-it">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="btn btn-xs btn-danger fas fa-xs fa-trash" type="submit"></button>
                        </form>
                        @endif

                    </div>
                </div>
                <div class="col-md-9">
                        {{$comment->body}}
                </div>
            </div>
        </div>
    </div>
    @include('thread.partials.comment-edit-model')
    {{-- reply to comment --}}
    @if($comment->comments !== null)
    @foreach($comment->comments as $reply)
    <div class="card border-light bg-light mt-1" style="margin-left: 40px">
        <div class="bg-light">
            {{-- <div class="row "> --}}
                {{-- <div class="col-md-12 "> --}}
                    <div class="row p-3">

                        <div class="col-md-3">
                            <span class="font-weight-light">
                                <a class="font-weight-light text-primary" href="{{ route('user_profile', $reply->user->name) }}">
                                    {{$reply->user->name}}
                                </a>
                            </span>
                            @if(Auth::user()->can('update',$reply))
                            <br>
                            <div class="actions">
                                <a class="btn btn-info btn-xs fas fa-xs fa-pen" data-toggle="modal" href="#{{$reply->id}}" data-target="#reply{{$reply->id}}"></a>
                                {{--//delete form--}}
                                <form action="{{route('comments.destroy',$reply->id)}}" method="POST" class="inline-it">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button class="btn btn-xs btn-danger fas fa-xs fa-trash" type="submit"></button>
                                </form>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-9">
                            <p>{{$reply->body}}</p>
                        </div>
                    </div>
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
    </div>
    @include('thread.partials.reply-edit-model')
    @endforeach
    @endif
    <div class="mt-3">
        <button style="margin-left: 50px" type="button" class="btn btn-link add-reply-input" value="{{$comment->id}}">Reply...</button>
        <div style="margin-left: 50px" id="reply-input-{{$comment->id}}" class="reply-form d-none">
            <form action="{{route('replycomment.store',$comment->id)}}" method="post" role="form">
                {{csrf_field()}}
                <div class="input-group">
                    <input type="text" class="form-control" autocomplete="off" name="body" id="" placeholder="Create Reply...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Reply</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endif

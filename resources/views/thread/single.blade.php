@extends('layouts.front')
@section('heading','Thread')
@section('extraInfo')
@include('thread.partials.legend')
@endsection
@section('content')
<div class="card border-light bg-secondary text-white">
    <div class="card-body">
        @include('layouts.partials.success')
        <div class="row">
            <div class="h4 col-md-6">{{$thread->subject}}</div>
            <div class="h5 text-right col-md-6"> {{$thread->user->name}}</div>
        </div>
        <hr>
        <div class="row">
            <div class="thread-details col-md-12">
                {!!$thread->thread!!}
            </div>
            <br>
            @if(auth()->user()->id == $thread->user_id)
            <div class="col-md-3 mt-3">
                <div class="actions">
                    <a href="{{route('threads.edit',$thread->id)}}" class="btn btn-xs btn-info btn-xs fas fa-xs fa-pen"></a>
                    {{--//delete form--}}
                    <form action="{{route('threads.destroy',$thread->id)}}" method="POST" class="inline-it">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-xs btn-danger fas fa-xs fa-trash" type="submit"></button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
{{-- Awnser/comment --}}
@if($thread->comments !== null)
<div class="comment-list">
    @foreach($thread->comments as $comment)
    <div class="card border-light bg-light mt-3" >
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="">
                        {{$comment->body}}
                    </p>
                </div>
                <div class="col-md-3">
                    <hr>
                    <span class="font-weight-light">{{$comment->user->name}}</span>
                    <div class="actions">
                        @if(!empty($thread->solution))
                            @if($thread->solution == $comment->id)
                            <a class="btn btn-success btn-xs fas fa-xs fa-check"  href="#" data-toggle="tooltip" data-placement="top" title="Marked as solution"></a>
                            @endif
                        @else
                        {{-- @can('update',$thread) --}}
                        <a class="btn btn-default btn-xs fas fa-xs fa-check toMark" href="#" onclick="markAsSolution('{{$thread->id}}','{{$comment->id}}',this)" data-toggle="tooltip" data-placement="top" title="Mark as solution"></a>
                        {{-- @endcan --}}
                        @endif
                        @if(Auth::user()->id === $comment->user_id)

                        <a class="btn btn-info btn-xs fas fa-xs fa-pen" data-toggle="modal" href="#{{$comment->id}}" data-target="#comment{{$comment->id}}"></a>
                        {{--//delete form--}}
                        <form action="{{route('comments.destroy',$comment->id)}}" method="POST" class="inline-it">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button class="btn btn-xs btn-danger fas fa-xs fa-trash" type="submit"></button>
                        </form>
                        @else
                        <button class="btn btn-secondary btn-xs fas fa-xs fa-arrow-up" onclick="likeIt({{$comment->id}},this)" data-toggle="tooltip" data-placement="top" title="like"></button>
                        {{-- {{$comment->isLiked()?"liked":""}} --}}
                        @endif
                    </div>
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
                        <div class="col-md-9">
                            <p>{{$reply->body}}</p>
                        </div>
                        <div class="col-md-3">
                            <span class="font-weight-light float-right">{{$reply->user->name}}</span>
                            @if(Auth::user()->id === $reply->user_id)
                            <br>
                            <div class="actions float-right">
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
<div class="card border-light bg-light mt-3">
    <div class="card-body">
        <div class="comment-form">
            <form action="{{route('threadcomment.store',$thread->id)}}" method="post" role="form">
                {{csrf_field()}}
                <div class="input-group">
                    <input type="text" class="form-control" name="body" id="" autocomplete="off" placeholder="Create Comment...">
                    <button type="submit" class="btn btn-primary">Comment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
function markAsSolution(threadId, solutionId,elem) {
var csrfToken='{{csrf_token()}}';
$.post('{{route('markAsSolution')}}', {solutionId: solutionId, threadId: threadId,_token:csrfToken}, function (data) {
$(elem).removeClass();
$(elem).addClass("btn btn-success btn-xs fas fa-xs fa-check")
$('.toMark').remove();
});
}
</script>
<script>
$('.add-reply-input').on('click', function (event) {
event.preventDefault();
console.log($(this).val());
$('#reply-input-'+$(this).val()).removeClass('d-none');
$(this).addClass('d-none');
});
</script>
<script type="text/javascript">
$(function () {
$('[data-toggle="tooltip"]').tooltip()
})
</script>

<script>
function likeIt(commentId, elem) {
    console.log(elem);
var csrfToken='{{csrf_token()}}';
$.post('{{route('toggleLike')}}', {commentId: commentId,_token:csrfToken}, function (data) {
    console.log(data);
     if(data.message==='Liked'){
                        var classes = $(elem).attr('class');
                    classes = 'liked' +' ' +classes;
                    $(elem).attr('class', classes);
                   // $(elem).addClass('liked');
                   // console.log(elem)
                   // $('#'+commentId+"-count").text(likesCount+1);
               }else{
                   console.log("unliked");

                   // $('#'+commentId+"-count").text(likesCount-1);
                   $(elem).removeClass('liked');
               }
            });
}
</script>
@endsection
